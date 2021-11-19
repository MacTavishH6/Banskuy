<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile Yayasan</title>

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
</head>

<body>
    @extends('layouts.app')

    @section('content')  

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
                            <h2>{{$foundation->Email}}</h2>
                        </div>
                        <div class="col-12">
                            <small>Member since {{$foundation->RegisterDate}}</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p align="justify">{{$foundation->Bio}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3" style="font-size:150%">
                            <small>Jl. Dr. Wahidin Sudirohusodo No.25, Fatmawati, Jakarta Selatan</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @if (true)
                                <button class="text-white py-1 px-3 edit-foundation-profile"
                                    style="border-radius: 20px; background-color: #AC8FFF; border: none;">Edit
                                    Profile</button>
                            @else
                                <button class="text-white py-1 px-3"
                                    style="border-radius: 20px; background-color: #AC8FFF; border: none;">Contact</button>

                                <button class="text-white py-1 px-3"
                                    style="border-radius: 20px; background-color: #53FF37; border: none;">Goods Needed</button>

                                <button class="text-white py-1 px-3"
                                    style="border-radius: 20px; background-color: #AC8FFF; border: none;">Report</button>                                
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
                        <a class="nav-link active" id="documentation-tab" data-toggle="tab" href="#documentation" role="tab"
                            aria-controls="documentation" aria-selected="false">Documentation</a>
                    </li>
                    {{-- @if (true) --}}
                        <li class="nav-item">
                            <a class="nav-link" id="aboutus-tab" data-toggle="tab" href="#aboutus"
                                role="tab" aria-controls="aboutus" aria-selected="false">About Us</a>
                        </li>
                    {{-- @endif --}}
                </ul>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="documentation" role="tabpanel" aria-labelledby="documentation-tab">
                <div class="container">
                    @include('FoundationProfile.FoundationMisc.component-list-documentation')
                </div>
            </div>
            <div class="tab-pane fade" id="aboutus" role="tabpanel" aria-labelledby="aboutus-tab">
                <div class="container">
                    @include('FoundationProfile.FoundationMisc.component-list-visimisiaboutus')
                </div>
            </div>
        </div>
    </section>

    <div id="modal">
        @include('Shared._popupConfirmed')
    </div>

    @endsection  
    @endsection

    @section('scripts')
        <script type="text/javascript">
            var foundation = <?php echo json_encode($foundation); ?>;
            $(document).ready(function () {
                if(!foundation.IsConfirmed){
                    $("#confirmedModal").modal();
                }
                $(".edit-profile").on('click', function() {
                    return location.href = '/editfoundationprofile/' + <?php echo '"' . Crypt::encrypt($foundation->FoundationID) . '"'; ?>;
                });
            });
        </script>
    @endsection

</body>
</html>