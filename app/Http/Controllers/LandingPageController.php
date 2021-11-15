<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){        
        return view('landingpage');
        
    }
}
