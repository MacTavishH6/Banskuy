<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Banskuy.Com</title>

    <style>
        .backgroundcolor1{
            background-color:#1f1e29; 
            border-radius: 50px;
            padding-bottom: 5%;
        }
        .buttonlp{
            border-radius: 20px; 
            background-color: #45C1A4; 
            border: none; 
            font-size: 140%;
            transition:0.2s;
        }
        .buttonlp:hover{
            background-color: #9F51CF;
        }
        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            width: 40%;
        }
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        .container {
            padding: 2px 16px;
        }
        .donationstuffcontainer{
            margin-left: 5%;
            margin-right: 5%;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="backgroundcolor1 d-flex">
        <div class="col-6 text-center" style="color: white">
            <div class="" style="font-size: 750%">
                Banskuy
            </div>
            <div style="font-size: 340%">
                We Share, We Care
            </div>
            <br>
            <div style="font-size: 200%">
                The Largest Site In Indonesia For Helping Those In Needs.
            </div>
            <br>
            <div style="font-size: 150%">
                Lebih Dari 3000 Orang Telah Berdonasi
            </div>
            <br>
            <div class="">
                <button type="submit" class="buttonlp py-1 px-4 text-white"
                    style="">Ayo Berdonasi Sekarang
                </button>
            </div>
        </div>

        <div class="col-6"></div>
    </div>
                                    <br>                        <br>
    <div class="donationstuffcontainer d-flex">
        <div class="card" style="margin:1%;">
            <img class="text-center" src="img_avatar.png" alt="Avatar" style="width:100%">
            <div class="container text-center">
                <h4><b>John Doe</b></h4> 
                <p>Architect & Engineer</p> 
            </div>
        </div>
        <div class="card" style="margin:1%;">
            <img class="text-center" src="img_avatar.png" alt="Avatar" style="width:100%">
            <div class="container text-center">
                <h4><b>John Doe</b></h4> 
                <p>Architect & Engineer</p> 
            </div>
        </div>
        <div class="card" style="margin:1%;">
            <img class="text-center" src="img_avatar.png" alt="Avatar" style="width:100%">
            <div class="container text-center">
                <h4><b>John Doe</b></h4> 
                <p>Architect & Engineer</p> 
            </div>
        </div>
    </div>
    
    @endsection        
</body>
</html>