<script type="text/template" id="component-list-approval">
    <div class="donationhistorycontent d-flex justify-content-around mb-3">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-around <%=data.headerColor%>">
                    <div class="transactiondate">
                        Tanggal Unggah : <%=data.uploadDate%>
                    </div>

                    <div class="requeststatus">
                        <div class="btn <%=data.statusColor%>"><%=data.status%></div>
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
                                <label for="">Nama Yayasan</label>
                            </div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <p class="card-text">
                                    <%=data.foundationName%>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="">Tipe Dokumen</label>
                            </div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <p class="card-text">
                                    <%=data.documentType%>
                                </p>
                            </div>
                        </div>
                    
                    </div>
                    <div class="col-3">
                        <div class="buttonapprovaldetail mt-4">
                            <button type="button" id="btnApprovalDetail" onclick="btnApprovalDetailClick(<%=data.documentId%>)" class="approvaldetail_button">
                                {{ __('Detail') }}
                            </button>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
</script>