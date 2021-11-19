<?php

namespace App\Http\Controllers;

use App\Models\DonationTransaction;
use App\Models\Foundation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TransactionController extends Controller
{
    public function MakeTransaction($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::where('UserID', $id)->with('UserLevel.LevelGrade')->with('Photo')->first();
        return view('Transaction.createtransaction', compact('user'));
    }

    public function DonationHistory()
    {        
        return view('DonationHistory.donationhistory');
    }

    public function GetFoundationSearch(Request $request)
    {
        if ($request->text == 'all')
            $foundation = Foundation::get();
        else
            $foundation = Foundation::where('FoundationName', 'like', '%' . $request->text . '%')->get();
        $foundationid = array();
        foreach ($foundation as $value) {
            $foundationid[] = ['key' => $value->FoundationID, 'value' => Crypt::encrypt($value->FoundationID)];
        };
        $response = array('payload' => $foundation, 'foundationID' => $foundationid);
        return response()->json($response);
    }

    public function GetFoundationByID(Request $request)
    {
        $id = Crypt::decrypt($request->UserID);

        $foundation = Foundation::where('FoundationID', $id)->with('Address.Province')->with('Address.City')->first();

        $response = ['payload' => $foundation, 'foundationid' => Crypt::encrypt($foundation->FoundationID)];
        return response()->json($response);
    }

    public function RequestTransaction(Request $request)
    {
        $donationtransaction = new DonationTransaction();
        $donationtransaction->UserID = Crypt::decrypt($request->UserID);
        $donationtransaction->FoundationID = Crypt::decrypt($request->FoundationID);
        $donationtransaction->DonationTypeDetailID = $request->Unit;
        $donationtransaction->ApprovalStatusID     = '1';
        $donationtransaction->DonationDescriptionName = $request->DonationDescription;
        $donationtransaction->TransactionDate = date('Y-m-d');
        $donationtransaction->Quantity = $request->Quantity;
        $donationtransaction->created_at = date('Y-m-d H:i:s');
        $donationtransaction->save();
        $request->session()->flash('toastsuccess', 'Request submitted');
        return redirect()->action('App\Http\Controllers\TransactionController@DonationHistory');
    }

    public function GetDonationHistory(Request $request){
        $id = Crypt::decrypt($request->UserID);
        $donationhistory = DonationTransaction::where('UserID', $id)->with('DonationTypeDetail.DonationType')->with('ApprovalStatus')->with('Foundation')->get();
        $response = ['payload' => $donationhistory];
        return response()->json($response);
    }

    public function GetDonationHistoryDetail(Request $request){
        $donation = DonationTransaction::where("DonationTransactionID", $request->TransactionID)->with('DonationTypeDetail.DonationType')->with('ApprovalStatus')->first();
        $response = ['payload' => $donation];
        return response()->json($response);
    }
}
