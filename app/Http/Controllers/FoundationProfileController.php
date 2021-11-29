<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Foundation;
use App\Models\UserDocumentation;
use App\Models\FoundationPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Hash;

class FoundationProfileController extends Controller
{
    public function FoundationProfile($id){
        $foundationID = Crypt::decrypt($id);
        $foundation = Foundation::where('FoundationID', $foundationID)->with('FoundationPhoto')->first();
        $documentation = UserDocumentation::where('ID', $foundationID)->with('Documentation')->get();

        return view('FoundationProfile.profileyayasan', ['foundation'=>$foundation,'documentation'=>$documentation]);
    }

    public function EditFoundationProfile($id){
        $foundationID = Crypt::decrypt($id);
        $foundation = Foundation::where('FoundationID', $foundationID)->with('Address')->first();
        
        return view('FoundationProfile.editprofileyayasan', ['foundation' => $foundation]);
    }

    public function GetFoundationProfile($id){
        $foundationID = Crypt::decrypt($id);
        $foundation = Foundation::where('FoundationID', $foundationID)->with('Address')->with('FoundationPhoto')->first();
        $response = array('payload'=>$foundation);
        return response()->json($response);
    }

    public function Put(Request $request){
        $foundationid = Crypt::decrypt($request->FoundationID);
        $foundation = Foundation::where('FoundationID', $foundationid)->with('Address')->first();

        if ($request->Email == $foundation->Email && $request->Username != $foundation->Username)
            $validator = Validator::make($request->all(), [
                'FoundationName' => ['required', 'string', 'min:4', 'max:36'],
                'Username' => ['required', 'string', 'unique:msfoundation'],
                'FoundationPhone' => ['required', 'numeric', 'digits_between:10,13'],
                'Visi' => ['required', 'string', 'min:4', 'max:100'],
                'Misi' => ['required', 'string', 'min:4', 'max:255'],
                'Address' => ['required', 'string'],
                'Province' => ['required'],
                'City' => ['required']
            ]);
        else if ($request->Email != $foundation->Email && $request->Username == $foundation->Username)
            $validator = Validator::make($request->all(), [
                'FoundationName' => ['required', 'string', 'min:4', 'max:36'],
                'Email' => ['required', 'string', 'email', 'unique:msfoundation'],
                'FoundationPhone' => ['required', 'numeric', 'digits_between:10,13'],
                'Visi' => ['required', 'string', 'min:4', 'max:100'],
                'Misi' => ['required', 'string', 'min:4', 'max:255'],
                'Address' => ['required', 'string'],
                'Province' => ['required'],
                'City' => ['required']
            ]);
        else if ($request->Email == $foundation->Email && $request->Username == $foundation->Username)
            $validator = Validator::make($request->all(), [
                'FoundationName' => ['required', 'string', 'min:4', 'max:36'],
                'FoundationPhone' => ['required', 'numeric', 'digits_between:10,13'],
                'Visi' => ['required', 'string', 'min:4', 'max:100'],
                'Misi' => ['required', 'string', 'min:4', 'max:255'],
                'Address' => ['required', 'string'],
                'Province' => ['required'],
                'City' => ['required']
            ]);
        else {
            $validator = Validator::make($request->all(), [
                'FoundationName' => ['required', 'string', 'min:4', 'max:36'],
                'Email' => ['required', 'string', 'email', 'unique:msfoundation'],
                'Username' => ['required', 'string', 'unique:msfoundation'],
                'FoundationPhone' => ['required', 'numeric', 'digits_between:10,13'],
                'Visi' => ['required', 'string', 'min:4', 'max:100'],
                'Misi' => ['required', 'string', 'min:4', 'max:255'],
                'Address' => ['required', 'string'],
                'Province' => ['required'],
                'City' => ['required']
            ]);
        }
        $validator->validate();
        $foundation->FoundationName = $request->FoundationName;
        $foundation->Username = $request->Username;
        $foundation->Email = $request->Email;
        $foundation->FoundationPhone = $request->FoundationPhone;
        $foundation->Visi = $request->Visi;
        $foundation->Misi = $request->Misi;
        $foundation->updated_at = date('Y-m-d H:i:s');
        $foundation->IsConfirmed = 1;
        $address = Address::where('AddressID', $foundation->AddressID)->first();
        if (!$address) {
            $address = new Address();
            $address->ID = $foundation->FoundationID;
            $address->created_at = date('Y-m-d H:i:s');
        } else $address->updated_at = date('Y-m-d H:i:s');
        $address->Address = $request->Address;
        $address->ProvinceID = $request->Province;
        $address->CityID = $request->City;
        $address->save();
        if($address->id){
            $foundation->AddressID = $address->id;
        }else {
            $foundation->AddressID = $address->AddressID;
        }
        $foundation->save();
        $request->session()->flash('toastsuccess', 'Profile updated successfully');
        return redirect()->action('App\Http\Controllers\FoundationProfileController@editfoundationprofile', ['id' => Crypt::encrypt($foundationid)]);
    }

    public function UpdateBio(Request $request)
    {
        $foundation = Foundation::where('FoundationID', $request->FoundationID)->first();
        $foundation->Bio = $request->Bio;
        $foundation->save();
        return redirect()->back()->with('toastsuccess', 'Bio updated');
    }

    public function ChangePassword(Request $request){
        $foundationid = Crypt::decrypt($request->FoundationID);
        $foundation = Foundation::where('FoundationID', $foundationid)->first();
        if (!Hash::check($request->OldPassword, $foundation->Password)) {
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

        return redirect()->action('App\Http\Controllers\FoundationProfileController@editfoundationprofile', ['id' => $request->FoundationID]);
    }

    public function UpdateProfilePicture(Request $request)
    {
        $hashed = Hash::make(Crypt::decrypt($request->FoundationID));
        $hashed = str_replace('\\',';',$hashed);
        $hashed = str_replace('/',';',$hashed);
        $filename = $hashed . '.' . $request->file('ProfilePicture')->getClientOriginalExtension();
        $ftp = ftp_connect(env('FTP_SERVER'));
        $login_result = ftp_login($ftp, env('FTP_USERNAME'), env('FTP_PASSWORD'));
        $foundation = Foundation::where('FoundationID', Crypt::decrypt($request->FoundationID))->first();
        if ($foundation->PhotoID) {
            $photo = FoundationPhoto::where('PhotoID', $foundation->PhotoID)->first();
            $photo->updated_at = date('Y-m-d H:i:s');
        } else {
            $photo = new FoundationPhoto();
            $photo->created_at = date('Y-m-d H:i:s');
        }
        $path = $photo->Path;
        if ($path && ftp_size($ftp, 'ProfilePicture/Yayasan/' . $path) > 0)
            ftp_delete($ftp, 'ProfilePicture/Yayasan/' . $path);
        ftp_close($ftp);
        // Storage::disk('ftp')->delete('\\ProfilePicture\\Donatur\\' . $filename);
        Storage::disk('ftp')->put('ProfilePicture/Yayasan/' . $filename, fopen($request->file('ProfilePicture'), 'r+'));

        $photo->ID = $foundation->FoundationID;
        $photo->Path = $filename;
        $photo->Role = '1';
        $photo->save();
        if (!$foundation->PhotoID) $foundation->PhotoID = $photo->PhotoID;
        $foundation->save();

        $request->session()->flash('toastsuccess', 'Profile picture updated successfully');
        return redirect()->action('App\Http\Controllers\FoundationProfileController@foundationprofile', ['id' => $request->FoundationID]);
    }

    public function DeleteProfilePhoto(Request $request)
    {
        $foundationid = Crypt::decrypt($request->FoundationID);
        $ftp = ftp_connect(env('FTP_SERVER'));
        $login_result = ftp_login($ftp, env('FTP_USERNAME'), env('FTP_PASSWORD'));
        $foundation = Foundation::where('FoundationID', $foundationid)->first();
        if ($foundation->PhotoID) {
            $photo = FoundationPhoto::where('PhotoID', $foundation->PhotoID)->first();
            $photo->updated_at = date('Y-m-d H:i:s');
            $path = $photo->Path;
            if ($path && ftp_size($ftp, 'ProfilePicture/Yayasan/' . $path) > 0)
                ftp_delete($ftp, 'ProfilePicture/Yayasan/' . $path);
            $photo->Path = '';
            $photo->save();
        }
        ftp_close($ftp);
        $request->session()->flash('toastsuccess', 'Profile picture has been deleted');
        return redirect()->action('App\Http\Controllers\FoundationProfileController@foundationprofile', ['id' => $request->FoundationID]);
    }

}
