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
    <section class="d-flex mt-3">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <img src="{{ env('FTP_URL') }}{{ $user->Photo ? 'ProfilePicture/Donatur/' . $user->Photo->Path : 'assets/Smiley.png' }}"
                        alt="UsernamePhotoProfile"
                        style="border-radius: 50%; border: 1px solid black; width: 250px; height: 250px;"
                        onerror="this.onerror==null;this.src='{{ env('FTP_URL') }}assets/Smiley.png'">
                </div>
                <div class="col-9">
                    <div class="row mt-5">
                        <div class="col-12">
                            <h2>{{ $user->Username ? $user->Username : $user->Email }}<small
                                    style="display: inline-block; vertical-align: top; font-size: 16px; color: #2f9194;">{{ $user->UserLevel->where('IsCurrentLevel','1')->first()->LevelGrade->LevelName }}
                                    <?php 
                                    $level = $user->UserLevel->where('IsCurrentLevel','1')->first()->LevelGrade->LevelOrder;
                                    for ($i=0; $i < $level; $i++) {?>
                                    *
                                    <?php } ?></small>
                            </h2>
                        </div>
                        <div class="col-12">
                            <small>{{ $user->RegisterDate }}</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 has-bio">
                            <p align="justify">{{ $user->Bio }}</p>
                        </div>
                        <div class="col-12 edit-bio">
                            <textarea name="Bio" id="Bio" class="form-control" rows="3"
                                style="resize: none">{{ $user->Bio ? $user->Bio : '' }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            @if (Auth::user()->UserID == $user->UserID)
                                <form action="/updatebio" class="form d-inline" method="post">
                                    @csrf
                                    @method("PUT")
                                    <input type="hidden" name="UserID" value="{{ $user->UserID }}">
                                    <input type="hidden" name="Bio" id="hidBio">
                                    <button class="text-white py-1 px-3 edit-bio"
                                        style="border-radius: 20px; background-color: #AC8FFF; border: none;">Save
                                        Bio</button>
                                </form>
                                <button class="text-white py-1 px-3 has-bio" id="btnEditBio"
                                    style="border-radius: 20px; background-color: #AC8FFF; border: none;">Edit Bio</button>

                                <button class="text-white py-1 px-3 edit-profile"
                                    style="border-radius: 20px; background-color: #AC8FFF; border: none;">Edit
                                    Profile</button>
                            @else
                                <button class="text-white py-1 px-3"
                                    style="border-radius: 20px; background-color: #AC8FFF; border: none;"
                                    data-toggle="modal" data-target="#mdlMakeReport">Report</button>

                                {{-- POP UP CREATE POST START HERE --}}
                                <div class="slider">
                                    @include('Forum.Misc.component-form-reportuserpopup')
                                </div>
                                {{-- POP UP CREATE POST End HERE --}}
                            @endif

                        </div>
                        <div class="col">
                            <label id="count-bio-word" class="edit-bio float-right">0/100</label>
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
        <div class="tab-content mb-3" id="myTabContent">
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
    <div id="modal">
        @include('Shared._popupConfirmed')
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var user;
            $.ajax({
                url: '/getprofile/' + <?php echo '"' . Crypt::encrypt($user->UserID) . '"'; ?>,
                type: 'GET',
                async: false,
                success: function(data) {
                    user = data.payload;
                }
            })
            if (!user.FullName && !user.LastName && !user.Address) {
                $("#confirmedModal").modal();
            }
            $(".edit-profile").on('click', function() {
                return location.href = '/editprofile/' + <?php echo '"' . Crypt::encrypt($user->UserID) . '"'; ?>;
            });
            $('#Bio').on('input', function() {
                if ($(this).val().length > 100) $(this).val($(this).val().substring(0, 100));
                $("#count-bio-word").html($(this).val().length + "/100");
                $("#hidBio").val($(this).val());
            });
            if (user.Bio) {
                $(".edit-bio").addClass("d-none");
            } else {
                $(".has-bio").addClass("d-none");
            }
            $("#btnEditBio").on('click', function() {
                $(".edit-bio").removeClass("d-none");
                $(".has-bio").addClass("d-none");
                $("#hidBio").val($("#Bio").val());
                $("#count-bio-word").html($("#hidBio").val().length + "/100");
            });
            $.ajax({
                url: '/nextlevel/' + <?php echo '"' . Crypt::encrypt($user->UserLevel->where('IsCurrentLevel', '1')->first()->LevelID) . '"'; ?>,
                type: 'GET',
                success: function(data) {
                    $("#nextlevelxp").html(data.payload.LevelExp);
                    $("#nextlevelname").html(data.payload.LevelName);
                }
            })
        });
    </script>
@endsection
