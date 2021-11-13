<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'mscity';

    public function Province(){
        return $this->belongsTo(Province::class,'ProvinceID','ProvinceID');
    }
}
