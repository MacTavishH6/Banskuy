<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BannedAccount;
use App\Models\Foundation;
use App\Models\Post;
use App\Models\Report;
use App\Models\ReportPost;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MasterSearchingController extends Controller
{
    public function MasterSearching($UserType = '')
    {
        if ($UserType != '')
            $report = Report::where([['IsTakenAction', '0'], ['RoleIDTarget', $UserType]])->distinct('IDTarget')->paginate(15);
        else $report = Report::where('IsTakenAction', '0')->distinct('IDTarget')->paginate(15);
        $User = User::all();
        $Foundation = Foundation::all();
        foreach ($report as $rprt) {
            if ($rprt->RoleIDTarget == 1) {
                $UserTarget = $User->where('UserID', $rprt->IDTarget)->first();
                $rprt->UserTarget = $UserTarget;
                $rprt->RoleTarget = 1;
            } else {
                $UserTarget = $Foundation->where('FoundationID', $rprt->IDTarget)->first();
                $rprt->UserTarget = $UserTarget;
                $rprt->RoleTarget = 2;
            }
        }
        return view('Admin.MasterSearching.mastersearching', compact('report'));
    }

    public function PostSearching($PostType=''){
        $reportedPost = ReportPost::where('IsTakenAction', 0)->distinct('PostID')->with('Post')->paginate(15);
        foreach($reportedPost as $rprtPost){
            if($rprtPost->Post->RoleID == 1){
                $User = User::where('UserID', $rprtPost->Post->ID)->first();
                $rprtPost->User = $User;
            }
            else{
                $Foundation = Foundation::where('FoundationID', $rprtPost->Post->ID)->first();
                $rprtPost->User = $Foundation;
            }
        }
        return view('Admin.MasterSearching.postsearching', compact('reportedPost'));
    }

    public function MasterSearchingDetail($id)
    {
        $id = Crypt::decrypt($id);
        $report = Report::where([['IsTakenAction', '0'], ['IDTarget', $id]])->with('ReportCategory')->get();
        $User = User::all();
        $Foundation = Foundation::all();
        foreach ($report as $rprt) {
            if ($rprt->RoleIDSource == 1) {
                $UserSource = $User->where('UserID', $rprt->IDSource)->first();
                $rprt->UserSource = $UserSource;
                $rprt->RoleSource = 1;
            } else {
                $UserSource = $Foundation->where('FoundationID', $rprt->IDSource)->first();
                $rprt->UserSource = $UserSource;
                $rprt->RoleSource = 2;
            }
            if ($rprt->RoleIDTarget == 1)
                $rprt->UserReported = $User->where('UserID', $id)->first();
            else
                $rprt->UserReported = $Foundation->where('FoundationID', $id)->first();
        }

        return view('Admin.MasterSearching.reportdetail', compact('report'));
    }

    public function BanUser(Request $request){
        $id = Crypt::decrypt($request->UserID);
        $report = Report::where([['IsTakenAction', '0'], ['IDTarget', $id]])->with('ReportCategory')->get();
        $banned = new BannedAccount();
        $banned->ID = $id;
        $banned->ReportID = $report->first()->ReportID;
        $banned->Status = 1;
        $banned->created_at = date('d M Y', strtotime(Carbon::now()));
        $banned->RoleID = $report->first()->RoleIDTarget;
        $banned->BanDuration = $request->Duration;
        $banned->save();
        foreach($report as $rprt){
            $rprt->IsTakenAction = 1;
            $rprt->save();
        }
        $request->session()->flash('toastsuccess', 'Pengguna telah diBan');
        return redirect('/usersearching');
    }
}
