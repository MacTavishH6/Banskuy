<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundationPhoto extends Model
{
    use HasFactory;

    protected $table = "msfoundationphoto";
    protected $primaryKey = "PhotoID";

    public function Foundation(){
        return $this->belongsTo(Foundation::class, 'PhotoID');
    }
}
