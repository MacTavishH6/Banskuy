<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "mspost";

    public function DonationTypeDetail() {
        return $this->hasOne(DonationTypeDetail::class,'DonationTypeDetailID','DonationTypeDetailID');
    }

}
