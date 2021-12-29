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

        .donationstuffcontainer {}

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
            <div class="col-12 text-center" style="color: white;">
                <div class="row mt-5">
                    <div class="col-md-7 col-sm-11">
                        <h1 style="font-size: 10vw"><b>Banskuy</b></h1>
                    </div>
                    <div class="col-md-7" style="font-size: 4vw">
                        Kita berbagi, karena Kita peduli
                    </div>
                    <div class="col-md-7" style="font-size: 2vw">
                        Website untuk menolong sesama.
                    </div>
                    <div class="col-md-7" style="font-size: 2vw">
                        Lebih Dari 3000 Orang Telah Berdonasi
                    </div>
                    <div class="col-md-7 mt-2" style="font-size: 2vw">
                        <button type="button" onclick="window.location.assign ('/Forum');"
                            class="buttonlp py-1 px-4 text-white" style="">Ayo Berdonasi Sekarang
                        </button>
                    </div>
                </div>
            </div>

        </div>

        @if (!Auth::guard('foundations')->check() && !Auth::check())
            <div class="row mx-5 py-5" style="background-color: #18171f; border-radius: 20px">
                <div class="col-md-6 col-sm-11 text-center">
                    <h3 class="text-white">Masuk sekarang! Masuk Sebagai :</h3>
                </div>
                <div class="col-md-6 col-sm-11">
                    <div class="row mt-2">
                        <div class="col-6 text-center"><a
                                href="{{ env('APP_SECURE') }}donate.{{ env('APP_URL') }}/login"
                                class="btn-banskuy">Donatur</a></div>
                        <div class="col-6 text-center"><a
                                href="{{ env('APP_SECURE') }}foundation.{{ env('APP_URL') }}/login"
                                class="btn-banskuy">Yayasan</a></div>
                    </div>

                </div>
            </div>
        @endif

        <div class="text-center pb-4" style="font-size: 5vw; color: white">
            <b>Anda dapat menolong dengan</b>
        </div>

        <div class="row justify-content-around w-100">
            <div class="col-md-4 col-xs-12 d-flex justify-content-center px-0">
                <div class="card w-75" style="background-color: #18171f; border-radius: 20px">
                    <div class="text-center my-2">
                        <img class="" src="{{ env('FTP_URL') }}assets/uang.jpg" alt="image"
                            style="max-width:10vw; color: white">
                    </div>
                    <div class="container text-center" style="color: white">
                        <h2 style="font-size: 3vw"><b>Uang</b></h2> <br>
                        <p style="font-size: 2vw" align="left">Anda dapat mendonasikan uang anda dengan mentranfser
                            uang
                            and
                            ke rekening
                            Yayasan atau langsung.</p>
                        <br><br>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 d-flex justify-content-center px-0">
                <div class="card w-75" style="background-color: #18171f; border-radius: 20px">
                    <div class="text-center my-2">
                        <img class="text-center" src="{{ env('FTP_URL') }}assets/barang.jpg" alt="image"
                            style="max-width:10vw; color: white">
                    </div>
                    <div class="container text-center" style="color: white">
                        <h2 style="font-size: 3vw"><b>Barang Bekas</b></h2> <br>
                        <p style="font-size: 2vw" align="left">Anda memiliki barang bekas dalam keadaan masih layak
                            pakai ?
                            Kamu dapat
                            mendonasikannya, sederhana namun sangat berharga</p>
                        <br><br>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 d-flex justify-content-center px-0">
                <div class="card w-75" style="background-color: #18171f; border-radius: 20px">
                    <div class="text-center my-2">
                        <img src="{{ env('FTP_URL') }}assets/comserv.png" alt="image"
                            style="max-width:10vw; color: white">
                    </div>
                    <div class="container text-center" style="color: white">
                        <h2 style="font-size: 3vw"><b>Pelayanan Masyarakat</b></h2> <br>
                        <p style="font-size: 2vw" align="left">Menolong orang lain adalah hal yang sederhana, jika
                            anda
                            memiliki waktu
                            luang, anda dapat menolong mereka.</p>
                        <br><br>
                    </div>
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
