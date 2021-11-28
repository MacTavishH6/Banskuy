@foreach ($ItemTypeDetail->Post as $ItemPost)
<div class="Post-Item mb-2 card-body mb-2">
    <div class="media mb-4 ">
        <img class="mr-3 d-block w-25 h-25"
            src="{{ env('FTP_URL') }}Forum/Post/{{$ItemPost->PostID}}/{{$ItemPost->PostPicture}}">
        <div class="media-body">
            <div class="d-flex">
                <div class="mr-auto p-1">
                    <a href="/ViewPost/{{$ItemPost->PostID}}" style="text-decoration:none;color:black"><h5>{{$ItemPost->PostTitle}}</h5></a>
                </div>
                <div>
                                    @if ($ItemPost->PostTypeID == 1)
                                    <a class="btn btn-secondary pb-2 pt-1 px-1" id="btnOpenDonation" href="#">
                                        Ask For Donation
                                    </a> 
                                    @else
                                    <a class="btn btn-primary pb-2 pt-1 px-1" id="btnOpenDonation" href="/makerequestwithpost/{{Crypt::encrypt($ItemPost->PostID)}}">
                                        Open For Donation
                                    </a> 
                                    @endif
                </div>
            </div>
            <div class="d-flex flex-column bd-highlight">
                <div class="d-flex flex-row bd-highlight">
                    <div class="p-1 bd-higlight mb-2 mr-4">
                        Author :
                    </div>

                    <div class="p-1 bd-higlight mb-2">
                        @if ($ItemPost->RoleID == 1)
                        {{$ItemPost->User->FirstName}} {{$ItemPost->User->LastName}}
                        @else
                        {{$ItemPost->Foundation->FoundationName}} 
                        @endif
                        
                    </div>
                </div>

                <div class="d-flex flex-row bd-highlight">
                    <div class="p-1 bd-higlight mb-2 mr-3">
                        @if ($ItemTypeDetail->DonationTypeID == 1)
                        Units : 
                        @elseif($ItemTypeDetail->DonationTypeID == 2)
                        Hours :
                        @else
                        Money Gathered :
                        @endif
                    </div>
                    <div class="p-1 bd-higlight mb-2">
                        {{$ItemPost->Quantity}}
                    </div>
                </div>

                <div class="d-flex flex-row bd-highlight">
                    <div class="p-1 bd-higlight mb-2 mr-1">
                        Comment :
                    </div>
                    <div class="p-1 bd-higlight mb-2">
                        {{$ItemPost->Comment->count()}}
                    </div>
                </div>
                <div class="d-flex flex-column bd-highlight w-100">
                    <div class="p-2 bd-higlight mb-2 mr-1">
                        <form method="POST" enctype="multipart/form-data" action="/PostCommentFromForum/{{$ItemPost->PostID}}">
                            @csrf
                            <div class="form-inline">
                                <div class="form-group w-100">
                                    <input type="text" class="form-control w-75 mr-3"
                                        placeholder="Leave a comment..." id="text" name="text">
                                    <button type="submit"
                                        class="btn btn-primary px-4">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endforeach