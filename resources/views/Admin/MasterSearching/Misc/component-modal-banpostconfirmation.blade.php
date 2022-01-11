<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Apakah kamu yakin ingin melakukan Ban untuk post dengan judul
                    {{ $report->first()->Post->PostTitle }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label class="form-group">
                    Tolong dipastikan kembali apakah anda ingin melakukan Ban pada akun ini?
                </label>
                <form action="/postsearching/ban" method="post" id="form-ban">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="PostID"
                        value="{{Crypt::encrypt($report->first()->PostID)}}">
                </form>
            </div>
            <div class="modal-footer">
                <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn-banskuy ban-user" onclick="$('#form-ban').submit()">Ban</button>
                </div>
            </div>
        </div>
    </div>
</div>
