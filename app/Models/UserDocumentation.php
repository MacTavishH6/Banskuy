<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDocumentation extends Model
{
    //
    protected $table = "truserdocumentation";

    public function Documentation(){

        return $this->hasOne(Documentation::class,'DocumentationID','DocumentationID');

    }
}
