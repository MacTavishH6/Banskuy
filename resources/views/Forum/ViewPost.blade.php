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
            width:50%
        }
    </style>

    <script>
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
                url : '/PostReply/' + $PostID + '/' + $CommentID;
                type : 'post',
                data:{
                    Comment : Comment
                },
                success:function(response){
                    var CommentBody;
                    var Body = '';
                    if(response.Data && response.length > 0){
                        response.Data.forEach(Comment => {
                            Body += "<div id=\"ReplySection\" class=\"ml-5\">";
                            Body += "<div class=\"media mb-2\">";
                            Body += "<img class=\"mr-3 mt-2   d-block rounded-circle\" style=\"height:50px;width:50px\"";
                            Body += "src=\"https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png\">"; 
                            Body += "<div class=\"border mt-2\">";
                            Body += "<div class=\"media-body p-3\">";
                            BodY += "<div class=\"d-flex \">";
                            BodY += "<div class=\"p-1\">";
                            Body += "<h5 style=\"font-weight: normal\"></h5>"
                            Body += "</div>";
                            Body += "</div>";            
                            Body += "</div>";            
                            Body += "</div>";            
                            Body += "</div>";
                            Body += "</div>";
                        });
                    }
                }
            });
        }

        function btnShowRepliesOnClick(){
            if($('#CollapseComment').css('display') == 'none'){
                $('#CollapseComment').css("display","block");
            }
            else{
                $('#CollapseComment').css("display","none");
            }
        }

        function btnReplyCommentOnClick($id,$PostID){
            $('.ReplyComment').remove();
            var Body = '';
            Body += "<div class=\"ReplyComment p-2 bd-higlight mb-2 mt-2 ml-5 h-75\" id=\"divReplyForm"+$id+"\" >";
            Body += "<form method=\"POST\" enctype=\"multipart/form-data\">"
        
            Body += "<div class=\"form-inline\">"
            Body += "<div class=\"form-group w-100 ml-4\" >"
            Body += "<input type=\"text\" class=\"form-control w-75 mr-3\" style=\"height: 28px;font-size:10pt\"";
            Body += "placeholder=\"Leave a comment...\" id=\"txtReplyComment" + $id +"\" name=\"txtReplyComment\">";
            Body += "<button type=\"submit\" id=\"btnSendReply\" onclick=\"btnSendReply("+$PostID + "," + $id +")\"";
            Body += "class=\"btn btn-primary px-3 py-1\" style=\"font-size:10pt\">Send</button>";                                   
            Body += "</div>";
            Body += "</div>";
            Body += "</form>";
            Body += "</div>";
            $('#CommentSection' + $id).append(Body);
        }

        // <div id="ReplySection" class="ml-5">
        //                                 <div class="media mb-2">
        //                                     {{-- <img class="mr-3 d-block rounded-circle" style="height:100px;width:100px"  src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png"> --}}
        //                                     <img class="mr-3 mt-2   d-block rounded-circle" style="height:50px;width:50px"
        //                                         src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png">
        //                                     <div class="border mt-2">
        //                                         <div class="media-body p-3">
        //                                             <div class="d-flex ">
        //                                                 <div class="p-1">
        //                                                     <h5 style="font-weight: normal">{{$Reply->User->FirstName}} {{$Reply->User->LastName}}</h5>
        //                                                 </div>
        //                                                 <div class="p-1 text-muted mr-4">
        //                                                     <small>{{date('d M Y',strtotime($Reply->created_at))}}</small> 
        //                                                 </div>
        //                                                 <div class="p-1 text-muted">
        //                                                     <small>Reply to {{$Comment->User->FirstName}} {{$Comment->User->LastName}}</small> 
        //                                                 </div>
        //                                             </div>
        //                                             <h6>{{$Reply->Comment}}</h6>
        //                                         </div>
        //                                     </div>
        //                                 </div>
                                        
        //                             </div>
    </script>

    {{-- css style end here --}}

    <div class="container" >
        {{-- SLIDER START HERE --}}
        <div class="slider">
            @include('Shared.Slider')
        </div>
        {{-- SLIDER END HERE --}}


        <div class="card w-100 mx-auto">
            <div class="card-header">
                <div class="media mb-3">
                    {{-- <img class="mr-3 d-block rounded-circle" style="height:100px;width:100px"  src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png"> --}}
                    <img class="mr-3 d-block rounded-circle" style="height:75px;width:75px"
                        src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png">

                    <div class="media-body mt-3">
                        <div class="d-flex">
                            <div class="mr-auto">
                                <h4>{{$Post->PostTitle}}</h4>
                            </div>
                            <div class="mr-2">
                                <button type="submit" class="btn btn-warning pb-2 pt-1 px-1">
                                    Contact Author</button>
                            </div>
                            <div class="mr-2">
                                <button type="submit" class="btn btn-primary pb-2 pt-1 px-1">Open For
                                    Donation</button>
                            </div>
                            <div><button type="button" class="btn btn-danger pb-2 pt-1 px-3" data-toggle="modal"
                                    data-target="#mdlMakeReport">
                                    Report
                                </button></div>
                        </div>
                        <div class="d-flex">
                            <div class="mr-2">
                                <h5 style="font-weight: normal">{{$Post->User->FirstName}} {{$Post->User->LastName}}</h5>
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
                        <img class="w-75 h-50" src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/Post/{{$Post->PostID}}/{{$Post->PostPicture}}">
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
                                    <h6 class="text-muted">{{count($Post->Comment)}} Replies</h6>
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
                                    <div class="border mt-2">
                                        <div class="media-body p-3">
                                            <div class="d-flex ">
                                                <div class="p-1">
                                                    <h5 style="font-weight: normal">{{$Comment->User->FirstName}} {{$Comment->User->LastName}}</h5>
                                                </div>
                                                <div class="p-1 text-muted mr-auto">
                                                    <small>{{date('d M Y',strtotime($Comment->created_at))}}</small> 
                                                </div>
                                                <div>
                                                    <button id="btnReplyComment" class="btn btn-link">
                                                        <button id="btnReplyComment" class="btn btn-link" onclick="btnReplyCommentOnClick({{$Comment->CommentID}},{{$Post->PostID}})">
                                                            <h6>Reply</h6>
                                                        </button>
                                                    </button>
                                                </div>
                                            </div>
                                            <h6>{{$Comment->Comment}}</h6>
                                        </div>
                                    </div>
                                </div>
                             

                             @foreach ($Post->Comment as $Reply)
                                @if ($Reply->CommentReplyID == $Comment->CommentID)
                                    
                                @endif
                            @endforeach
                        </div> 
                            @endif
                            @endforeach
                            <div class="p-2 bd-higlight mb-2 mt-4">
                                <form method="POST" enctype="multipart/form-data" action="/PostComment/{{$Post->PostID}}">
                                    @csrf
                                    <div class="form-inline">
                                        <div class="form-group w-100">
                                            <input type="text" class="form-control w-75 mr-3"
                                                placeholder="Leave a comment..." id="txtComment" name="txtComment">
                                            <button type="submit"
                                                class="btn btn-primary px-4">Send</button>
                                        </div>
                                    </div>
                                </form>
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
