<script type="text/template" id="component-modal-donation-approval">
    <div class="modal" id="approvaldetail" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Persetujuan Donasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-around">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header text-center" style="font-size:140%">
                                    Detail Persetujuan Donasi Anda
                                </div>

                                <div class="card-body d-flex flex-column ">
                                    <div class="row my-2">
                                        <div class="col-6">
                                            <label class=" d-block">Tipe Donasi</label>
                                            <label class=""><%=data.DonationType%></label>
                                        </div>

                                        <div class="col-6">
                                            <label class=" d-block">Tanggal Donasi</label>
                                            <label class=""><%=data.TransactionDate%></label>
                                        </div>  
                                    </div>
                                    
                                    
                                    <div class="row my-2">
                                        <div class="col-6">
                                            <label class=" d-block">Nama Barang / Jasa / Uang</label>
                                            <label class=""><%=data.DonationTransactionName%></label>
                                        </div>

                                        <div class="col-6">
                                            <label class=" d-block">Status Transaksi</label>
                                            <label class=""><%=data.Status%></label>
                                        </div>
                                    </div>
                        
                                    <div class="row my-2">
                                        <div class="col-6">
                                            <label class=" d-block">Quantity</label>
                                            <label class=""><%=data.Quantity%> <%=data.Unit%></label>
                                        </div>
                                        
                                        <div class="col-6">
                                            <label class=" d-block">Nama Donatur</label>
                                            <label class=""><%=data.Username%></label>
                                        </div>
                                    </div>
                                    
                                    <%if(data.approvalStatusID == 4) {%>
                                        <div class="row my-2">
                                            <div class="col-6">
                                                <form enctype="multipart/form-data" method="POST" id='updocumentation' action="/uploaddocumentation">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="transactionID"
                                                        value="<%=data.transactionID%>">
                                                    <label class=" d-block">Foto Dokumentasi</label>
                                                    <input class="" type="file" id="DocumentationPhoto" name="DocumentationPhoto" >
                                                </form>
                                            </div>
                                        </div>
                                    <%}%>

                                    <div class="row">
                                        <%if(data.approvalStatusID == 1) {%>
                                            <div class="col text-center">
                                                <button id="" value="3" data-id="<%=data.transactionID%>" class="btnRejectingTransaction btn btn-danger mb-3 mt-5">Tolak Donasi</button>
                                            </div>
                                            <div class="col text-center">
                                                <button id="" value="4" data-id="<%=data.transactionID%>" class="btnApprovingTransaction btn btn-success mb-3 mt-5">Terima Donasi</button>
                                            </div>
                                        <%}%>
                                        <%if(data.approvalStatusID == 4) {%>
                                            <div class="col text-center">
                                                <button id="" value="5" data-id="<%=data.transactionID%>" class="btnFinishingTransaction btn btn-primary mb-3 mt-5">Donasi Selesai</button>
                                            </div>
                                        <%}%>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    
</script>
