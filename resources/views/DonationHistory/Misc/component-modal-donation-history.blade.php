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

                                <div class="historybodycontent">
                                    <div class="card-body d-flex justify-content-around">
                                        <div>
                                            <p class="card-text">Tipe Donasi</p>
                                            <label class="card-text"><%=data.DonationType%></label>
                                        </div>

                                        <div>
                                            <p class="card-text">Tanggal Donasi</p>
                                            <label class="card-text"><%=data.TransactionDate%></label>
                                        </div>                        
                                    </div>
                        
                                    <div class="card-body d-flex justify-content-around">
                                        <div>
                                            <p class="card-text">Nama Barang / Jasa / Uang</p>
                                            <label class="card-text"><%=data.DonationTransactionName%></label>
                                        </div>

                                        <div>
                                            <p class="card-text">Status Transaksi</p>
                                            <label class="card-text"><%=data.Status%></label>
                                        </div>
                                    </div>
                        
                                    <div class="card-body d-flex justify-content-around">
                                        <div>
                                            <p class="card-text">Quantity</p>
                                            <label class="card-text"><%=data.Quantity%></label>
                                        </div>
                                        
                                        <div>
                                            <p class="card-text">Nama Penerima</p>
                                            <input type="text">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-center">
                                    <a href="#" class="btn btn-success mb-3 mt-5">Download Certificate</a>
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
