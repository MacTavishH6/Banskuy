<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Foundations as Authenticatable;

class Foundation extends Authenticatable
{
    protected $table = "msfoundation";


    public function Document(){
        return $this->hasMany(Document::class, 'FoundationID', 'FoundationID');
    }
}
