<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Echo_;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = ("/LandingPage/landingpage");

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function validateLoginRequest($request){

        $validated = Validator::make($request->all(),[

            'email'=>'required|email',

            'password'=>'required|string|min:6',

        ]);



        return $validated;

    }

    public function login(Request $request){
        $validated = $this->validateLoginRequest($request);
        
        if ($validated->fails()) return redirect()->back()->withInput($request->all())->withErrors($validated->errors());

        $credential = $request->only('email','password');
        
        $isRemember = false;

        if($request->rememberMe != null) $isRemember = true;

        Auth::attempt($credential,$isRemember);

        if(Auth::check()){

            if($isRemember == true){

                $minute = 120;

                $rememberToken = Auth::getRecallerName();

                Cookie::queue($rememberToken,Cookie::get($rememberToken),$minute);

            }

            return showLoginForm();

        }
        else return redirect('/login')->with('failed',"Invalid email or password");
    }

    public function showLoginForm(){
        if(Auth::check()){
            return redirect('/LandingPage/landingpage');
        }
        else{   
            return view("auth/login");
        }
    }

    // public function logout(){
    //     Auth::logout();
    //     return redirect('/login');
    // } 
}
