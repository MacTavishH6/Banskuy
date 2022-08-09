@extends('layouts.app')

@section('styles')
    <style>
        ul#myTab li.nav-item a.nav-link {
            color: black;
            font-size: 36px;
            padding: 5px 50px;
        }

        ul#myTab li.nav-item a.active {
            border-bottom: 10px solid black;
        }

        div.tab-pane div.container {
            border: 1px solid black;
        }

        #btnEditBio:hover {
            cursor: pointer;
        }

        #btnCancelBio:hover {
            cursor: pointer;
        }

        @media(max-width: 425px) {
            div.row ul#myTab li.nav-item {
                width: 33.33%;
            }

            div.row ul#myTab li.nav-item a {
                font-size: 3vw;
            }
        }

    </style>
@endsection

@section('content')
    <section class="d-flex mt-3">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-sm-3 col-md-3">
                    <img src="{{ env('FTP_URL') }}{{ $user->Photo ? 'ProfilePicture/Donatur/' . $user->Photo->Path : 'assets/Smiley.png' }}"
                        alt="UsernamePhotoProfile"
                        style="border-radius: 50%; border: 1px solid black; width: 15vw; height: 15vw;"
                        onerror="this.onerror==null;this.src='{{ env('FTP_URL') }}assets/Smiley.png'">
                </div>
                <div class="col-sm-9 col-md-9 align-self-start">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>{{ $user->Username ? $user->Username : $user->Email }}<small
                                    style="display: inline-block; vertical-align: top; font-size: 16px; color: #2f9194;">{{ $user->UserLevel->where('IsCurrentLevel', '1')->first()->LevelGrade->LevelName }}
                                    <?php 
                                    $level = $user->UserLevel->where('IsCurrentLevel','1')->first()->LevelGrade->LevelOrder;
                                    for ($i=0; $i < $level; $i++) {?>
                                    *
                                    <?php } ?></small>
                            </h2>
                        </div>
                        <div class="col-md-12 mb-2">
                            <small>Bergabung sejak {{ $user->RegisterDate }}</small>
                        </div>
                        <div class="col-md-12 has-bio">
                            <p align="justify">{{ $user->Bio }}</p>
                        </div>
                        @if (Auth::check() && Auth::id() == $user->UserID)
                            <div class="col-md-12 edit-bio">
                                <textarea name="Bio" id="Bio" class="form-control" rows="3"
                                    style="resize: none">{{ $user->Bio ? $user->Bio : '' }}</textarea>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="row justify-content-start mt-2">
                                <div class="col-sm-10 col-md-10 align-self-start">
                                    <small class="has-bio"><img src="{{ asset('images/edit.png') }}" alt=""
                                            srcset="" id="btnEditBio" style="max-width: 7%;"></small>
                                    @if (Auth::check() && Auth::id() == $user->UserID)
                                        <form action="/updatebio" class="form d-inline" method="post">
                                            @csrf
                                            @method("PUT")
                                            <input type="hidden" name="UserID" value="{{ $user->UserID }}">
                                            <input type="hidden" name="Bio" id="hidBio">
                                            <small class="edit-bio"><img id="btnCancelBio"
                                                    src="{{ asset('images/cancel.png') }}" alt="" srcset=""
                                                    style="max-width: 7%;"></small>
                                            <button class="text-white py-1 px-3 edit-bio"
                                                style="border-radius: 20px; background-color: #AC8FFF; border: none;">Simpan</button>
                                        </form>


                                        <button class="text-white py-1 px-3 edit-profile has-bio"
                                            style="border-radius: 20px; background-color: #AC8FFF; border: none;">Sunting
                                            Profil</button>
                                    @elseif(Auth::check() || Auth::guard('foundations')->check())
                                        <div style="margin-left:10%">
                                            <button class="text-white py-1 px-3 report-button"
                                            style="border-radius: 20px; background-color: #AC8FFF; border: none;"
                                            data-toggle="modal" data-target="#mdlMakeReport"
                                            onclick="btnMakeReportOnClick()">Laporkan</button>
                                        </div>
                                        

                                        {{-- POP UP report START HERE --}}
                                        <div class="slider">
                                            @include('Profile.Misc.component-form-reportuserpopup')
                                        </div>
                                        {{-- POP UP report End HERE --}}
                                    @endif

                                </div>
                                <div class="col-md-2">
                                    <label id="count-bio-word" class="edit-bio float-right">0/100</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <ul class="nav text-center" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="post-tab" data-toggle="tab" href="#post" role="tab"
                            aria-controls="post" aria-selected="true">Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="documentation-tab" data-toggle="tab" href="#documentation" role="tab"
                            aria-controls="documentation" aria-selected="false">Dokumentasi</a>
                    </li>
                    @if (Auth::check() && Auth::id() == $user->UserID)
                        <li class="nav-item">
                            <a class="nav-link" id="leveltracking-tab" data-toggle="tab" href="#leveltracking"
                                role="tab" aria-controls="leveltracking" aria-selected="false">Level</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="tab-content mb-3" id="myTabContent">
            <div class="tab-pane fade show active" id="post" role="tabpanel" aria-labelledby="post-tab">
                <div class="container list-post-container">
                    @include('Profile.Misc.component-list-post')
                </div>
            </div>
            <div class="tab-pane fade" id="documentation" role="tabpanel" aria-labelledby="documentation-tab">
                <div class="container">
                    @include('Profile.Misc.component-list-documentation')
                </div>
            </div>
            <div class="tab-pane fade" id="leveltracking" role="tabpanel" aria-labelledby="leveltracking-tab">
                <div class="container">
                    @include('Profile.Misc.component-list-leveltracking')
                </div>
            </div>
        </div>
    </section>
    <div id="modal">
        @include('Shared._popupConfirmed')
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
                    <form id="formDelete" action="/Post/Profile/Delete" method="POST">
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
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("a[id^='btnAction']").click(function() {
                let _id = $(this).attr('id').split('-')[1]
                if ($('input[id="ddlActionStatus-' + _id + '"]').val() == "hide") {
                    $('div[id^="ddlAction-"]').removeClass("show");
                    _.each($('input[id^="ddlActionStatus-"]'), function (x) {
                        $(x).val('hide')
                    });
                    $('div[id="ddlAction-' + _id + '"]').addClass("show");
                    $('div[id="ddlAction-' + _id + '"]').css({'position': 'absolute', 'will-change': 'transform', 'top': '0px', 'left': '0px', 'transform': 'translate3d(-162px, 0px, 0px)'});
                    $('input[id="ddlActionStatus-' + _id + '"]').val('show');
                } else {
                    $('div[id="ddlAction-' + _id + '"]').removeClass("show");
                    $('input[id="ddlActionStatus-' + _id + '"]').val("hide");
                }
            })
            $("a.hapus-post").on('click', function() {
                $("input[name='PostDeleteID']").val($(this).attr('data-id'))
                $("#modal-delete-confirmation").modal()
            })
            var user;
            var authUser = <?php echo '"' . Auth::guard()->id() . '"'; ?>;
            console.log(authUser);
            banskuy.getReq('/getprofile/' + <?php echo '"' . Crypt::encrypt($user->UserID) . '"'; ?>)
                .then(function(data) {
                    user = data.payload;
                })
                .finally(function() {
                    if (authUser && authUser == user.UserID) {
                        if (!user.IsConfirmed) {
                            $("#confirmedModal").modal();
                        }
                        $(".edit-profile").on('click', function() {
                            return location.href = '/editprofile/' + <?php echo '"' . Crypt::encrypt($user->UserID) . '"'; ?>;
                        });
                        $('#Bio').on('input', function() {
                            if ($(this).val().length > 100) $(this).val($(this).val().substring(0,
                                100));
                            $("#count-bio-word").html($(this).val().length + "/100");
                            $("#hidBio").val($(this).val());
                        });
                        $(".edit-bio").hide();
                        // if (user.Bio) {
                        //     $(".edit-bio").hide();
                        // } else {
                        //     $(".has-bio").hide();
                        // }
                        $("#btnEditBio").on('click', function() {
                            $(".edit-bio").show();
                            $(".has-bio").hide();
                            $("#hidBio").val($("#Bio").val());
                            $("#count-bio-word").html($("#hidBio").val().length + "/100");
                        });
                        $("#btnCancelBio").on('click', function() {
                            $(".edit-bio").hide();
                            $(".has-bio").show();
                        });
                    } else if (authUser) {
                        $(".has-bio").hide();
                        $(".edit-bio").hide();
                        $(".report-button").show();
                    } else {
                        $(".has-bio").hide();
                        $(".edit-bio").hide();
                    }
                });
            banskuy.getReq('/nextlevel/' + <?php echo '"' . Crypt::encrypt($user->UserLevel->where('IsCurrentLevel', '1')->first()->LevelID) . '"'; ?>)
                .then(function(data) {
                    $("#nextlevelxp").html(data.payload.LevelExp);
                    $("#nextlevelname").html(data.payload.LevelName);
                });
            $(".pagination").parent().addClass('w-25').addClass('mx-auto');
        });

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
@endsection
