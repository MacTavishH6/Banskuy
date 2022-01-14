<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;
use App\Events\Message;
use App\Events\MessageFoundation;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Foundation;

class MessageController extends Controller
{


    public function GetChat(Request $request){
        $id = Crypt::decrypt($request->id);
        $roleId = Crypt::decrypt($request->roleId);
        
        
        if($roleId == 1){
            $user = User::where('UserID',$id)->first();
        }
        else if($roleId == 2){
            $user = Foundation::where('FoundationID',$id)->first();
        }

        $Message = Messages::whereIn('SenderID', [$senderId,$receiverId])->whereIn('ReceiverID',[$senderId,$receiverId])->orderBy('created_at','asc')->first();
        if($Message != null){
            $messageExists = 1;
        }
        else{
            $messageExists = 2;
        }
        
        $result = ['userId' => $request->id,'username'=> $user->Username,'messageExists' => $messageExists];

        return view('/Message/Message',compact('result'));
    }

    public function SendMessages(Request $request){
        
        if(Auth::guard('foundations')->check()){
            $user = Auth::guard('foundations')->user();
            $id = Auth::guard('foundations')->user()->FoundationID;
            $senderRoleId = 2;
 
            
        }
        else{
            $user = Auth::user();
            $id = Auth::user()->UserID;
            $senderRoleId = 1;
      
        }
       
        $receiverId = Crypt::decrypt($request->receiverId);
     
        $Messages = new Messages;
        $Messages->ReceiverID = $receiverId;
        $Messages->SenderID = $id ;
        $Messages->Messages = $request->input('message');   
        $Messages->RoleId = $request->role;
        $Messages->SenderRoleID = $senderRoleId;
        $Messages->save();

        $date = date('d M Y',strtotime($Messages->created_at));
     
        if($Messages->RoleId == 1){
        
            $Receiver = User::where('UserID',$Messages->ReceiverID)->first();
            broadcast(new Message($Receiver,$request->input('message'),$date,$user->Username));

        }
        else{
            
            $Receiver = Foundation::where('FoundationID',$Messages->ReceiverID)->first();
            
            broadcast(new MessageFoundation($Receiver,$request->input('message'),$date,$user->Username));
        }
        
        

        $response = ['payload' => $date];
        return response()->json($response); 
    }


    public function GetMessage(Request $request){
        // $senderId = Crypt::decrypt($request->senderId);
        // $receiverId = Crypt::decrypt($request->receiverId);
        //$senderId = $request->senderId;
        $roleId = 0;
        if(Auth::guard('foundations')->check()){
            $User = Auth::guard('foundations');
            $id = Auth::guard('foundations')->user()->FoundationID;
            $roleId = 2;
        }
        else{
            $User = Auth::user();
            $id = Auth::user()->UserID;
            $roleId = 1;
        }
        $senderId = $id;
        $receiverId = Crypt::decrypt($request->receiverId);
        $Message = DB::table('trmessage')->whereIn('SenderID', [$senderId,$receiverId])->whereIn('ReceiverID',[$senderId,$receiverId])->orderBy('created_at','asc')->get();
        
        $DateMessage = '';
         $ListMessage = array();
        foreach($Message as $item){
            if(($item->ReceiverID == $id && $item->RoleId != $roleId) || ($item->SenderID == $id && $item->SenderRoleID != $roleId)){
                continue;
            }
            $ListMessage[] = ['senderId' => $item->SenderID,'receiverId' => $item->ReceiverID , 'messages' => $item->Messages, 'date' => date('d M Y',strtotime($item->created_at)) ];
        }

        $response = ['payload' => $ListMessage];
        return response()->json($response);
    }

    public function Chat(){
        $result =  ['id'=>"0",'roleId'=>"0"];
        return view('/Message/Message',compact('result'));
    }

    public function ChatTo(Request $request){
        // $id = Crypt::decrypt($request->id);
        $id = Crypt::encrypt($request->id);
        // $roleId = Crypt::decrypt($request->roleId);
        $roleId = $request->roleId;
        if($roleId == 1){
            $user = User::where('UserID',$id)->first();
        }
        else if($roleId == 2){
            $user = Foundation::where('FoundationID',$id)->first();
        }

        // $Message = Messages::whereIn('SenderID', [$senderId,$receiverId])->whereIn('ReceiverID',[$senderId,$receiverId])->orderBy('created_at','asc')->first();
        // if($Message != null){
        //     $messageExists = 0;
        // }
        // else{
        //     $messageExists = 1;
        // }
        
        $result =  ['id'=>$id,'roleId'=>$roleId];

        return view('/Message/Message',compact('result'));
    }

    public function GetListUserMessage(Request $request){
        $currUserId = $request->currUserId;

        if(Auth::guard('foundations')->check()){
            $User = Auth::guard('foundations');
            $id = Auth::guard('foundations')->user()->FoundationID;
            $roleId = 2;
        }
        else{
            $User = Auth::user();
            $id = Auth::user()->UserID;
            $roleId = 1;
        }

        $User = DB::table('trmessage')->select('SenderID','ReceiverID','RoleID','SenderRoleID')->where('ReceiverID',$currUserId)->orWhere('SenderID',$currUserId)->orderBy('created_at','asc')->distinct()->get();
        //$User = Messages::select('SenderID','ReceiverID')->where('ReceiverID',$currUserId)->orWhere('SenderID',$currUserId)->distinct()->get();
        // dd($User);
        // $ListUser = [];
        $ListUser = array();
        foreach($User as $val){
            if(($val->ReceiverID == $currUserId && $val->RoleID != $roleId) || ($val->SenderID == $currUserId && $val->SenderRoleID != $roleId)){
                continue;
            }
                if($val->SenderID == $currUserId){
                    $ListUser[] = ['UserID' =>$val->ReceiverID, 'RoleID' => $val->RoleID];
                }
                else{
                    $ListUser[] = ['UserID' =>$val->SenderID, 'RoleID' => $val->SenderRoleID];
                }   
        
        }   

        $chatTo = "";
        $exists = false;
        if($request->chatTo != ""){
            $chatTo = Crypt::decrypt($request->chatTo);
        }
       
        
        if(count($User) > 0){
            $distinct  = array_unique($ListUser,SORT_REGULAR);
            
            foreach($distinct as $val){
                
                if($val['RoleID'] == 1){
                    $Name =  User::select('Username')->where('UserID',$val['UserID'])->first();
                }
                else{
                    $Name =  Foundation::select('Username')->where('FoundationID',$val['UserID'])->first();
                }

                $LastMessage = DB::table('trmessage')->whereIn('SenderID', [$currUserId,$val['UserID']])->whereIn('ReceiverID',[$currUserId,$val['UserID']])->orderBy('created_at','desc')->first();
                // $LastMessage = Messages::where('ReceiverID',$val)->where('SenderID',$currUserId)->orderBy('created_at','desc')->first();
                // if($LastMessage == null){
                // $LastMessage = Messages::where('ReceiverID',$currUserId)->where('SenderID',$val)->orderBy('created_at','desc')->first();
                // }
                
                $id = Crypt::encrypt($val['UserID']);
                    if($chatTo == $val['UserID']){
                        $exists = true;
                        $id = $request->chatTo;
                    }
                if($val != $currUserId){
                    $ListResponse[] = ['userId' => $id,'roleId'=>$val['RoleID'],'username' => $Name->Username,'lastMessage'=>$LastMessage->Messages,'date' => date('d M Y',strtotime($LastMessage->created_at))];
                }
            }
        }
        
        //dd($ListResponse);
        if($exists == false && $chatTo != ""){
            $roleId = $request->roleId;
            if($roleId == 1){
                $userTo =  User::select('Username')->where('UserID',$chatTo)->first();
            }
            else{
                $userTo =  Foundation::select('Username')->where('FoundationID',$chatTo)->first();
            }
            $ListResponse[] = ['userId' => $request->chatTo,'roleId' => $roleId,'username' => $userTo->Username,'lastMessage'=> "",'date'=> date('d M Y',strtotime(Carbon::now()))];
        }

        $ListResponse = array_reverse($ListResponse);
        
        // Crypt::decrypt($val)
        $response = ['payload' => $ListResponse];
        return response()->json($response);

    }
}