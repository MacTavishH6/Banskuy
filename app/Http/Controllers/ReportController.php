<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportPost;
use App\Models\Report;
use App\Models\ReportCategory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function MakeReport($postId,Request $request){
        if(!Auth::guard('foundations')->check()){
            $sourceId = Auth::user()->UserID;
            $sourceRole = 1;
        }
        else{
            $sourceId = Auth::guard('foundations')->user()->FoundationID;
            $sourceRole = 2;
        }
        $Report = new ReportPost();
        $Report->PostID = $postId;
        $Report->IDSource = $sourceId;
        $Report->ReportCategoryID = $request->ddlReportType;
        $Report->Reason = $request->txaReportDesc;
        $Report->RoleIDSource = $sourceRole;
        $Report->IsTakenAction = 0;
        try{
            $Report->save();
            $request->session()->flash('toastsuccess', 'Laporan berhasil dibuat');
            return redirect()->back();
        }catch(Exception $ex){

        }
    }


    public function MakeReportUser(Request $request){
        if(!Auth::guard('foundations')->check()){
            $sourceId = Auth::user()->UserID;
            $sourceRole = 1;
        }
        else{
            $sourceId = Auth::guard('foundations')->user()->FoundationID;
            $sourceRole = 2;
        }
        $Report = new Report();
        $Report->IDSource = $sourceId;
        $Report->IDTarget = Crypt::decrypt($request->targetId);
        $Report->ReportCategoryID = $request->ddlReportType;
        $Report->Reason = $request->txaReportDesc;
        $Report->RoleIDTarget = $request->roleId;
        $Report->RoleIDSource = $sourceRole;
        $Report->IsTakenAction = 0;
        try{
            $Report->save();
            $request->session()->flash('toastsuccess', 'Laporan berhasil dibuat');
            return redirect()->back();
        }catch(Exception $ex){

        }
    }

    public function GetReportCategory(){
        $ReportCategory = ReportCategory::all();

        $response = array('payload' => $ReportCategory);
        return response()->json($response);
    }

    
}
