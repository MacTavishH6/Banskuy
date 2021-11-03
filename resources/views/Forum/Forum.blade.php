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
        /* Slider Start Here */


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

        {{-- LIST POST START HERE --}}
        <div class="PagePost">
            <div class="d-flex flex-row-reverse bd-highlight w-100 mb-3">
                <div class="p-2"><button type="button" class="btn btn-info px-2 pt-2" data-toggle="modal"
                        data-target="#mdlMakePost">
                        <h6>Create a Post</h6>
                    </button></div>
            </div>

            <div id="accordion ">
                <div class="card mb-3" style="max-height: 330px">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header" id="headingOne">
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
                                <div class="Post-Item mb-2 card-body">
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
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card mb-3" style="max-height: 330px">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header" id="headingTwo">
                                <div class="d-flex">
                                    <div class="mr-auto p-2">
                                        <h4>Service</h4>
                                    </div>
                                    <div>
                                        <button class="btn btn-link" style="text-decoration: none;" data-toggle="collapse"
                                            data-target="#CollapseService" arial-expanded="true"
                                            aria-controls="CollapseService">
                                            <h2 class="font-weight-bold">-</h2>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="CollapseService" class="collapse show" aria-labelledby="headingTwo"
                                data-parent="#accordion">
                                <div class="Post-Item mb-2 card-body">
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
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card mb-3" style="max-height: 330px">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header" id="headingThree" >
                                <div class="d-flex">
                                    <div class="mr-auto p-2">
                                        <h4>Second Hand Goods</h4>
                                    </div>
                                    <div>
                                        <button class="btn btn-link" style="text-decoration: none;" data-toggle="collapse"
                                            data-target="#CollapseStuff" arial-expanded="true"
                                            aria-controls="CollapseStuff">
                                            <h2 class="font-weight-bold">-</h2>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="CollapseStuff" class="collapse show" aria-labelledby="headingThree"
                                data-parent="#accordion">
                                <div class="Post-Item mb-2 card-body">
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
                            </div>
                        </div>

                    </div>
                </div>


            </div>

        </div>
        {{-- LIST POST END HERE --}}

        {{-- POP UP CREATE POST START HERE --}}

        <div class="modal fade bd-example-modal-lg" id="mdlMakePost" tabindex="-1" role="dialog" aria-hidden="true" style="max-height: 600px" >
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content p-4">
                    <div class="modal-header">
                        <h3 class="modal-title w-100 text-center">Create a Post</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mb-1">
                        <div class="media mb-2">
                            {{-- <img class="mr-3 d-block rounded-circle" style="height:100px;width:100px"  src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png"> --}}
                            <img class="mr-3 d-block rounded-circle" style="height:75px;width:75px"
                                src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png">

                            <div class="media-body mt-3">
                                <h3>Fikri Fadillah</h3>
                            </div>
                        </div>

                        <div>
                            <form>
                                <div class="form-inline mb-2">
                                    <div class="form-group w-100">
                                        <div class="input-group w-50 p-1">
                                            <div class="mt-2 mr-1">
                                                <h6>Post Type :</h6>
                                            </div>
                                            <select class="form-control" id="ddlPostType">
                                                <option>Donation Post</option>
                                                <option>Donation Post</option>
                                            </select>
                                        </div>

                                        <div class="input-group w-50 p-1">
                                            <div class="mt-2 mr-1">
                                                <h6>Donation Type :</h6>
                                            </div>
                                            <select class="form-control" id="ddlDonationType">
                                                <option>Finance</option>
                                                <option>Stuff</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <textarea class="form-control" id="txaPostDesc" rows="3" style="resize: none"></textarea>
                                </div>

                                <div class="form-inline mb-3">
                                    <div class="form-group w-100">
                                        <div class="input-group w-50 p-1">
                                            <div class="mt-2 mr-1">
                                                <h6>Unit :</h6>
                                            </div>
                                            <select class="form-control" id="ddlUnit">
                                                <option>Piece</option>
                                                <option>Currency</option>
                                            </select>
                                        </div>

                                        <div class="input-group w-50 p-1">
                                            <div class="mt-2 mr-1">
                                                <h6>Quantity :</h6>
                                            </div>
                                            <input class="form-control" type="number" id="txtQuantity">
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-file w-100 mb-3">
                                    <input class="custom-file-input" type="file" id="fuAttachment">
                                    <label class="custom-file-label" for="fuAttachment">Choose File</label>
                                </div>
                                <div class="text-center w-100 mb-1">
                                    <button type="submit" class="btn btn-primary w-75 " id="btnSubmit">
                                        <h5>Post</h5>
                                    </button>
                                </div>
                                    
                            </form>
                        </div>

                    </div>
                </div>

            </div>
    </div>


    </div>


@endsection
