<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
    //
    protected $table = "msuserlevel";

    public function User(){
        return $this->hasOne(User::class,'UserID','UserID');
    }

    public function Level(){
        return $this->hasMany(Level::class,'LevelID','LevelID');
    }

    public function LevelGrade(){
        return $this->hasOne(LevelGrade::class,'LevelGradeID','LevelGradeID');
    }
}