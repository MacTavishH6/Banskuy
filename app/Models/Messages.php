<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'trmessage';

    public function ToUser(){
        return $this->hasOne(User::class,'ReceiverID','UserID');
    }

    public function FromUser(){
        return $this->hasOne(User::class,'SenderID','UserID');
    }
}
