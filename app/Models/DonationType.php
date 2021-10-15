<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationType extends Model
{
    protected $table = "msdonationtype";
    
    public function DonationTypeDetail(){
        return $this->hasMany(DonationTypeDetail::class, 'DonationTypeID', 'DonationTypeID');
    }
}
