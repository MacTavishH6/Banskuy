<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foundation extends Model
{
    protected $table = "msfoundation";

    protected $fillable = [
        'email',
        'password',
        'foundationPhone',
    ];


    public function Document(){
        return $this->hasMany(Document::class, 'FoundationID', 'FoundationID');
    }
}
