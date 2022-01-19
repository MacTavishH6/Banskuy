@extends('layouts.app')

@section('styles')
    <style>
        .pagetitle {
            font-size: 300%;
            text-align: center;
        }

        .approvaldetail_button {
            background-color: #AC8FFF;
            border: none;
            border-radius: 21px;
            font-family: "Raleway SemiBold", sans-serif;
            height: 42.3px;
            margin: 0 auto;
            transition: 0.25s;
            width: 153px;
            box-shadow: 0px 1px 8px rgb(153, 121, 39);
            margin-bottom: 10px;
            cursor: pointer;
            color: black;
        }

        .approvaldetail_button:hover {
            box-shadow: 0px 5px 20px rgb(153, 121, 39);
        }

    </style>
@endsection

@section('content')
    <div class="container mt-3">
        <div class="pagetitle">
            <p>Daftar Persetujuan Donasi</p>
        </div>
        <div class="row w-75 mx-auto mb-5">
            {{-- sebelahkiri --}}
            <div class="col-6">
                <div class="form-group">
                    <label for="searchbox">Pencarian :</label>
                    <form class="form-inline m-0">
                        <input class="form-control col" type="search" placeholder="Input Keyword" aria-label="Search"
                            id="searchKeyword">
                    </form>
                </div>
                <div class="form-group">
                    <label for="inputState">Status Donasi :</label>
                    <select id="donationStatus" class="form-control">
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="from">Tanggal Awal</label>
                        <input type="text" class="form-control" name="DateStart" id="from" placeholder="">
                    </div>

                    <div class="form-group col-md-1">
                        <label for=""></label>
                        <button id="resetfrom" class="btn btn-info mt-2 ml-n2 d-none"><span>x</span></button>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="to">Tanggal Akhir</label>
                        <input type="text" class="form-control" name="DateEnd" id="to" placeholder="">
                    </div>
                    <div class="form-group col-md-1">
                        <label for=""></label>
                        <button id="resetto" class="btn btn-info mt-2 ml-n2 d-none"><span>x</span></button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputState">Tipe Donasi :</label>
                    <select id="donationType" class="form-control">
                    </select>
                </div>
            </div>
            <div class="col-6">

            </div>
            <div class="col-6">
                <button id="applyFilter" class="btn btn-primary float-right">Terapkan Filter</button>

            </div>
        </div>
        <div class="row mb-2" id="btnRecap">
            <div class="col-9"></div>
            <div class="col-2">
                <form id="formRecap" action="/pdf_recapdownload" method="post">
                    @method("POST")
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth::guard()->id() }}">
                    <input type="hidden" name="keyword" id="formKeyword">
                    <input type="hidden" name="donationStatus" id="formdonationStatus">
                    <input type="hidden" name="dateStart" id="formdateStart">
                    <input type="hidden" name="dateEnd" id="formdateEnd">
                    <input type="hidden" name="transactionDate" id="formtransactionDate">
                    <input type="hidden" name="donationType" id="formdonationType">
                    <button id="btnRecap" type="submit" class="btn btn-primary mr-2">Buat Rekap</button>
                </form>
            </div>
        </div>
        <div id="list-containter">

        </div>

    </div>
    <div class="modal-containter">

    </div>
    @include('Transaction.Misc.component-list-approval')
    @include('Transaction.Misc.component-modal-donation-approval')
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#btnRecap").hide()
            $("#formRecap").on('submit', function() {
                $("#formKeyword").val($("#searchKeyword").val())
                $("#formdonationStatus").val($("#donationStatus").val())
                $("#formdateStart").val($("#from").val())
                $("#formdateEnd").val($("#to").val())
                $("#formtransactionDate").val($("#transactionDate").val())
                $("#formdonationType").val($("#donationType").val())
                // console.log($(this).serializeArray())
                // event.preventDefault()
            })
            var dateFormat = "mm/dd/yy",
                from = $("#from")
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    maxDate: '0'
                })
                .on("change", function() {
                    to.datepicker("option", "minDate", getDate(this));
                    if (this.value) {
                        $("#resetfrom").removeClass('d-none');
                    } else {
                        $("#resetfrom").addClass('d-none');
                    }
                }),
                to = $("#to").datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    maxDate: '0'
                })
                .on("change", function() {
                    if (this.value) {
                        $("#resetto").removeClass('d-none');
                    } else {
                        $("#resetto").addClass('d-none');
                    }
                });
            $("#resetto").on('click', function() {
                $("#to").datepicker('setDate', null);
                $("#resetto").addClass('d-none');
            });
            $("#resetfrom").on('click', function() {
                $("#from").datepicker('setDate', null);
                $("#resetfrom").addClass('d-none');
            });
            banskuy.getReq('/getdonationtype')
                .then(function(data) {
                    var donationtype = data.msg;
                    var option = document.getElementById("donationType");
                    let newOption = new Option('All', '');
                    option.add(newOption, undefined);
                    donationtype.forEach(element => {
                        let newOption = new Option(element.DonationTypeName,
                            element.DonationTypeID);
                        option.add(newOption, undefined);

                    });
                });
            banskuy.getReq('/getdonationstatus')
                .then(function(data) {
                    var donationtype = data.msg;
                    var option = document.getElementById("donationStatus");
                    let newOption = new Option('All', '');
                    option.add(newOption, undefined);
                    donationtype.forEach(element => {
                        let newOption = new Option(element.ApprovalStatusName,
                            element.ApprovalStatusID);
                        option.add(newOption, undefined);

                    });
                });
            // DISINI MULAI APPLY FILTER
            $("#applyFilter").on('click', function() {
                $("#btnRecap").hide()
                if (!$("#from").val() && $("#to").val()) {
                    toastr.error("Tolong isi tanggal awal!");
                    return;
                } else if ($("#from").val() && !$("#to").val()) {
                    toastr.error("Tolong isi tanggal akhir!");
                    return;
                }
                $("#list-containter").empty();
                var data = {
                    keyword: $("#searchKeyword").val(),
                    donationStatus: $("#donationStatus").val(),
                    dateStart: $("#from").val(),
                    dateEnd: $("#to").val(),
                    transactionDate: $("#transactionDate").val(),
                    donationType: $("#donationType").val(),
                    FoundationID: <?php echo '"' . Crypt::encrypt(Auth::guard('foundations')->id()) . '"'; ?>,
                    _token: "<?php echo csrf_token(); ?>"
                }
                banskuy.postReq('/getdonationapproval', data)
                    .then((response) => {
                        var listDonation = response.payload;
                        _.each(listDonation, function(donation, donationKey) {
                            var data = {};
                            if ((donationKey + 1) % 2 == 1) {
                                data.headerColor = "bg-secondary";
                                data.headerTextColor = "text-white";
                            } else {
                                data.headerColor = "";
                                data.headerTextColor = "";
                            }
                            var transactionDate = new Date(donation.TransactionDate);
                            var formattedDate = transactionDate.toString(
                                "MMMM dS, yyyy");
                            data.transactionDate = formattedDate;
                            data.transactionID = donation.DonationTransactionID;
                            data.status = donation.approval_status.ApprovalStatusName;
                            switch (donation.approval_status.ApprovalStatusID) {
                                case '1':
                                    data.statusColor = 'btn-warning';
                                    break;
                                case '2':
                                    data.statusColor = 'btn-primary';
                                    break;
                                case '3':
                                    data.statusColor = 'btn-danger';
                                    break;
                                case '4':
                                    data.statusColor = 'btn-warning';
                                    break;
                                case '5':
                                    data.statusColor = 'btn-success';
                                    break;
                            }
                            data.donationTitle = donation.DonationDescriptionName;
                            data.donationType = donation.donation_type_detail
                                .donation_type.DonationTypeName;
                            console.log(donation);
                            data.username = donation.user.Username;
                            var divtemplate = _.template($("#component-list-approval")
                                .html());
                            $("#list-containter").append(divtemplate({
                                data: data
                            }));
                        });

                    })
                    .finally(function() {
                        $("#btnRecap").show()
                        $(".approvaldetail_button").on('click', function() {
                            // alert('tes');
                            var transactionid = $(this).attr('data-id');
                            console.log($(this).attr('data-id'));
                            var data = {
                                TransactionID: transactionid,
                                _token: "<?php echo csrf_token(); ?>"
                            }
                            banskuy.postReq('/getdonationapprovaldetail', data)
                                .then(function(response) {
                                    var transaction = response.payload;
                                    console.log(transaction);
                                    var data = {
                                        DonationType: transaction.donation_type_detail
                                            .donation_type.DonationTypeName,
                                        Unit: transaction.donation_type_detail
                                            .DonationTypeDetail,
                                        DonationTransactionName: transaction
                                            .DonationDescriptionName,
                                        Status: transaction.approval_status
                                            .ApprovalStatusName,
                                        Quantity: transaction.Quantity,
                                        transactionID: transaction
                                            .DonationTransactionID,
                                        Username: transaction.user.Username,
                                        approvalStatusID: transaction.ApprovalStatusID,
                                    };
                                    switch (transaction.approval_status.ApprovalStatusID) {
                                        case '5':
                                            data.IsShow = '';
                                            break;
                                        default:
                                            data.IsShow = 'd-none';
                                            break;
                                    }
                                    var transactionDate = new Date(transaction
                                        .TransactionDate);
                                    var formattedDate = transactionDate.toString(
                                        "MMMM dS, yyyy");
                                    data.TransactionDate = formattedDate;
                                    $(".modal-containter").empty();
                                    var modal = _.template($(
                                        "#component-modal-donation-approval"
                                    ).html());
                                    $(".modal-containter").append(modal({
                                        data: data
                                    }));
                                    $('.modal').css('overflow-y', 'auto');
                                    $("#approvaldetail").modal();
                                })
                                //============================================================================
                                .finally(function() {
                                    $(".btnRejectingTransaction").on('click', function() {
                                        var transactionid = $(this).attr('data-id');
                                        console.log(transactionid);
                                        var data = {
                                            TransactionID: transactionid,
                                            donationStatus: $(
                                                    ".btnRejectingTransaction")
                                                .val(),
                                            _token: "<?php echo csrf_token(); ?>"
                                        }
                                        banskuy.postReq('/updateapprovalstatus',
                                                data)
                                            .then(function(response) {
                                                var transaction = response
                                                    .payload;
                                                // window.location.reload();
                                                // console.log(transaction); 
                                                $("#approvaldetail").modal(
                                                    'hide');
                                                $("#applyFilter").click();
                                            })
                                    })
                                    $(".btnApprovingTransaction").on('click', function() {
                                        var transactionid = $(this).attr('data-id');
                                        console.log(transactionid);
                                        var data = {
                                            TransactionID: transactionid,
                                            donationStatus: $(
                                                    ".btnApprovingTransaction")
                                                .val(),
                                            _token: "<?php echo csrf_token(); ?>"
                                        }
                                        banskuy.postReq('/updateapprovalstatus',
                                                data)
                                            .then(function(response) {
                                                var transaction = response
                                                    .payload;
                                                // window.location.reload();
                                                // console.log(transaction); 
                                                $("#approvaldetail").modal(
                                                    'hide');
                                                $("#applyFilter").click();
                                            })
                                    })
                                    $(".btnFinishingTransaction").on('click', function() {
                                        var transactionid = $(this).attr('data-id');
                                        console.log(transactionid);
                                        var data = {
                                            TransactionID: transactionid,
                                            donationStatus: $(
                                                    ".btnFinishingTransaction")
                                                .val(),
                                            _token: "<?php echo csrf_token(); ?>"
                                        }
                                        banskuy.postReq('/updateapprovalstatus',
                                                data)
                                            .then(function(response) {
                                                var transaction = response
                                                    .payload;
                                                $("#updocumentation").submit();
                                                // window.location.reload();
                                                // console.log(transaction); 
                                            })
                                    })
                                })
                            //============================================================================
                        });
                    });
            });

            //PEMBATAS SI APPLY FILTER
            function getDate(element) {
                var date;
                try {
                    console.log(dateFormat);
                    date = $.datepicker.parseDate(dateFormat, element.value);
                } catch (error) {
                    date = null;
                }

                return date;
            }
        });
    </script>
@endsection
