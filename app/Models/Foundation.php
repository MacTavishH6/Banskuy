<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//use Illuminate\Foundation\Auth\Foundations as Authenticatable;

use App\Models\Users as Authenticatable;

class Foundation extends Authenticatable
{
    protected $table = "msfoundation";
    protected $primaryKey = "FoundationID";

    protected $fillable = [
        'email',
        'password',
        'foundationPhone',
        'registerDate'
    ];

    protected $guard = 'foundations';

    public function Document(){
        return $this->hasMany(Document::class, 'FoundationID', 'FoundationID');
    }

    public function Address(){
        return $this->hasOne(Address::class, 'AddressID', 'AddressID');
    }

    public function FoundationPhoto(){
        return $this->hasOne(FoundationPhoto::class, 'PhotoID', 'PhotoID');
    }

    public function DonationTransaction(){
        return $this->hasMany(DonationTransaction::class);
    }
}
