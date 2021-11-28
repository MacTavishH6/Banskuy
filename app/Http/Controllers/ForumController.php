<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonationType;
use App\Models\DonationTypeDetail;
use App\Models\Post;
use App\Models\Like;
use Carbon\Carbon;
use App\Models\Comment;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class ForumController extends Controller
{

   
    public function Index(){
      
        $DonationType = $this->GetCategory();
        $DonationTypeDetail = DonationTypeDetail::all();
        
        return view('/Forum/Forum',compact('DonationType','DonationTypeDetail'));
    }

    public function ForumWithCategory($id){
        $DonationType = $this->GetCategory()->where('DonationTypeID',$id);
        $DonationTypeDetail = DonationTypeDetail::all();
        return view('/Forum/Forum',compact('DonationType','DonationTypeDetail'));
    }

    public function PostDetail($id){
        $Post = Post::where('PostID',$id)->first();
        $Like = Like::where('PostID',$id)->where('LikePost',1)->get();
        return view('/Forum/ViewPost',compact('Post','Like'));
    }

    public function CreatePost(Request $request){
        $Post = new Post;
        $Post->DonationTypeDetailID = $request->ddlDonationTypeDetail;

        $Post->DonationTypeID = $request->ddlDonationType;
        $Post->ID = auth()->id();
        $Post->PostTypeID = $request->ddlPostType;
        if( $Post->PostTypeID == 1){
            $Post->PostType = "Donation Post";
        }
        else{
            $Post->PostType = "Request Post";
        }
        $Post->PostDescription = $request->txaPostDesc;
        $Post->UploadDate = Carbon::now()->toDateTimeString();
        $Post->Quantity = $request->txtQuantity;
        $Post->PostTitle = $request->txtPostTitle;

        if(Auth::guard('foundations')->check()){
            $Post->RoleID = 2;
        } 
        else{
            $Post->RoleID = 1;
        }
 

        $EncodeFile = Hash::make("img.".$Post->ID."1");
        $EncodeFile = str_replace(array('/'),'',$EncodeFile) . '.jpg';
        $Post->PostPicture = $EncodeFile;

        try{
            //Save first to get PostID
          
            $Post->save();

            //Upload to FTP
            Storage::disk('ftp')->put('Forum/Post/'.$Post->id.'/'.$EncodeFile,fopen($request->file('fuAttachment'),'r+'));
           
            return redirect('/Forum');
        }
        catch(Exception $e){
            throw($e);
        }
    }

    public function GetCategory(){
        $Result = DonationType::all();

        return $Result;
    }

    
    public function GetDonationCategoryDetail($id){
        $arr['Data'] = DonationTypeDetail::where('DonationTypeID',$id)->get();

        echo json_encode($arr);
        exit;
    }

    public function SendLike($id){

        $ExistingLike = Like::where('PostID',$id)->where('ID',auth()->id())->first();
        if($ExistingLike != null){
            if($ExistingLike->LikePost == 1){
                Like::where('PostID',$id)->where('ID',auth()->id())->update(['LikePost'=>0]);
            }
            else{
                Like::where('PostID',$id)->where('ID',auth()->id())->update(['LikePost'=>1]);
            }
        }
        else{
            $Like = new Like;
            $Like->PostID = $id;
            $Like->ID = auth()->id();
            $Like->LikePost = 1;
            $Like->save();
        }
            
            $arr['Data'] = Like::where('PostID',$id)->where('LikePost',1)->get();
            echo json_encode($arr);
            exit;
    }

    public function PostComment($id,Request $request){
        $Comment = new Comment;
        $Comment->PostID = $id;
        $Comment->CommentReplyID = 0;
        $Comment->OrderNumber = 1;
        $Comment->ID = auth()->id();
        $Comment->Comment = $request->text;
        $Comment->CommentDate = Carbon::Now()->toDateTimeString();

        $UserName = "";
        if(Auth::guard('foundations')->check()){
            $UserName = Auth::guard('foundations')->user()->FoundationName;
        } 
        else{
            $UserName = Auth::user()->FirstName.' '.Auth::user()->LastName;
        }
        
        try{
            $Comment->save();
            $totalReplies = Comment::where('PostID',$id)->get()->count();
            $response = ['payload' => $Comment,'totalReplies'=>$totalReplies,'UserName'=>$UserName,'date' => date('d M Y',strtotime($Comment->created_at))];
            return response()->json($response);
        }catch(Exception $ex){
            return redirect('/');
        }
    }

    public function PostReply($idpost,$id,Request $request){

        $LastComment = Comment::where('CommentID',$id)->orderby('OrderNumber','desc')->first();
        $Comment = new Comment;
        $Comment->PostID = $idpost;
        $Comment->CommentReplyID = $id;
        $Comment->OrderNumber = $LastComment->OrderNumber + 1;
        $Comment->ID = auth()->id();
        $Comment->Comment = $request->text;
        $Comment->CommentDate = Carbon::Now()->toDateTimeString();

        $UserName = "";
        if(Auth::guard('foundations')->check()){
            $UserName = Auth::guard('foundations')->user()->FoundationName;
        } 
        else{
            $UserName = Auth::user()->FirstName.' '.Auth::user()->LastName;
        }
        
        try{
            $Comment->save();
            $Comment->created_at = date('d M Y',strtotime($Comment->created_at));
            $commentForm = Comment::where('CommentID',$id)->first();
            $totalReplies = Comment::where('PostID',$idpost)->get()->count();

            $response = ['payload' => $Comment,'totalReplies'=>$totalReplies,'UserName' => $UserName,'replyTo'=> $commentForm->User->FirstName." ".$commentForm->User->LastName,'date' => date('d M Y',strtotime($Comment->created_at))];
        return response()->json($response);

        }catch(Exception $ex){
            return redirect('/');
        }
    }
    


  
    public function ViewForum(){
        return view('Forum/ViewForum');
    }

    public function ViewThread(){
        return view('Forum/ViewThread');
    }


    public function TestDelete(){
        $ftp_server = "ftp.banskuy.com";
        $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
        $login = ftp_login($ftp_conn, 'Basnkuy2022@banskuy.com', 'b!Nu$_Basnkuy22FTP');

        $file = "ProfilePicture/Donatur/OQ==.jpg";

        // try to delete file
        if (ftp_delete($ftp_conn, $file))
        {
        dd("deleted");
        }
        else
        {
        echo "Could not delete $file";
        }

        // close connection
        ftp_close($ftp_conn);

    }

    
    
}
