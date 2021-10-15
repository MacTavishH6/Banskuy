<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class level extends Model
{
    //
    protected $table = "trlevel";

    public function userlevel(){

        return $this->hasOne(userlevel::class,'LevelID','LevelID');

    }
}
