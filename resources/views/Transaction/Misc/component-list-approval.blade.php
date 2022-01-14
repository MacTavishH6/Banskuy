<script type="text/template" id="component-list-approval">
    <div class="donationhistorycontent d-flex justify-content-around mb-3">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-around <%=data.headerColor%>">
                    <div class="transactiondate <%=data.headerTextColor%>">
                        <%=data.transactionDate%>
                    </div>

                    <div class="requeststatus">
                        <div class="btn btn-success <%=data.statusColor%>"><%=data.status%></div>
                    </div>
                </div>

                <div class="card-body row ">
                    <div class="col-2 text-center">
                        <img src="{{ env('FTP_URL') }}{{ 'assets/Smiley.png' }}" alt="UsernamePhotoProfile"
                            style="border-radius: 50%; border: 1px solid black; width: 70px; height: 70px;"
                            onerror="this.onerror==null;this.src='{{ env('FTP_URL') }}assets/Smiley.png'">
                    </div>
                    <div class="col-7">
                        <div class="row">
                            <div class="col-4">
                                <label for="">Nama Donasi</label>
                            </div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <p class="card-text">
                                    <%=data.donationTitle%>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="">Tipe Donasi</label>
                            </div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <p class="card-text">
                                    <%=data.donationType%>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="">Nama Donatur</label>
                            </div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <p class="card-text">
                                    <%=data.username%>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="buttonapprovaldetail mt-4">
                            <button type="button" id="btnApprovalDetail" data-id="<%=data.transactionID%>" class="approvaldetail_button">
                                {{ __('Detail Transaksi') }}
                            </button>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
</script>