<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentationPhoto extends Model
{
    //
    protected $table = "trdocumentationphoto";

    public function Documentation(){

        return $this->hasOne(Documentation::class,'DocumentationID','DocumentationID');

    }
}
