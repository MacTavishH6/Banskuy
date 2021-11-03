@extends('layouts.app')

@section('styles')
    <style>
        .pagetitle {
            font-size: 300%;
            text-align: center;
        }

    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-around">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-center" style="font-size:140%">
                    Approval Detail
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
                <div class="row">
                    <div class="col-6 ">
                        <a href="#" class="btn btn-success float-right mb-3 mt-5">Accept Donation</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-success mb-3 mt-5">Denied Donation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
