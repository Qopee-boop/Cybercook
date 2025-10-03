<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    // Simple ownership check
    private function ensureOwner(int $userId)
    {
        abort_unless(auth()->id() === $userId, 403);
    }

    // Page that shows an embedded PDF
    public function show(QuizAttempt $attempt)
    {
        $this->ensureOwner($attempt->user_id);

        // Ensure certificate exists (your service already issues it on pass)
        $cert = $attempt->certificate ?? app(\App\Services\CertificateService::class)->issueForAttempt($attempt);

        // If still no cert (e.g., the attempt didn’t pass), bounce
        abort_unless($cert && $attempt->score >= ($attempt->module->pass_score ?? 70), 404);

        return view('certificates.show', [
            'attempt' => $attempt->load('module'),
            'certificate' => $cert,
        ]);
    }

    // Stream the stored PDF inline from private storage
    public function stream(Certificate $certificate)
    {
        $this->ensureOwner($certificate->user_id);

        // File lives on a private disk, stream with Content-Disposition:inline
        $disk = $certificate->disk ?? 'local';
        $path = $certificate->path;   // e.g. certificates/ABC123.pdf

        // Use Storage::response() for proper headers
        return Storage::disk($disk)->response($path, basename($path), [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.basename($path).'"',
            'Cache-Control'       => 'no-store, no-cache, must-revalidate',
            'Pragma'              => 'no-cache',
            'X-Content-Type-Options' => 'nosniff',
            // Optional hardening for iframe display:
            'X-Frame-Options'     => 'SAMEORIGIN',
        ]);
    }
}
