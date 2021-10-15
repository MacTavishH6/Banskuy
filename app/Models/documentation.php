<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class documentation extends Model
{
    //
    protected $table = "msdocumentation";

    public function userdocumentation(){

        return $this->hasOne(userdocumentation::class,'DocumentationID','DocumentationID');

    }

    public function documentationphoto(){

        return $this->hasMany(documentationphoto::class,'DocumentationID','DocumentationID');

    }
}
