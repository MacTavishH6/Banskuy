<script type="text/template" id="component-modal-photo-approval">    
    <div class="modal fade" id="documentPhoto" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dokument Foto</h5>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-around">

                                <div>
                                    <img  style="width:100%;height:100%" src="{{ env('FTP_URL') }}<%=data.filePath%>">
                                </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCloseViewPhoto" onclick="btnCloseViewPhotoClick()" class="btn btn-secondary text-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</script>