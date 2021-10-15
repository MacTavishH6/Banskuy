<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class documentationphoto extends Model
{
    //
    protected $table = "trdocumentationphoto";

    public function documentation(){

        return $this->hasOne(documentation::class,'DocumentationID','DocumentationID');

    }
}
