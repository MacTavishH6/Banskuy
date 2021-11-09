@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="slider">
                @include('Shared.Slider')
            </div>
        </div>
    </section>
    <section>
        <div class="container ">
            <div class="row text-center">
                <div class="col">
                    <h3>Make Donation Request Now!</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col">
                    <h3>People In Need Is Waiting For You</h3>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="card w-50 m-auto">
            <div class="card-body">
                <div class="form-row py-4">
                    <div class="col-2 text-center">
                        <img src="https://www.banskuy.com/banskuy.com/Basnkuy2022/assets/BinusUniv.png"
                            alt="UsernamePhotoProfile" style="border-radius: 50%; border: 1px solid black; width: 75px">
                    </div>
                    <div class="col-9 mt-3">
                        <h3>My Username<small
                                style="display: inline-block; vertical-align: top; font-size: 16px;">Saint***</small></h3>
                    </div>
                </div>
                <form action="#" method="post">
                    <div class="form-row py-1">
                        <div class="col-3">
                            <label for="DonationType">Donation Type</label>
                        </div>
                        <div class="col-5">
                            <select name="DonationType" class="form-control" id="DonationType"></select>
                        </div>
                    </div>
                    <div class="form-row py-1">
                        <div class="col-3">
                            <label for="Foundation">Foundation</label>
                        </div>
                        <div class="col-5">
                            <input type="text" name="Foundation" id="Foundation" class="form-control">
                        </div>
                        <div class="col mt-1">
                            <button style="border-radius: 20px; background-color: #AC8FFF; border: none;">Search</button>
                        </div>
                    </div>
                    <div class="form-row py-1">
                        <div class="col-3">
                            <label for="FoundationAddress">Foundation Address</label>
                        </div>
                        <div class="col-5">
                            <textarea class="form-control" name="FoundationAddress" id="FoundationAddress" rows="3"
                                style="resize: none;"></textarea>
                        </div>
                    </div>
                    @if (true)
                        <div class="form-row py-1">
                            <div class="col-3">
                                <label for="DonationDescription">
                                    @if (true)
                                        Donation Description
                                    @elseif (false)
                                        Kind of Service
                                    @endif
                                </label>
                            </div>
                            <div class="col-5">
                                <textarea name="DonationDescription" id="DonationDescription" rows="3"
                                    class="form-control" style="resize: none;"></textarea>
                            </div>
                        </div>
                    @endif
                    <div class="form-row py-1">
                        <div class="col-3">
                            <label for="Unit">Unit</label>
                        </div>
                        <div class="col-5">
                            <select name="Unit" id="Unit" class="form-control"></select>
                        </div>
                    </div>
                    <div class="form-row py-1">
                        <div class="col-3">
                            <label for="Quantity">Quantity</label>
                        </div>
                        <div class="col-5">
                            <input type="text" name="Quantity" id="Quantity" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6 pr-2">
                            <button type="submit" class="float-right py-1 px-5"
                                style="border-radius: 20px; background-color: #AC8FFF; border: none;">Make A
                                Request</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
