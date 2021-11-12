<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//use Illuminate\Foundation\Auth\Foundations as Authenticatable;

use App\Models\Users as Authenticatable;

class Foundation extends Authenticatable
{
    protected $table = "msfoundation";

    protected $fillable = [
        'email',
        'password',
        'foundationPhone',
        'registerDate'
    ];

    public function Document(){
        return $this->hasMany(Document::class, 'FoundationID', 'FoundationID');
    }
}
