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
        <div class="card w-50 m-auto">
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
                <form action="#" method="post">
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
                            <label for="Foundation">Foundation</label>
                        </div>
                        <div class="col-5">
                            <input type="text" name="Foundation" id="Foundation" class="form-control">
                            <input type="hidden" name="FoundationID">
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
                                style="resize: none;" disabled></textarea>
                        </div>
                    </div>
                    @if (true)
                        <div class="form-row py-1">
                            <div class="col-3">
                                <label for="DonationDescription">
                                    @if (true)
                                        Donation Description
                                    @elseif (false)
                                        Kind of Service
                                    @endif
                                </label>
                            </div>
                            <div class="col-5">
                                <textarea name="DonationDescription" id="DonationDescription" rows="3"
                                    class="form-control" style="resize: none;"></textarea>
                            </div>
                        </div>
                    @endif
                    <div class="form-row py-1">
                        <div class="col-3">
                            <label for="Unit">Unit</label>
                        </div>
                        <div class="col-5">
                            <select name="Unit" id="Unit" class="form-control"></select>
                        </div>
                    </div>
                    <div class="form-row py-1">
                        <div class="col-3">
                            <label for="Quantity">Quantity</label>
                        </div>
                        <div class="col-5">
                            <input type="text" name="Quantity" id="Quantity" class="form-control">
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
                bindDonationTypeDetail();
            });
            $("#searchfoundation").on('click', function() {
                event.preventDefault();
                $("#table-foundation tbody").empty();
                var searchtext = $("#Foundation").val();
                $.ajax({
                    url: "{{ url('/getfoundationsearch') }}",
                    type: 'POST',
                    data: {
                        text: searchtext,
                        _token: "<?php echo csrf_token(); ?>"
                    },
                    error: function(data) {
                        console.log(data);
                    },
                    success: function(data) {
                        var tbodystring;
                        if (data.payload && data.payload.length > 0) {
                            data.payload.forEach((foundation, index) => {
                                tbodystring += "<tr>";
                                tbodystring += "<td>" + (index + 1) + "</td>";
                                tbodystring += "<td>" + foundation.FoundationName +
                                    "</td>";
                                tbodystring += "<td>" + foundation.Username + "</td>";
                                tbodystring += "<td>" + foundation.FoundationPhone +
                                    "</td>";
                                tbodystring +=
                                    "<td><button type=\"Button\" id=\"foundationselect\" data-id=\"" +
                                    foundation.FoundationID +
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
                    },
                    complete: function() {
                        $("#modal-foundation").modal();
                        $("#foundationselect").on('click', function() {
                            var foundationid = $(this).attr('data-id');
                            $.ajax({
                                url: "{{ url('/getfoundationbyid') }}",
                                type: 'POST',
                                data: {
                                    UserID: foundationid,
                                    _token: "<?php echo csrf_token(); ?>"
                                },
                                success: function(data) {
                                    var foundation = data.payload;
                                    $("#FoundationID").val(foundation.FoundationID);
                                    $("#Foundation").val(foundation.FoundationName)
                                    $("#FoundationAddress").val(foundation.address?foundation.address.Address:'');
                                },
                                complete: function() {
                                    $("#modal-foundation").modal('hide');

                                }
                            })
                        });
                    }
                })
            });

            $("#Unit").on('change', function() {
                console.log($('#Unit').val());
                if ($('#Unit').val()) $("#Quantity").prop('disabled', false);
                else $("#Quantity").prop('disabled', true);
                $("#Quantity").val('');
            });
        });

        function bindDonationType() {
            $.ajax({
                url: '/getdonationtype',
                type: "GET",
                success: function(data) {
                    var donationtype = data.msg;
                    var option = document.getElementById("DonationType");
                    let newOption = new Option('', '');
                    option.add(newOption, undefined);
                    donationtype.forEach(element => {
                        let newOption = new Option(element.DonationTypeName,
                            element.DonationTypeID);
                        option.add(newOption, undefined);

                    });
                }
            })
            bindDonationTypeDetail();
        }

        function bindDonationTypeDetail() {
            $("#Unit").empty().trigger('change');
            if ($("#DonationType").val()) {
                $("#Unit").prop('disabled', false);
                $.ajax({
                    url: '/getdonationtype',
                    type: 'GET',
                    success: function(data) {
                        var donationtype = data.msg;
                        var donationtypeval = $("#DonationType").val();
                        var donationtypedetail = donationtype.find(function(x) {
                            return x.DonationTypeID == donationtypeval
                        }).donation_type_detail;
                        var optiondetail = document.getElementById("Unit");
                        let newOptionDetail = new Option('', '');
                        optiondetail.add(newOptionDetail, undefined);
                        donationtypedetail.forEach(element2 => {
                            let newOptionDetail = new Option(element2.DonationTypeDetail,
                                element2.DonationTypeDetailID);
                            optiondetail.add(newOptionDetail, undefined);
                        });
                    }
                })
            } else {
                $("#Unit").prop('disabled', true);
                $("#Quantity").val('').prop('disabled', true);
            }

        }
    </script>
@endsection
