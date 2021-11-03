<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonationHistoryController extends Controller
{
    public function DonationHistoryPage(){
        return view('DonationHistory/donationhistory');
    }

    public function DonationHistoryDetailPage(){
        return view('DonationHistory/donationhistorydetail');
    }
}
