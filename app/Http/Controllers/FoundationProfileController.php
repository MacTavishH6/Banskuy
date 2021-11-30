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
use Carbon\Carbon;
use Auth;
use App\Models\Document;

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
        $foundation = Foundation::where('FoundationID', $foundationID)->with('Address')->with('Address.Province')->with('Address.City')->with('FoundationPhoto')->first();
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

    public function DeleteDocument($DocumentTypeID){
        $FoundationID = Auth::guard('foundations')->user()->FoundationID;
        $ftp = ftp_connect(env('FTP_SERVER'));
        $login_result = ftp_login($ftp, env('FTP_USERNAME'), env('FTP_PASSWORD'));
        $ExistingDocument = Document::where('FoundationID',$FoundationID)->where('DocumentTypeID',$DocumentTypeID)->first();
        if ($ExistingDocument != null) {
            $path = $ExistingDocument->Path;
            if ($path && ftp_size($ftp, env('FTP_URL').'DocumentYayasan/' . $path) > 0)
                ftp_delete($ftp, 'DocumentYayasan/' . $path);
        }
        else{
            ftp_close($ftp);
            return false;
        }

        ftp_close($ftp);
        return true;
    }


    //27 Nov 2021 - Fikri for document

    public function ValidateDocument(Request $request){
        
        if($request->hasFile('OwnerIdentityCard') || $request->hasFile('FoundationCertificate') || $request->hasFile('FoundationOperationalPermit') || $request->hasFile('FoundationRegistrationPermit')){
            return true;
        }
        else{
            return false;
        }
    }

    public function ReUploadDocument(Request $request){
        if($request->hasFile('reuploadDocument')){
            $EncodeFile = Hash::make("document.".Auth::guard('foundations')->user()->FoundationID.$request->file('reuploadDocument')->getClientOriginalName());
            $EncodeFile = str_replace(array('/'),'',$EncodeFile) . '.jpg';
            $FoundationID = Auth::guard('foundations')->user()->FoundationID;
            $ExistingDocument = Document::where('FoundationID',$FoundationID)->where('DocumentTypeID',$request->txtDocumentTypeIDPopUp)->first();
    
                if($this->DeleteDocument($ExistingDocument->DocumentTypeID)){
                    $ExistingDocument->DocumentName = $request->file('reuploadDocument')->getClientOriginalName();
                    $ExistingDocument->Path = $EncodeFile;
                    $ExistingDocument->save();
                }
                else{
                    $request->session()->flash('toastfailed', 'Error when upload document');
                    return redirect()->back();
                
                }
            Storage::disk('ftp')->put('DocumentYayasan/'.$EncodeFile,fopen($request->file('reuploadDocument'),'r+'));
            $request->session()->flash('toastfailed', 'Upload dokumen berhasil');
            return response()->json('');
        }
    }

    public function UploadDocument(Request $request){
        if($this->ValidateDocument($request)){
            //Upload to FTP
            if($request->hasFile('OwnerIdentityCard')){
                $EncodeFile = Hash::make("document.".Auth::guard('foundations')->user()->FoundationID.$request->file('OwnerIdentityCard')->getClientOriginalName());
                $EncodeFile = str_replace(array('/'),'',$EncodeFile) . '.jpg';
                $FoundationID = Auth::guard('foundations')->user()->FoundationID;
                $ExistingDocument = Document::where('FoundationID',$FoundationID)->where('DocumentTypeID',1)->first();
                if($ExistingDocument == null){
                    $Document = new Document();
                    $Document->FoundationID = $FoundationID;
                    $Document->DocumentTypeID = 1;
                    $Document->DocumentName = $request->file('OwnerIdentityCard')->getClientOriginalName();
                    $Document->ApprovalStatusID = 1;
                    $Document->UploadDate = Carbon::now();
                    $Document->ReviewDate = Carbon::now();
                    $Document->Path = $EncodeFile;
                    $Document->save();
                }
                else{
                    if($this->DeleteDocument($ExistingDocument->DocumentTypeID)){
                        $ExistingDocument->DocumentName = $request->file('OwnerIdentityCard')->getClientOriginalName();
                        $ExistingDocument->Path = $EncodeFile;
                        $ExistingDocument->save();
                    }
                    else{
                        $request->session()->flash('toastfailed', 'Error when upload document');
                        return redirect()->back();
                    }
                }
                
                Storage::disk('ftp')->put('DocumentYayasan/'.$EncodeFile,fopen($request->file('OwnerIdentityCard'),'r+'));              


            }
            if($request->hasFile('FoundationCertificate')){
                $EncodeFile = Hash::make("document.".Auth::guard('foundations')->user()->FoundationID.$request->file('FoundationCertificate')->getClientOriginalName());
                $EncodeFile = str_replace(array('/'),'',$EncodeFile) . '.jpg';
                $FoundationID = Auth::guard('foundations')->user()->FoundationID;
                $ExistingDocument = Document::where('FoundationID',$FoundationID)->where('DocumentTypeID',2)->first();
                if($ExistingDocument == null){
                    $Document = new Document();
                    $Document->FoundationID = $FoundationID;
                    $Document->DocumentTypeID = 2;
                    $Document->DocumentName = $request->file('FoundationCertificate')->getClientOriginalName();
                    $Document->ApprovalStatusID = 1;
                    $Document->UploadDate = Carbon::now();
                    $Document->ReviewDate = Carbon::now();
                    $Document->Path = $EncodeFile;
                    $Document->save();
                }
                else{
                    if($this->DeleteDocument($ExistingDocument->DocumentTypeID)){
                        $ExistingDocument->DocumentName = $request->file('FoundationCertificate')->getClientOriginalName();
                        $ExistingDocument->Path = $EncodeFile;
                        $ExistingDocument->save();
                    }
                    else{
                        $request->session()->flash('toastfailed', 'Error when upload document');
                        return redirect()->back();
                    }
                }
                Storage::disk('ftp')->put('DocumentYayasan/'.$EncodeFile,fopen($request->file('FoundationCertificate'),'r+'));

            }
            if($request->hasFile('FoundationOperationalPermit')){
                $EncodeFile = Hash::make("document.".Auth::guard('foundations')->user()->FoundationID.$request->file('FoundationOperationalPermit')->getClientOriginalName());
                $EncodeFile = str_replace(array('/'),'',$EncodeFile) . '.jpg';
                $FoundationID = Auth::guard('foundations')->user()->FoundationID;
                $ExistingDocument = Document::where('FoundationID',$FoundationID)->where('DocumentTypeID',3)->first();
                if($ExistingDocument == null){
                    $Document = new Document();
                    $Document->FoundationID = $FoundationID;
                    $Document->DocumentTypeID = 3;
                    $Document->DocumentName = $request->file('FoundationOperationalPermit')->getClientOriginalName();
                    $Document->ApprovalStatusID = 1;
                    $Document->UploadDate = Carbon::now();
                    $Document->ReviewDate = Carbon::now();
                    $Document->Path = $EncodeFile;
                    $Document->save();
                }
                else{
                    if($this->DeleteDocument($ExistingDocument->DocumentTypeID)){
                        $ExistingDocument->DocumentName = $request->file('FoundationOperationalPermit')->getClientOriginalName();
                        $ExistingDocument->Path = $EncodeFile;
                        $ExistingDocument->save();
                    }
                    else{
                        $request->session()->flash('toastfailed', 'Error when upload document');
                        return redirect()->back();
                    }
                }
                Storage::disk('ftp')->put('DocumentYayasan/'.$EncodeFile,fopen($request->file('FoundationOperationalPermit'),'r+'));

            }

            if($request->hasFile('FoundationRegistrationPermit')){
                $EncodeFile = Hash::make("document.".Auth::guard('foundations')->user()->FoundationID.$request->file('FoundationRegistrationPermit')->getClientOriginalName());
                $EncodeFile = str_replace(array('/'),'',$EncodeFile) . '.jpg';
                $FoundationID = Auth::guard('foundations')->user()->FoundationID;
                $ExistingDocument = Document::where('FoundationID',$FoundationID)->where('DocumentTypeID',4)->first();
                if($ExistingDocument == null){
                    $Document = new Document();
                    $Document->FoundationID = $FoundationID;
                    $Document->DocumentTypeID = 4;
                    $Document->DocumentName = $request->file('FoundationRegistrationPermit')->getClientOriginalName();
                    $Document->ApprovalStatusID = 1;
                    $Document->UploadDate = Carbon::now();
                    $Document->ReviewDate = Carbon::now();
                    $Document->Path = $EncodeFile;
                    $Document->save();
                }
                else{
                    if($this->DeleteDocument($ExistingDocument->DocumentTypeID)){
                        $ExistingDocument->DocumentName = $request->file('FoundationRegistrationPermit')->getClientOriginalName();
                        $ExistingDocument->Path = $EncodeFile;
                        $ExistingDocument->save();
                    }
                    else{
                        $request->session()->flash('toastfailed', 'Error when upload document');
                        return redirect()->back();
                    }
                }
                Storage::disk('ftp')->put('DocumentYayasan/'.$EncodeFile,fopen($request->file('FoundationRegistrationPermit'),'r+'));

            }



            $request->session()->flash('toastsuccess', 'Document has been updated');
            return redirect()->back();
            
        }
        else{
            $request->session()->flash('toastfailed', 'Please upload the document');
            return redirect()->back();
        }
    }


    public function GetListDocument(Request $request){
        $FoundationID = Auth::guard('foundations')->user()->FoundationID;

        $Document = Document::where('FoundationID',$FoundationID)->get();

        $ListDocument[] = array();
        foreach($Document as $Val){
            $ListDocument[] = ['FoundationID' => Crypt::encrypt($Val->FoundationID),'DocumentName' => $Val->DocumentType->DocumentTypeName,'DocumentTypeID' => $Val->DocumentTypeID,'DocumentStatusID' => $Val->ApprovalStatusID, 'DocumentStatus' => $Val->ApprovalStatus->ApprovalStatusName ];
        }

        $response = array('payload'=>$ListDocument);
        return response()->json($response);
    }

    public function GetDocumentDetail(Request $request){
        $FoundationID = Crypt::decrypt($request->FoundationID);

        $Document = Document::where('FoundationID',$FoundationID)->where('DocumentTypeID',$request->TypeID)->first();
        
        $DocumentDetail = 
        ['DocumentType'=> $Document->DocumentType->DocumentTypeName,
        'DocumentTypeID'=> $Document->DocumentType->DocumentTypeID,
        'DocumentName' => $Document->DocumentName,
        'UploadDate' => $Document->UploadDate,
        'ReviewDate' => $Document->ReviewDate,
        'ReviewStatus' => $Document->ApprovalStatus->ApprovalStatusName,
        'ReviewStatusID' => $Document->ApprovalStatus->ApprovalStatusID,
        'ReviewDescription' => $Document->Description 
        ];

        $response = ['payload' => $DocumentDetail];
        return response()->json($response);
    }


}
