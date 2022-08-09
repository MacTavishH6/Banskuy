<script type="text/template" id="component-modal-confimartion-approval">    
    <div class="modal fade" id="confimationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                </div>
                <form method="POST" action="/SaveDocumentApproval">
                <div class="modal-body">
                    <div class="d-flex justify-content-around">
                    
                        <div class="col-md-10">

                                <div class="">
                                    Apakah anda yakin ingin <%=data.typeApproval%> dokumen ini?
                                </div>
                                <%if(data.typeApprovalId == 3) {%>
                                
                                            <div class="row my-2">
                                                <div class="col-3">
                                                    <label class=" d-block">Alasan :</label>
                                                    
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" id="txtAlasan" class="form-control" onkeyup="txtAlasanChange()">
                                                </div>
                                            </div>        
                                   
                                <%}%>
                        </div>
                        <label id="lblerrorconf" style="color:red">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCancelConfirmation" onclick="btnCancelConfirmationClick()" class="btn btn-danger text-white" data-dismiss="modal">Batalkan</button>
                    <button type="button" id="btnSaveConfirmation" onclick="btnSaveConfirmationClick(<%=data.typeApprovalId%>)" class="<%=data.buttonType%> text-white" data-dismiss="modal">Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</script>