@foreach ($ItemTypeDetail->Post as $ItemPost)
<div class="Post-Item mb-2 card-body mb-2">
    <div class="media mb-4 ">
        <img class="mr-3 d-block w-25 h-25" style="max-width: 25%;max-height: 25%"
            src="{{ env('FTP_URL') }}Forum/Post/{{$ItemPost->PostID}}/{{$ItemPost->PostPicture}}">
        <div class="media-body">
            <div class="d-flex">
                <div class="mr-auto p-1">
                    <h5><a href="/ViewPost/{{$ItemPost->PostID}}" class="PostTitle" style="color: black;text-decoration:none">{{$ItemPost->PostTitle}}</a></h5>
                </div>
                <div>
                                @if($ItemPost->StatusPostId == 1)
                                    @if ($ItemPost->PostTypeID == 1 && Auth::guard('foundations')->check())

                                        <form action="/chatTo" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input id="id" name="id" type="hidden" value="{{$ItemPost->ID}}">
                                            <input id="roleId" name="roleId" type="hidden" value="{{$ItemPost->RoleID}}">
                                            <button type="submit" class="btn btn-secondary pb-2 pt-1 px-1">
                                                Hubungi Pembuat</button>
                                        </form>
                                        @elseif(Auth::check() && $ItemPost->PostTypeID == 2)
                                        <a class="btn btn-primary pb-2 pt-1 px-1" id="btnOpenDonation" href="/makerequestwithpost/{{Crypt::encrypt($ItemPost->PostID)}}">
                                            Memberikan Donasi
                                        </a> 
                                    @endif
                                @elseif($ItemPost->StatusPostId == 2)
                                    <a class="btn btn-danger pb-2 pt-1 px-1" id="btnOpenDonation" href="#}">
                                        Post Ditutup
                                    </a>  
                                @endif
                                
                                    
                </div>
            </div>
            <div class="d-flex flex-column bd-highlight">
                <div class="d-flex flex-row bd-highlight">
                    <div class="p-1 bd-higlight mb-2 mr-4">
                        Pembuat :
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
                        Unit : 
                        @elseif($ItemTypeDetail->DonationTypeID == 2)
                        Jam :
                        @else
                        Uang :
                        @endif
                    </div>
                    <div class="p-1 bd-higlight mb-2">
                        @if ($ItemTypeDetail->DonationTypeID != 3)
                        {{$ItemPost->Quantity + 0}} 
                        @else
                        {{$ItemPost->Quantity}} 
                        @endif
                        
                    </div>
                </div>

                <div class="d-flex flex-row bd-highlight">
                    <div class="p-1 bd-higlight mb-2 mr-1">
                        Komentar :
                    </div>
                    <div class="p-1 bd-higlight mb-2">
                        {{$ItemPost->Comment->count()}}
                    </div>
                </div>
                @if (Auth::check() || Auth::guard('foundations')->check())
                <div class="d-flex flex-column bd-highlight w-100">
                    <div class="p-2 bd-higlight mb-2 mr-1">
                        <form method="POST" enctype="multipart/form-data" action="/PostCommentFromForum/{{$ItemPost->PostID}}">
                            @csrf
                            <div class="form-inline">
                                <div class="form-group w-100">
                                    <input type="text" class="form-control w-75 mr-3"
                                        placeholder="Leave a comment..." id="text" name="text">
                                    <button type="submit"
                                        class="btn btn-primary px-4">Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endforeach