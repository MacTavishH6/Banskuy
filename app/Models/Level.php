<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    //
    protected $table = "trlevel";
    protected $primaryKey = "id";

    public function UserLevel(){

        return $this->belongsTo(UserLevel::class,'LevelID','LevelID');

    }
}
