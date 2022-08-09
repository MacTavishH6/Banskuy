<div class="modal fade bd-example-modal-lg" id="mdlEditPost" tabindex="-1" role="dialog" aria-hidden="true" style="max-height: 700px" >
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h3 class="modal-title w-100 text-center">Edit Post</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mb-1">
                <div class="media mb-2">
                    {{-- <img class="mr-3 d-block rounded-circle" style="height:100px;width:100px"  src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png"> --}}

                        @if (Auth::guard('foundations')->check())
                        <img src="{{ env('FTP_URL') }}{{ Auth::guard('foundations')->user()->FoundationPhoto ? 'ProfilePicture/Yayasan/' . Auth::guard('foundations')->user()->FoundationPhoto->Path : 'assets/Smiley.png' }}"
                        alt="FoundationPhotoProfile" class="mr-3 d-block rounded-circle"
                        style="height:75px;width:75px"
                        onerror="this.onerror==null;this.src='{{ env('FTP_URL') }}assets/Smiley.png'">
                        <div class="media-body mt-3">
                            <h3>{{Auth::guard('foundations')->user()->FoundationName}}</h3>
                        </div>
                        
                        @elseif(Auth::check())
                        <img src="{{ env('FTP_URL') }}{{ Auth::user()->Photo ? 'ProfilePicture/Donatur/' . Auth::user()->Photo->Path : 'assets/Smiley.png' }}"
                        alt="UsernamePhotoProfile" class="mr-3 d-block rounded-circle"
                        style="height:75px;width:75px"
                        onerror="this.onerror==null;this.src='{{ env('FTP_URL') }}assets/Smiley.png'">
                            
                            <div class="media-body mt-3">
                                <h3>{{Auth::user()->FirstName}} {{Auth::user()->LastName}}</h3>
                            </div>
                            
                        @endif
                    
                </div>

                <div>
                    <form method="POST" action="/EditPost" enctype="multipart/form-data"> 
                        @csrf
                       
                        <div class="form-inline mb-2">
                            <div class="form-group w-100">
                                <div class="input-group p-1" style="width:40%">
                                    <div class=" mt-2 mr-1" style="width: 30%">
                                        <h6>Tipe Post :</h6>
                                    </div>
                                    <select class="form-control" id="ddlPostType" name="ddlPostType">
                                        @if (Auth::guard('foundations')->check())
                                        <option value="2">Request Post</option>
                                        @else
                                        <option value="1">Donation Post</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="input-group p-1" style="width:60%">
                                    <div class="mt-2 mr-1" style="width:30%">
                                        <h6>Tipe Donasi :</h6>
                                    </div>
                                    <select class="form-control" id="ddlDonationType" name="ddlDonationType" onchange="ChangeDonationTypeDetail(this)">
                                        @foreach ($DonationType as $item)
                                            <option value="{{$item->DonationTypeID}}" {{$item->DonationTypeID == $Post->DonationTypeID ? 'selected' : ''}}>{{$item->DonationTypeName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-inline mb-2">
                            <div class="form-group w-100">
                                <div class="input-group w-100 p-1">
                                    <div class="mt-2 mr-3">
                                        <h6>Judul Post :</h6>
                                    </div>
                                    <input type="text" value="{{$Post->PostTitle}}" class="form-control" id="txtPostTitle" name="txtPostTitle" placeholder="Post Title" required>
                                    
                                </div>  
                            </div>
                        </div>
                        <div class="form-group ">
                            <textarea class="form-control"  id="txaPostDesc" name="txaPostDesc" rows="3" style="resize: none" placeholder="Description" maxlength="255" required>{{$Post->PostDescription}}</textarea>
                            <label class="float-right text-muted" id="lblDescLenght"></label>
                        </div>
                        <br>
                        <div class="form-inline mb-3">
                            <div class="form-group w-100">
                                <div class="input-group p-1" style="width:40%">
                                    <div class="mt-2 mr-1" style="width: 30%">
                                        <h6>Unit :</h6>
                                    </div>
                                    
                                        <select class="form-control" id="ddlDonationTypeDetail" name="ddlDonationTypeDetail">
                                            @foreach ($DonationTypeDetail as $item)
                                                <option value="{{$item->DonationTypeDetailID}}" {{$item->DonationTypeDetailID == $Post->DonationTypeDetailID ? 'selected' : ''}}>{{$item->DonationTypeDetail}}</option>
                                            @endforeach
                                        </select>
                                    
                                    
                                </div>

                                <div class="input-group  p-1" style="width:60%">
                                    <div class="mt-2 mr-1" style="width: 30%">
                                        <h6>Quantity :</h6>
                                    </div>
                                    <input class="form-control" type="number" value="{{$Post->Quantity + 0 }}" id="txtQuantity" name="txtQuantity" required>
                                </div>
                            </div>
                        </div>

                        <div class="custom-file w-100 mb-3">
                            <input class="custom-file-input" type="file" id="fuAttachment" name="fuAttachment" >
                            <label class="custom-file-label" for="fuAttachment" id="lblFuAttachment">{{$Post->PictureRealName}}</label>
                        </div>
                        <div class="text-center w-100">
                            <input type="hidden" id="PostID" name="PostID" value="{{Crypt::encrypt($Post->PostID)}}">
                            <button type="submit" class="btn btn-primary w-75 " id="btnSubmit">
                                <h5>Perbarui Post</h5>
                            </button>
                        </div>
                            
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>