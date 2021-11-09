<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//use Illuminate\Foundation\Auth\Foundations as Authenticatable;


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
