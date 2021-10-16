<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "msuser";

    public function FollowPost(){

        return $this->hasMany(FollowPost::class,'UserID','UserID');

    }

    public function UserLevel(){

        return $this->hasMany(UserLevel::class,'UserID','UserID');

    }

    public function DonationTransaction(){

        return $this->hasMany(DonationTransaction::class,'UserID','UserID');

    }
}
