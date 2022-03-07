<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\LevelGrade;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Registered;

use App\Models\Foundation;
use App\Models\Level;
use App\Models\User;
use App\Models\UserLevel;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = ('/landingpage');

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:50', 'unique:msuser,email','unique:msfoundation,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'max:20'],
            'phoneNumber' => ['required', 'numeric', 'digits_between:10,13']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    protected function register(Request $request){

        $this->validator($request->all())->validate();

        if($request['registerAs']=='1'){
            $user = new User; 
            $user->email = $request['email'];
            $user->password = Hash::make($request['password']);
            $user->phoneNumber = $request['phoneNumber'];
            $user->registerDate = Carbon::now()->toDateTimeString();
            $user->Role = '1';
            $user->created_at = date('Y-m-d H:i:s');
            $user->save(); 

            $userlastId = $user->UserID;

            $userlevel = new UserLevel;
            $userlevel->UserID = $userlastId;
            $userlevel->LevelGradeID = 1;
            $userlevel->IsCurrentLevel = 1;
            $userlevel->ReceivedDate = Carbon::now()->toDateTimeString();
            $userlevel->created_at = date('Y-m-d H:i:s');
            $userlevel->save();

            $userlevellastid = $userlevel->LevelID;

            $level = new Level();
            $level->LevelID = $userlevellastid;
            $level->Exp = 2500;
            $level->ReceivedDate = Carbon::now()->toDateTimeString();
            $level->created_at = date('Y-m-d H:i:s');
            $level->save();

            
            $this->guard()->login($user);

            if ($response = $this->registered($request, $user)) {
                Mail::to($user->email)->send(new VerificationMail());
                Auth::logout();
                return redirect('/verifyEmailSent');
                return $response;
                
            }
            Mail::to($user->email)->send(new VerificationMail());
            Auth::logout();
        
            return redirect('/verifyEmailSent');
            // return $request->wantsJson()
            //             ? new JsonResponse([], 201)
            //             : redirect($this->redirectPath());

        }
        else if($request['registerAs']=='2'){
            $foundation = new Foundation; 
            $foundation->email = $request['email'];
            $foundation->password = Hash::make($request['password']);
            $foundation->foundationPhone = $request['phoneNumber'];
            $foundation->registerDate = Carbon::now()->toDateTimeString();
            $foundation->Role = '2';
            $foundation->created_at = date('Y-m-d H:i:s');
            $foundation->save();


            // $this->guard()->login($foundation);
            Auth::guard('foundations')->login($foundation);


            if ($response = $this->registered($request, $foundation)) {
                Mail::to($foundation->email)->send(new VerificationMail());
                Auth::guard('foundations')->logout();
                return redirect('/verifyEmailSent');
                return $response;
            }

            Mail::to($foundation->email)->send(new VerificationMail());
            Auth::guard('foundations')->logout();
            return redirect('/verifyEmailSent');
            // return $request->wantsJson()
            //             ? new JsonResponse([], 201)
            //             : redirect($this->redirectPath());
        }
    }


    public function VerifikasiEmailUser($id){
        $userId = Crypt::decrypt($id);
        
        $user = User::where('UserID',$userId)->first();
        $user->EmailVerified = 1;
       
        
        try{
            $user->save();
        
            return view('/Verification/verifyEmailResult');
        }catch(Exception $e){
            throw $e;
        }
    }

    public function VerifikasiEmailFoundation($id){
        $foundationId = Crypt::decrypt($id);
        
        $foundation = Foundation::where('FoundationID',$foundationId)->first();
        $foundation->EmailVerified = 1;
       
        
        try{
            $foundation->save();

            return view('/Verification/verifyEmailResult');
        }catch(Exception $e){
            throw $e;
        }
        
        
    }
}