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

        .file-upload {
            background-color: #ffffff;
            width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .file-upload-btn {
            width: 100%;
            margin: 0;
            color: #fff;
            background: #AC8FFF;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #AC8FFF;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .file-upload-btn:hover {
            background: #d0c1fa;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .file-upload-btn:active {
            border: 0;
            transition: all .2s ease;
        }

        .file-upload-content {
            display: none;
            text-align: center;
        }

        .file-upload-input {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
            cursor: pointer;
        }

        .image-upload-wrap {
            margin-top: 20px;
            border: 4px dashed #AC8FFF;
            position: relative;
        }

        .image-dropping,
        .image-upload-wrap:hover {
            background-color: #d0c1fa;
            border: 4px dashed #ffffff;
        }

        .image-title-wrap {
            padding: 0 15px 15px 15px;
            color: #222;
        }

        .drag-text {
            text-align: center;
        }

        .drag-text h3 {
            font-weight: 100;
            text-transform: uppercase;
            padding: 60px 0;
        }

        .file-upload-image {
            max-height: 200px;
            max-width: 200px;
            margin: auto;
            padding: 20px;
        }

        .remove-image {
            width: 200px;
            margin: 0;
            color: #fff;
            background: #cd4535;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #b02818;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .remove-image:hover {
            background: #c13b2a;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .remove-image:active {
            border: 0;
            transition: all .2s ease;
        }

    </style>
@endsection

@section('content')
    {{-- Untuk Get --}}
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

    {{-- ====================================PEMBATAS UNTUK POP UP PROFILE PICT========================================= --}}

    <div class="modal" id="form-file" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Upload Profile Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="/UpdateFoundationProfilePicture">
                        @csrf
                        @method('POST')
                        <div class="file-upload">
                            <input type="hidden" name="FoundationID" value="{{ Crypt::encrypt($foundation->FoundationID) }}">
                            <button class="file-upload-btn" type="button"
                                onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

                            <div class="image-upload-wrap">
                                <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*"
                                    name="ProfilePicture" />
                                <div class="drag-text">
                                    <h3>Photo Preview</h3>
                                </div>
                            </div>
                            <div class="file-upload-content">
                                <img class="file-upload-image" src="#" alt="your image" />
                                <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span
                                            class="image-title">Uploaded Image</span></button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn-banskuy text-white">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="form-delete-file" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Profile Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="POST" action="/deleteprofilephoto">
                        @csrf
                        @method('DELETE')
                        <div class="form-row">
                            <label>Are you sure you want to delete Profile Photo ?</label>
                            <input type="hidden" name="FoundationID" value="{{ Crypt::encrypt($foundation->FoundationID) }}">
                        </div>
                        <div class="form-row">
                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger text-white">Delete</button>
                        </div>
                    </form>
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
            var foundation;
            banskuy.getReq('/getfoundationprofile/' + <?php echo '"' . Crypt::encrypt($foundation->FoundationID) . '"'; ?>)
                .then(function(data) {
                    foundation = data.payload;
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
                            if (foundation.address) {
                                $(option).val(foundation.address.ProvinceID);
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
                                        if (foundation.address) {
                                            $(option).val(foundation.address.CityID);
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
                                            if (foundation.address) {
                                                $(option).val(foundation
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
            foundation = '';
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
