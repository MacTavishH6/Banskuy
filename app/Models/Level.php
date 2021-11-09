<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    //
    protected $table = "trlevel";

    public function UserLevel(){

        return $this->hasOne(UserLevel::class,'LevelID','LevelID');

    }
}
