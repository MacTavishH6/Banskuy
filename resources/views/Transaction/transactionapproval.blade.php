@extends('layouts.app')

@section('styles')
    <style>
        .pagetitle {
            font-size: 300%;
            text-align: center;
        }

        .historydetail_button {
            background-color: #AC8FFF;
            border: none;
            border-radius: 21px;
            font-family: "Raleway SemiBold", sans-serif;
            height: 42.3px;
            margin: 0 auto;
            transition: 0.25s;
            width: 153px;
            box-shadow: 0px 1px 8px rgb(153, 121, 39);
            margin-bottom: 10px;
            cursor: pointer;
            color: black;
        }

        .historydetail_button:hover {
            box-shadow: 0px 5px 20px rgb(153, 121, 39);
        }

    </style>
@endsection

@section('content')

    <div class="pagetitle">
        <p>
            Donation Approval
        </p>
    </div>

    <br>

    <div class="containermenu">

        <div class="row">
            <div class="col-3"></div>

            {{-- sebelahkiri --}}
            <div class="col-3">
                <div class="searchbox">

                    <label for="searchbox">Search :</label> <br>

                    <form class="form-inline m-0">
                        <input class="form-control col-10 mr-sm-2" type="search" placeholder="Input Keyword"
                            aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-2" type="submit">Go</button>
                    </form>

                </div>

                <div class="donationstatus">
                    <div class="form-group">

                        <label for="inputState">Donation Status :</label>

                        <select id="inputState" class="form-control">
                            <option selected>Status 1</option>
                            <option>Status 2</option>
                            <option>Status 3</option>
                        </select>

                    </div>
                </div>
            </div>

            {{-- sebelahkanan --}}
            <div class="col-3">
                <div class="form-group col-md-12">
                    <label for="inputState">Choose Date :</label>
                    <input class="form-control mr-sm-2" type="date" name="" id="">
                </div>

                <div class="donationstatus">
                    <div class="form-group col-md-12">

                        <label for="inputState">Donation Type :</label>

                        <select id="inputState" class="form-control">
                            <option selected>Donation Type 1</option>
                            <option>Donation Type 2</option>
                            <option>Donation Type 3</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="col-3"></div>
        </div>



    </div>

    <br><br><br>

    <div class="donationhistorycontent d-flex justify-content-around">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-around">
                    <div class="transactiondate">
                        Transaction Date
                    </div>

                    <div class="requeststatus">
                        <div class="btn btn-success">Request Confirmed (Status)</div>
                    </div>
                </div>

                <div class="card-body d-flex justify-content-around ">
                    <div class="bodyleftside">
                        <img src="https://www.banskuy.com/banskuy.com/Basnkuy2022/assets/BinusUniv.png"
                            alt="UsernamePhotoProfile" style="border: 1px solid black; width: 75px">
                    </div>

                    <div class="bodymidside">
                        <p class="card-text">
                            StuffName
                        </p>

                        <p class="card-text">
                            StuffType
                        </p>

                        <p class="card-text">
                            Fikri Nich
                        </p>
                    </div>

                    <div class="bodyrightside">
                        <div class="buttonhistorydetail">
                            {{-- Route Login ini harusnya ke historydetailpage bukan ke loginpage --}}
                            <a href="{{ route('login') }}">
                                <button type="submit" class="historydetail_button">
                                    {{ __('Detail') }}
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="paginationhistory d-flex justify-content-around mt-5 mb-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>

                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>

                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
