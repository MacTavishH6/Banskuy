<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BannedAccount;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function validateLoginRequest($request)
    {

        $validated = Validator::make($request->all(), [

            'username' => 'required',

            'password' => 'required|string|min:6',

        ]);

        return $validated;
    }

    public function username()
    {
        return 'username';
    }
    
    public function login(Request $request)
    {
        $validated = $this->validateLoginRequest($request);

        if ($validated->fails()) return redirect()->back()->withInput($request->all())->withErrors($validated->errors());

        $credential = $request->only('username', 'password');        
        $isRemember = false;

        if ($request->rememberMe != null) $isRemember = true;

        if (Auth::guard('admin')->attempt($credential, $isRemember)) {
            if ($isRemember == true) {
                $minute = 120;
                $rememberToken = Auth::getRecallerName();
                Cookie::queue($rememberToken, Cookie::get($rememberToken), $minute);
            }
            return redirect('/landingpage');
        } else return redirect('/login')->with('failed', "Email atau password salah");
    }
}
