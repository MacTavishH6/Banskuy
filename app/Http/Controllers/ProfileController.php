<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function Profile(Request $request, string $id){
        return view('Profile.profile');
    }
}
