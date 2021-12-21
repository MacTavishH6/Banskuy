@extends('layouts.app')
@section('styles')
    <style>
        .pagetitle {
            font-size: 300%;
            text-align: center;
        }

        .historydetail_button {
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

        #formprogress {
            text-align: center;
            position: relative;
            margin-top: 20px
        }

        .text {
            color: #2F8D46;
            font-weight: normal
        }

        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: lightgrey
        }

        #progressbar .active {
            color: #2F8D46
        }

        #progressbar li {
            list-style-type: none;
            font-size: 15px;
            width: 25%;
            float: left;
            position: relative;
            font-weight: 400;
            z-index: 2;
        }

        #progressbar #step1:before {
            content: "1"
        }

        #progressbar #step2:before {
            content: "2"
        }

        #progressbar #step3:before {
            content: "3"
        }

        #progressbar #step4:before {
            content: "4"
        }

        #progressbar li:before {
            width: 50px;
            height: 50px;
            line-height: 45px;
            display: block;
            font-size: 20px;
            color: #ffffff;
            background: lightgray;
            border-radius: 50%;
            margin: 0 auto 10px auto;
            padding: 2px
        }

        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background-color: lightgray;
            position: absolute;
            left: -27%;
            top: 25px;
            z-index: -1;
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #2F8D46
        }

        #progressbar li:first-child:before,
        #progressbar li:first-child:after {
            content: none;
        }

        /* #progressbar li.active+li:after {
                            background: #2F8D46
                        } */

    </style>
@endsection
@section('content')
    <div class="container mt-3">
        <div class="row w-50 m-auto text-center">
            <div class="col">
                <h2>Riwayat Donasi</h3>
            </div>
        </div>
        <div class="row w-75 mx-auto mb-5">
            {{-- sebelahkiri --}}
            <div class="col-6">
                <div class="form-group">
                    <label for="searchbox">Pencarian :</label>
                    <form class="form-inline m-0">
                        <input class="form-control col" type="search" placeholder="Masukan Kata" aria-label="Search"
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
                        <label for="from">Tanggal Awal :</label>
                        <input type="text" class="form-control" name="DateStart" id="from" placeholder="">
                    </div>
                    <div class="form-group col-md-1">
                        <label for=""></label>
                        <button id="resetfrom" class="btn btn-info mt-2 ml-n2 d-none"><span>x</span></button>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="to">Tanggal Akhir :</label>
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
            <div class="col-6"></div>
            <div class="col-6">
                <button id="applyFilter" class="btn btn-primary float-right">Terapkan Filter</button>
            </div>
        </div>
        <div id="list-containter">

        </div>
        {{-- <div class="paginationhistory d-flex justify-content-around mt-5 mb-5">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div> --}}
    </div>
    <div class="modalcontainer">

    </div>
    @include('DonationHistory.Misc.component-modal-donation-history')
    @include('DonationHistory.Misc.component-list-donation')
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
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
                    let newOption = new Option('Semua', '');
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
                    let newOption = new Option('Semua', '');
                    option.add(newOption, undefined);
                    donationtype.forEach(element => {
                        let newOption = new Option(element.ApprovalStatusName,
                            element.ApprovalStatusID);
                        option.add(newOption, undefined);

                    });
                });
            $("#applyFilter").on('click', function() {
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
                    UserID: <?php echo '"' . Crypt::encrypt(Auth::id()) . '"'; ?>,
                    _token: "<?php echo csrf_token(); ?>"
                }
                banskuy.postReq('/getdonationhistory', data)
                    .then((response) => {
                        var listDonation = response.payload;
                        if (listDonation.length < 1) {
                            $("#list-containter").html(
                                "<h3 class=\"text-center mb-3\">Tidak ada Data</h3>");
                        } else {
                            $("#list-containter").html('');
                            var counter = 1;
                            _.each(listDonation, function(donation, donationKey) {
                                var data = {};
                                if ((counter++) % 2 == 1) {
                                    data.headerColor = "bg-secondary";
                                    data.headerTextColor = "text-white";
                                } else {
                                    data.headerColor = "";
                                    data.headerTextColor = "";
                                }
                                var transactionDate = new Date(donation.TransactionDate);
                                var formattedDate = transactionDate.toString(
                                    "d MMMM yyyy");
                                data.transactionDate = formattedDate;
                                data.transactionID = donation.DonationTransactionID;
                                data.status = donation.approval_status.ApprovalStatusName;
                                switch (donation.approval_status.ApprovalStatusID) {
                                    case "1":
                                        data.statusColor = 'btn-warning';
                                        break;
                                    case "2":
                                        data.statusColor = 'btn-primary';
                                        break;
                                    case "3":
                                        data.statusColor = 'btn-danger';
                                        break;
                                    case "4":
                                        data.statusColor = 'btn-warning';
                                        break;
                                    case "5":
                                        data.statusColor = 'btn-success';
                                        break;
                                }
                                data.donationTitle = donation.DonationDescriptionName;
                                data.donationType = donation.donation_type_detail
                                    .donation_type.DonationTypeName;
                                data.foundationName = donation.foundation.FoundationName;
                                var divtemplate = _.template($("#component-list-donation")
                                    .html());
                                $("#list-containter").append(divtemplate({
                                    data: data
                                }));
                            });
                        }

                    })
                    .finally(function() {
                        $(".historydetail_button").on('click', function() {
                            // alert('tes');
                            var transactionid = $(this).attr('data-id');
                            var data = {
                                TransactionID: transactionid,
                                _token: "<?php echo csrf_token(); ?>"
                            }
                            banskuy.postReq('/gettransactiondetail', data)
                                .then(function(response) {
                                    var transaction = response.payload;
                                    let quantity = transaction.Quantity;
                                    if (transaction.donation_type_detail
                                        .donation_type.DonationTypeID != 3) {
                                        quantity = transaction.Quantity.substring(0,
                                            transaction.Quantity.indexOf('.'));
                                    }
                                    var data = {
                                        DonationType: transaction.donation_type_detail
                                            .donation_type.DonationTypeName,
                                        Unit: transaction.donation_type_detail
                                            .DonationTypeDetail,
                                        DonationTransactionName: transaction
                                            .DonationDescriptionName,
                                        Status: transaction.approval_status
                                            .ApprovalStatusName,
                                        Quantity: quantity,
                                        Foundation: transaction.foundation
                                            .FoundationName
                                    };
                                    data.donaterName = transaction.user.FirstName + ' ' +
                                        transaction.user.LastName;
                                    data.donationTitle = transaction
                                    .DonationDescriptionName;
                                    switch (transaction.approval_status.ApprovalStatusID) {
                                        case "5":
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
                                    $(".modalcontainer").empty();
                                    var modal = _.template($(
                                        "#component-modal-donation-history"
                                    ).html());
                                    $(".modalcontainer").append(modal({
                                        data: data
                                    }));
                                    $('.modal').css('overflow-y', 'auto');
                                    $("#donationhistorydetail").modal();

                                    var opacity;
                                    var current;
                                    switch (transaction.approval_status.ApprovalStatusID) {
                                        case "1":
                                            current = 1;
                                            break;
                                        case "4":
                                            current = 2;
                                            break;
                                        case "5":
                                            current = 3;
                                            break;
                                        case "3":
                                            current = 3;
                                            break;
                                    }
                                    setProgressBar(current);

                                    function setProgressBar(currentStep) {
                                        for (var i = 1; i <= currentStep; i++) {
                                            $("#progressbar li#step" + i).addClass(
                                                'active');
                                            if (currentStep == 3) $("#progressbar li#step" +
                                                (i + 1)).addClass('active');
                                        }
                                    }

                                    $(".submit").click(function() {
                                        return false;
                                    })
                                });
                        });
                    });
            });

            function getDate(element) {
                var date;
                try {
                    date = $.datepicker.parseDate(dateFormat, element.value);
                } catch (error) {
                    date = null;
                }

                return date;
            }
        });
    </script>
@endsection
