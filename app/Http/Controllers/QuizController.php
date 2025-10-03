<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Question;
use App\Models\QuizAttempt;
use App\Models\QuestionAttempt;
use App\Models\UserProgress;
use App\Services\AdaptiveSelector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class QuizController extends Controller
{
    public function start(Request $request, Module $module)
    {
        // idempotent start: resume latest incomplete attempt or create new
        $attempt = QuizAttempt::where('user_id', Auth::id())
            ->where('module_id', $module->id)
            ->whereNull('completed_at')
            ->latest()->first();

        if (!$attempt) {
            $attempt = new QuizAttempt();
            $attempt->user_id = Auth::id();
            $attempt->module_id = $module->id;
            $attempt->target_questions = (int) config('quiz.questions_per_attempt', 8);
            $attempt->time_limit_sec   = config('quiz.time_limit_sec'); // null or int
            $attempt->started_at = now();
            $attempt->save();
        }

        return redirect()->route('quiz.show', $attempt);
    }

    public function show(QuizAttempt $attempt, AdaptiveSelector $selector)
    {
        $this->authorizeAttempt($attempt);

        // timer enforcement
        if ($attempt->time_limit_sec && $attempt->started_at && now()->diffInSeconds($attempt->started_at) > $attempt->time_limit_sec) {
            return $this->finish(request(), $attempt);
        }

        // if we already reached target, finish
        $asked = $attempt->questionAttempts()->count();
        if ($asked >= $attempt->target_questions) {
            return redirect()->route('quiz.result', $attempt);
        }

        // pick next question
        $question = $selector->nextQuestion($attempt);
        if (!$question) {
            // nothing left to ask -> finish
            return redirect()->route('quiz.result', $attempt);
        }

        return view('quiz.take', [
            'attempt' => $attempt,
            'question'=> $question,
            'asked'   => $asked,
        ]);
    }

    public function answer(Request $request, QuizAttempt $attempt)
    {
        $this->authorizeAttempt($attempt);

        // Enforce time limit server-side
        if ($attempt->time_limit_sec && now()->diffInSeconds($attempt->started_at) > $attempt->time_limit_sec) {
            return $this->finish($request, $attempt);
        }

        // Validate payload depending on type
        $question = Question::findOrFail($request->input('question_id'));
        abort_unless($question->module_id === $attempt->module_id, 403);

        $data = $request->validate([
            'question_id' => 'required|integer',
            'type'        => 'required|in:mcq,truefalse,fib',
            'answer'      => 'nullable', // rules by type below
            'time_taken'  => 'nullable|integer|min:0'
        ]); // request validation pattern per docs. :contentReference[oaicite:6]{index=6}

        // normalize user answer -> array of strings
        $userAns = [];
        if ($data['type'] === 'mcq') {
            $val = $request->input('answer');
            $userAns = is_array($val) ? array_map('strval', $val) : [(string) $val];
        } elseif ($data['type'] === 'truefalse') {
            $userAns = [ $request->boolean('answer') ? 'true' : 'false' ];
        } else { // fib
            $userAns = [ trim((string) $request->input('answer')) ];
        }

        // compute correctness (string compare, case-insensitive for fib)
        $correctArr = array_map('strval', $question->answer ?? []);
        $isCorrect = false;
        if ($question->type === 'fib') {
            $canon = array_map(fn($s) => mb_strtolower(trim($s)), $correctArr);
            $isCorrect = in_array(mb_strtolower(trim($userAns[0] ?? '')), $canon, true);
        } else {
            sort($correctArr); $ua = $userAns; sort($ua);
            $isCorrect = $ua === $correctArr;
        }

        // upsert QA (avoid dupes if user refreshes)
        $qa = QuestionAttempt::firstOrCreate([
            'quiz_attempt_id' => $attempt->id,
            'question_id'     => $question->id,
        ], [
            'user_answer'     => $userAns,
            'is_correct'      => $isCorrect,
            'time_taken_sec'  => (int) ($data['time_taken'] ?? 0),
        ]);

        if ($qa->wasRecentlyCreated === false) {
            $qa->update([
                'user_answer'    => $userAns,
                'is_correct'     => $isCorrect,
                'time_taken_sec' => (int) ($data['time_taken'] ?? 0),
            ]);
        }

        // progress hint
        $asked = $attempt->questionAttempts()->count();
        if ($asked >= $attempt->target_questions) {
            return redirect()->route('quiz.result', $attempt);
        }
        return redirect()->route('quiz.show', $attempt);
    }

    public function finish(Request $request, QuizAttempt $attempt = null)
    {
        // allow show() to call finish($attempt) internally
        if ($attempt === null) { $attempt = $request->route('attempt'); }

        $this->authorizeAttempt($attempt);

        if ($attempt->completed_at) {
            return redirect()->route('quiz.result', $attempt);
        }

       // compute score
$total   = max(1, $attempt->questionAttempts()->count());
$correct = $attempt->questionAttempts()->where('is_correct', true)->count();
$score   = (int) round(($correct / $total) * 100);

// Save attempt + progress atomically
DB::transaction(function () use ($attempt, $score) {
    $attempt->score        = $score;
    $attempt->completed_at = now();
    $attempt->duration_sec = now()->diffInSeconds($attempt->started_at);
    $attempt->save();

    // update progress (simple: completed if pass)
    $pass    = $attempt->module->pass_score ?? 70;
    $status  = $score >= $pass ? 'completed' : 'in_progress';
    $percent = $score >= $pass ? 100 : max($score, 10);

    \App\Models\UserProgress::updateOrCreate(
        ['user_id' => $attempt->user_id, 'module_id' => $attempt->module_id],
        ['status' => $status, 'percent_complete' => $percent, 'last_activity_at' => now()]
    );
});

// Post-commit hooks (safe to run after data is persisted)

// Issue certificate if passed
if ($score >= ($attempt->module->pass_score ?? 70)) {
    app(\App\Services\CertificateService::class)->issueForAttempt($attempt);
}

// Award badges based on this attempt
app(\App\Services\BadgeService::class)->checkAndAward($attempt);

return redirect()->route('quiz.result', $attempt);
  
   
        // Issue certificate if passed
if ($score >= ($attempt->module->pass_score ?? 70)) {
    app(\App\Services\CertificateService::class)->issueForAttempt($attempt);
}

// Award badges based on this attempt
app(\App\Services\BadgeService::class)->checkAndAward($attempt);

        

        return redirect()->route('quiz.result', $attempt);
    }

    public function result(QuizAttempt $attempt)
    {
        $this->authorizeAttempt($attempt);

        $qas = $attempt->questionAttempts()->with('question')->get();
        return view('quiz.result', compact('attempt','qas'));
    }

    private function authorizeAttempt(QuizAttempt $attempt): void
    {
        abort_unless($attempt->user_id === Auth::id(), 403); // simple ownership check. See policies/gates docs if you prefer. :contentReference[oaicite:7]{index=7}
    }
}
