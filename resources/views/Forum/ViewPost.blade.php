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

        .container {
            width: 60%
        }

    </style>

    <script>
        $(document).ready(function() {


            $("#txaLaporkanDesc").on("change keyup paste", function() {

                var TextLength = $('#txaReportDesc').val().length;

                $('#lblDescLenght').text(TextLength + "/255");
            });

                $(".custom-file-input").on("change",function(){
               
                    var FileUpload = $('#fuAttachment').val().split('\\').pop();
                    console.log(FileUpload)
                        $(this).siblings(".custom-file-label").addClass("selected").html(FileUpload);
                });
   
                
                $("#txaPostDesc").on("change keyup paste",function(){
                  
                   var TextLength = $('#txaPostDesc').val().length;
                   
                   $('#lblDescLenght').text(TextLength + "/255");
                });

            $(".menuAction").click(function() {
                if ($('#ddlActionStatus').val() == "hide") {
                    $('#ddlActionPost').addClass("show");
                    // $('#ddlActionComment').addClass("show");
                    $('#ddlActionStatus').val('show');
                    
                } else {
                    $('#ddlActionPost').removeClass("show");
                    // $('#ddlActionComment').removeClass("show");
    
                    $('#ddlActionStatus').val("hide");
                }
            });

            $("#hapus-post").on('click', function () {
                $("input[name='PostDeleteID']").val($(this).attr('data-id'))
                $("#modal-delete-confirmation").modal()
            })

            $("button[id^='btn-hapuscomment-']").on('click', function() {
                let commentid = $(this).attr('data-id')
                let data = {
                    _token: "<?php echo csrf_token(); ?>",
                    id: commentid
                }
                banskuy.postReq('/Comment/Delete', data)
                    .then(function(response) {
                        if (response.payload == 'success') {
                            toastr.success('Komentar berhasil dihapus')
                            window.setTimeout(function() {
                                location.reload()
                            }, 1000)
                        }
                    })
            })
        });

        function ChangeDonationTypeDetail(val) {
            $.ajax({
                url: '/GetDonationCategoryDetail/' + val.value,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    var Lenght = 0;
                    if (response['Data'] != null) {
                        $('#ddlDonationTypeDetail').empty();
                        for (var i = 0; i < response['Data'].length; i++) {
                            var Value = response['Data'][i].DonationTypeDetailID;
                            var Name = response['Data'][i].DonationTypeDetail;
                            $('#ddlDonationTypeDetail').append('<option value =' + Value + '>' + Name +
                                '</option>');
                        }
                    }
                }
            });
        }

        function btnSendCommentOnClick() {
            var Comment = $('#txtComment').val();
            $('#txtComment').val("");
            //console.log(Comment);
            $.ajax({
                type: 'POST',
                url: '/PostComment/' + {{ $Post->PostID }},
                data: {
                    text: Comment,
                    _token: "<?php echo csrf_token(); ?>"
                },
                success: function(response) {
                    var commentResponse = response.payload;
                    var Body = "";
                    var Name = response.UserName;

                    Body += "<div id=\"CommentSection" + commentResponse.CommentID + "\">";
                    Body += "<div class=\"media\">";
                    Body +=
                        "<img class=\"mr-3 mt-2    d-block rounded-circle\" style=\"height:50px;width:50px\" src=\"" +
                        response.PhotoPath + "\">";


                    Body += "<div class=\"border mt-2 w-100\">";
                    Body += "<div class=\"media-body p-3\">";
                    Body += "<div class=\"d-flex \">";

                    Body += "<div class=\"p-1\"> <a href=\"/" + response.hrefProfile +
                        "\" style=\"color: black\"><h5 style=\"font-weight: normal\">" + Name +
                        "</h5></a></div> ";

                    Body += "<div class=\"p-1 text-muted mr-auto\"> <small>" + response.date + "</small></div>"
                    Body += "<div>";
                    Body +=
                        "<button class=\"btn btn-link float-right\" id=\"btn-hapuscomment-" + commentResponse
                        .CommentID + "\" data-id=\"" +
                        commentResponse.CommentID + "\">Hapus</button>"
                    Body +=
                        "<button id=\"btnReplyComment\" class=\"btn btn-link\" onclick=\"btnReplyCommentOnClick(" +
                        commentResponse.CommentID + "," + commentResponse.PostID + ")\">"
                    Body += "<h6>Reply</h6> </button>"
                    Body += "</div>"
                    Body += "</div>";
                    Body += "<h6>" + commentResponse.Comment + "</h6>";
                    Body += "</div>";
                    Body += "</div>";
                    Body += "</div>";
                    Body += "</div>";
                    var tempTxtCommentSection = $('#formComment').clone();
                    $('#formComment').remove();
                    $('#CollapseComment').append(Body);
                    $('#CollapseComment').append(tempTxtCommentSection);
                    var closeText = "<h6 class=\"text-muted\">Tutup " + response.totalReplies +
                        " komentar <i class=\"fa fa-angle-up\"></i></h6>";
                    $('#btnShowReplies').html(closeText);
                    $("button[id^='btn-hapuscomment-']").on('click', function() {
                        let commentid = $(this).attr('data-id')
                        let data = {
                            _token: "<?php echo csrf_token(); ?>",
                            id: commentid
                        }
                        banskuy.postReq('/Comment/Delete', data)
                            .then(function(response) {
                                if (response.payload == 'success') {
                                    toastr.success('Komentar berhasil dihapus')
                                    window.setTimeout(function() {
                                        location.reload()
                                    }, 1000)
                                }
                            })
                    })

                }
            });
        }




        function btnLikeOnClick($id) {
            $.ajax({
                url: '/sendlike/' + $id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    var Lenght = 0;
                    if (response['Data'] != null) {
                        $('#lblLike').text(response['Data'].length + ' Like');
                    }
                }
            });
        }



        function btnSendReply($PostID, $CommentID) {

            var Comment = $('#txtReplyComment' + $CommentID).val();


            $.ajax({
                type: 'POST',
                url: '/PostReply/' + $PostID + '/' + $CommentID,
                data: {
                    text: Comment,
                    _token: "<?php echo csrf_token(); ?>"
                },
                success: function(response) {
                    var Reply = response.payload;
                    var Name = response.UserName;
                    console.log(response);
                    var Body = "";
                    Body += "<div id=\"ReplySection\" class=\"ml-5\">";
                    Body += "<div class=\"media mb-2\">";

                    Body +=
                        "<img class=\"mr-3 mt-2    d-block rounded-circle\" style=\"height:50px;width:50px\" src=\"" +
                        response.PhotoPath + "\">"
                    Body += "<div class=\"border mt-2 w-100\">";
                    Body += "<div class=\"media-body p-3\">";
                    Body += "<div class=\"d-flex\">";
                    //Body += "<div class=\"p-1\"> <h5 style=\"font-weight: normal\">"+Name+"</h5></div>"
                    Body += "<div class=\"p-1\"><small>Reply to " + response.replyTo +
                        "</small> <a href=\"/" + response.hrefProfile +
                        "\" style=\"color: black\"><h5 style=\"font-weight: normal\">" + Name +
                        "</h5></a></div> ";

                    Body += "<div class=\"p-1 text-muted mr-auto\"> <small> | " + response.date + "</small></div>"
                    Body += "<div class=\"p-1 text-muted\"> <button class=\"btn btn-link float-right\" id=\"btn-hapuscomment-" + Reply
                        .id + "\" data-id=\"" +
                        Reply.CommentID + "\">Hapus</button> </div>"
                    Body += "</div>";
                    Body += "<h6>" + Reply.Comment + "</h6>";
                    Body += "</div>";
                    Body += "</div>";
                    Body += "</div>";
                    Body += "</div>";
                    $('#CommentSection' + $CommentID).append(Body);
                    var closeText = "<h6 class=\"text-muted\">Tutup " + response.totalReplies +
                        " komentar <i class=\"fa fa-angle-up\"></i></h6>";
                    $('#btnShowReplies').html(closeText);

                    $("button[id^='btn-hapuscomment-']").on('click', function() {
                        let commentid = $(this).attr('data-id')
                        let data = {
                            _token: "<?php echo csrf_token(); ?>",
                            id: commentid
                        }
                        banskuy.postReq('/Comment/Delete', data)
                            .then(function(response) {
                                if (response.payload == 'success') {
                                    toastr.success('Komentar berhasil dihapus')
                                    window.setTimeout(function() {
                                        location.reload()
                                    }, 1000)
                                }
                            })
                    })
                }
            });
            $('.ReplyComment').remove();

        }



        function btnShowRepliesOnClick() {
            if ($('#CollapseComment').css('display') == 'none') {
                $('#CollapseComment').css("display", "block");
                var closeText = "<h6 class=\"text-muted\">Tutup " + {{ count($Post->Comment) }} +
                    " komentar <i class=\"fa fa-angle-up\"></i></h6>";
                $('#btnShowReplies').html(closeText);
            } else {
                var openText = "<h6 class=\"text-muted\">Lihat " + {{ count($Post->Comment) }} +
                    " komentar <i class=\"fa fa-angle-down\"></i></h6>";
                $('#btnShowReplies').html(openText);
                $('#CollapseComment').css("display", "none");
            }
        }

        function btnReplyCommentOnClick($id, $PostID) {
            $('.ReplyComment').remove();
            var Body = '';
            Body += "<div class=\"ReplyComment p-2 bd-higlight mb-2 mt-2 ml-5 h-75\" id=\"divReplyForm" + $id + "\" >";
            // += "<form>"

            Body += "<div class=\"form-inline\">"
            Body += "<div class=\"form-group w-100 ml-5\" >"
            Body += "<input type=\"text\" class=\"form-control w-75 mr-3\" style=\"height: 28px;font-size:10pt\"";
            Body += "placeholder=\"Tinggalkan komentar...\" id=\"txtReplyComment" + $id + "\" name=\"txtReplyComment\">";
            Body += "<button type=\"button\" id=\"btnSendReply1\" onclick=\"btnSendReply(" + $PostID + "," + $id +
                ")\" class=\"btn btn-primary px-3 py-1\" style=\"font-size:10pt\">Send</button>";
            Body += "</div>";
            Body += "</div>";
            // Body += "</form>";
            Body += "</div>";
            $('#CommentSection' + $id).append(Body);
        }

        function btnMakeReportOnClick() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/GetReportCategory',
                success: function(response) {
                    if (response.payload) {
                        $('#ddlReportType').empty();
                        $.each(response.payload, function(index) {
                            var Value = response.payload[index].ReportCategoryID;
                            var Name = response.payload[index].ReportCategoryName;
                            $('#ddlReportType').append("<option value=" + Value + ">" + Name +
                                "</option");
                        });
                    }
                }
            });
        }
    </script>

    {{-- css style end here --}}

    <div class="container">
        {{-- SLIDER START HERE --}}
        <div class="slider">
            @include('Shared.Slider')
        </div>
        {{-- SLIDER END HERE --}}


        <div class="card w-100 mx-auto">
            <div class="card-header">
                <div class="media mb-3">
                    {{-- <img class="mr-3 d-block rounded-circle" style="height:100px;width:100px"  src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png"> --}}
                    @if ($Post->RoleID == 2)
                        <img src="{{ env('FTP_URL') }}{{ $Post->Foundation->FoundationPhoto ? 'ProfilePicture/Yayasan/' . $Post->Foundation->FoundationPhoto->Path : 'assets/Smiley.png' }}"
                            alt="FoundationPhotoProfile" class="mr-3 d-block rounded-circle" style="height:75px;width:75px"
                            onerror="this.onerror==null;this.src='{{ env('FTP_URL') }}assets/Smiley.png'">


                    @else
                        <img src="{{ env('FTP_URL') }}{{ $Post->User->Photo ? 'ProfilePicture/Donatur/' . $Post->User->Photo->Path : 'assets/Smiley.png' }}"
                            alt="UsernamePhotoProfile" class="mr-3 d-block rounded-circle" style="height:75px;width:75px"
                            onerror="this.onerror==null;this.src='{{ env('FTP_URL') }}assets/Smiley.png'">


                    @endif

                    <div class="media-body mt-3">
                        <div class="d-flex">
                            <div class="mr-auto">
                                <h2>{{ $Post->PostTitle }}</h2>
                            </div>
                            @if (Auth::check() || Auth::guard('foundations')->check())
                                <div class="btn-group dropleft">
                                    <a href="#" class="menuAction" style="color: black" role="button" id="btnAction" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-align-justify"></i>
                                    </a>

                                    <div class="dropdown-menu" id="ddlActionPost" aria-labelledby="btnAction">
                                        {{-- <a class="dropdown-item" href="#">Action</a>
                                  <a class="dropdown-item" href="#">Another action</a>
                                  <a class="dropdown-item" href="#">Something else here</a> --}}


                                        @if ($Post->StatusPostId == 1)
                                            @if ($Post->PostTypeID == 1 && Auth::guard('foundations')->check())
                                            @elseif(Auth::check() && $Post->PostTypeID == 2)
                                                <a class="dropdown-item" href="/makerequestwithpost/{{Crypt::encrypt($Post->PostID)}}"">
                                                                                                                    Memberikan Donasi
                                                                                                                </a> 
                                                                                                                          
                                                                                  @endif
                                                @elseif($Post->StatusPostId == 2)
                                                    <a class="dropdown-item" href="#"">
                                                                                                                    Post Ditutup
                                                                                                                </a>  
                                                                                                                       
                                                                                 @endif
                                                        @if ($Post->RoleID == 1 && Auth::check() && Auth::id() == $Post->ID)
                                                            <a class="dropdown-item" data-id="{{ $Post->PostID }}"
                                                                id="hapus-post" href="#"">
                                                                                                                    Hapus Post
                                                                                                                </a> 
                                        @elseif($Post->RoleID == 1 && Auth::guard('foundations') && Auth::guard('foundations')->id() == $Post->ID) 
                                                                                                                <a class="
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                           dropdown-item"
                                                                data-id="{{ $Post->PostID }}" id="hapus-post" href="#"">
                                                                                                                    Hapus Post
                                                                                                                </a> 
                                                                                                                       
                                                                                         @endif


                                                                @if ($StatusPost == true)

                                                                    <form action="/chatTo" method="POST"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input id="id" name="id" type="hidden"
                                                                            value="{{ $Post->ID }}">
                                                                        <input id="roleId" name="roleId" type="hidden"
                                                                            value="{{ $Post->RoleID }}">
                                                                        <button type="submit" class="dropdown-item">
                                                                            Hubungi Pembuat</button>
                                                                    </form>
                                                                    <button id="btnMakeReport" type="button"
                                                                        class="dropdown-item" data-toggle="modal"
                                                                        data-target="#mdlMakeReport"
                                                                        onclick="btnMakeReportOnClick()">
                                                                        Report
                                                                    </button>
                                                                @else
                                                                    <div>
                                                                        <button type="button" class="dropdown-item"
                                                                            data-toggle="modal" data-target="#mdlEditPost">
                                                                            <h6>Edit Post</h6>
                                                                        </button>
                                                                    </div>

                                                                @endif



                                    </div>
                                </div>
                                <input type="hidden" id="ddlActionStatus" value="hide">
                            @endif
                        </div>
                        <div class="d-flex">
                            <div class="mr-2">
                                @if ($Post->RoleID == 2)
                                    <a href="/foundationprofile/{{ Crypt::encrypt($Post->ID) }}" style="color: black">
                                        <h5 style="font-weight: normal">{{ $Post->Foundation->FoundationName }}</h5>
                                    </a>
                                @else
                                    <a href="/profile/{{ Crypt::encrypt($Post->ID) }}" style="color: black">
                                        <h5 style="font-weight: normal">{{ $Post->User->FirstName }}
                                            {{ $Post->User->LastName }}</h5>
                                    </a>
                                @endif
                            </div>
                            <div class="text-muted">
                                <small>{{ date('d M Y', strtotime($Post->created_at)) }} at
                                    {{ date('h:i A', strtotime($Post->created_at)) }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column bd-highlight">
                    <div class="p-2 bd-highlight h6 font-weight-normal">
                        {{ $Post->PostDescription }}
                    </div>
                    <div class="p-2 bd-highlight">
                        <img class="w-75 h-50"
                            src="{{ env('FTP_URL') }}Forum/Post/{{ $Post->PostID }}/{{ $Post->PostPicture }}">
                    </div>
                    <div class="p-2 bd-highlight">
                        <div class="d-flex border-bottom">
                            @if (Auth::check() || Auth::guard('foundations')->check())
                                <div class="p-2">
                                    <button class="btn btn-link" onclick="btnLikeOnClick({{ $Post->PostID }})"
                                        id="btnLike">
                                        <i class="fa fa-thumbs-up fa-2x"></i>
                                    </button>

                                </div>
                            @endif
                            <div class="mr-auto mt-3 pt-1">
                                <label id="lblLike">{{ count($Like) }} Like</label>
                            </div>
                            <div class="p-3 ">
                                <button type="button" class="btn btn-link" style="text-decoration: none"
                                    id="btnShowReplies" onclick="btnShowRepliesOnClick()">
                                    <h6 class="text-muted">Tutup {{ count($Post->Comment) }} komentar <i
                                            class="fa fa-angle-up"></i></h6>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="accordion">
                        <div id="CollapseComment" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            @foreach ($Post->Comment as $Comment)

                                @if ($Comment->CommentReplyID == 0)
                                    <div id="CommentSection{{ $Comment->CommentID }}">
                                        <div class="media">
                                            {{-- <img class="mr-3 d-block rounded-circle" style="height:100px;width:100px"  src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png"> --}}
                                            @if ($Comment->RoleID == 1)
                                                <img class="mr-3 mt-2    d-block rounded-circle"
                                                    style="height:50px;width:50px"
                                                    src="{{ env('FTP_URL') }}{{ $Comment->User->Photo ? 'ProfilePicture/Donatur/' . $Comment->User->Photo->Path : 'assets/Smiley.png' }}">
                                            @else
                                                <img class="mr-3 mt-2    d-block rounded-circle"
                                                    style="height:50px;width:50px"
                                                    src="{{ env('FTP_URL') }}{{ $Comment->Foundation->FoundationPhoto ? 'ProfilePicture/Yayasan/' . $Comment->Foundation->FoundationPhoto->Path : 'assets/Smiley.png' }}">
                                            @endif

                                            <div class="border mt-2 w-100">
                                                <div class="media-body p-3">
                                                    <div class="d-flex ">
                                                        <div class="p-1">

                                                            @if ($Comment->RoleID == 2)
                                                                <a href="/foundationprofile/{{ Crypt::encrypt($Comment->ID) }}"
                                                                    style="color: black">
                                                                    <h5 style="font-weight: normal">
                                                                        {{ $Comment->Foundation->FoundationName }}</h5>
                                                                </a>
                                                            @else
                                                                <a href="/profile/{{ Crypt::encrypt($Comment->ID) }}"
                                                                    style="color: black">
                                                                    <h5 style="font-weight: normal">
                                                                        {{ $Comment->User->FirstName }}
                                                                        {{ $Comment->User->LastName }}</h5>
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="p-1 text-muted mr-auto">
                                                            <small>{{ date('d M Y', strtotime($Comment->created_at)) }}</small>
                                                        </div>
                                                        
                                                            @if (Auth::check() || Auth::guard('foundations')->check())
                                                            <div class="p-1 text-muted">
                                                                <button id="btnReplyComment" class="btn btn-link"
                                                                    onclick="btnReplyCommentOnClick({{ $Comment->CommentID }},{{ $Post->PostID }})">
                                                                    <h6>Reply</h6>
                                                                </button>
                                                                </div>
                                                                <div class="p-1 text-muted">
                                                                    @if ($Comment->RoleID == 2 && Auth::guard('foundations')->id() == $Comment->ID)
                                                                    <button class="btn btn-link"
                                                                        id="btn-hapuscomment-{{ $Comment->CommentID }}"
                                                                        data-id="{{ $Comment->CommentID }}">Hapus</button>
                                                                    @elseif($Comment->RoleID == 1 && Auth::id() == $Comment->ID)
                                                                    <button class="btn btn-link"
                                                                        id="btn-hapuscomment-{{ $Comment->CommentID }}"
                                                                        data-id="{{ $Comment->CommentID }}">Hapus</button>
                                                                    @endif
                                                                </div>
                                                                
            
                                                                
                                                            @endif
                                                        
                                                    </div>
                                                    <h6>{{ $Comment->Comment }}</h6>
                                                </div>
                                            </div>
                                        </div>


                                        @foreach ($Post->Comment as $Reply)
                                            @if ($Reply->CommentReplyID == $Comment->CommentID)

                                                <div id="ReplySection" class="ml-5">
                                                    <div class="media mb-2">

                                                        {{-- <img class="mr-3 d-block rounded-circle" style="height:100px;width:100px"  src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png"> --}}
                                                        @if ($Reply->RoleID == 1)
                                                            <img class="mr-3 mt-2    d-block rounded-circle"
                                                                style="height:50px;width:50px"
                                                                src="{{ env('FTP_URL') }}{{ $Reply->User->Photo ? 'ProfilePicture/Donatur/' . $Reply->User->Photo->Path : 'assets/Smiley.png' }}">
                                                        @else
                                                            <img class="mr-3 mt-2    d-block rounded-circle"
                                                                style="height:50px;width:50px"
                                                                src="{{ env('FTP_URL') }}{{ $Reply->Foundation->FoundationPhoto ? 'ProfilePicture/Yayasan/' . $Reply->Foundation->FoundationPhoto->Path : 'assets/Smiley.png' }}">
                                                        @endif
                                                        <div class="border mt-2 w-100">
                                                            <div class="media-body p-3">
                                                                @if ($Comment->RoleID == 1)
                                                                    <small class="text-muted p-1">Reply to
                                                                        {{ $Comment->User->FirstName }}
                                                                        {{ $Comment->User->LastName }} | {{ date('d M Y', strtotime($Reply->created_at)) }}</small>
                                                                @else
                                                                    <small class="text-muted p-1">Reply to
                                                                        {{ $Comment->Foundation->FoundationName }} | {{ date('d M Y', strtotime($Reply->created_at)) }}</small>
                                                                @endif
                                                                <div class="d-flex ">
                                                                    <div class="p-1">
                                                                        @if ($Reply->RoleID == 2)
                                                                            <a href="/foundationprofile/{{ Crypt::encrypt($Reply->ID) }}"
                                                                                style="color: black">
                                                                                <h5 style="font-weight: normal">
                                                                                    {{ $Reply->Foundation->FoundationName }}
                                                                                </h5>
                                                                            </a>
                                                                        @else
                                                                            <a href="/profile/{{ Crypt::encrypt($Reply->ID) }}"
                                                                                style="color: black">
                                                                                <h5 style="font-weight: normal">
                                                                                    {{ $Reply->User->FirstName }}
                                                                                    {{ $Reply->User->LastName }}</h5>
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                    <div class="p-1 text-muted mr-auto">
                                                                        <small></small>
                                                                    </div>
                                                                    <div class="p-1 text-muted">




                                                                        @if (Auth::check() || Auth::guard('foundations')->check())
                                                                        @if ($Comment->RoleID == 2 && Auth::guard('foundations')->id() == $Comment->ID)
                                                                        <button class="btn btn-link "
                                                                            id="btn-hapuscomment-{{ $Comment->CommentID }}"
                                                                            data-id="{{ $Comment->CommentID }}">Hapus</button>
                                                                            @elseif($Comment->RoleID == 1 && Auth::id() == $Comment->ID)
                                                                                <button class="btn btn-link"
                                                                                    id="btn-hapuscomment-{{ $Comment->CommentID }}"
                                                                                    data-id="{{ $Comment->CommentID }}">Hapus</button>
                                                                            @endif
                                                                            {{-- <div class="btn-group dropleft">
                                                                                <a href="#" style="color: black"
                                                                                    role="button" id="btnAction"
                                                                                    data-toggle="dropdown"
                                                                                    aria-haspopup="true"
                                                                                    aria-expanded="false">
                                                                                    <i class="fa fa-align-justify"></i>
                                                                                </a>
                                                                                <div class="dropdown-menu" id="ddlAction" aria-labelledby="btnAction">
                                                                                    <a class="dropdown-item" href="#"">
                                                                                        Edit Comment
                                                                                    </a>  

                                                                                    @if ($Comment->RoleID == 2 && Auth::guard('foundations')->id() == $Comment->ID)
                                                                                        <button class="dropdown-item "
                                                                                            id="btn-hapuscomment-{{ $Comment->CommentID }}"
                                                                                            data-id="{{ $Comment->CommentID }}">Hapus</button>
                                                                                    @elseif($Comment->RoleID == 1 && Auth::id() == $Comment->ID)
                                                                                        <button class="dropdown-item "
                                                                                            id="btn-hapuscomment-{{ $Comment->CommentID }}"
                                                                                            data-id="{{ $Comment->CommentID }}">Hapus</button>
                                                                                    @endif
                                                                                </div>

                                                                            </div> --}}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <h6>{{ $Reply->Comment }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                            @if (Auth::check() || Auth::guard('foundations')->check())
                                <div class="p-2 bd-higlight mb-2 mt-4" id="formComment">
                                    {{-- <form method="POST" enctype="multipart/form-data" action="" >
                                    @csrf --}}
                                    <div class="form-inline">
                                        <div class="form-group w-100">
                                            <input type="text" class="form-control w-75 mr-3"
                                                placeholder="Leave a comment..." id="txtComment" name="txtComment">
                                            <button type="button" class="btn btn-primary px-4" id="btnSendComment"
                                                onclick="btnSendCommentOnClick()">Send</button>
                                        </div>
                                    </div>
                                    {{-- </form> --}}
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal" id="modal-delete-confirmation" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex">
                            <h6>Apakah anda yakin ingin menghapus post ini ?</h6>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Tutup</button>
                        <form id="formDelete" action="/Post/Delete" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="PostDeleteID">
                            <button type="submit" id="batal-popup-transaksi" class="btn btn-danger text-white">Hapus
                            Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- POP UP CREATE POST START HERE --}}
        <div class="slider">
            @include('Forum.Misc.component-form-reportpopup')
        </div>
        <div>
            @include('Forum.Misc.component-form-editpost')
        </div>

        {{-- POP UP CREATE POST End HERE --}}


    </div>



@endsection
