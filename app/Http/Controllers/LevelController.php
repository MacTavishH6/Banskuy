<?php

namespace App\Http\Controllers;

use App\Models\LevelGrade;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LevelController extends Controller
{
    public function GetNextLevelInfo($id){
        $id = Crypt::decrypt($id);
        $userlevel = UserLevel::where('LevelID', $id)->first();        
        $nextlevel = LevelGrade::where('LevelGradeID', '>', $userlevel->LevelGradeID)->first();
        $response = array('payload' => $nextlevel);
        return response()->json($response);
    }
}
