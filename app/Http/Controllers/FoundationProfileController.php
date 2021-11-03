<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoundationProfileController extends Controller
{
    public function FoundationProfilePage(){
        return view('FoundationProfile/profileyayasan');
    }

    public function EditFoundationProfilePage(){
        return view('FoundationProfile/editprofileyayasan');
    }

    public function DocumentReviewResultPage(){
        return view('FoundationProfile/documentreviewresult');
    }
}
