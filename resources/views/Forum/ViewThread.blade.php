@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- css style start here --}}
    <style>
        

        .btn {
            border-radius: 21px;
            text-decoration: none;
        }

        .border {
            border-radius: 30px;
        }

        #ReplySection {
            max-width: 90%;
        }

        .container{
            width:50%
        }
    </style>

    {{-- css style end here --}}

    <div class="container" >
        {{-- SLIDER START HERE --}}
        <div class="slider">
            @include('Shared.Slider')
        </div>
        {{-- SLIDER END HERE --}}


        <div class="card w-100 mx-auto">
            <div class="card-header">
                <div class="media mb-3">
                    {{-- <img class="mr-3 d-block rounded-circle" style="height:100px;width:100px"  src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png"> --}}
                    <img class="mr-3 d-block rounded-circle" style="height:75px;width:75px"
                        src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png">

                    <div class="media-body mt-3">
                        <div class="d-flex">
                            <div class="mr-auto">
                                <h4>Buku matematika kelas 4 SD</h4>
                            </div>
                            <div class="mr-2">
                                <button type="submit" class="btn btn-warning pb-2 pt-1 px-1">
                                    Contact Author</button>
                            </div>
                            <div class="mr-2">
                                <button type="submit" class="btn btn-primary pb-2 pt-1 px-1">Open For
                                    Donation</button>
                            </div>
                            <div><button type="button" class="btn btn-danger pb-2 pt-1 px-3" data-toggle="modal"
                                    data-target="#mdlMakeReport">
                                    Report
                                </button></div>
                        </div>
                        <div class="d-flex">
                            <div class="mr-2">
                                <h5 style="font-weight: normal">Fikri Fadillah</h5>
                            </div>
                            <div class="text-muted">
                                10 July 2021 at 10:00 AM
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column bd-highlight">
                    <div class="p-2 bd-highlight h6 font-weight-normal">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, quaerat similique! Impedit, harum
                        aut voluptas, quos quae soluta aspernatur dolor eligendi molestiae explicabo eveniet! Temporibus
                        omnis blanditiis eius tenetur delectus.
                    </div>
                    <div class="p-2 bd-highlight">
                        <img class="w-75 h-50" src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/Money.jpg">
                    </div>
                    <div class="p-2 bd-highlight">
                        <div class="d-flex">
                            <div class="p-2 mr-auto">
                                <i class="fa fa-thumbs-up fa-2x"></i> 22 Likes
                            </div>
                            <div class="p-3 ">
                                <button type="button" class="btn btn-link" style="text-decoration: none"
                                    data-toggle="collapse" data-target="#CollapseComment" arial-expaned="true"
                                    arial-controls="CollapseComment">
                                    <h6 class="text-muted">5 Replies</h6>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="accordion ">
                        <div id="CollapseComment" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            @for ($i = 0; $i <5; $i++)
                            <div id="CommentSection">
                                <div class="media">
                                    {{-- <img class="mr-3 d-block rounded-circle" style="height:100px;width:100px"  src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png"> --}}
                                    <img class="mr-3 mt-1    d-block rounded-circle" style="height:50px;width:50px"
                                        src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png">
                                    <div class="border mt-2">
                                        <div class="media-body p-3">
                                            <div class="d-flex ">
                                                <div class="p-1">
                                                    <h5 style="font-weight: normal">Fikri Fadillah</h5>
                                                </div>
                                                <div class="p-1 text-muted mr-auto">
                                                    10 July 2021 at 10:00 AM
                                                </div>
                                                <div>
                                                    <button id="btnReplyComment" class="btn btn-link">
                                                        <button id="btnReplyComment" class="btn btn-link">
                                                            <h6>Reply</h6>
                                                        </button>
                                                    </button>
                                                </div>
                                            </div>
                                            <h6>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Id repellat amet aliquid repellendus facilis, odio tempore, natus quasi accusantium voluptas ipsa non, rerum quidem. Neque iure repellat in dicta nisi!</h6>
                                        </div>
                                    </div>
                                </div>
                             </div> 

                             <div id="ReplySection" class="ml-5">
                                    <div class="media mb-2">
                                        {{-- <img class="mr-3 d-block rounded-circle" style="height:100px;width:100px"  src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png"> --}}
                                        <img class="mr-3 mt-1    d-block rounded-circle" style="height:50px;width:50px"
                                            src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png">
                                        <div class="border mt-2">
                                            <div class="media-body p-3">
                                                <div class="d-flex ">
                                                    <div class="p-1">
                                                        <h5 style="font-weight: normal">Fikri Fadillah</h5>
                                                    </div>
                                                    <div class="p-1 text-muted mr-auto">
                                                        10 July 2021 at 10:00 AM
                                                    </div>
                                                    <div class="p-1 text-muted">
                                                        Reply to Fikri Fadillah
                                                    </div>
                                                </div>
                                                <h6>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Id repellat amet aliquid repellendus facilis, odio tempore, natus quasi accusantium voluptas ipsa non, rerum quidem. Neque iure repellat in dicta nisi!</h6>
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
        {{-- POP UP CREATE POST START HERE --}}
        <div class="slider">
            @include('Forum.Misc.component-form-reportpopup')
        </div>
        {{-- POP UP CREATE POST End HERE --}}
        

    </div>


@endsection
