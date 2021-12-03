<?php

namespace App\Http\Controllers;

use App\Models\Documentation;
use App\Models\DocumentationPhoto;
use App\Models\DonationTransaction;
use App\Models\Foundation;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    //===============================  PEMBATAS UNTUK DONATION APPROVAL  ==================================//

    public function DonationApproval()
    {
        return view('Transaction.transactionapproval');
    }

    public function GetDonationApproval(Request $request)
    {
        $foundationid = Crypt::decrypt($request->FoundationID);
        $donationapproval = DonationTransaction::where('FoundationID', $foundationid)->with('DonationTypeDetail.DonationType')->with('ApprovalStatus')->with('User')->orderBy('TransactionDate', 'DESC')->get();
        // echo ($donationhistory);
        $donationapproval = $donationapproval->filter(function ($x) use ($request) {
            if ($request->keyword) $x = (str_contains($x->DonationDescriptionName, $request->keyword) || str_contains($x->DonationTypeDetail->DonationType->DonationTypeName, $request->keyword)) ? $x : [];
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
        $response = ['payload' => $donationapproval];
        return response()->json($response);
    }

    public function GetDonationApprovalDetail(Request $request)
    {
        $donation = DonationTransaction::where("DonationTransactionID", $request->TransactionID)->with('DonationTypeDetail.DonationType')->with('ApprovalStatus')->with('User')->first();
        $response = ['payload' => $donation];
        return response()->json($response);
    }

    public function AcceptRejectDonationTransaction(Request $request)
    {
        $donation = DonationTransaction::where("DonationTransactionID", $request->TransactionID)->first();
        
        
        $donation->ApprovalStatusID = $request->donationStatus;
        
        $donation->save();
        $response = ['payload' => 'sukses'];
        return response()->json($response);
    }

    public function UploadDocumentation(Request $request)
    {
        $hashed = Hash::make($request->transactionID);
        $hashed = str_replace('\\',';',$hashed);
        $hashed = str_replace('/',';',$hashed);
        $filename = $hashed . '.' . $request->file('DocumentationPhoto')->getClientOriginalExtension();
        $ftp = ftp_connect(env('FTP_SERVER'));
        // $login_result = ftp_login($ftp, env('FTP_USERNAME'), env('FTP_PASSWORD'));

        $donation = DonationTransaction::where('DonationTransactionID', $request->transactionID)->first();

        $documentation = new Documentation();
        $documentation->DocumentationDate = date('Y-m-d H:i:s');
        //$documentation->DonationTypeID = ; // MASIH ENTAHLAH GIMANA GET NYA DI TRANSACTION GAADA SOALNYA
        $documentation->updated_at = date('Y-m-d H:i:s');
        $documentation->save();

        $donation->DocumentationID = $documentation->DocumentationID;
        $donation->save();

        $documentationphoto = new DocumentationPhoto();
        //Storage::disk('ftp')->put('DocumentationPicture/' . $filename, fopen($request->file('DocumentationPhoto'), 'r+'));
        Storage::disk('public')->put('DocumentationPicture/' . $filename, fopen($request->file('DocumentationPhoto'), 'r+'));
        
        $documentationphoto->DocumentationID = $documentation->DocumentationID;
        $documentationphoto->PhotoName = $filename;
        $documentationphoto->save();
        
        $request->session()->flash('toastsuccess', 'Dokumentasi updated successfully');
        return redirect()->back();
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

