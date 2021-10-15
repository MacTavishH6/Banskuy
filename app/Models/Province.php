<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'msprovince';

    public function City() {
        return $this->hasMany(City::class,'ProvinceID');
    }
}
