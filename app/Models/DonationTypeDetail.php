<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationTypeDetail extends Model
{
    protected $table = 'msdonationtypedetail';

    public function DonationType(){
        return $this->hasOne(DonationType::class,'DonationTypeID','DonationTypeID');
    }

    
}
