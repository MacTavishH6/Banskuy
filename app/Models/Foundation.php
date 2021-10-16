<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foundation extends Model
{
    protected $table = "msfoundation";


    public function Document(){
        return $this->hasMany(Document::class, 'FoundationID', 'FoundationID');
    }
}
