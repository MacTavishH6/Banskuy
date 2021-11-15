<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\DonationType;

class LOVController extends Controller
{
    public function Country()
    {
    }

    public function Province()
    {
        $province = Province::get();

        return response()->json(array('msg' => $province), 200);
    }

    public function City($id){
        $city = City::where("ProvinceID", $id)->get();
        return response()->json(array('msg' => $city), 200);
    }

    public function DonationType(){
        $donationtype = DonationType::with('DonationTypeDetail')->get();
        return response()->json(array('msg' => $donationtype), 200);

    }
}
