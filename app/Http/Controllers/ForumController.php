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
use App\Models\Document;
use Illuminate\Support\Facades\Crypt;
use App\Events\NotificationEvent;
use App\Models\User;
use App\Models\Foundation;
use App\Models\HtrNotification;
use App\Models\TrNotification;


class ForumController extends Controller
{

    public function SendNotification()
    {
        broadcast(new NotificationEvent("1", "Post Baru", "Ada post baru nih bang"));
    }

    public function Index()
    {

        $DonationType = $this->GetCategory();
        $DonationTypeDetail = DonationTypeDetail::all();

        $AllowedPost = 3;
        if (Auth::guard('foundations')->check()) {
            $Document = Document::where('FoundationID', Auth::guard('foundations')->user()->FoundationID)->where('ApprovalStatusID', '5')->get();
            if ($Document->count() == 2 && Auth::guard('foundations')->User()->IsConfirmed == 1) {
                $AllowedPost = 1;
            } else {
                $AllowedPost = 0;
            }
        } else if (Auth::check()) {
            $AllowedPost = 1;
        }

        return view('/Forum/Forum', compact('DonationType', 'DonationTypeDetail', 'AllowedPost'));
    }

    public function ForumWithCategory($id)
    {
        $DonationType = $this->GetCategory()->where('DonationTypeID', $id);
        $DonationTypeDetail = DonationTypeDetail::all();

        $AllowedPost = 3;
        if (Auth::guard('foundations')->check()) {
            $Document = Document::where('FoundationID', Auth::guard('foundations')->user()->FoundationID)->where('ApprovalStatusID', '2')->get();
            if ($Document->count() == 4) {
                $AllowedPost = 1;
            } else {
                $AllowedPost = 0;
            }
        } else if (Auth::check()) {
            $AllowedPost = 1;
        }
        return view('/Forum/Forum', compact('DonationType', 'DonationTypeDetail', 'AllowedPost'));
    }

    public function PostDetail($id)
    {
        $Post = Post::where('PostID', $id)->first();
        $Like = Like::where('PostID', $id)->where('LikePost', 1)->get();

        $StatusPost = true;
        if (Auth::check()) {
            if (Auth::user()->UserID == $Post->ID && $Post->RoleID == 1) {
                $StatusPost = false;
            }
        } else if (Auth::guard('foundations')->check()) {
            if (Auth::guard('foundations')->user()->FoundationID == $Post->ID && $Post->RoleID == 2) {
                $StatusPost = false;
            }
        }
        return view('/Forum/ViewPost', compact('Post', 'Like', 'StatusPost'));
    }

    public function CreatePost(Request $request)
    {
        $Post = new Post;
        $Post->DonationTypeDetailID = $request->ddlDonationTypeDetail;

        $Post->DonationTypeID = $request->ddlDonationType;
        $Post->ID = auth()->id();
        $Post->PostTypeID = $request->ddlPostType;
        if ($Post->PostTypeID == 1) {
            $Post->PostType = "Donation Post";
        } else {
            $Post->PostType = "Request Post";
        }
        $Post->PostDescription = $request->txaPostDesc;
        $Post->UploadDate = Carbon::now()->toDateTimeString();
        $Post->Quantity = $request->txtQuantity;
        $Post->PostTitle = $request->txtPostTitle;
        $Post->StatusPostId = 1;
        if (Auth::guard('foundations')->check()) {
            $Post->RoleID = 2;
        } else {
            $Post->RoleID = 1;
        }


        $EncodeFile = Hash::make("img." . $Post->ID . "1");
        $EncodeFile = str_replace(array('/'), '', $EncodeFile) . '.jpg';
        $Post->PostPicture = $EncodeFile;

        try {
            //Save first to get PostID

            $Post->save();

            //Upload to FTP
            Storage::disk('ftp')->put('Forum/Post/' . $Post->PostID . '/' . $EncodeFile, fopen($request->file('fuAttachment'), 'r+'));
            $request->session()->flash('toastsuccess', 'Post Created');

            //Send Notification
            $ListUser = User::all();
            $ListFoundation = Foundation::all();

            $CurrUser = "";
            $CurrFoundation = "";

            if (Auth::guard('foundations')->check()) {
                $CurrFoundation = Auth::guard('foundations')->user()->FoundationID;
            } else {
                $CurrUser = Auth::user()->UserID;
            }

            //save header first
            $DonationType = DonationType::where('DonationTypeID', $Post->DonationTypeID)->first();
            $NewNotif = new HtrNotification();
            $NewNotif->NotificationType = "1";
            if (strlen($Post->PostTitle) > 27) {
                $NewNotif->NotificationContent = substr($Post->PostTitle, 0, 25) . "...";
            } else {
                $NewNotif->NotificationContent = $Post->PostTitle;
            }
            $NewNotif->NotificationHeader = $DonationType->DonationTypeName;

            $NewNotif->PostID = $Post->PostID;
            $NewNotif->save();

            foreach ($ListUser as $val) {
                if ($CurrUser == $val->UserID) {
                    continue;
                }
                $NewTrNotif = new TrNotification();
                $NewTrNotif->HtrNotificationID = $NewNotif->HtrNotificationID;
                $NewTrNotif->ReceiverID = $val->UserID;
                $NewTrNotif->StatusNotification = 1;
                $NewTrNotif->RoleID = 1;
                $NewTrNotif->save();
            }

            foreach ($ListFoundation as $val) {
                if ($CurrFoundation == $val->FoundationID) {
                    continue;
                }
                $NewTrNotif = new TrNotification();
                $NewTrNotif->HtrNotificationID = $NewNotif->HtrNotificationID;
                $NewTrNotif->ReceiverID = $val->FoundationID;
                $NewTrNotif->StatusNotification = 1;
                $NewTrNotif->RoleID = 2;
                $NewTrNotif->save();
            }
            broadcast(new NotificationEvent($NewNotif));
            return redirect('/Forum');
        } catch (Exception $e) {
            throw ($e);
        }
    }

    public function GetCategory()
    {
        $Result = DonationType::all();

        return $Result;
    }


    public function GetDonationCategoryDetail($id)
    {
        $arr['Data'] = DonationTypeDetail::where('DonationTypeID', $id)->get();

        echo json_encode($arr);
        exit;
    }

    public function SendLike($id)
    {

        $ExistingLike = Like::where('PostID', $id)->where('ID', auth()->id())->first();
        if ($ExistingLike != null) {
            if ($ExistingLike->LikePost == 1) {
                Like::where('PostID', $id)->where('ID', auth()->id())->update(['LikePost' => 0]);
            } else {
                Like::where('PostID', $id)->where('ID', auth()->id())->update(['LikePost' => 1]);
            }
        } else {
            $Like = new Like;
            $Like->PostID = $id;
            $Like->ID = auth()->id();
            $Like->LikePost = 1;
            $Like->save();
        }

        $arr['Data'] = Like::where('PostID', $id)->where('LikePost', 1)->get();
        echo json_encode($arr);
        exit;
    }

    public function PostComment($id, Request $request)
    {
        $Comment = new Comment;
        $Comment->PostID = $id;
        $Comment->CommentReplyID = 0;
        $Comment->OrderNumber = 1;
        $Comment->ID = auth()->id();

        if (Auth::guard('foundations')->check()) {
            $Comment->RoleID = 2;
        } else {
            $Comment->RoleID = 1;
        }
        $Comment->Comment = $request->text;
        $Comment->CommentDate = Carbon::Now()->toDateTimeString();

        $UserName = "";
        $PhotoPath = "";

        $ReplyTo = "";
        $hrefProfile = "";
        $commentForm = Comment::where('CommentID', $id)->first();
        if (Auth::guard('foundations')->check()) {
            $UserName = Auth::guard('foundations')->user()->FoundationName;
            $hrefProfile = "foundationProfile/" . Crypt::encrypt(Auth::guard('foundations')->user()->FoundationID);
            if (Auth::guard('foundations')->user()->FoundationPhoto) {
                $PhotoPath = env('FTP_URL') . 'ProfilePicture/Yayasan/' . Auth::guard('foundations')->user()->FoundationPhoto->Path;
            } else {
                $PhotoPath = env('FTP_URL') . 'assets/Smiley.png';
            }
        } else {
            $UserName = Auth::user()->FirstName . ' ' . Auth::user()->LastName;
            $hrefProfile = "profile/" . Crypt::encrypt(Auth::user()->UserID);
            if (Auth::user()->Photo) {
                $PhotoPath = env('FTP_URL') . 'ProfilePicture/Donatur/' . Auth::user()->Photo->Path;
            } else {
                $PhotoPath = env('FTP_URL') . 'assets/Smiley.png';
            }
        }



        try {
            $Comment->save();
            $totalReplies = Comment::where('PostID', $id)->get()->count();
            $response = ['payload' => $Comment, 'totalReplies' => $totalReplies, 'UserName' => $UserName, 'date' => date('d M Y', strtotime($Comment->created_at)), 'PhotoPath' => $PhotoPath, 'hrefProfile' => $hrefProfile];
            return response()->json($response);
        } catch (Exception $ex) {
            return redirect('/');
        }
    }

    public function PostCommentFromForum($id, Request $request)
    {
        $Comment = new Comment;
        $Comment->PostID = $id;
        $Comment->CommentReplyID = 0;
        $Comment->OrderNumber = 1;
        $Comment->ID = auth()->id();
        $Comment->Comment = $request->text;
        $Comment->CommentDate = Carbon::Now()->toDateTimeString();

        $UserName = "";
        if (Auth::guard('foundations')->check()) {
            $UserName = Auth::guard('foundations')->user()->FoundationName;
            $Comment->RoleID = 2;
        } else {
            $UserName = Auth::user()->FirstName . ' ' . Auth::user()->LastName;
            $Comment->RoleID = 1;
        }

        try {
            $Comment->save();

            return redirect('/ViewPost/' . $id);
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function PostReply($idpost, $id, Request $request)
    {

        $LastComment = Comment::where('CommentID', $id)->orderby('OrderNumber', 'desc')->first();
        $Comment = new Comment;
        $Comment->PostID = $idpost;
        $Comment->CommentReplyID = $id;
        $Comment->OrderNumber = $LastComment->OrderNumber + 1;
        $Comment->ID = auth()->id();
        if (Auth::guard('foundations')->check()) {
            $Comment->RoleID = 2;
        } else {
            $Comment->RoleID = 1;
        }
        $Comment->Comment = $request->text;
        $Comment->CommentDate = Carbon::Now()->toDateTimeString();

        $UserName = "";
        $PhotoPath = "";
        $ReplyTo = "";
        $hrefProfile = "";
        $commentForm = Comment::where('CommentID', $id)->first();
        if ($commentForm->RoleID == 1) {
            $ReplyTo  = $commentForm->User->FirstName . " " . $commentForm->User->LastName;
        } else {
            $ReplyTo  = $commentForm->Foundation->FoundationName;
        }
        if (Auth::guard('foundations')->check()) {
            $UserName = Auth::guard('foundations')->user()->FoundationName;
            $hrefProfile = "foundationProfile/" . Crypt::encrypt(Auth::guard('foundations')->user()->FoundationID);
            if (Auth::guard('foundations')->user()->FoundationPhoto) {
                $PhotoPath = env('FTP_URL') . 'ProfilePicture/Yayasan/' . Auth::guard('foundations')->user()->FoundationPhoto->Path;
            } else {
                $PhotoPath = env('FTP_URL') . 'assets/Smiley.png';
            }
        } else {
            $UserName = Auth::user()->FirstName . ' ' . Auth::user()->LastName;
            $hrefProfile = "profile/" . Crypt::encrypt(Auth::user()->UserID);

            if (Auth::user()->Photo) {
                $PhotoPath = env('FTP_URL') . 'ProfilePicture/Donatur/' . Auth::user()->Photo->Path;
            } else {
                $PhotoPath = env('FTP_URL') . 'assets/Smiley.png';
            }
        }

        try {
            $Comment->save();
            $Comment->created_at = date('d M Y', strtotime($Comment->created_at));

            $totalReplies = Comment::where('PostID', $idpost)->get()->count();

            $response = ['payload' => $Comment, 'totalReplies' => $totalReplies, 'UserName' => $UserName, 'replyTo' => $ReplyTo, 'date' => date('d M Y', strtotime($Comment->created_at)), 'PhotoPath' => $PhotoPath, 'hrefProfile' => $hrefProfile];
            return response()->json($response);
        } catch (Exception $ex) {
            return redirect('/');
        }
    }




    public function ViewForum()
    {
        return view('Forum/ViewForum');
    }

    public function ViewThread()
    {
        return view('Forum/ViewThread');
    }


    public function TestDelete()
    {
        $ftp_server = "ftp.banskuy.com";
        $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
        $login = ftp_login($ftp_conn, 'Basnkuy2022@banskuy.com', 'b!Nu$_Basnkuy22FTP');

        $file = "ProfilePicture/Donatur/OQ==.jpg";

        // try to delete file
        if (ftp_delete($ftp_conn, $file)) {
            dd("deleted");
        } else {
            echo "Could not delete $file";
        }

        // close connection
        ftp_close($ftp_conn);
    }

    public function PostDelete(Request $request)
    {
        $post = Post::where('PostID', $request->PostDeleteID)->first();
        $comment = Comment::where('PostID', $post->PostID)->get();
        $like = Like::where('PostID', $post->PostID)->get();
        $path = $post->PostID . '/' . $post->PostPicture;
        $ftp = ftp_connect(env('FTP_SERVER'));
        $login_result = ftp_login($ftp, env('FTP_USERNAME'), env('FTP_PASSWORD'));
        if ($login_result) {
            if ($path && ftp_size($ftp, 'Forum/Post/' . $path) > 0)
                ftp_delete($ftp, 'Forum/Post/' . $path);
        } else {
            $request->session()->flash('toasterror', 'Terjadi kesalahan');
            return redirect('')->back();
        }
        ftp_close($ftp);
        $comment->each->delete();
        $like->each->delete();
        $post->delete();
        $request->session()->flash('toastsuccess', 'Post Berhasil Dihapus');
        return redirect('/Forum');
    }

    public function PostProfileDelete(Request $request)
    {
        $post = Post::where('PostID', $request->PostDeleteID)->first();
        $comment = Comment::where('PostID', $post->PostID)->get();
        $like = Like::where('PostID', $post->PostID)->get();
        $path = $post->PostID . '/' . $post->PostPicture;
        $ftp = ftp_connect(env('FTP_SERVER'));
        $login_result = ftp_login($ftp, env('FTP_USERNAME'), env('FTP_PASSWORD'));
        if ($login_result) {
            if ($path && ftp_size($ftp, 'Forum/Post/' . $path) > 0)
                ftp_delete($ftp, 'Forum/Post/' . $path);
        } else {
            $request->session()->flash('toasterror', 'Terjadi kesalahan');
            return redirect('')->back();
        }
        ftp_close($ftp);
        $comment->each->delete();
        $like->each->delete();
        $post->delete();
        $request->session()->flash('toastsuccess', 'Post Berhasil Dihapus');
        return redirect()->back();
    }

    public function CommentDelete(Request $request){
        $comment = Comment::where('CommentID', $request->id)->first();
        $commentReply = Comment::where('CommentReplyID', $comment->id)->get()->each->delete();
        $comment->delete();
        // dd($comment);
        $response = ['payload' => "success"];
        return response()->json($response);
    }
}
