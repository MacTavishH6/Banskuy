<?php

namespace App\Http\Controllers;

use App\Models\DonationTransaction;
use App\Models\Foundation;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class TransactionController extends Controller
{
    public function MakeTransaction($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::where('UserID', $id)->with('UserLevel.LevelGrade')->with('Photo')->first();
        $StatusRedirect = 0;
        return view('Transaction.createtransaction', compact('user','StatusRedirect'));
    }

    public function DonationHistory()
    {
        return view('DonationHistory.donationhistory');
    }

    public function GetFoundationSearch(Request $request)
    {
        // if($request->donationType) $post = Ppst::where()
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

    public function GetDonationHistory(Request $request)
    {
        $id = Crypt::decrypt($request->UserID);
        $donationhistory = DonationTransaction::where('UserID', $id)->with('DonationTypeDetail.DonationType')->with('ApprovalStatus')->with('Foundation')->orderBy('TransactionDate', 'DESC')->get();
        // echo ($donationhistory);
        $donationhistory = $donationhistory->filter(function ($x) use ($request) {
            if ($request->keyword) $x = (str_contains($x->DonationDescriptionName, $request->keyword) || str_contains($x->DonationTypeDetail->DonationType->DonationTypeName, $request->keyword) || str_contains($x->Foundation->FoundationName, $request->keyword)) ? $x : [];
            // echo ($x);
            // // echo ($x->ApprovalStatus);
            // return;
            if ($x && $request->donationStatus) $x = ($x->ApprovalStatus->ApprovalStatusID == $request->donationStatus) ? $x : [];

            if ($x && $request->donationType) $x = ($x->DonationTypeDetail->DonationType->DonationTypeID == $request->donationType) ? $x : [];

            if ($x && ($request->dateStart && $request->dateEnd)) {
                $dateFrom = date('Y-m-d', strtotime($request->dateStart));
                $dateTo = date('Y-m-d', strtotime($request->dateEnd));
                $transactionDate = date('Y-m-d', strtotime($x->TransactionDate));
                if (($transactionDate >= $dateFrom) && ($transactionDate <= $dateTo)) 
                {
                    $x = $x;
                } else {
                    $x = [];
                }
            }

            return $x;
        });
        // echo ($donationhistory);
        // return;
        $response = ['payload' => $donationhistory];
        return response()->json($response);
    }

    public function GetDonationHistoryDetail(Request $request)
    {
        $donation = DonationTransaction::where("DonationTransactionID", $request->TransactionID)->with('DonationTypeDetail.DonationType')->with('ApprovalStatus')->with('foundation')->first();
        $response = ['payload' => $donation];
        return response()->json($response);
    }

    //25 Nov 2021 - add fikri for redirecting from post
    public function MakeTransactionWithPost($id){
        $PostID = Crypt::decrypt($id);
        $user = User::where('UserID',FacadesAuth::id())->with('UserLevel.LevelGrade')->with('Photo')->first();
        $Post = Post::where('PostID',$PostID)->first();
        $Foundation = Foundation::where('FoundationID',$Post->ID)->first();
        $StatusRedirect = 1;
        return view('Transaction.createtransaction', compact('user','Foundation','Post','StatusRedirect'));
    }
}
