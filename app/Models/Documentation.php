<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    //
    protected $table = "msdocumentation";

    public function UserDocumentation(){

        return $this->hasOne(UserDocumentation::class,'DocumentationID','DocumentationID');

    }

    public function DocumentationPhoto(){

        return $this->hasMany(DocumentationPhoto::class,'DocumentationID','DocumentationID');

    }
}
