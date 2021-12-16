<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HtrNotification extends Model
{
    use HasFactory;
    protected $primaryKey = "HtrNotificationID";

    protected $table = "htrnotification";

    public function TrnsactionNotif(){
        return $this->hasMany(TrNotification::class,'HtrNotificationID','HtrNotificationID');
    }
}
