<?php

namespace App\Http\Controllers;

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

    public function GetFoundationSearch(Request $request)
    {
        if ($request->text == 'all')
            $foundation = Foundation::get();
        else
            $foundation = Foundation::where('FoundationName', 'like', '%' . $request->text . '%')->get();
        foreach ($foundation as $value) {
            $value->FoundationID = Crypt::encrypt($value->FoundationID);
        };
        $response = array('payload' => $foundation);
        return response()->json($response);
    }

    public function GetFoundationByID(Request $request)
    {
        $id = Crypt::decrypt($request->UserID);
        $foundation = Foundation::where('FoundationID', $id)->with('Address')->first();
        $response = array('payload' => $foundation);
        return response()->json($response);
    }
}
