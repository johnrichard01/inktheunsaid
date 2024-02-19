<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyController extends Controller
{
    public function send()
    {
        $user= Auth::user();
        return view('auth.verify-email', compact('user'));
    }
    public function verify(EmailVerificationRequest $request)
    {
            $request->fulfill();
         
            return redirect('/');
    }
    public function resend(Request $request)
    {
            $request->user()->sendEmailVerificationNotification();
            return back();  
    }
}
