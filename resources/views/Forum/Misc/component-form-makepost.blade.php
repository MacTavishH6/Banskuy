<div class="modal fade bd-example-modal-lg" id="mdlMakePost" tabindex="-1" role="dialog" aria-hidden="true" style="max-height: 700px" >
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h3 class="modal-title w-100 text-center">Create a Post</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mb-1">
                <div class="media mb-2">
                    {{-- <img class="mr-3 d-block rounded-circle" style="height:100px;width:100px"  src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png"> --}}
                    <img class="mr-3 d-block rounded-circle" style="height:75px;width:75px"
                        src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/image/img1.png">

                    <div class="media-body mt-3">
                        <h3>Fikri Fadillah</h3>
                    </div>
                </div>

                <div>
                    <form method="POST" action="/CreatePost" enctype="multipart/form-data"> 
                        @csrf
                        <div class="form-inline mb-2">
                            <div class="form-group w-100">
                                <div class="input-group w-50 p-1">
                                    <div class="w-25 mt-2 mr-1">
                                        <h6>Post Type :</h6>
                                    </div>
                                    <select class="form-control" id="ddlPostType" name="ddlPostType">
                                        <option value="1">Donation Post</option>
                                        <option value="2">Request Post</option>
                                    </select>
                                </div>

                                <div class="input-group w-50 p-1">
                                    <div class="w-25 mt-2 mr-1">
                                        <h6>Donation Type :</h6>
                                    </div>
                                    <select class="form-control" id="ddlDonationType" onchange="ChangeDonationTypeDetail(this)">
                                        @foreach ($DonationType as $item)
                                            <option value="{{$item->DonationTypeID}}">{{$item->DonationTypeName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-inline mb-2">
                            <div class="form-group w-100">
                                <div class="input-group w-100 p-1">
                                    <div class="mt-2 mr-3">
                                        <h6>Post Title :</h6>
                                    </div>
                                    <input type="text" class="form-control" id="txtPostTitle" name="txtPostTitle" placeholder="Post Title">
                                   
                                </div>  
                            </div>
                        </div>
                        <div class="form-group ">
                            <textarea class="form-control" id="txaPostDesc" name="txaPostDesc" rows="3" style="resize: none" placeholder="Description" maxlength="255"></textarea>
                            <label class="float-right text-muted" id="lblDescLenght"></label>
                        </div>
                        <br>
                        <div class="form-inline mb-3">
                            <div class="form-group w-100">
                                <div class="input-group w-50 p-1">
                                    <div class="w-25 mt-2 mr-1">
                                        <h6>Unit :</h6>
                                    </div>
                                    
                                        <select class="form-control" id="ddlDonationTypeDetail" name="ddlDonationTypeDetail">
                         
                                                <option value="{{$DonationTypeDetail->first()->DonationTypeDetailID}}">{{$DonationTypeDetail->first()->DonationTypeDetail}}</option>
                                    
                                        </select>
                                    
                                    
                                </div>

                                <div class="input-group w-50 p-1">
                                    <div class="w-25 mt-2 mr-1">
                                        <h6>Quantity :</h6>
                                    </div>
                                    <input class="form-control" type="number" id="txtQuantity" name="txtQuantity" >
                                </div>
                            </div>
                        </div>

                        <div class="custom-file w-100 mb-3">
                            <input class="custom-file-input" type="file" id="fuAttachment" name="fuAttachment" >
                            <label class="custom-file-label" for="fuAttachment" id="lblFuAttachment">Choose File</label>
                        </div>
                        <div class="text-center w-100">
                            <button type="submit" class="btn btn-primary w-75 " id="btnSubmit">
                                <h5>Post</h5>
                            </button>
                        </div>
                            
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>