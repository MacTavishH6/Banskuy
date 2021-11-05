<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Banskuy.com</title>

    <style>
        .backgroundcolor1{
            background-color:#18171f; 
            border-radius: 50px;
            padding-bottom: 3%;
        }
        .buttonlp{
            border-radius: 20px; 
            background-color: #9F51CF; 
            border: none; 
            font-size: 140%;
            transition:0.2s;
        }
        .buttonlp:hover{
            background-color: #45C1A4;
            box-shadow: 0px 0px 20px rgb(255,255,255);
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

    <script>
        var myCarousel = document.querySelector('#myCarousel')
        var carousel = new bootstrap.Carousel(myCarousel)

        
    </script>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div style="background-color: #282731">
        <div class="backgroundcolor1 d-flex">
            <div class="col-6 text-center" style="color: white">
                <div class="" style="font-size: 750%">
                    <b>Banskuy</b>
                </div>
                <div style="font-size: 340%">
                    We Share, Because We Care
                </div>
                <br>
                <div style="font-size: 180%">
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

        <br><br>
        <div class="text-center pb-4" style="font-size: 300%; color: white">
            <b>You Can Help Them With</b>
        </div>

        <div class="donationstuffcontainer d-flex">
            <div class="card" style="margin:1%; background-color: #18171f; border-radius: 20px">
                <img class="text-center" src="img_avatar.png" alt="image" style="width:100%; color: white">
                <div class="container text-center" style="color: white">
                    <h2><b>Money</b></h2> <br>
                    <p style="font-size: 140%">You can donate your money and transfer it to Foundation Account or you can give it directly</p> 
                    <button type="submit" class="buttonlp py-1 px-4 text-white"
                        style="">Detail
                    </button>
                    <br><br>
                </div>
            </div>
            <div class="card" style="margin:1%; background-color: #18171f; border-radius: 20px">
                <img class="text-center" src="img_avatar.png" alt="image" style="width:100%; color: white">
                <div class="container text-center" style="color: white">
                    <h2><b>Used Stuff</b></h2> <br>
                    <p style="font-size: 140%">Do you Have a used stuff and still in good condition? You Can Give it to Them, it’s simple but meaningful</p> 
                    <button type="submit" class="buttonlp py-1 px-4 text-white"
                        style="">Detail
                    </button>
                    <br><br>
                </div>
            </div>
            <div class="card" style="margin:1%; background-color: #18171f; border-radius: 20px">
                <img class="text-center" src="img_avatar.png" alt="image" style="width:100%; color: white">
                <div class="container text-center" style="color: white">
                    <h2><b>Comunity Service</b></h2> <br>
                    <p style="font-size: 140%">Helping Others is a simple things, if you have enough time, just do some service for them</p> 
                    <button type="submit" class="buttonlp py-1 px-4 text-white"
                        style="">Detail
                    </button>
                    <br><br>
                </div>
            </div>
        </div>
        
        <br><br>

        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img style="height: 500px" src="https://www.banskuy.com/banskuy.com/Basnkuy2022/assets/BinusSOCS.png " class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
                </div>
                <div class="carousel-item">
                <img style="height: 500px" src="https://www.banskuy.com/banskuy.com/Basnkuy2022/assets/BinusSOCS.png " class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
                </div>
                <div class="carousel-item">
                    <img style="height: 500px" src="https://www.banskuy.com/banskuy.com/Basnkuy2022/assets/BinusSOCS.png " class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <br><br><br>

        <div class="text-center pb-4" style="font-size: 300%; color: white">
            <b>What They Said About Us :</b>
        </div>

        <div>
            
        </div>
    </div>
    @endsection        
</body>
</html>