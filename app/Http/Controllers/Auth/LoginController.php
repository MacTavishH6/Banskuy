<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Foundation;
use App\Models\User;
use App\Models\BannedAccount;
use Carbon\Carbon;
use DateTime;
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
    protected $redirectTo = ("/");

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
            
            if(Auth::user()->EmailVerified != 1){
                Auth::logout();
                return redirect('/login')->with('failed',"Silahkan verifikasi email anda terlebih dahulu"); 
            }

            $banned = BannedAccount::where([['ID',Auth::user()->UserID],['RoleID','1']])->first();
            
            if($banned!=NULL){
                $timenow = strtotime(Carbon::now()->toDateTimeString());
                $timeban = strtotime($banned->created_at);
                $totalhourban = abs($timenow - $timeban)/(60*60);

                if($totalhourban < $banned->BanDuration){
                    Auth::logout();
                    return redirect('/login')->with('failed',"Akun anda sedang diblokir oleh sistem, silahkan tunggu sampai akun anda bisa diakses lagi");
                }
            }

            if($isRemember == true){
                $minute = 120;
                $rememberToken = Auth::getRecallerName();
                Cookie::queue($rememberToken,Cookie::get($rememberToken),$minute);
            }
            return $this->showLoginForm();
        }
        else return redirect('/login')->with('failed',"Email atau password salah");
    }

    public function loginFoundation(Request $request){
        $credential = $request->only('email','password');

        if(Auth::guard('foundations')->attempt($credential)){
            if(Auth::guard('foundations')->user()->EmailVerified != 1){
                Auth::guard('foundations')->logout();
                return redirect('/foundationlogin')->with('failed',"Silahkan verifikasi email anda terlebih dahulu"); 
            }

            $banned = BannedAccount::where([['ID',Auth::guard('foundations')->user()->FoundationID],['RoleID','2']])->first();
            
            if($banned!=NULL){
                $timenow = strtotime(Carbon::now()->toDateTimeString());
                $timeban = strtotime($banned->created_at);
                $totalhourban = abs($timenow - $timeban)/(60*60);
                
                if($totalhourban < $banned->BanDuration){
                    Auth::guard('foundations')->logout();
                    return redirect('/foundationlogin')->with('failed',"Akun anda sedang diblokir oleh sistem, silahkan tunggu sampai akun anda bisa diakses lagi");
                }
            }

            if($isRemember == true){
                $minute = 120;
                $rememberToken = Auth::getRecallerName();
                Cookie::queue($rememberToken,Cookie::get($rememberToken),$minute);
            }

            return $this->showLoginForm();
        }
        else return redirect('/foundationlogin')->with('failed',"Email atau password salah");    
    }

    public function showLoginForm(){
        if(Auth::check()){
            return redirect('/landingpage');
        }
        else{   
            if(Auth::guard('foundations')->check()){
                return redirect('/landingpage');
            }
            return view("auth/login");
        }
    }

    public function logout(){
        Auth::logout();
        Auth::guard('foundations')->logout();
        Auth::guard('admin')->logout();
        return redirect('/login');
    } 
}
