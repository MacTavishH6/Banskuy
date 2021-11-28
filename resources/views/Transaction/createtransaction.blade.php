@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="slider">
                @include('Shared.Slider')
            </div>
        </div>
    </section>
    <section>
        <div class="container ">
            <div class="row text-center">
                <div class="col">
                    <h3>Make Donation Request Now!</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col">
                    <h3>People In Need Is Waiting For You</h3>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="card w-50 mx-auto my-3">
            <div class="card-body">
                <div class="form-row py-4">
                    <div class="col-2 text-center">
                        <img src="{{ env('FTP_URL') }}{{ $user->Photo ? 'ProfilePicture/Donatur/' . $user->Photo->Path : 'assets/Smiley.png' }}"
                            alt="UsernamePhotoProfile"
                            style="border-radius: 50%; border: 1px solid black; width: 70px; height: 70px;"
                            onerror="this.onerror==null;this.src='{{ env('FTP_URL') }}assets/Smiley.png'">
                    </div>
                    <div class="col-9 mt-3">
                        <h3>{{ $user->Username ? $user->Username : $user->Email }}
                            <small
                                style="display: inline-block; vertical-align: top; font-size: 16px; color: #2f9194;">{{ $user->UserLevel->where('IsCurrentLevel', '1')->first()->LevelGrade->LevelName }}
                                <?php 
                                    $level = $user->UserLevel->where('IsCurrentLevel','1')->first()->LevelGrade->LevelOrder;
                                    for ($i=0; $i < $level; $i++) {?>
                                *
                                <?php } ?></small>
                        </h3>
                    </div>
                </div>
                <form action="/requesttransaction" method="post">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="UserID" value="{{ Crypt::encrypt($user->UserID) }}">
                    <div class="form-row py-1">
                        <div class="col-3">
                            <label for="DonationType">Donation Type</label>
                        </div>
                        <div class="col-5">
                            <select name="DonationType" class="form-control" id="DonationType" required></select>
                        </div>
                    </div>
                    <div class="form-row py-1">
                        <div class="col-3">
                            <label for="WithPost">With Post</label>
                        </div>
                        <div class="col-5">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="WithPost" id="WithPostYes" value="1"
                                    required>
                                <label class="form-check-label" for="WithPostYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="WithPost" id="WithPostNo" value="2">
                                <label class="form-check-label" for="WithPostNo">No</label>
                            </div>
                            @error('WithPost')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-row py-1">
                        <div class="col-3">
                            <label for="Foundation">Foundation</label>
                        </div>
                        <div class="col-5">
                            <input type="text" name="Foundation" id="Foundation" class="form-control" required>
                            <input type="hidden" name="FoundationID" id="FoundationID">
                        </div>
                        <div class="col mt-1">
                            <button type="button" style="border-radius: 20px; background-color: #AC8FFF; border: none;"
                                id="searchfoundation">Search</button>
                        </div>
                    </div>
                    <div class="form-row py-1">
                        <div class="col-3">
                            <label for="FoundationAddress">Foundation Address</label>
                        </div>
                        <div class="col-5">
                            <textarea class="form-control" name="FoundationAddress" id="FoundationAddress" rows="3"
                                style="resize: none;" disabled required></textarea>
                        </div>
                    </div>
                    <div class="form-row py-1">
                        <div class="col-3">
                            <label for="FoundationAddress">Foundation Province</label>
                        </div>
                        <div class="col-5">
                            <input type="text" name="Province" id="Province" class="form-control" disabled required>
                        </div>
                    </div>
                    <div class="form-row py-1">
                        <div class="col-3">
                            <label for="FoundationAddress">Foundation City</label>
                        </div>
                        <div class="col-5">
                            <input type="text" name="City" id="City" class="form-control" disabled required>
                        </div>
                    </div>
                    <div class="form-row py-1 d-none" id="select-post">
                        <div class="col-3">
                            <label for="SelectPost">Select Post</label>
                        </div>
                        <div class="col-5">
                            <select name="SelectPost" class="form-control" id="SelectPost"></select>
                        </div>
                    </div>
                    <div class="form-row py-1 d-none" id="descriptionContainer">
                        <div class="col-3">
                            <label for="DonationDescription" id="descriptionLabel">

                            </label>
                        </div>
                        <div class="col-5">
                            <textarea name="DonationDescription" id="DonationDescription" rows="3" class="form-control"
                                style="resize: none;" required></textarea>
                        </div>
                    </div>
                    <div class="form-row py-1">
                        <div class="col-3">
                            <label for="Unit">Unit</label>
                        </div>
                        <div class="col-5">
                            <select name="Unit" id="Unit" class="form-control" required></select>
                        </div>
                    </div>
                    <div class="form-row py-1">
                        <div class="col-3">
                            <label for="Quantity">Quantity</label>
                        </div>
                        <div class="col-5">
                            <input type="text" name="Quantity" id="Quantity" class="form-control"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6 pr-2">
                            <button type="submit" class="float-right py-1 px-5"
                                style="border-radius: 20px; background-color: #AC8FFF; border: none;">Make A
                                Request</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div class="modal" id="modal-foundation" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foundation List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="table-foundation" class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Foundation Name</th>
                                <th>Username</th>
                                <th>Foundation Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            bindDonationType();
            
            $("#DonationType").on('change', function() {
                if ($(this).val()) {
                    var donType = $(this).val();
                    $("#descriptionContainer").removeClass('d-none');
                    switch (donType) {
                        case '1':
                            $("#descriptionLabel").html('Donation Title');
                            break;
                        case '2':
                            $("#descriptionLabel").html('Kind of Service');
                            break;
                        case '3':
                            $("#descriptionLabel").html('Donation Title');
                            break;
                    }
                    CheckPostEnabled();
                } else {
                    $("#descriptionContainer").addClass('d-none');
                }
                
                bindDonationTypeDetail();
            });
            $("#searchfoundation").on('click', function() {
                event.preventDefault();
                if (!$("#DonationType").val()) {
                    toastr.error("Tolong pilih Tipe Donasi dahulu!");
                    return;
                }
                $("#table-foundation tbody").empty();
                var searchtext = $("#Foundation").val();
                var data = {
                    text: searchtext,
                    donationType: '',
                    _token: "<?php echo csrf_token(); ?>"
                }
                if ($("input[name='WithPost']").val() == 1) data.donationType = $("#DonationType").val();
                banskuy.postReq("{{ url('/getfoundationsearch') }}", data)
                    .then(function(data) {
                        var tbodystring;
                        if (data.payload && data.payload.length > 0) {
                            data.payload.forEach((foundation, index) => {
                                var hashedFoundationId = data.foundationID.find(obj =>
                                    obj.key == foundation.FoundationID);
                                hashedFoundationId = hashedFoundationId ?
                                    hashedFoundationId.value : '';
                                tbodystring += "<tr>";
                                tbodystring += "<td>" + (index + 1) + "</td>";
                                tbodystring += "<td>" + foundation.FoundationName +
                                    "</td>";
                                tbodystring += "<td>" + foundation.Username + "</td>";
                                tbodystring += "<td>" + foundation.FoundationPhone +
                                    "</td>";
                                tbodystring +=
                                    "<td><button type=\"Button\" id=\"foundationselect\" data-id=\"" +
                                    hashedFoundationId +
                                    "\" class=\"btn btn-info\">Select</button></td>";
                                tbodystring += "</tr>";
                            });
                        } else {
                            tbodystring += "<tr>";
                            tbodystring +=
                                "<td colspan=\"5\" class=\"text-center\">No Data Available</td>";
                            tbodystring += "</tr>";
                        }
                        $("#table-foundation tbody").append(tbodystring);
                    })
                    .finally(function() {
                        $("#modal-foundation").modal();
                        $("#foundationselect").on('click', function() {
                            var foundationid = $(this).attr('data-id');
                            var data = {
                                UserID: foundationid,
                                _token: "<?php echo csrf_token(); ?>"
                            }
                            
                            banskuy.postReq("{{ url('/getfoundationbyid') }}", data)
                                .then(function(data) {
                                    
                                    var foundation = data.payload;

                                    $("#FoundationID").val(data
                                        .foundationid);
                                    $("#Foundation").val(foundation
                                        .FoundationName)
                                    $("#FoundationAddress").val(foundation
                                        .address ? foundation.address
                                        .Address : '');
                                    $("#Province").val(foundation.address ?
                                        (foundation.address.province ?
                                            foundation.address.province
                                            .ProvinceName : '') : '');
                                    $("#City").val(foundation.address ? (
                                        foundation.address.city ?
                                        foundation.address.city
                                        .CityName : '') : '');
                                })
                                .finally(function() {
                                    $("#modal-foundation").modal('hide');
                                    CheckPostEnabled();
                                    bindListPost($("#FoundationID").val());
                                });
                        });
                    })
            });
            $("#Unit").on('change', function() {
                if ($('#Unit').val()) $("#Quantity").prop('disabled', false);
                else $("#Quantity").prop('disabled', true);
                $("#Quantity").val('');
            });

            $("input[name='WithPost']").change(function() {
                if ($(this).val() == 1) {
                    $("#select-post").removeClass('d-none');
                    CheckPostEnabled();
                    
                    
                } else if ($(this).val() == 2) {
                    $("#select-post").addClass('d-none');
                }
            });
       
        });

        function bindListPost($id){
            //var id = $('#FoundationID').val();
            //console.log(id);
            var data = {
                        UserID: $id,
                        _token: "<?php echo csrf_token(); ?>"
                    }
            banskuy.postReq('/getpostlist', data)
                .then(function(data) {
                    var SelectPost = document.getElementById('SelectPost');
                    var listPost = data.msg;
                    let newOption = new Option('','');
                    SelectPost.add(newOption,undefined);
                    console.log(data.msg);
                    listPost.forEach(element=>{
                        // let newOption = new Option(element.PostTitle,element.PostID);
                        // SelectPost.add(newOption,undefined);

                        if(element.PostID == {{isset($Post) ? $Post->PostID : 0}})
                            $('#SelectPost').append('<option value ='+element.PostID+' selected>'+element.PostTitle+'</option>');
                            else
                            $('#SelectPost').append('<option value ='+element.PostID+'>'+element.PostTitle+'</option>');

                    });
                })
                .finally(function () {

                });
        }

        function bindDonationType() {
            banskuy.getReq('/getdonationtype')
                .then(function(data) {
                    var donationtype = data.msg;
                    var option = document.getElementById("DonationType");
                    let newOption = new Option('', '');
                    option.add(newOption, undefined);
                    donationtype.forEach(element => {
                        // let newOption = new Option(element.DonationTypeName,
                        //     element.DonationTypeID);
                        //option.add(newOption, undefined);
                            if(element.DonationTypeID == {{isset($Post) ? $Post->DonationTypeID : 0}})
                            $('#DonationType').append('<option value ='+element.DonationTypeID+' selected>'+element.DonationTypeName+'</option>');
                            else
                            $('#DonationType').append('<option value ='+element.DonationTypeID+'>'+element.DonationTypeName+'</option>');

                    });
                })
                .finally(function() {
                    bindDonationTypeDetail();
                });
        }

        function bindDonationTypeDetail() {
            $("#Unit").empty().trigger('change');
            if ($("#DonationType").val()) {
                $("#Unit").prop('disabled', false);
                banskuy.getReq('/getdonationtype')
                    .then(function(data) {
                        var donationtype = data.msg;
                        console.log(donationtype);
                        var donationtypeval = $("#DonationType").val();
                        var donationtypedetail = donationtype.find(function(x) {
                            return x.DonationTypeID == donationtypeval
                        }).donation_type_detail;
                        var optiondetail = document.getElementById("Unit");
                        let newOptionDetail = new Option('', '');
                        optiondetail.add(newOptionDetail, undefined);
                        console.log(donationtypedetail);
                        donationtypedetail.forEach(element2 => {
                            // let newOptionDetail = new Option(element2.DonationTypeDetail,
                            //     element2.DonationTypeDetailID);
                            // optiondetail.add(newOptionDetail, undefined);
                            if(element2.DonationTypeDetailID == {{isset($Post) ? $Post->DonationTypeDetailID : 0}})
                            {
                                $('#Unit').append('<option value ='+element2.DonationTypeDetailID+' selected>'+element2.DonationTypeDetail+'</option>');
                                $("#Quantity").val('').prop('disabled', false);
                            }
                            else
                            $('#Unit').append('<option value ='+element2.DonationTypeDetailID+'>'+element2.DonationTypeDetail+'</option>');
                        });
                    });
            } else {
                $("#Unit").prop('disabled', true);
                $("#Quantity").val('').prop('disabled', true);
            }

        }

        function CheckPostEnabled() {
            if ($("#FoundationID").val() && $("#DonationType").val()) $("#SelectPost").prop('disabled', false);
            else $("#SelectPost").prop('disabled', true);
        }
        
        $(window).on('load',function(){
            if({{$StatusRedirect}} == 1){
                $('#WithPostYes').prop("checked",true);
                $("#select-post").removeClass('d-none');
                var donType = '{{isset($Post) ? $Post->DonationTypeID : 0}}';
 
                    $("#descriptionContainer").removeClass('d-none');
                    switch (donType) {
                        case '1':
                            $("#descriptionLabel").html('Donation Title');
                            break;
                        case '2':
                            $("#descriptionLabel").html('Kind of Service');
                            break;
                        case '3':
                            $("#descriptionLabel").html('Donation Title');
                            break;
                    }
                
                var FoundationID = '{{isset($Post) ? Crypt::encrypt($Post->ID) : 1}}';
                var data = {
                                UserID: FoundationID,
                                _token: "<?php echo csrf_token(); ?>"
                            }
                            banskuy.postReq("{{ url('/getfoundationbyid') }}", data)
                                .then(function(data) {
                                    var foundation = data.payload;
                                    $("#FoundationID").val(data
                                        .foundationid);
                                    $("#Foundation").val(foundation
                                        .FoundationName)
                                    $("#FoundationAddress").val(foundation
                                        .address ? foundation.address
                                        .Address : '');
                                    $("#Province").val(foundation.address ?
                                        (foundation.address.province ?
                                            foundation.address.province
                                            .ProvinceName : '') : '');
                                    $("#City").val(foundation.address ? (
                                        foundation.address.city ?
                                        foundation.address.city
                                        .CityName : '') : '');
                                })
                                .finally(function() {
                                    $("#modal-foundation").modal('hide');
                                    CheckPostEnabled();
                                });
                                
            }
            CheckPostEnabled();
            $("#SelectPost").prop('disabled', false);
            bindListPost('{{Crypt::encrypt(isset($Post) ? $Post->ID : 0)}}');
            
        });
    </script>
@endsection
