<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userdocumentation extends Model
{
    //
    protected $table = "truserdocumentation";

    public function documentation(){

        return $this->hasOne(documentation::class,'DocumentationID','DocumentationID');

    }
}
