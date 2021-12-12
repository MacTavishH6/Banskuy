@extends('layouts.app')
@section('styles')
    <style>
        .backgroundstyle {
            background-image: url(<?php echo env('FTP_URL') . 'assets/lp_background.jpg'; ?>);
            background-repeat: no-repeat;
            background-size: cover;
        }

        .backgroundcolor1 {
            /* background-color:#18171f;  */
            border-radius: 50px;
            padding-bottom: 3%;
        }

        .buttonlp {
            border-radius: 20px;
            background-color: #9F51CF;
            border: none;
            font-size: 140%;
            transition: 0.2s;
        }

        .buttonlp:hover {
            background-color: #45C1A4;
            box-shadow: 0px 0px 20px rgb(255, 255, 255);
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 40%;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .container {
            padding: 2px 16px;
        }

        .donationstuffcontainer {
            margin-left: 5%;
            margin-right: 5%;
        }

        .btn-banskuy {
            padding: 20px 40px;
            font-size: 2vw;
            text-decoration: none;
            color: white;
        }

        .btn-banskuy:hover {
            text-decoration: none;

        }

    </style>
@endsection

@section('content')
    <div class="backgroundstyle">
        <div class="backgroundcolor1 d-flex">
            <div class="col-8 text-center" style="color: white">
                <div class="" style="font-size: 750%">
                    <b>Banskuy</b>
                </div>
                <div style="font-size: 340%">
                    Kita berbagi, karena Kita peduli
                </div>
                <br>
                <div style="font-size: 180%">
                    Website untuk menolong sesama.
                </div>
                <br>
                <div style="font-size: 150%">
                    Lebih Dari 3000 Orang Telah Berdonasi
                </div>
                <br>
                <div class="">
                    <button type="button" onclick="window.location.assign ('/Forum');" class="buttonlp py-1 px-4 text-white"
                        style="">Ayo Berdonasi Sekarang
                    </button>
                </div>
            </div>

            <div class="col-4"></div>
        </div>

        <br><br>

        @if (!Auth::guard('foundations')->check() && !Auth::check())
            <div class="d-flex mx-5 py-5" style="height: 10vw; background-color: #18171f; border-radius: 20px">
                <div class="col-md-6 text-center">
                    <h2 class="text-white">Masuk sekarang! Masuk Sebagai :</h2>
                </div>
                <div class="col-md-6">
                    <div class="row">
                            <div class="col-6 text-center"><a href="{{env('APP_SECURE')}}donate.{{ env('APP_URL') }}/login"
                                    class="btn-banskuy">Donatur</a></div>
                        <div class="col-6 text-center"><a href="{{env('APP_SECURE')}}foundation.{{ env('APP_URL') }}/login"
                                class="btn-banskuy">Yayasan</a></div>
                    </div>

                </div>
            </div>
        @endif

        <br><br>
        <div class="text-center pb-4" style="font-size: 300%; color: white">
            <b>Anda dapat menolong dengan</b>
        </div>

        <div class="donationstuffcontainer d-flex">
            <div class="card" style="margin:1%; background-color: #18171f; border-radius: 20px">
                <div class="text-center my-2">
                    <img class="" src="{{ env('FTP_URL') }}assets/uang.jpg" alt="image"
                        style="max-width:200px; color: white">
                </div>
                <div class="container text-center" style="color: white">
                    <h2><b>Uang</b></h2> <br>
                    <p style="font-size: 140%" align="justify">Anda dapat mendonasikan uang anda dengan mentranfser uang and
                        ke rekening
                        Yayasan atau langsung.</p>
                    <br><br>
                </div>
            </div>
            <div class="card" style="margin:1%; background-color: #18171f; border-radius: 20px">
                <div class="text-center my-2">
                    <img class="text-center" src="{{ env('FTP_URL') }}assets/barang.jpg" alt="image"
                        style="max-width:200px; color: white">
                </div>
                <div class="container text-center" style="color: white">
                    <h2><b>Barang Bekas</b></h2> <br>
                    <p style="font-size: 140%" align="justify">Anda memiliki barang bekas dalam keadaan masih layak pakai ?
                        Kamu dapat
                        mendonasikannya, sederhana namun sangat berharga</p>
                    <br><br>
                </div>
            </div>
            <div class="card" style="margin:1%; background-color: #18171f; border-radius: 20px">
                <div class="text-center my-2">
                    <img  src="{{ env('FTP_URL') }}assets/comserv.png" alt="image"
                    style="max-width:200px; color: white">
                </div>
                <div class="container text-center" style="color: white">
                    <h2><b>Pelayanan Masyarakat</b></h2> <br>
                    <p style="font-size: 140%" align="justify">Menolong orang lain adalah hal yang sederhana, jika anda
                        memiliki waktu
                        luang, anda dapat menolong mereka.</p>
                    <br><br>
                </div>
            </div>
        </div>

        <br><br>

        {{-- SLIDERS START HERE --}}
        <div class="slider">
            @include('Shared.LandingPageSlider')
        </div>
        {{-- SLIDERS END HERE --}}

        <br>

        

        {{-- <div class="text-center pb-4" style="font-size: 300%; color: white">
            <b>Apa yang mereka katakan tentang kita :</b>
        </div> --}}

        <div>

        </div>
    </div>
@endsection
