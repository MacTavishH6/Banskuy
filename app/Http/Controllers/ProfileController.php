<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\UserDocumentation;
use App\Models\UserLevel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class ProfileController extends Controller
{
    public function Profile($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::where('UserID', $id)->with('UserLevel.LevelGrade')->with('Photo')->first();
        $post = Post::where([['ID', $id],['RoleID', '1']])->paginate(15);
        $documentation = UserDocumentation::where('ID', $id)->with('Documentation')->get();
        return view('Profile.profile', ['user' => $user, 'posts' => $post, 'documentation' => $documentation]);
    }

    public function GetProfile($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::where('UserID', $id)->with('UserLevel.LevelGrade')->with('Address')->with('Photo')->first();
        $response = array('payload' => $user);
        return response()->json($response);
    }

    public function EditProfile($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::where('UserID', $id)->with('Address')->first();
        return view('Profile.editprofile', ['user' => $user]);
    }

    public function Put(Request $request)
    {
        $id = Crypt::decrypt($request->UserID);
        $user = User::where('UserID', $id)->with('Address')->first();
        if ($request->Email == $user->Email && $request->Username != $user->Username)
            $validator = Validator::make($request->all(), [
                'FirstName' => ['required', 'string', 'min:4', 'max:36'],
                'LastName' => ['required', 'string', 'min:4', 'max:36'],
                'Username' => ['required', 'string', 'unique:msuser'],
                'PhoneNumber' => ['required', 'numeric', 'digits_between:10,13'],
                'Gender' => ['required'],
                'Address' => ['required', 'string'],
                'Province' => ['required'],
                'City' => ['required']
            ]);
        else if ($request->Email != $user->Email && $request->Username == $user->Username)
            $validator = Validator::make($request->all(), [
                'FirstName' => ['required', 'string', 'min:4', 'max:36'],
                'LastName' => ['required', 'string', 'min:4', 'max:36'],
                'Email' => ['required', 'string', 'email', 'unique:msuser'],
                'PhoneNumber' => ['required', 'numeric', 'digits_between:10,13'],
                'Gender' => ['required'],
                'Address' => ['required', 'string'],
                'Province' => ['required'],
                'City' => ['required']
            ]);
        else if ($request->Email == $user->Email && $request->Username == $user->Username)
            $validator = Validator::make($request->all(), [
                'FirstName' => ['required', 'string', 'min:4', 'max:36'],
                'LastName' => ['required', 'string', 'min:4', 'max:36'],
                'PhoneNumber' => ['required', 'numeric', 'digits_between:10,13'],
                'Gender' => ['required'],
                'Address' => ['required', 'string'],
                'Province' => ['required'],
                'City' => ['required']
            ]);
        else {
            $validator = Validator::make($request->all(), [
                'FirstName' => ['required', 'string', 'min:4', 'max:36'],
                'LastName' => ['required', 'string', 'min:4', 'max:36'],
                'Email' => ['required', 'string', 'email', 'unique:msuser'],
                'Username' => ['required', 'string', 'unique:msuser'],
                'PhoneNumber' => ['required', 'numeric', 'digits_between:10,13'],
                'Gender' => ['required'],
                'Address' => ['required', 'string'],
                'Province' => ['required'],
                'City' => ['required']
            ]);
        }
        $validator->validate();
        $user->FirstName = $request->FirstName;
        $user->LastName = $request->LastName;
        $user->Username = $request->Username;
        $user->Gender = $request->Gender;
        $user->Email = $request->Email;
        $user->PhoneNumber = $request->PhoneNumber;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->IsConfirmed = 1;
        $address = Address::where('AddressID', $user->AddressID)->first();
        if (!$user->AddressID || !$address) {
            $address = new Address();
            $address->ID = $user->UserID;
            $address->created_at = date('Y-m-d H:i:s');
        } else $address->updated_at = date('Y-m-d H:i:s');
        $address->Address = $request->Address;
        $address->ProvinceID = $request->Province;
        $address->CityID = $request->City;
        $address->save();
        $user->AddressID = $address->AddressID;
        $user->save();
        $request->session()->flash('toastsuccess', 'Profile updated successfully');
        return redirect()->action('App\Http\Controllers\ProfileController@editprofile', ['id' => Crypt::encrypt($id)]);
    }

    public function UpdateBio(Request $request)
    {
        $user = User::where('UserID', $request->UserID)->first();
        $user->Bio = $request->Bio;
        $user->save();
        return redirect()->back()->with('toastsuccess', 'Bio updated');
    }

    public function ChangePassword(Request $request)
    {
        $id = Crypt::decrypt($request->UserID);
        $user = User::where('UserID', $id)->first();
        if (!Hash::check($request->OldPassword, $user->Password)) {
            $msg = new MessageBag();
            $msg->add('OldPassword', 'Old password not match our record!');
            return redirect()->back()->withErrors($msg);
        }
        $validator = Validator::make($request->all(), [
            'NewPassword' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        // Tambahin send email

        return redirect()->action('App\Http\Controllers\ProfileController@editprofile', ['id' => $request->UserID]);
    }

    public function UpdateProfilePicture(Request $request)
    {
        $hashed = Hash::make(Crypt::decrypt($request->UserID));
        $hashed = str_replace('\\',';',$hashed);
        $hashed = str_replace('/',';',$hashed);
        $filename = $hashed . '.' . $request->file('ProfilePicture')->getClientOriginalExtension();
        $ftp = ftp_connect(env('FTP_SERVER'));
        $login_result = ftp_login($ftp, env('FTP_USERNAME'), env('FTP_PASSWORD'));
        $user = User::where('UserID', Crypt::decrypt($request->UserID))->first();
        if ($user->PhotoID) {
            $photo = Photo::where('PhotoID', $user->PhotoID)->first();
            $photo->updated_at = date('Y-m-d H:i:s');
        } else {
            $photo = new Photo();
            $photo->created_at = date('Y-m-d H:i:s');
        }
        $path = $photo->Path;
        if ($path && ftp_size($ftp, 'ProfilePicture/Donatur/' . $path) > 0)
            ftp_delete($ftp, 'ProfilePicture/Donatur/' . $path);
        ftp_close($ftp);
        // Storage::disk('ftp')->delete('\\ProfilePicture\\Donatur\\' . $filename);
        Storage::disk('ftp')->put('ProfilePicture/Donatur/' . $filename, fopen($request->file('ProfilePicture'), 'r+'));

        $photo->ID = $user->UserID;
        $photo->Path = $filename;
        $photo->Role = '1';
        $photo->save();
        if (!$user->PhotoID) $user->PhotoID = $photo->PhotoID;
        $user->save();

        $request->session()->flash('toastsuccess', 'Profile picture updated successfully');
        return redirect()->action('App\Http\Controllers\ProfileController@profile', ['id' => $request->UserID]);
    }

    public function DeleteProfilePhoto(Request $request)
    {
        $id = Crypt::decrypt($request->UserID);
        $ftp = ftp_connect(env('FTP_SERVER'));
        $login_result = ftp_login($ftp, env('FTP_USERNAME'), env('FTP_PASSWORD'));
        $user = User::where('UserID', $id)->first();
        if ($user->PhotoID) {
            $photo = Photo::where('PhotoID', $user->PhotoID)->first();
            $photo->updated_at = date('Y-m-d H:i:s');
            $path = $photo->Path;
            if ($path && ftp_size($ftp, 'ProfilePicture/Donatur/' . $path) > 0)
                ftp_delete($ftp, 'ProfilePicture/Donatur/' . $path);
            $photo->Path = '';
            $photo->save();
        }
        ftp_close($ftp);
        $request->session()->flash('toastsuccess', 'Profile picture has been deleted');
        return redirect()->action('App\Http\Controllers\ProfileController@profile', ['id' => $request->UserID]);
    }

    public function GetUserListPost($id){
        $id = Crypt::decrypt($id);
        $post = Post::where([["ID", $id],["RoleID", "1"]])->get();
        $response = ['payload' => $post];
        return response()->json($response);
    }
}
