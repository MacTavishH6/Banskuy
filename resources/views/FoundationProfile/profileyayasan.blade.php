<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile Yayasan</title>

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

    </style>
</head>

<body>
    @extends('layouts.app')

    @section('content')
        <section class="d-flex">
            <div class="container">
                <div class="row">
                    <div class="col-3 mt-4">
                        <img src="{{ env('FTP_URL') }}{{ $foundation->FoundationPhoto ? 'ProfilePicture/Yayasan/' . $foundation->FoundationPhoto->Path : 'assets/Smiley.png' }}"
                            alt="FoundationPhotoProfile"
                            style="border-radius: 50%; border: 1px solid black; width: 250px; height: 250px;"
                            onerror="this.onerror==null;this.src='{{ env('FTP_URL') }}assets/Smiley.png'">
                    </div>
                    <div class="col-9">
                        <div class="row mt-5">
                            <div class="col-12">
                                <h2>{{ $foundation->FoundationName }}</h2>
                            </div>
                            <div class="col-12">
                                <small>Anggota sejak {{ $foundation->RegisterDate }}</small>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12 has-bio">
                                <p align="justify">{{ $foundation->Bio }}</p>
                            </div>
                            @if (Auth::guard('foundations') && Auth::guard('foundations')->id() == $foundation->FoundationID)
                                <div class="col-12 edit-bio">
                                    <textarea name="Bio" id="Bio" class="form-control" rows="3"
                                        style="resize: none">{{ $foundation->Bio ? $foundation->Bio : '' }}</textarea>
                                </div>
                            @endif

                        </div>
                        @if (Auth::guard('foundations') && Auth::guard('foundations')->id() == $foundation->FoundationID)
                            <div class="col">
                                <label id="count-bio-word" class="edit-bio float-right">0/100</label>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12 mt-3" style="font-size:150%">
                                <small>
                                    {{ $foundation->address ? $foundation->address->Address : '' }}
                                    ,
                                    <label for="City" id="City"></label>
                                    ,
                                    <label for="Province" id="Province"></label>
                                </small>
                            </div>
                            <div class="col-12 mb-4" style="font-size:100%">
                                <span>Telepon Yayasan :
                                    {{ $foundation->FoundationPhone ? $foundation->FoundationPhone : '' }}</span>
                                <span>, Email Yayasan : {{ $foundation->Email ? $foundation->Email : '' }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                @if (Auth::guard('foundations') && Auth::guard('foundations')->id() == $foundation->FoundationID)
                                    <form action="/updatefoundationbio" class="form d-inline" method="post">
                                        @csrf
                                        @method("PUT")
                                        <input type="hidden" name="FoundationID" value="{{ $foundation->FoundationID }}">
                                        <input type="hidden" name="Bio" id="hidBio">
                                        <button class="text-white py-1 px-3 edit-bio"
                                            style="border-radius: 20px; background-color: #AC8FFF; border: none;">Simpan
                                            Bio</button>
                                    </form>
                                    <button class="text-white py-1 px-3 has-bio" id="btnEditBio"
                                        style="border-radius: 20px; background-color: #AC8FFF; border: none;">Sunting
                                        Bio</button>
                                    <button class="text-white py-1 px-3 edit-profile"
                                        style="border-radius: 20px; background-color: #AC8FFF; border: none;">Sunting
                                        Profil</button>
                                    <button class="text-white py-1 px-3 donation-approval"
                                        style="border-radius: 20px; background-color: #AC8FFF; border: none;">Persetujuan Donasi</button>
                                @elseif(Auth::guard('foundations')->check() || Auth::check())
                                    {{-- <button class="text-white py-1 px-3"
                                        style="border-radius: 20px; background-color: #AC8FFF; border: none;">Hubungi
                                        Sekarang</button> --}}
                                    <form action="/chatTo" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input id="id" name="id" type="hidden"
                                            value="{{ $foundation->FoundationID }}">
                                        <input id="roleId" name="roleId" type="hidden"
                                            value="2">
                                        <button type="submit" class="text-white py-1 px-3"
                                        style="border-radius: 20px; background-color: #AC8FFF; border: none;">
                                            Hubungi Sekarang</button>
                                    </form>
                                    <br/>
                                    <button class="text-white py-1 px-3"
                                        style="border-radius: 20px; background-color: #AC8FFF; border: none;"
                                        data-toggle="modal" data-target="#mdlMakeReport"
                                        onclick="btnMakeReportOnClick()">Laporkan</button>


                                    {{-- POP UP report START HERE --}}
                                    <div class="slider">
                                        @include('FoundationProfile.FoundationMisc.component-form-reportfoundationpopup')
                                    </div>
                                    {{-- POP UP report End HERE --}}
                                @endif
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
                                aria-controls="post" aria-selected="true">Daftar Kebutuhan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="documentation-tab" data-toggle="tab" href="#documentation"
                                role="tab" aria-controls="documentation" aria-selected="false">Dokumentasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="aboutus-tab" data-toggle="tab" href="#aboutus" role="tab"
                                aria-controls="aboutus" aria-selected="false">Tentang Kami</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="post" role="tabpanel" aria-labelledby="post-tab">
                    <div class="container list-post-container">
                        @include('FoundationProfile.FoundationMisc.component-list-post')
                    </div>
                </div>
                <div class="tab-pane fade" id="documentation" role="tabpanel" aria-labelledby="documentation-tab">
                    <div class="container">
                        @include('FoundationProfile.FoundationMisc.component-list-documentation')
                    </div>
                </div>
                <div class="tab-pane fade" id="aboutus" role="tabpanel" aria-labelledby="aboutus-tab">
                    <div class="container">
                        @include('FoundationProfile.FoundationMisc.component-list-visimisiaboutus')
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
                $("a[id^='btnAction-']").click(function() {
                    
                    let _id = $(this).attr('id').split('-')[1]
                    if ($('input[id="ddlActionStatus-' + _id + '"]').val() == "hide") {
                        $('div[id^="ddlAction-"]').removeClass("show");
                        _.each($('input[id^="ddlActionStatus-"]'), function(x) {
                            $(x).val('hide')
                        });
                        $('div[id="ddlAction-' + _id + '"]').addClass("show");
                        $('div[id="ddlAction-' + _id + '"]').css({
                            'position': 'absolute',
                            'will-change': 'transform',
                            'top': '0px',
                            'left': '0px',
                            'transform': 'translate3d(-162px, 0px, 0px)'
                        });
                        $('input[id="ddlActionStatus-' + _id + '"]').val('show');
                    }
                    else{
                        $('div[id="ddlAction-' + _id + '"]').removeClass("show");
                        $('input[id="ddlActionStatus-' + _id + '"]').val("hide");
                    }
                })
                $("a.hapus-post").on('click', function() {
                    $("input[name='PostDeleteID']").val($(this).attr('data-id'))
                    $("#modal-delete-confirmation").modal()
                })
                var foundation;
                banskuy.getReq('/getfoundationprofile/' + <?php echo '"' . Crypt::encrypt($foundation->FoundationID) . '"'; ?>)
                    .then(function(data) {
                        debugger
                        foundation = data.payload;
                        $("#Province").html(foundation.address ? (foundation.address.province ? foundation.address
                            .province.ProvinceName : '') : '');
                        $("#City").html(foundation.address ? (foundation.address.city ? foundation.address.city
                            .CityName : '') : '');
                    })
                    .finally(function() {
                        if (!foundation.IsConfirmed) {
                            $("#confirmedModal").modal();
                        }
                        $(".edit-profile").on('click', function() {
                            return location.href = '/editfoundationprofile/' + <?php echo '"' . Crypt::encrypt($foundation->FoundationID) . '"'; ?>;
                        });
                        $(".donation-approval").on('click', function() {
                            // return location.href = '/donationapproval/' + <?php echo '"' . Crypt::encrypt($foundation->FoundationID) . '"'; ?>;
                            return location.href = '/donationapproval/';
                        });
                        $('#Bio').on('input', function() {
                            if ($(this).val().length > 100) $(this).val($(this).val().substring(0, 100));
                            $("#count-bio-word").html($(this).val().length + "/100");
                            $("#hidBio").val($(this).val());
                        });
                        if (foundation.Bio) {
                            $(".edit-bio").addClass("d-none");
                        } else {
                            $(".has-bio").addClass("d-none");
                        }
                        $("#btnEditBio").on('click', function() {
                            $(".edit-bio").removeClass("d-none");
                            $(".has-bio").addClass("d-none");
                            $("#hidBio").val($("#Bio").val());
                            $("#count-bio-word").html($("#hidBio").val().length + "/100");
                        });
                    });
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

</body>

</html>
