@foreach ($ItemTypeDetail->Post as $ItemPost)
<div class="Post-Item mb-2 card-body mb-2">
    <div class="media mb-4 ">
        <img class="mr-3 d-block w-25 h-25"
            src="https://banskuy.com/banskuy.com/Basnkuy2022/Forum/Post/{{$ItemPost->PostID}}/{{$ItemPost->PostPicture}}">
        <div class="media-body">
            <div class="d-flex">
                <div class="mr-auto p-1">
                    <a href="/ViewPost/{{$ItemPost->PostID}}" style="text-decoration:none;color:black"><h5>{{$ItemPost->PostTitle}}</h5></a>
                </div>
                <div >
                    <button type="submit" class="btn btn-primary pb-2 pt-1 px-2" >Open For
                        Donation</button>
                </div>
            </div>
            <div class="d-flex flex-column bd-highlight">
                <div class="d-flex flex-row bd-highlight">
                    <div class="p-1 bd-higlight mb-2 mr-4">
                        Author :
                    </div>

                    <div class="p-1 bd-higlight mb-2">
                        {{$ItemPost->User->FirstName}} {{$ItemPost->User->LastName}}
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
                        50
                    </div>
                </div>

                <div class="d-flex flex-row bd-highlight">
                    <div class="p-1 bd-higlight mb-2 mr-1">
                        Comment :
                    </div>
                    <div class="p-1 bd-higlight mb-2">
                        10k
                    </div>
                </div>
                <div class="d-flex flex-column bd-highlight w-100">
                    <div class="p-2 bd-higlight mb-2 mr-1">
                        <form method="POST" enctype="multipart/form-data" action="/PostComment/{{$ItemPost->PostID}}">
                            @csrf
                            <div class="form-inline">
                                <div class="form-group w-100">
                                    <input type="text" class="form-control w-75 mr-3"
                                        placeholder="Leave a comment..." id="txtComment" name="txtComment">
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