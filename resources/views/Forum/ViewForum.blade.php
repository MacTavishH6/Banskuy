@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    {{-- css style start here --}}
    <style>

        .btn{
          border-radius:21px;
        }

        .container{
            width:50%
        }

        .card-header{
            max-height: 70px;
        }
    </style>

    {{-- css style end here --}}

    <div class="container" >
        {{-- SLIDER START HERE --}}
        <div class="slider">
            @include('Shared.Slider')
        </div>
        {{-- SLIDER END HERE --}}

        <div>
            <h2 class="title ml-1">
                Finance
            </h2>

            <div class="description">
                <div class="d-flex flex-row bd-highlight">
                    <div class="p-2 bd-highlight">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sit amet est neque. Sed vitae velit
                        a justo pretium aliquam. Morbi blandit sem ac sem porta varius. Aliquam erat volutpat
                    </div>

                </div>

                <div class="d-flex flex-row bd-highlight">
                    <div class="p-2 bd-highlight">
                        Total Thread :
                    </div>
                    <div class="p-2 bd-highlight">
                        50
                    </div>

                </div>
                <div class="d-flex flex-row bd-highlight">
                    <div class="p-2 bd-highlight">
                        Total Comment :
                    </div>
                    <div class="p-2 bd-highlight">
                        200k
                    </div>

                </div>
                <div class="d-flex flex-row bd-highlight">
                    <div class="p-2 bd-highlight">
                        Total Followers :
                    </div>
                    <div class=" mr-auto p-2 bd-highlight">
                        50k
                    </div>
                    <div class="bd-highlight mb-2">
                        <button type="button" class="btn btn-primary px-4 pt-2">
                            <h6>Follow</h6>
                        </button>
                    </div>

                </div>


            </div>

            <div id="accordion ">
                <div class="card mb-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header" id="headingOne" >
                                <div class="d-flex">
                                    <div class="mr-auto p-2">
                                        <h4>Finance</h4>
                                    </div>
                                    <div>
                                        <button class="btn btn-link" style="text-decoration: none;" data-toggle="collapse"
                                            data-target="#CollapseFinance" arial-expanded="true"
                                            aria-controls="CollapseFinance">
                                            <h2 class="font-weight-bold">-</h2>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="CollapseFinance" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                @for ($i = 0; $i < 5; $i++)
                                <div class="Post-Item mb-2 card-body mb-2">
                                    <div class="media mb-4 ">
                                        <img class="mr-3 d-block w-25 h-25"
                                            src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/Money.jpg">
                                        <div class="media-body">
                                            <div class="d-flex">
                                                <div class="mr-auto p-1">
                                                    <h5>Buku matematika kelas 4 SD</h5>
                                                </div>
                                                <div >
                                                    <button type="submit" class="btn btn-primary pb-2 pt-1 px-2" >Open For
                                                        Donation</button>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column bd-highlight">
                                                <div class="d-flex flex-row bd-highlight">
                                                    <div class="p-1 bd-higlight mb-2 mr-4">
                                                        Author :
                                                    </div>

                                                    <div class="p-1 bd-higlight mb-2">
                                                        Rafli
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row bd-highlight">
                                                    <div class="p-1 bd-higlight mb-2 mr-3">
                                                        Money Gathered :
                                                    </div>
                                                    <div class="p-1 bd-higlight mb-2">
                                                        50
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-row bd-highlight">
                                                    <div class="p-1 bd-higlight mb-2 mr-1">
                                                        Comment :
                                                    </div>
                                                    <div class="p-1 bd-higlight mb-2">
                                                        10k
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column bd-highlight w-100">
                                                    <div class="p-2 bd-higlight mb-2 mr-1">
                                                        <form>
                                                            <div class="form-inline">
                                                                <div class="form-group w-100">
                                                                    <input type="text" class="form-control w-75 mr-3"
                                                                        placeholder="Leave a comment...">
                                                                    <button type="submit"
                                                                        class="btn btn-primary px-4">Send</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                                @endfor
                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection
