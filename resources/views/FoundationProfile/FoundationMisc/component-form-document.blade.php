<div class="row mb-4">
    <div class="col-9">
        <h2>Sunting Dokumen</h2>
    </div>
</div>

<form action="/UpdateDocument" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-row py-1">
        <div class="col-4">
            <label for="FirstName">Kartu Tanda Penduduk Pemilik</label>
        </div>
        <div class="col-6">
            <div class="custom-file w-100 mb-3">
                <input class="custom-file-input" type="file" id="OwnerIdentityCard" name="OwnerIdentityCard" >
                <label class="custom-file-label" for="OwnerIdentityCard" id="lblOwnerIdentityCard">Choose File</label>
            </div>
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-4">
            <label for="FirstName">Sertifikat Yayasan</label>
        </div>
        <div class="col-6">
            <div class="custom-file w-100 mb-3">
                <input class="custom-file-input" type="file" id="FoundationCertificate" name="FoundationCertificate" >
                <label class="custom-file-label" for="FoundationCertificate" id="lblFoundationCertificate" >Choose File</label>
            </div>
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-4">
            <label for="FirstName">Izin Operasional Yayasan</label>
        </div>
        <div class="col-6">
            <div class="custom-file w-100 mb-3">
                <input class="custom-file-input" type="file" id="FoundationOperationalPermit" name="FoundationOperationalPermit" >
                <label class="custom-file-label" for="FoundationOperationalPermit" id="lblFoundationOperationalPermit" >Choose File</label>
            </div>
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-4">
            <label for="FirstName">Izin Pendaftaran Yayasan</label>
        </div>
        <div class="col-6">
            <div class="custom-file w-100 mb-3">
                <input class="custom-file-input" type="file" id="FoundationRegistrationPermit" name="FoundationRegistrationPermit" >
                <label class="custom-file-label" for="FoundationRegistrationPermit" id="lblFoundationRegistrationPermit" >Choose File</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 pr-2">
            <button type="submit" class="float-right py-1 px-5 text-white" id="btnSaveDocument" name="btnSaveDocument"
                    style="border-radius: 20px; background-color: #AC8FFF; border: none;">Save</button>
        </div>
    </div>
</form>

<div id="lblNoDocument" class="mb-5 mt-5" >
    <h2 style="color:red;">Tidak ada dokumen</h2>
</div>



<div class="mt-5 mb-4" id="divTableDocument" style="display: none">
    
   
    <table class="table" id="tblDocument">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Dokument</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>



<div>
    <p class="" style="color: #FF0000; font-size: 120%">
        Untuk tujuan keamanan, semua dokumen harus sudah terverifikasi sebelum menerima donasi
    </p>
</div>

<div >
    @include('FoundationProfile.FoundationMisc.component-list-documentresult')
</div>


<script>
    $(function(){
            $(".custom-file-input").on("change",function(){
               
               var FileUpload = $(this).val().split('\\').pop();
               
                $(this).siblings(".custom-file-label").addClass("selected").html(FileUpload);
            });
                
            // $("#FoundationCertificate").on("change",function(){
               
            //    var FileUpload = $(this).val().split('\\').pop();
             
            //        $(this).siblings(".custom-file-label").addClass("selected").html(FileUpload);
            // });

            // $("#FoundationOperationalPermit").on("change",function(){
               
            //    var FileUpload = $(this).val().split('\\').pop();
               
            //        $(this).siblings(".custom-file-label").addClass("selected").html(FileUpload);
            // });

            // $("#FoundationRegistrationPermit").on("change",function(){
               
            //    var FileUpload = $(this).val().split('\\').pop();
               
            //        $(this).siblings(".custom-file-label").addClass("selected").html(FileUpload);
            // });

        
        BindDocumentList();

        $('#btnCloseDocPopup').on('click',function(){
           
            ClosePopUpDocument();
        });
        
        $('#FormPopupDocument').on('submit',function(){
            event.preventDefault();
            var Form = new FormData(this);
            $.ajax({
                type : 'POST',
                url : '/ReUploadDocument',
                data : Form,
                cache:false,
                contentType: false,
                processData: false,
                success:function(response){
                    $('#tblDocument tbody').empty();
                    BindDocumentList();
                    ClosePopUpDocument();
                }
            });
        });
    });

    

    function BindDocumentList(){
            ClosePopUpDocument();
            var UserID = "{{Crypt::encrypt(Auth::guard('foundations')->user()->FoundationID)}}";
            $.ajax({
                type : 'POST',
                url : '/GetListDocument',
                data : {id:UserID,_token: "<?php echo csrf_token(); ?>"},
                success:function(response){
                    
                    var table = $('#tblDocument tbody');
                    console.log(response.payload);
                    if(response.payload && response.payload.length > 1){
                       
                        $('#divTableDocument').css('display','block');
                        $('#lblNoDocument').css('display','none');
                        
                        response.payload.forEach((element,index) => {
                            var tbody = "";
                            if(element.DocumentName != undefined){
                            tbody += "<tr>";
                            tbody += "<th scope=\"row\">"+(index)+"</th>";
                            tbody += "<td>"+element.DocumentName+"</td>";
                            tbody += "<td><div class=\"text-black\" style=\"border-radius: 20px;border: none;width:113px;\">"+element.DocumentStatus+"</div></td>";
                            tbody += "<td><button type=\"button\" class=\"py-1 px-4 text-white\" id=\"btnDocumentDetail\" onclick=\"btnDocumentDetailOnClick('"+element.DocumentTypeID+"')\"  style=\"border-radius: 20px; background-color: #AC8FFF; border: none;\">Detail</button></td>"
                            tbody += "</tr>";

                            table.append(tbody);
                            }
                            
                        });
                        
                    }
                    else{
                    
                        $('#divTableDocument').css('display','none');
                        $('#lblNoDocument').css('display','block');
                       
                    }
                }

            });
    }


    function btnDocumentDetailOnClick($val){
        var UserID = "{{Crypt::encrypt(Auth::guard('foundations')->user()->FoundationID)}}";
            var TypeID = $val;
            
            $.ajax({
                type : 'POST',
                url : '/GetDocumentDetail',
                data : {FoundationID : UserID, TypeID : TypeID,_token: "<?php echo csrf_token(); ?>"},
                success:function(response){
             
                    if(response.payload){
         
                        var Result = response.payload;
                        
                        $('#lblDocumentTypePopup').text(Result.DocumentType);
                        $('#lblDocumentFileNamePopup').text(Result.DocumentName);
                        $('#lblDocumentUploadDatePopup').text(Result.UploadDate);
                        $('#lblDocumentReviewDatePopup').text(Result.ReviewDate);
                        $('#lblDocumentStatusPopup').text(Result.ReviewStatus);
                        $('#lblDocumentReviewDescPopup').text(Result.ReviewDescription);
                        $('#txtDocumentTypeIDPopUp').val(Result.DocumentTypeID);
                        
                        if(Result.ReviewStatusID == 3){
                            $('#divReuploadDocument').removeClass('d-none');
                            $('#divReuploadDocument').removeClass('d-flex');

                            $('#divReuploadDocument').addClass('d-flex');
                             $('#btnSaveDocPopup').css('display','inline-block');
                        }
                        else{
                            $('#divReuploadDocument').removeClass('d-none');
                            $('#divReuploadDocument').removeClass('d-flex');
                            
                            $('#divReuploadDocument').addClass('d-none');
                            $('#btnSaveDocPopup').css('display','none');
                        }
                    }
                }
            });
            $("#mdlReviewDetail").modal();
    }


    function ClosePopUpDocument(){
        $("#mdlReviewDetail").modal('hide');
        $('#lblDocumentTypePopup').text('');
        $('#lblDocumentFileNamePopup').text('');
        $('#lblDocumentUploadDatePopup').text('');
        $('#lblDocumentReviewDatePopup').text('');
        $('#lblDocumentStatusPopup').text('');
        $('#lblDocumentReviewDescPopup').text('');
        $('#reuploadDocument').val('');
        $('#lblReuploadDocument').html('Choose File');
    }


</script>