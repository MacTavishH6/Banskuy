<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportPost;
use App\Models\ReportCategory;

class ReportController extends Controller
{
    public function MakeReport($postId,Request $request){
        $Report = new ReportPost();
        $Report->PostID = $postId;
        $Report->IDSource = auth()->id();
        $Report->ReportCategoryID = $request->ddlReportType;
        $Report->Reason = $request->txaReportDesc;
        
        try{
            $Report->save();
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
