<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = "msuser";

    public function followpost(){

        return $this->hasMany(followpost::class,'UserID','UserID');

    }

    public function userlevel(){

        return $this->hasMany(userlevel::class,'UserID','UserID');

    }

    // public function donationtransaction(){

    //     return $this->hasMany(donationtransaction::class,'UserID','UserID');

    // }
}
