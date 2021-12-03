<script type="text/template" id="component-modal-document-approval">
    <div class="modal" id="approvaldetail" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dokumen Approval Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-around">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header text-center" style="font-size:140%">
                                    Dokumen Detail
                                </div>

                                <div class="card-body d-flex flex-column ">
                                    <div class="row my-2">
                                        <div class="col-6">
                                            <label class=" d-block">Tipe Dokumen :</label>
                                            <label class=""><%=data.dokumentType%></label>
                                        </div>

                                        <div class="col-6">
                                            <label class=" d-block">Tanggal Upload :</label>
                                            <label class=""><%=data.uploadedDate%></label>
                                        </div>  
                                    </div>
                                    
                                    
                                    <div class="row my-2">
                                        <div class="col-6">
                                            <label class=" d-block">Nama Yayasan :</label>
                                            <label class=""><%=data.foundationName%></label>
                                        </div>

                                        <div class="col-6">
                                            <label class=" d-block">Status Dokumen :</label>
                                            <label class=""><%=data.approvalStatus%></label>
                                        </div>
                                    </div>

                                    <div class="row my-2">
                                        <div class="col-6">
                                            <label class=" d-block">File Dokumen :</label>
                                            <button type="button" id="btnViewFile" onclick="btnViewFileClick()" class="btn btn-link" style="text-decoration:none"><i class="fa fa-eye fa-lg" aria-hidden="true"></i>View</button>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <input type="hidden" id="txtdocumentidhidden" value="<%=data.documentId%>">
                                        <%if(data.approvalStatusID == 1) {%>
                                            <div class="col text-center">
                                                <button id=""  onclick="btnRejectClick()" class="btnRejectingTransaction btn btn-danger mb-3 mt-5">Tolak Dokumen</button>
                                            </div>
                                            <div class="col text-center">
                                                <button id="" onclick="btnApproveClick()" class="btnApprovingTransaction btn btn-success mb-3 mt-5">Terima Dokumen</button>
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
