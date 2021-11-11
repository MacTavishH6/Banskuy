<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\UserDocumentation;
use App\Models\UserLevel;

class ProfileController extends Controller
{
    public function Profile($id)
    {
        $id = base64_decode($id);
        $user = User::where('UserID', $id)->with('UserLevel.LevelGrade')->first();
        $post = Post::where('ID', $id)->get();
        $documentation = UserDocumentation::where('ID', $id)->with('Documentation')->get();
        return view('Profile.profile', ['user'=>$user,'post'=>$post,'documentation'=>$documentation]);
    }

    public function EditProfile($id){
        $id = base64_decode($id);
        $user = User::where('UserID', $id)->with('Address')->first();
        return view('Profile.editprofile', ['user' => $user]);
    }
}
