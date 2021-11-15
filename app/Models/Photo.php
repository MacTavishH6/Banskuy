<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $table = "msphoto";
    protected $primaryKey = "PhotoID";

    public function User(){
        return $this->belongsTo(User::class, 'PhotoID');
    }
}
