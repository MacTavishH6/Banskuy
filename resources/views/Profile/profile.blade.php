@extends('layouts.app')

@section('styles')
    <style>
        ul#myTab li.nav-item a.nav-link {
            color: black;
            font-size: 36px;
            padding: 5px 50px;
        }

        ul#myTab li.nav-item a.active {
            border-bottom: 10px solid black;
        }

        div.tab-pane div.container {
            border: 1px solid black;
        }

    </style>
@endsection

@section('content')
    <section class="d-flex">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <img src="https://www.banskuy.com/banskuy.com/Basnkuy2022/assets/BinusUniv.png"
                        alt="UsernamePhotoProfile" style="border-radius: 50%; border: 1px solid black;">
                </div>
                <div class="col-9">
                    <div class="row mt-5">
                        <div class="col-12">
                            <h2>My Username<small
                                    style="display: inline-block; vertical-align: top; font-size: 16px;">Saint***</small>
                            </h2>
                        </div>
                        <div class="col-12">
                            <small>Member since - March 2020</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p align="justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio
                                reprehenderit adipisci corporis! Eaque quod libero, delectus numquam consequuntur pariatur
                                accusantium ipsum fugiat nisi. Aspernatur sit obcaecati cumque quis at enim. Lorem, ipsum
                                dolor sit amet consectetur adipisicing elit. Porro fugit voluptatibus possimus? Vitae
                                distinctio doloribus amet a deleniti quam nihil earum expedita ducimus quas! Debitis saepe
                                minus veniam modi et.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @if (false)
                                <button class="text-white py-1 px-3"
                                    style="border-radius: 20px; background-color: #AC8FFF; border: none;">Edit
                                    Profile</button>
                            @else
                                <button class="text-white py-1 px-3"
                                    style="border-radius: 20px; background-color: #AC8FFF; border: none;" data-toggle="modal"
                                    data-target="#mdlMakeReport">Report</button>
                                     
                                {{-- POP UP CREATE POST START HERE --}}
                                <div class="slider">
                                    @include('Forum.Misc.component-form-reportuserpopup')
                                </div>
                                {{-- POP UP CREATE POST End HERE --}}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <ul class="nav text-center" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="post-tab" data-toggle="tab" href="#post" role="tab"
                            aria-controls="post" aria-selected="true">Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="documentation-tab" data-toggle="tab" href="#documentation" role="tab"
                            aria-controls="documentation" aria-selected="false">Documentation</a>
                    </li>
                    @if (true)
                        <li class="nav-item">
                            <a class="nav-link" id="leveltracking-tab" data-toggle="tab" href="#leveltracking"
                                role="tab" aria-controls="leveltracking" aria-selected="false">Level Tracking</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="post" role="tabpanel" aria-labelledby="post-tab">
                <div class="container">
                    @include('Profile.Misc.component-list-post')
                </div>
            </div>
            <div class="tab-pane fade" id="documentation" role="tabpanel" aria-labelledby="documentation-tab">
                <div class="container">
                    @include('Profile.Misc.component-list-documentation')
                    @include('Profile.Misc.component-list-documentation')
                    @include('Profile.Misc.component-list-documentation')
                </div>
            </div>
            <div class="tab-pane fade" id="leveltracking" role="tabpanel" aria-labelledby="leveltracking-tab">
                <div class="container">
                    @include('Profile.Misc.component-list-leveltracking')
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>

    </script>
@endsection
