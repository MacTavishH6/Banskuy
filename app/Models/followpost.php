<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class followpost extends Model
{
    //
    protected $table = "trfollowpost";

    public function user(){

        return $this->hasOne(user::class,'UserID','UserID');

    }

}
