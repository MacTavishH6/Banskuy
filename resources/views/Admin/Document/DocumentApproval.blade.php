@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .pagetitle {
            font-size: 300%;
            text-align: center;
        }

        .approvaldetail_button {
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

        .approvaldetail_button:hover {
            box-shadow: 0px 5px 20px rgb(153, 121, 39);
        }

    </style>
@endsection

@section('content')
<div class="container mt-3">
    <div class="pagetitle">
        <p>Document Approval</p>
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
                <label for="inputState">Approval Status :</label>
                <select id="approvalStatus" class="form-control">
                </select>
            </div>
        </div>
        <div class="col-6">
            {{-- <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="from">Date Start</label>
                    <input type="text" class="form-control" name="DateStart" id="from" placeholder="">
                </div>

                <div class="form-group col-md-1">
                    <label for=""></label>
                    <button id="resetfrom" class="btn btn-info mt-2 ml-n2 d-none"><span>x</span></button>
                </div>
                <div class="form-group col-md-5">
                    <label for="to">Date End</label>
                    <input type="text" class="form-control" name="DateEnd" id="to" placeholder="">
                </div>
                <div class="form-group col-md-1">
                    <label for=""></label>
                    <button id="resetto" class="btn btn-info mt-2 ml-n2 d-none"><span>x</span></button>
                </div>
            </div> --}}
            <div class="form-group">
                <label for="inputState">Document Type :</label>
                <select id="documentType" class="form-control">
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


<div class="modal-containter">

</div>

<div class="modal-confirmation">

</div>
@include('Admin.Document.Misc.component-list-documentapprovallist')
@include('Admin.Document.Misc.component-form-documentapprovaldetail')
@include('Admin.Document.Misc.component-view-documentphoto')
@include('Admin.Document.Misc.component-alert-confirmation')
@endsection

@section('scripts')
    <script>
        $(function(){
            var dateFormat = "mm/dd/yy",
                from = $("#from")
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    maxDate: '0'
                })
                .on("change", function() {
                    to.datepicker("option", "minDate", getDate(this));
                    if (this.value) {
                        $("#resetfrom").removeClass('d-none');
                    } else {
                        $("#resetfrom").addClass('d-none');
                    }
                }),
                to = $("#to").datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    maxDate: '0'
                })
                .on("change", function() {
                    if (this.value) {
                        $("#resetto").removeClass('d-none');
                    } else {
                        $("#resetto").addClass('d-none');
                    }
                });

            
            $.ajax({
                url : '\GetListDocumentType',
                type : 'GET',
                dataType : 'json',
                success: function(response){
               
                    var ListOption = response.payload;
                    var ddlDocument = document.getElementById('documentType');
                    let option = new Option('ALL','0');
                    ddlDocument.add(option,undefined);
                    ListOption.forEach(element=>{
                        let option = new Option(element.DocumentTypeName,element.DocumentTypeID);
                        ddlDocument.add(option);
                    });
                }
            });


            $.ajax({
                url : '\GetApprovalStatus',
                type : 'GET',
                dataType : 'json',
                success: function(response){
                 
                    var ListOption = response.payload;
                    var ddlApproval = document.getElementById('approvalStatus');
                    let option = new Option('ALL','0');
                    ddlApproval.add(option,undefined);
                    ListOption.forEach(element=>{
                        let option = new Option(element.ApprovalStatusName,element.ApprovalStatusID);
                        ddlApproval.add(option);
                    });
                }
            });

            $('#applyFilter').on('click',function(){
                $('#list-containter').empty();
                var DocumenType = $('#documentType').val();
                var ApprovalStatus = $('#approvalStatus').val();
                console.log(DocumenType);
                $.ajax({
                    url : '\GetListDocumentByFilter',
                    type : 'POST',
                    data : {_token: "<?php echo csrf_token(); ?>",documentType:DocumenType, approvalStatus : ApprovalStatus},
                    success: function(response){
                        var result = response.payload;
                        console.log(result);
                        result.forEach(element=>{
                            if(element.DocumentID == undefined){
                                return;
                            }
                            var Data = {};
                            switch (element.ApprovalStatusID) {
                                case 1:
                                    Data.statusColor = 'btn-warning';
                                    break;
                                case 2:
                                    Data.statusColor = 'btn-primary';
                                    break;
                                case 3:
                                    Data.statusColor = 'btn-danger';
                                    break;
                            }
                            Data.uploadDate = element.UploadDate;
                            Data.status = element.ApprovalStatus;
                            Data.foundationName = element.FoundationName;
                            Data.documentType = element.DocumentType;
                            Data.documentId = element.DocumentID;
                            // console.log(Data);
                            var divTemplate = _.template($('#component-list-approval').html());
                            $('#list-containter').append(divTemplate({
                                data : Data
                            }));
                        });
                    }
                });
            });



            

            

            

            function getDate(element) {
                    var date;
                    try {
                        console.log(dateFormat);
                        date = $.datepicker.parseDate(dateFormat, element.value);
                    } catch (error) {
                        date = null;
                    }

                    return date;
                }
        });

        function btnApprovalDetailClick($val){
                
                var documentID = $val;
                
                $.ajax({
                    url : '\GetDocumentApprovalDetail',
                    type : 'POST',
                    data: {_token: "<?php echo csrf_token(); ?>",documentId : documentID},
                    success:function(response){
                        $('.modal-containter').empty();
                        var result = response.payload;
                        console.log(response.payload);
                        var Data = {};
                        Data.documentId = result.DocumentID;
                        Data.dokumentType = result.DocumentType;
                        Data.uploadedDate = result.UploadDate;
                        Data.foundationName = result.FoundationName;
                        Data.approvalStatus = result.ApprovalStatus;
                        Data.approvalStatusID = result.ApprovalStatusID;
                        Data.filePath = result.FilePath;

                        var divModal = _.template($('#component-modal-document-approval').html());
                        var divModalPhoto = _.template($('#component-modal-photo-approval').html());
                        $('.modal-containter').append(divModal({
                            data: Data
                        }));
                        $('.modal-containter').append(divModalPhoto({
                                data : Data
                            }));
                        $('.modal').css('overflow-y', 'auto');
                        $('#approvaldetail').modal();
                    }
                });
            }
        
        function btnRejectClick(){
           // alert('Apakah anda yakin ingin menolak dokumen?');

            $('.modal-confirmation').empty();
            var Data = {};
            Data.typeApproval = "Menolak";
            Data.typeApprovalId = "3"; 
            Data.buttonType = "btn btn-danger";
            
            var divModalConf = _.template($('#component-modal-confimartion-approval').html());
            $('.modal-confirmation').append(divModalConf({
                data : Data
            }));
            $("#btnSaveConfirmation").prop('disabled', true);
            $('#approvaldetail').modal('hide');
            $('#confimationModal').modal();
        }

        function btnApproveClick(){
            // alert('Apakah anda yakin ingin menolak dokumen?');
            
            $('.modal-confirmation').empty();
            var Data = {};
            Data.typeApproval = "Mernerima";
            Data.typeApprovalId = "2"; 
            Data.buttonType = "btn btn-primary";
            var divModalConf = _.template($('#component-modal-confimartion-approval').html());
            $('.modal-confirmation').append(divModalConf({
                data : Data
            }));
            $("#btnSaveConfirmation").prop('disabled', false);
            $('#approvaldetail').modal('hide');
            $('#confimationModal').modal();
        }

        function btnSaveConfirmationClick($val){
            var documentId = $('#txtdocumentidhidden').val();
            var approvalStatusId = $val;
            var description = "";
            if($val == 3){
                description = $('#txtAlasan').val();
            }

            $.ajax({
                url : '\SaveDocumentApproval',
                type : 'POST',
                data : {_token: "<?php echo csrf_token(); ?>",documentId : documentId, approvalStatusId : approvalStatusId, description : description},
                success: function(response){
                    window.location.reload();
                }
            }); 
        }
    
        function btnViewFileClick(){
           // $('#approvaldetail').modal('hide');
            $('#approvaldetail').modal('hide');
            $('#documentPhoto').modal();
            
        }

        function btnCloseViewPhotoClick(){
            $('#documentPhoto').modal('hide');
            $('#approvaldetail').modal();
        }

        function btnCancelConfirmationClick(){
            $('#confimationModal').modal('hide');
            $('#approvaldetail').modal();
        } 

        function txtAlasanChange(){
                var TextLength = $('#txtAlasan').val().length;
               
               if(TextLength > 5){
                $("#btnSaveConfirmation").prop('disabled', false);
               }
               else{
                $("#btnSaveConfirmation").prop('disabled', true);
               }
            }
    </script>
@endsection