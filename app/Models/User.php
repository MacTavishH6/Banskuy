<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
