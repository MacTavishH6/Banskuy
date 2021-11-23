<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Foundation;
use App\Models\UserDocumentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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

}
