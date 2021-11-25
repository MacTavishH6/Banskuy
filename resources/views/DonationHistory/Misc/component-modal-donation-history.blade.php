<script type="text/template" id="component-modal-donation-history">
    <div class="modal" id="donationhistorydetail" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Donation History Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-around">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header text-center" style="font-size:140%">
                                    Your Donation Detail
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
                                            <label class=" d-block">Nama Penerima</label>
                                            <input type="text">
                                        </div>
                                    </div>
                                    
                                    <div class="row <%=data.IsShow%>">
                                        <div class="col text-center">
                                            <a href="#" class="btn btn-success mb-3 mt-5">Download Certificate</a>
                                        </div>
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
