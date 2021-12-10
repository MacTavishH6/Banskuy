<?php

namespace App\Http\Controllers;

use App\Models\ApprovalStatus;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\DonationType;
use App\Models\Post;
use App\Models\DocumentType;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

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

    public function DonationStatus(){
        $donationstatus = ApprovalStatus::get();
        return response()->json(array('msg' => $donationstatus), 200);
    }

    public function PostList(Request $request){
        $id = Crypt::decrypt($request->UserID);
        $TypePost = $request->TipePost;
        if($TypePost == 1){
            $id = Auth::user()->UserID;

        }
        $listPost = Post::where('ID',$id)->get();

        return response()->json(array('msg'=>$listPost),200);
    }


    public function GetDocumentTypeList(){
        $DocumentType = DocumentType::all();

        return response()->json(array('payload'=>$DocumentType),200);
    }

    public function GetApprovalStatus(){
        $ApprovalStatus = ApprovalStatus::all();

        return response()->json(array('payload'=>$ApprovalStatus),200);
    }

    
}
