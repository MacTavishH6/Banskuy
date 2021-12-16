<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrNotification extends Model
{
    use HasFactory;
    protected $primaryKey = "TrNotificationID";
    protected $table = "trnotification";


    public function notification(){
        return $this->hasOne(HTrNotification::class,'HtrNotificationID','HtrNotificationID');
    }
}
