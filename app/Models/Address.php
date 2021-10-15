<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = "msaddress";

    public function Province() {
        return $this->hasOne(Province::class,'ProvinceID','ProvinceID');
    } 

    public function City(){
        return $this->hasOne(City::class,'CityID','CityID');
    }
}
