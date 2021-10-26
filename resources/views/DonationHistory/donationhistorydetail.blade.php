<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Donation History Detail</title>

    <style>
        .pagetitle{
            font-size: 300%;
            text-align: center;
        }
    </style>

</head>

<body>
    @extends('layouts.app')

    @section('content')
        <div class="pagetitle">
            <p>
                History Detail
            </p>
        </div>

        <div class="d-flex justify-content-around">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-center" style="font-size:140%">
                        Your Donation Detail
                    </div>

                    <div class="historybodycontent">
                        <div class="card-body d-flex justify-content-around">
                            <div>
                                <p class="card-text">Tipe Donasi</p>
                                <input type="text">
                            </div>

                            <div>
                                <p class="card-text">Tanggal Donasi</p>
                                <input type="text">
                            </div>                        
                        </div>
            
                        <div class="card-body d-flex justify-content-around">
                            <div>
                                <p class="card-text">Nama Barang / Jasa / Uang</p>
                                <input type="text">
                            </div>

                            <div>
                                <p class="card-text">Status Transaksi</p>
                                <input type="text">
                            </div>
                        </div>
            
                        <div class="card-body d-flex justify-content-around">
                            <div>
                                <p class="card-text">Quantity</p>
                                <input type="text">
                            </div>
                            
                            <div>
                                <p class="card-text">Nama Penerima</p>
                                <input type="text">
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <a href="#" class="btn btn-success mb-3 mt-5">Download Certificate</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection

</body>

</html>