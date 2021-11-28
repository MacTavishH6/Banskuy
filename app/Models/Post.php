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

    public function User(){
        return $this->hasOne(User::class,'UserID','ID');
    }

    public function Foundation(){
        return $this->hasOne(Foundation::class,'FoundationID','ID');
    }

    public function Like(){
        return $this->hasMany(Like::class,'PostID','PostID');
    }

    public function Comment(){
        return $this->hasMany(Comment::class,'PostID','PostID');
    }

}
