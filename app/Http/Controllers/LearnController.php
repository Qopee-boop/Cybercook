<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\UserProgress;
use Illuminate\Support\Facades\Auth;

class LearnController extends Controller
{
    public function index()
    {
        $modules = Module::where('is_active', true)->orderBy('title')->get();

        // progress map: module_id => percent
        $progress = UserProgress::where('user_id', Auth::id())
            ->pluck('percent_complete', 'module_id');

        return view('learn.index', compact('modules','progress'));
    }
}
