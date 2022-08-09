@if (count($posts) > 0)
    @foreach ($posts as $post)
        <div class="row text-center w-75 mx-auto my-3 px-3 py-2" style="border: 1px solid black;">
            <div class="col-2">
                <div class="row text-center">
                    <div class="col-4">
                        <img src="{{ env('FTP_URL') }}Forum/Post/{{ $post->PostID }}/{{ $post->PostPicture }}"
                            alt="UsernamePhotoProfile" style="max-width: 100px;"
                            onerror="this.onerror==null;this.src='{{ env('FTP_URL') }}assets/Smiley.png'">
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="row">
                    <h4>Nama Kebutuhan : <a href="/ViewPost/{{ $post->PostID }}" class="PostTitle"
                            style="text-decoration:none">{{ $post->PostTitle }}</a></h4>
                </div>
                <div class="row">
                    <h6>Deskripsi : {{ $post->PostDescription }}</h6>
                </div>
                <div class="row">
                    <h6>Tanggal Post : {{ date('d M Y', strtotime($post->created_at)) }} at
                        {{ date('h:i A', strtotime($post->created_at)) }}</h6>
                </div>
            </div>
            @if(Auth::guard('foundations')->check() && Auth::guard('foundations')->user()->FoundationID == $post->ID && $post->RoleID == 2)
            <div class="col-md-1">
                <div class="btn-group dropleft">
                    <a href="#" style="color: black" role="button" id="btnAction-{{$post->PostID}}" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-align-justify"></i>
                    </a>

                    <div class="dropdown-menu" id="ddlAction-{{$post->PostID}}" aria-labelledby="btnAction-{{$post->PostID}}">
                        <a class="dropdown-item hapus-post" data-id="{{ $post->PostID }}" href="#">Hapus Post</a>
                    </div>
                </div>
                <input type="hidden" id="ddlActionStatus-{{$post->PostID}}" value="hide">
            </div>
            @endif
        </div>
    @endforeach
    {{ $posts->links() }}
@else
    <div class="row text-center w-75 mx-auto my-3 px-3 py-2">
        <div class="col-12">
            <div class="row text-center">
                <div class="col-12">
                    <h3>Tidak ada Data</h3>
                </div>
            </div>
        </div>
    </div>
@endif
