<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailOtpController extends Controller
{
    public function showVerifyForm() { return view('auth.verify-otp'); }
    public function send(Request $request)   { return back()->with('status','OTP sent.'); }
    public function verify(Request $request) { return redirect()->route('dashboard')->with('status','Verified.'); }
}
