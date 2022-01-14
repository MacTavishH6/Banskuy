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

        .container {
            width: 100%
        }

    </style>

    <script>
        $(document).ready(function() {


            $("#txaReportDesc").on("change keyup paste", function() {

                var TextLength = $('#txaReportDesc').val().length;

                $('#lblDescLenght').text(TextLength + "/255");
            });

            $("#btnAction").click(function() {
                if ($('#ddlActionStatus').val() == "hide") {
                    $('#ddlAction').addClass("show");
                    $('#ddlActionStatus').val('show');
                } else {
                    $('#ddlAction').removeClass("show");
                    $('#ddlActionStatus').val("hide");
                }
            });

            $("#hapus-post").on('click', function() {
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
                    console.log(response)
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
                        "\" style=\"color: black\"><h5 style=\"font-size:1rem\">" + Name + "</h5></a></div> ";


                    Body += "<div>";

                    Body +=
                        "<button class=\"btn btn-link float-right\" id=\"btn-hapuscomment-" + commentResponse
                        .CommentID + "\" data-id=\"" +
                        commentResponse.CommentID + "\">Hapus</button>"
                    Body +=
                        "<button id=\"btnReplyComment\" class=\"btn btn-link float-right\" onclick=\"btnReplyCommentOnClick(" +
                        commentResponse.CommentID + "," + commentResponse.PostID + ")\">"
                    Body += "<h6>Reply</h6> </button>"
                    Body += "</div>"
                    Body += "</div>";
                    Body += "<p>" + commentResponse.Comment + "</p>";
                    Body += "<div class=\" text-muted\" style=\"text-align:right\"> <small>" + response.date +
                        "</small></div>"
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
                    console.log(Reply)
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
                    Body += "<div class=\"p-1 text-muted\"><small>Reply to " + response.replyTo +
                        "</small> <button class=\"btn btn-link float-right\" id=\"btn-hapuscomment-" + Reply
                        .id + "\" data-id=\"" +
                        Reply.CommentID + "\">Hapus</button> </div>"
                    Body += "<div class=\"d-flex\">";
                    //Body += "<div class=\"p-1\"> <h5 style=\"font-weight: normal\">"+Name+"</h5></div>"
                    Body += "<div class=\"p-1\"> <a href=\"/" + response.hrefProfile +
                        "\" style=\"color: black\"><h5 style=\"font-size:1rem\">" + Name + "</h5></a></div> ";



                    Body += "</div>";
                    Body += "<p>" + Reply.Comment + "</p>";
                    Body += "<div class=\"ext-muted \" style=\"text-align:right\"> <small>" + response.date +
                        "</small></div>"
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
            Body += "<div class=\"row w-100\">"
            Body += "<div class=\"col-9\">"
            Body += "<input type=\"text\" class=\"form-control mr-3 w-100\" style=\"height: 28px;font-size:10pt\"";
            Body += "placeholder=\"Tinggalkan komentar...\" id=\"txtReplyComment" + $id + "\" name=\"txtReplyComment\">";
            Body += "</div>"
            Body += "<div class=\"col-3\">"
            Body += "<button type=\"button\" id=\"btnSendReply1\" onclick=\"btnSendReply(" + $PostID + "," + $id +
                ")\" class=\"btn btn-primary px-3 py-1\" style=\"font-size:10pt\">Send</button>";
            Body += "</div>"
            Body += "</div>"
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
                        <div class="d-flex col-sm-12 pl-0">
                            <div class="mr-auto col-sm-6  pl-0">
                                <h2 style="font-size: 4vw;">{{ $Post->PostTitle }}</h2>
                            </div>

                            <div class="btn-group dropleft">
                                <a href="#" style="color: black" role="button" id="btnAction" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-align-justify"></i>
                                </a>

                                <div class="dropdown-menu" id="ddlAction" aria-labelledby="btnAction">
                                    {{-- <a class="dropdown-item" href="#">Action</a>
                                  <a class="dropdown-item" href="#">Another action</a>
                                  <a class="dropdown-item" href="#">Something else here</a> --}}
                                    @if (Auth::check() || Auth::guard('foundations')->check())

                                        @if ($Post->StatusPostId == 1)
                                            @if ($Post->PostTypeID == 1 && Auth::guard('foundations')->check())
                                                <a class="dropdown-item" href="#">
                                                    Meminta Donasi
                                                </a>
                                            @elseif(Auth::check() && $Post->PostTypeID == 2)
                                                <a class="dropdown-item" href="#"">
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

                                                                @endif


                                                        @endif
                                </div>
                            </div>
                            <input type="hidden" id="ddlActionStatus" value="hide">
                            {{-- @if (Auth::check() || Auth::guard('foundations')->check())
                            
                            <div class="mr-2 col-sm-2">
                                @if ($Post->StatusPostId == 1)
                                    @if ($Post->PostTypeID == 1 && Auth::guard('foundations')->check())
                                    <a class="btn btn-secondary pb-2 pt-1 px-1" id="btnOpenDonation" href="#">
                                        Meminta Donasi
                                    </a> 
                                    @elseif(Auth::check() && $Post->PostTypeID == 2)
                                    <a class="btn btn-primary pb-2 pt-1 px-1" id="btnOpenDonation" href="/makerequestwithpost/{{Crypt::encrypt($Post->PostID)}}">
                                        Memberikan Donasi
                                    </a> 
                                    @endif  
                                @elseif($Post->StatusPostId == 2)
                                    <a class="btn btn-danger pb-2 pt-1 px-1" id="btnOpenDonation" href="#}">
                                        Post Ditutup
                                    </a>  
                                @endif   
                            </div>
                            
                           
                                @if ($StatusPost == true)
                                <div class="mr-2 col-sm-2">
                                    <form action="/chatTo" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input id="id" name="id" type="hidden" value="{{$Post->ID}}">
                                        <input id="roleId" name="roleId" type="hidden" value="{{$Post->RoleID}}">
                                        <button type="submit" class="btn btn-warning pb-2 pt-1 px-1">
                                            Hubungi Pembuat</button>
                                    </form>
                                   
                                </div>
                                <div class="col-sm-2">
                                    <button id="btnMakeReport" type="button" class="btn btn-danger pb-2 pt-1 px-3" data-toggle="modal"
                                    data-target="#mdlMakeReport" onclick="btnMakeReportOnClick()">
                                    Report
                                    </button> 
                                </div>
                                @endif
                                
                            
                                @endif --}}
                        </div>
                        <div class="d-flex">
                            <div class="mr-2">
                                @if ($Post->RoleID == 2)
                                    <a href="/foundationprofile/{{ Crypt::encrypt($Post->ID) }}" style="color: black;">
                                        <h5 style="font-weight: normal;font-size:3vw">
                                            {{ $Post->Foundation->FoundationName }}</h5>
                                    </a>
                                @else
                                    <a href="/profile/{{ Crypt::encrypt($Post->ID) }}"
                                        style="color: black;font-size:3vw">
                                        <p style="font-weight: normal;font-size:3vw">{{ $Post->User->FirstName }}
                                            {{ $Post->User->LastName }}</p>
                                    </a>
                                @endif
                            </div>
                            <div class="text-muted mt-2">
                                <p style="font-size: 2vw;">{{ date('d M Y', strtotime($Post->created_at)) }} at
                                    {{ date('h:i A', strtotime($Post->created_at)) }}</p>
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
                                                        <div class="p-1 mr-auto">

                                                            @if ($Comment->RoleID == 2)
                                                                <a href="/foundationprofile/{{ Crypt::encrypt($Comment->ID) }}"
                                                                    style="color: black">
                                                                    <h5 style="font-size:1rem">
                                                                        {{ $Comment->Foundation->FoundationName }}</h5>
                                                                </a>
                                                            @else
                                                                <a href="/profile/{{ Crypt::encrypt($Comment->ID) }}"
                                                                    style="color: black">
                                                                    <h5 style="font-size:1rem">
                                                                        {{ $Comment->User->FirstName }}
                                                                        {{ $Comment->User->LastName }}</h5>
                                                                </a>
                                                            @endif
                                                        </div>

                                                        <div class="">
                                                            @if (Auth::check() || Auth::guard('foundations')->check())
                                                                @if ($Comment->RoleID == 2 && Auth::guard('foundations')->id() == $Comment->ID)
                                                                    <button class="btn btn-link float-right"
                                                                        id="btn-hapuscomment-{{ $Comment->CommentID }}"
                                                                        data-id="{{ $Comment->CommentID }}">Hapus</button>
                                                                @elseif($Comment->RoleID == 1 && Auth::id() == $Comment->ID)
                                                                    <button class="btn btn-link float-right"
                                                                        id="btn-hapuscomment-{{ $Comment->CommentID }}"
                                                                        data-id="{{ $Comment->CommentID }}">Hapus</button>
                                                                @endif
                                                                <button id="btnReplyComment"
                                                                    class="btn btn-link float-right"
                                                                    onclick="btnReplyCommentOnClick({{ $Comment->CommentID }},{{ $Post->PostID }})">
                                                                    <h6>Reply</h6>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <p>{{ $Comment->Comment }}</p>
                                                    <div class="text-muted" style="text-align: right">
                                                        <small>{{ date('d M Y', strtotime($Comment->created_at)) }}</small>
                                                    </div>
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
                                                                <div class="p-1 text-muted">
                                                                    @if ($Comment->RoleID == 1)
                                                                        <small>Reply to {{ $Comment->User->FirstName }}
                                                                            {{ $Comment->User->LastName }}</small>
                                                                    @else
                                                                        <small>Reply to
                                                                            {{ $Comment->Foundation->FoundationName }}</small>
                                                                    @endif
                                                                    @if (Auth::check() || Auth::guard('foundations')->check())
                                                                        @if ($Comment->RoleID == 2 && Auth::guard('foundations')->id() == $Comment->ID)
                                                                            <button class="btn btn-link float-right "
                                                                                id="btn-hapuscomment-{{ $Comment->CommentID }}"
                                                                                data-id="{{ $Comment->CommentID }}">Hapus</button>
                                                                        @elseif($Comment->RoleID == 1 && Auth::id() == $Comment->ID)
                                                                            <button class="btn btn-link float-right "
                                                                                id="btn-hapuscomment-{{ $Comment->CommentID }}"
                                                                                data-id="{{ $Comment->CommentID }}">Hapus</button>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="d-flex ">
                                                                    <div class="p-1 mr-auto">
                                                                        @if ($Reply->RoleID == 2)
                                                                            <a href="/foundationprofile/{{ Crypt::encrypt($Reply->ID) }}"
                                                                                style="color: black">
                                                                                <h5 style="font-size:1rem">
                                                                                    {{ $Reply->Foundation->FoundationName }}
                                                                                </h5>
                                                                            </a>
                                                                        @else
                                                                            <a href="/profile/{{ Crypt::encrypt($Reply->ID) }}"
                                                                                style="color: black">
                                                                                <h5 style="font-size:1rem">
                                                                                    {{ $Reply->User->FirstName }}
                                                                                    {{ $Reply->User->LastName }}</h5>
                                                                            </a>
                                                                        @endif
                                                                    </div>


                                                                </div>
                                                                <p>{{ $Reply->Comment }}</p>
                                                                <div class="p-1 text-muted" style="text-align: right">
                                                                    <small>{{ date('d M Y', strtotime($Reply->created_at)) }}</small>
                                                                </div>
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
                                            <div class="row w-100">

                                                <div class="col-9">
                                                    <input type="text" class="form-control mr-3 w-100"
                                                        placeholder="Tinggalkan komentar..." id="txtComment"
                                                        name="txtComment">
                                                </div>
                                                <div class="col-3">
                                                    <button type="button" class="btn btn-primary px-4" id="btnSendComment"
                                                        onclick="btnSendCommentOnClick()">Send</button>
                                                </div>

                                            </div>

                                        </div>

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
    {{-- POP UP CREATE POST End HERE --}}


    </div>



@endsection
