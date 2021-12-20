<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\NewResetPasswordMail;
use App\Models\Foundation;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    protected function guard()
    {
        if (str_contains($_SERVER['HTTP_HOST'], 'foundation.'))
            return Auth::guard('foundations');
        else if (str_contains($_SERVER['HTTP_HOST'], 'donate.'))
            return Auth::guard('web');
    }

    protected function broker()
    {
        if (str_contains($_SERVER['HTTP_HOST'], 'foundation.'))
            return Password::broker('foundations');
        else if (str_contains($_SERVER['HTTP_HOST'], 'donate.'))
            return Password::broker('users');
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }

    public function ResetPassword($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::where('UserID', $id)->first();
        if ($user) {
            $newPassword = uniqid('BN');
            $user->Password = Hash::make($newPassword);
            $user->save();
            Auth::login($user);
            Mail::to($user->Email)->send(new NewResetPasswordMail($newPassword));
            Session::flash(
                'toastsuccess',
                'Password telah disetel ulang, silahkan cek email anda'
            );
            Auth::logout();
            return redirect('/login');
        }
        Auth::logout();
        return redirect()->back()->with('failed', "Pengguna tidak terdaftar di sistem kami");
    }

    public function ResetPasswordFoundation($id)
    {
        $id = Crypt::decrypt($id);
        $user = Foundation::where('FoundationID', $id)->first();
        if ($user) {
            $newPassword = uniqid('BN');
            $user->Password = Hash::make($newPassword);
            $user->save();
            Auth::guard('foundations')->login($user);
            Mail::to(
                $user->Email
            )->send(new NewResetPasswordMail($newPassword));
            Session::flash(
                'toastsuccess',
                'Password telah disetel ulang, silahkan cek email anda'
            );
            Auth::guard('foundations')->logout();
            return redirect('/login');
        }
        Auth::logout();
        return redirect()->back()->with('failed', "Pengguna tidak terdaftar di sistem kami");
    }
}
