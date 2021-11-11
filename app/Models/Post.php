<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "mspost";

    public function DonationTypeDetail() {
        return $this->hasOne(DonationTypeDetail::class,'DonationTypeDetailID','DonationTypeDetailID');
    }

    public function FollowPost(){
        return $this->hasMany(FollowPost::class, 'FollowPostID');
    }

}
