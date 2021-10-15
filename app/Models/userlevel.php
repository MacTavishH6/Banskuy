<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userlevel extends Model
{
    //
    protected $table = "msuserlevel";

    public function user(){
        return $this->hasOne(user::class,'UserID','UserID');
    }

    public function level(){
        return $this->hasMany(level::class,'LevelID','LevelID');
    }

    public function levelgrade(){
        return $this->hasOne(levelgrade::class,'LevelGradeID','LevelGradeID');
    }

}
