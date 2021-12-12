<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Users as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = "msadmin";
    protected $primaryKey = "AdminID";
    
    protected $fillable = [
        'username',
        'password'
    ];
}
