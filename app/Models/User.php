<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\Users as Authenticatable;
// Authenticatable (ini buat ditaro di sebelah kanan extends)

class User extends Model 
{
    protected $table = "msuser";
    protected $primaryKey = "UserID";

    protected $fillable = [
        'email',
        'password',
        'phoneNumber',
    ];

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
