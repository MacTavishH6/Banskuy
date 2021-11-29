<div class="modal fade bd-example-modal-lg" id="mdlReviewDetail" tabindex="-1" role="dialog" aria-hidden="true" style="max-height: 700px" >
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h3 class="modal-title w-100 text-center">Document Review Result</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mb-1">
                <form id="FormPopupDocument">
                    <div class="d-flex flex-column bd-highlght mb-3">
                        <div class="d-flex flex-row bd-highlight mb-2 border-bottom">
                            <div class="p-2 bd-highlight w-50">
                                Document Type
                            </div>
                            <div class="p-2 bd-highlight">
                                <label id="lblDocumentTypePopup"></label>
                            </div>
                        </div>
                        <div class="d-flex flex-row bd-highlight mb-2 border-bottom"">
                            <div class="p-2 bd-highlight w-50">
                                File Name
                            </div>
                            <div class="p-2 bd-highlight">
                                <label id="lblDocumentFileNamePopup"></label>
                            </div>
                        </div>
                        <div class="d-flex flex-row bd-highlight mb-2 border-bottom"">
                            <div class="p-2 bd-highlight w-50">
                                Upload Date
                            </div>
                            <div class="p-2 bd-highlight">
                                <label id="lblDocumentUploadDatePopup"></label>
                            </div>
                        </div>
                        <div class="d-flex flex-row bd-highlight mb-2 border-bottom"">
                            <div class="p-2 bd-highlight w-50">
                                Review Date
                            </div>
                            <div class="p-2 bd-highlight">
                                <label id="lblDocumentReviewDatePopup"></label>
                            </div>
                        </div>
                        <div class="d-flex flex-row bd-highlight mb-2 border-bottom"">
                            <div class="p-2 bd-highlight w-50">
                                Review Status
                            </div>
                            <div class="p-2 bd-highlight">
                                <label id="lblDocumentStatusPopup"></label>
                            </div>
                        </div>
                        <div class="d-flex flex-row bd-highlight mb-2 border-bottom"">
                            <div class="p-2 bd-highlight w-50">
                                Review Description
                            </div>
                            <div class="p-2 bd-highlight">
                                <label id="lblDocumentReviewDescPopup"></label>
                            </div>
                        </div>
                        <form id="FormPopupDocument" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex flex-row bd-highlight mb-2 d-none" id="divReuploadDocument"  >
                          
                                <div class="p-2 bd-highlight w-50">
                                    Reupload Document
                                </div>
                                <div class="p-2 bd-highlight">
                                    <div class="custom-file w-100 mb-3">
                                        <input class="custom-file-input" type="file" id="reuploadDocument" name="reuploadDocument" >
                                        <label class="custom-file-label" for="reuploadDocument" id="lblReuploadDocument" >Choose File</label>
                                    </div>
                                </div>
  
                            
                        </div>
                        <div class="d-flex flex-row bd-highlight mb-2" style="text-align: center">
                            <div class="p-2 bd-highlight w-100" >
                                <input type="hidden" id="txtDocumentTypeIDPopUp" name="txtDocumentTypeIDPopUp">
                                <button type="submit" class="btn btn-primary" 
                                    id="btnSaveDocPopup">
                                    <h6 class="pl-3 pr-3">Save</h6>
                                </button>
                                <button type="button" class="btn btn-danger ml-4" data-dismiss="modal" aria-label="Close" id="btnCloseDocPopup">
                                    <h6 class="pl-3 pr-3">Close</h6>
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
            </div>
        </div>

    </div>
</div>