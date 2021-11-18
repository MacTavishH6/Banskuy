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

        .historydetail_button:hover {
            box-shadow: 0px 5px 20px rgb(153, 121, 39);
        }

    </style>
@endsection
@section('content')
    <div class="container mt-3">
        <div class="row w-50 m-auto text-center">
            <div class="col">
                <h2>Donation History</h3>
            </div>
        </div>
        <div class="row w-75 mx-auto mb-5">
            {{-- sebelahkiri --}}
            <div class="col-6">
                <div class="form-group">
                    <label for="searchbox">Search :</label>
                    <form class="form-inline m-0">
                        <input class="form-control col" type="search" placeholder="Input Keyword" aria-label="Search"
                            id="searchKeyword">
                    </form>
                </div>
                <div class="form-group">
                    <label for="inputState">Donation Status :</label>
                    <select id="donationStatus" class="form-control">
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="inputState">Choose Date :</label>
                    <input class="form-control mr-sm-2" type="date" name="TransactionDate" id="transactionDate">
                </div>
                <div class="form-group">
                    <label for="inputState">Donation Type :</label>
                    <select id="donationType" class="form-control">
                    </select>
                </div>
            </div>
            <div class="col-6"></div>
            <div class="col-6">
                <button id="applyFilter" class="btn btn-primary float-right">Apply Filter</button>
            </div>
        </div>
        <div id="list-containter">

        </div>
        <div class="paginationhistory d-flex justify-content-around mt-5 mb-5">
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
        </div>
    </div>
    @include('DonationHistory.Misc.component-modal-donation-history')
    @include('DonationHistory.Misc.component-list-donation')
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
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
            $("#applyFilter").on('click', function() {
                $("#list-containter").empty();
                var data = {
                    keyword: $("#searchKeyword").val(),
                    donationStatus: $("#donationStatus").val(),
                    transactionDate: $("#transactionDate").val(),
                    donationType: $("#donationType").val(),
                    UserID: <?php echo '"' . Crypt::encrypt(Auth::id()) . '"'; ?>,
                    _token: "<?php echo csrf_token(); ?>"
                }
                banskuy.postReq('/getdonationhistory', data)
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
                                case 1:
                                    data.statusColor = 'btn-warning';
                                    break;
                                case 2:
                                    data.statusColor = 'btn-primary';
                                    break;
                                case 3:
                                    data.statusColor = 'btn-danger';
                                    break;
                                case 4:
                                    data.statusColor = 'btn-warning';
                                    break;
                                case 5:
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
                                    var modal = _.template($(
                                        "#component-modal-donation-history"
                                    ).html());
                                    $(".container").append(modal({
                                        data: ''
                                    }));
                                    $('.modal').css('overflow-y', 'auto');
                                    $("#donationhistorydetail").modal();
                                });
                        });
                    });
            });

        });
    </script>
@endsection
