@extends('layouts.app')

@section('styles')
    <style>
        a.profile-link {
            color: black;
            font-size: 20px;
        }

        a.profile-link:hover {
            color: white;
        }

        li.nav-item a.active {
            border-left: 10px solid black;
            color: white;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4 p-0" style="width: 100vp;background-color: #AC8FFF;">
                @include('Shared._sidebar-edit')
            </div>
            <div class="tab-content col-8" id="myTabContent">
                <div class="tab-pane fade show active" id="editprofile" role="tabpanel" aria-labelledby="editprofile-tab">
                    @include('Profile.Misc.component-form-editprofile')
                </div>
                <div class="tab-pane fade" id="changepassword" role="tabpanel" aria-labelledby="changepassword-tab">
                    @include('Profile.Misc.component-form-changepassword')
                </div>
                <div class="tab-pane fade" id="leveltracking" role="tabpanel" aria-labelledby="leveltracking-tab">
                    <div class="container">
                        @include('Profile.Misc.component-list-leveltracking')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
