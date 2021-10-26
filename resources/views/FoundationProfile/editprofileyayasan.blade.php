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
                @include('FoundationProfile.foundationsidebar')
            </div>
            <div class="tab-content col-8" id="myTabContent">
                <div class="tab-pane fade show active" id="editprofileyayasan" role="tabpanel" aria-labelledby="editprofileyayasan-tab">
                    @include('FoundationProfile.FoundationMisc.component-form-editprofileyayasan')
                </div>
                <div class="tab-pane fade" id="changepassword" role="tabpanel" aria-labelledby="changepassword-tab">
                    @include('FoundationProfile.FoundationMisc.component-form-changepassword')
                </div>
                <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
                    @include('FoundationProfile.FoundationMisc.component-form-document')
                </div>
            </div>
        </div>
    </div>
@endsection
