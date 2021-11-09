<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonationHistoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function DonationHistoryPage(){
        return view('DonationHistory/donationhistory');
    }

    public function DonationHistoryDetailPage(){
        return view('DonationHistory/donationhistorydetail');
    }
}
