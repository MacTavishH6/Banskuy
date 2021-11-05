<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelGrade extends Model
{
    //
    protected $table = "mslevelgrade";

    public function UserLevel(){

        return $this->hasOne(UserLevel::class,'LevelGradeID','LevelGradeID');

    }
}
