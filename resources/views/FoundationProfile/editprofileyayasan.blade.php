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


@section('scripts')
    <script>
        $(document).ready(function() {
            var passwordError = <?php echo ($errors->any() && $errors->has('NewPassword')) || $errors->has('OldPassword') ? json_encode($errors) : '""'; ?>;
            if (passwordError) $("#changepassword-tab").click();
            var user;
            banskuy.getReq('/getfoundationprofile/' + <?php echo '"' . Crypt::encrypt($foundation->FoundationID) . '"'; ?>)
                .then(function(data) {
                    user = data.payload;
                })
                .finally(function() {
                    banskuy.getReq('/getprovince')
                        .then(function(data) {
                            var option = document.getElementById("Province");
                            let newOption = new Option('', '');
                            option.add(newOption, undefined);
                            data.msg.forEach(element => {
                                let newOption = new Option(element.ProvinceName,
                                    element.ProvinceID);
                                option.add(newOption, undefined);
                            });
                            if (user.address) {
                                $(option).val(user.address.ProvinceID);
                            }
                            if ($(option).val()) {
                                $("#City").prop("disabled", false);
                                $("#City").empty();
                                banskuy.getReq('/getcity/' + $(option).val())
                                    .then(function(data) {
                                        var option = document.getElementById(
                                            "City");
                                        let newOption = new Option('', '');
                                        option.add(newOption, undefined);
                                        data.msg.forEach(element => {
                                            let newOption = new Option(
                                                element
                                                .CityName, element
                                                .CityID);
                                            option.add(newOption,
                                                undefined);
                                        });
                                        if (user.address) {
                                            $(option).val(user.address.CityID);
                                        }
                                    })
                            } else {
                                $("#City").prop("disabled", true);
                            }
                            $(option).on('change', function() {
                                if ($(this).val()) {
                                    $("#City").prop("disabled", false);
                                    $("#City").empty();
                                    banskuy.getReq('/getcity/' + $(this).val())
                                        .then(function(data) {
                                            var option = document
                                                .getElementById(
                                                    "City");
                                            let newOption = new Option(
                                                '', '');
                                            option.add(newOption,
                                                undefined);
                                            data.msg.forEach(
                                                element => {
                                                    let newOption =
                                                        new Option(
                                                            element
                                                            .CityName,
                                                            element
                                                            .CityID
                                                        );
                                                    option.add(
                                                        newOption,
                                                        undefined
                                                    );
                                                });
                                            if (user.address) {
                                                $(option).val(user
                                                    .address.CityID);
                                                // console.log(option);
                                            }
                                        })
                                } else {
                                    $("#City").prop("disabled", true);
                                    $("#City").empty();
                                }
                            });
                        })
                });
            $("#editphoto").on('click', function() {
                event.preventDefault();
                $("#form-file").modal();
            });
            $("#deletephoto").on('click', function() {
                event.preventDefault();
                $("#form-delete-file").modal();
            });
            user = '';
        });

        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.image-upload-wrap').hide();

                    $('.file-upload-image').attr('src', e.target.result);
                    $('.file-upload-content').show();

                    $('.image-title').html(input.files[0].name);
                };

                reader.readAsDataURL(input.files[0]);

            } else {
                removeUpload();
            }
        }

        function removeUpload() {
            $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
        }
        $('.image-upload-wrap').bind('dragover', function() {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function() {
            $('.image-upload-wrap').removeClass('image-dropping');
        });
    </script>
@endsection
