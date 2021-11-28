@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- css style start here --}}
    <style>
        

        .btn {
            border-radius: 21px;
            text-decoration: none;
        }

        .border {
            border-radius: 30px;
        }

        #ReplySection {
            max-width: 90%;
        }

        .container{
            width:60%
        }
    </style>

    <script>

    $( document ).ready(function() {

             
             $("#txaReportDesc").on("change keyup paste",function(){
               
                var TextLength = $('#txaReportDesc').val().length;
                
                $('#lblDescLenght').text(TextLength + "/255");
             });
        });

            function btnSendCommentOnClick(){
                var Comment = $('#txtComment').val();
                $('#txtComment').val("");
                console.log(Comment);
                $.ajax({
                    type: 'POST',
                    url : '/PostComment/' + {{$Post->PostID}},
                    data: {text : Comment,_token: "<?php echo csrf_token(); ?>"},
                    success:function(response){
                    var commentResponse = response.payload; 
                    console.log(commentResponse);
                    var Body = "";
                    var Name = response.UserName;
                    
                    
                    //var Name = "{{Auth::user()->FirstName}} {{Auth::user()->LastName}}";
                            Body += "<div id=\"CommentSection" + commentResponse.CommentID +"\">";
                            Body += "<div class=\"media\">";
                            Body += "<img class=\"mr-3 mt-2    d-block rounded-circle\" style=\"height:50px;width:50px\" src=\"https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png\">"
                            Body += "<div class=\"border mt-2 w-100\">";
                            Body += "<div class=\"media-body p-3\">";
                            Body += "<div class=\"d-flex \">";
                            Body += "<div class=\"p-1\"> <h5 style=\"font-weight: normal\">"+Name+"</h5></div>";
                            Body += "<div class=\"p-1 text-muted mr-auto\"> <small>"+response.date+"</small></div>"
                            Body += "<div>";
                            Body += "<button id=\"btnReplyComment\" class=\"btn btn-link\" onclick=\"btnReplyCommentOnClick("+commentResponse.CommentID+","+commentResponse.PostID+")\">"
                            Body += "<h6>Reply</h6> </button>"                      
                            Body += "</div>"
                            Body += "</div>";
                            Body += "<h6>"+commentResponse.Comment+"</h6>"; 
                            Body += "</div>";
                            Body += "</div>";
                            Body += "</div>";
                            Body += "</div>";
                            var tempTxtCommentSection = $('#formComment').clone();
                            $('#formComment').remove();
                            $('#CollapseComment').append(Body);
                            $('#CollapseComment').append(tempTxtCommentSection);
                            var closeText = "<h6 class=\"text-muted\">Close "+response.totalReplies +" replies <i class=\"fa fa-angle-up\"></i></h6>";
                            $('#btnShowReplies').html(closeText);
                    }
                });
            }




        function btnLikeOnClick($id){
            $.ajax({
                url : '/sendlike/' + $id,
                type : 'get',
                dataType : 'json',
                success:
                function(response){
                    var Lenght = 0;
                    if(response['Data'] != null){
                        $('#lblLike').text(response['Data'].length + ' Like');
                    }
                }
            });
        }
   
       

        function btnSendReply($PostID,$CommentID){

            var Comment = $('#txtReplyComment' + $CommentID).val();


            $.ajax({
                type:'POST',
                url: '/PostReply/' + $PostID + '/' + $CommentID,
                data:{text:Comment,_token: "<?php echo csrf_token(); ?>"},
                success:function(response){
                    var Reply = response.payload;
                    var Name = response.UserName;
                    
                    var Body = "";
                    Body += "<div id=\"ReplySection\" class=\"ml-5\">";
                            Body += "<div class=\"media mb-2\">";
                            Body += "<img class=\"mr-3 mt-2   d-block rounded-circle\" style=\"height:50px;width:50px\" src=\"https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png\">"
                            Body += "<div class=\"border mt-2 w-100\">";
                            Body += "<div class=\"media-body p-3\">";
                            Body += "<div class=\"d-flex\">";
                            Body += "<div class=\"p-1\"> <h5 style=\"font-weight: normal\">"+Name+"</h5></div>"
                            Body += "<div class=\"p-1 text-muted mr-auto\"> <small>"+response.date+"</small></div>"
                            Body += "<div class=\"p-1 text-muted\"><small>Reply to "+ response.replyTo +"</small> </div>"
                            Body += "</div>"; 
                            Body += "<h6>"+Reply.Comment+"</h6>"; 
                            Body += "</div>";  
                            Body += "</div>";
                            Body += "</div>";    
                            Body += "</div>";
                            $('#CommentSection' + $CommentID).append(Body);
                            var closeText = "<h6 class=\"text-muted\">Close "+response.totalReplies +" replies <i class=\"fa fa-angle-up\"></i></h6>";
                            $('#btnShowReplies').html(closeText);
                }
            });
            $('.ReplyComment').remove();
            
        }



        function btnShowRepliesOnClick(){
            if($('#CollapseComment').css('display') == 'none'){
                $('#CollapseComment').css("display","block");
                var closeText = "<h6 class=\"text-muted\">Close "+{{count($Post->Comment)}}+" replies <i class=\"fa fa-angle-up\"></i></h6>";
                $('#btnShowReplies').html(closeText);
            }
            else{
                var openText = "<h6 class=\"text-muted\">See "+{{count($Post->Comment)}}+" replies <i class=\"fa fa-angle-down\"></i></h6>";
                $('#btnShowReplies').html(openText);
                $('#CollapseComment').css("display","none");
            }
        }

        function btnReplyCommentOnClick($id,$PostID){
            $('.ReplyComment').remove();
            var Body = '';
            Body += "<div class=\"ReplyComment p-2 bd-higlight mb-2 mt-2 ml-5 h-75\" id=\"divReplyForm"+$id+"\" >";
            // += "<form>"
                
            Body += "<div class=\"form-inline\">"
            Body += "<div class=\"form-group w-100 ml-5\" >"
            Body += "<input type=\"text\" class=\"form-control w-75 mr-3\" style=\"height: 28px;font-size:10pt\"";
            Body += "placeholder=\"Leave a comment...\" id=\"txtReplyComment" + $id +"\" name=\"txtReplyComment\">";
            Body += "<button type=\"button\" id=\"btnSendReply1\" onclick=\"btnSendReply("+ $PostID + "," + $id+ ")\" class=\"btn btn-primary px-3 py-1\" style=\"font-size:10pt\">Send</button>";                                   
            Body += "</div>";
            Body += "</div>";
           // Body += "</form>";
            Body += "</div>";
            $('#CommentSection' + $id).append(Body);
        }

        function btnMakeReportOnClick(){
            $.ajax({
                type: 'GET',
                dataType : 'json',
                url : '/GetReportCategory',
                success:function(response){
                    if(response.payload){
                        $('#ddlReportType').empty();
                        $.each(response.payload,function(index){
                            var Value = response.payload[index].ReportCategoryID;
                            var Name = response.payload[index].ReportCategoryName;
                            $('#ddlReportType').append("<option value="+Value+">"+Name+"</option");
                        });
                    }
                }
            });
        }

    </script>

    {{-- css style end here --}}

    <div class="container" >
        {{-- SLIDER START HERE --}}
        <div class="slider" style="margin-left: 20%">
            @include('Shared.Slider')
        </div>
        {{-- SLIDER END HERE --}}


        <div class="card w-100 mx-auto">
            <div class="card-header">
                <div class="media mb-3">
                    {{-- <img class="mr-3 d-block rounded-circle" style="height:100px;width:100px"  src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png"> --}}
                        @if (Auth::guard('foundations')->check())
                        <img src="{{ env('FTP_URL') }}{{ Auth::guard('foundations')->user()->FoundationPhoto ? 'ProfilePicture/Yayasan/' . Auth::guard('foundations')->user()->FoundationPhoto->Path : 'assets/Smiley.png' }}"
                        alt="FoundationPhotoProfile" class="mr-3 d-block rounded-circle"
                        style="height:75px;width:75px"
                        onerror="this.onerror==null;this.src='{{ env('FTP_URL') }}assets/Smiley.png'">

                        
                        @else
                        <img src="{{ env('FTP_URL') }}{{ Auth::user()->Photo ? 'ProfilePicture/Donatur/' . Auth::user()->Photo->Path : 'assets/Smiley.png' }}"
                        alt="UsernamePhotoProfile" class="mr-3 d-block rounded-circle"
                        style="height:75px;width:75px"
                        onerror="this.onerror==null;this.src='{{ env('FTP_URL') }}assets/Smiley.png'">

                        
                        @endif

                    <div class="media-body mt-3">
                        <div class="d-flex">
                            <div class="mr-auto">
                                <h2>{{$Post->PostTitle}}</h2>
                            </div>
                            <div class="mr-2">
                                <button type="submit" class="btn btn-warning pb-2 pt-1 px-1">
                                    Contact Author</button>
                            </div>
                            <div class="mr-2">
                                @if ($Post->PostTypeID == 1)
                                    <a class="btn btn-secondary pb-2 pt-1 px-1" id="btnOpenDonation" href="#">
                                        Ask For Donation
                                    </a> 
                                    @else
                                    <a class="btn btn-primary pb-2 pt-1 px-1" id="btnOpenDonation" href="/makerequestwithpost/{{Crypt::encrypt($Post->PostID)}}">
                                        Open For Donation
                                    </a> 
                                    @endif
                            </div>
                            <div><button id="btnMakeReport" type="button" class="btn btn-danger pb-2 pt-1 px-3" data-toggle="modal"
                                    data-target="#mdlMakeReport" onclick="btnMakeReportOnClick()">
                                    Report
                                </button></div>
                        </div>
                        <div class="d-flex">
                            <div class="mr-2">
                                @if (Auth::guard('foundations')->check())
                                <h5 style="font-weight: normal">{{Auth::guard('foundations')->user()->FoundationName}}</h5>
                                @else
                                <h5 style="font-weight: normal">{{Auth::user()->FirstName}} {{Auth::user()->LastName}}</h5>
                                @endif
                            </div>
                            <div class="text-muted">
                                <small>{{date('d M Y',strtotime($Post->created_at))}} at {{date('h:i A',strtotime($Post->created_at))}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column bd-highlight">
                    <div class="p-2 bd-highlight h6 font-weight-normal">
                        {{$Post->PostDescription}}
                    </div>
                    <div class="p-2 bd-highlight">
                        <img class="w-75 h-50" src="{{ env('FTP_URL') }}Forum/Post/{{$Post->PostID}}/{{$Post->PostPicture}}">
                    </div>
                    <div class="p-2 bd-highlight">
                        <div class="d-flex border-bottom">
                            <div class="p-2">
                                    <button class="btn btn-link" onclick="btnLikeOnClick({{$Post->PostID}})" id="btnLike">
                                    <i class="fa fa-thumbs-up fa-2x"></i>
                                    </button> 
                                    
                            </div>
                            <div class="mr-auto mt-3 pt-1">
                                <label id="lblLike">{{count($Like)}} Like</label>
                            </div>
                            <div class="p-3 ">
                                <button type="button" class="btn btn-link" style="text-decoration: none"
                                   id="btnShowReplies" onclick="btnShowRepliesOnClick()">
                                    <h6 class="text-muted">Close {{count($Post->Comment)}} replies <i class="fa fa-angle-up"></i></h6>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div id="accordion">
                        <div id="CollapseComment" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            @foreach ($Post->Comment as $Comment)
                            
                            @if ($Comment->CommentReplyID == 0)
                            <div id="CommentSection{{$Comment->CommentID}}">
                                <div class="media">
                                    {{-- <img class="mr-3 d-block rounded-circle" style="height:100px;width:100px"  src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png"> --}}
                                    <img class="mr-3 mt-2    d-block rounded-circle" style="height:50px;width:50px"
                                        src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png">
                                    <div class="border mt-2 w-100">
                                        <div class="media-body p-3">
                                            <div class="d-flex ">
                                                <div class="p-1">
                                                    <h5 style="font-weight: normal">{{$Comment->User->FirstName}} {{$Comment->User->LastName}}</h5>
                                                </div>
                                                <div class="p-1 text-muted mr-auto">
                                                    <small>{{date('d M Y',strtotime($Comment->created_at))}}</small> 
                                                </div>
                                                <div>
           
                                                        <button id="btnReplyComment" class="btn btn-link" onclick="btnReplyCommentOnClick({{$Comment->CommentID}},{{$Post->PostID}})">
                                                            <h6>Reply</h6>
                                                        </button>
                         
                                                </div>
                                            </div>
                                            <h6>{{$Comment->Comment}}</h6>
                                        </div>
                                    </div>
                                </div>
                             

                             @foreach ($Post->Comment as $Reply)
                                @if ($Reply->CommentReplyID == $Comment->CommentID)
                                        
                                  <div id="ReplySection" class="ml-5">
                                    <div class="media mb-2">
                                        {{-- <img class="mr-3 d-block rounded-circle" style="height:100px;width:100px"  src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png"> --}}
                                        <img class="mr-3 mt-2   d-block rounded-circle" style="height:50px;width:50px"
                                            src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png">
                                        <div class="border mt-2 w-100">
                                            <div class="media-body p-3">
                                                <div class="d-flex ">
                                                    <div class="p-1">
                                                        <h5 style="font-weight: normal">{{$Reply->User->FirstName}} {{$Reply->User->LastName}}</h5>
                                                    </div>
                                                    <div class="p-1 text-muted mr-auto">
                                                        <small>{{date('d M Y',strtotime($Reply->created_at))}}</small> 
                                                    </div>
                                                    <div class="p-1 text-muted">
                                                        <small>Reply to {{$Comment->User->FirstName}} {{$Comment->User->LastName}}</small> 
                                                    </div>
                                                </div>
                                                <h6>{{$Reply->Comment}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                @endif
                            @endforeach
                        </div> 
                            @endif
                            @endforeach
                            <div class="p-2 bd-higlight mb-2 mt-4" id="formComment">
                                {{-- <form method="POST" enctype="multipart/form-data" action="" >
                                    @csrf --}}
                                    <div class="form-inline">
                                        <div class="form-group w-100">
                                            <input type="text" class="form-control w-75 mr-3"
                                                placeholder="Leave a comment..." id="txtComment" name="txtComment">
                                            <button type="button"
                                                class="btn btn-primary px-4" id="btnSendComment" onclick="btnSendCommentOnClick()" >Send</button>
                                        </div>
                                    </div>
                                {{-- </form> --}}
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- POP UP CREATE POST START HERE --}}
        <div class="slider">
            @include('Forum.Misc.component-form-reportpopup')
        </div>
        {{-- POP UP CREATE POST End HERE --}}
        

    </div>



@endsection
