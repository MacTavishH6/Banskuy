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
                    @include('Profile.Misc.component-form-editprofile', ['user' => $user])
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

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/getprovince',
                // dataType: 'json',
                // contentType: 'application/json',
                method: 'GET',
                success: function(data) {
                    var option = document.getElementById("Province");
                    let newOption = new Option('', '');
                    option.add(newOption, undefined);
                    data.msg.forEach(element => {
                        let newOption = new Option(element.ProvinceName, element.ProvinceID);
                        option.add(newOption, undefined);
                    });
                    if ($(option).val()) {
                        $("#City").prop("disabled", false);
                    } else {
                        $("#City").prop("disabled", true);
                    }
                    $(option).on('change', function() {
                        if ($(this).val()) {
                            $("#City").prop("disabled", false);
                            $.ajax({
                                url: '/getcity/' + $(this).val(),
                                method: 'GET',
                                success: function(data) {
                                    var option = document.getElementById(
                                    "City");
                                    let newOption = new Option('', '');
                                    option.add(newOption, undefined);
                                    data.msg.forEach(element => {
                                        let newOption = new Option(element
                                            .CityName, element
                                            .CityID);
                                        option.add(newOption, undefined);
                                    });
                                }
                            });
                        } else {
                            $("#City").prop("disabled", true);
                            $("#City").empty();
                        }
                    });
                }
            });
        });
    </script>
@endsection
