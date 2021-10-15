<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class levelgrade extends Model
{
    //
    protected $table = "mslevelgrade";

    public function userlevel(){

        return $this->hasOne(userlevel::class,'LevelGradeID','LevelGradeID');

    }
}
