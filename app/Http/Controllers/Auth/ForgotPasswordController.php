<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Mail\VerificationMail;
use App\Models\Foundation;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        if (str_contains($_SERVER['HTTP_HOST'], 'foundation.')) {
            $User = Foundation::where('Email', $request->email)->first();
            Auth::guard('foundations')->login($User);
        } else if (str_contains($_SERVER['HTTP_HOST'], 'donate.')) {
            $User = User::where('Email', $request->email)->first();
            Auth::login($User);
        }
        if ($User) {
            Mail::to($request->email)->send(new ResetPasswordMail());
            $request->session()->flash(
                'toastsuccess',
                'Email telah terkirim untuk setel ulang password'
            );
            Auth::logout();
            Auth::guard('foundations')->logout();
            return redirect('/login');
        }
        Auth::logout();
        Auth::guard('foundations')->logout();
        return redirect()->back()->with('failed', "Email tidak terdaftar di sistem kami");
    }
}
