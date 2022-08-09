<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Apakah kamu yakin ingin melakukan Ban untuk
                    {{ $report->first()->UserReported->Username }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label class="form-group">
                    Tolong dipastikan kembali apakah anda ingin melakukan Ban pada akun ini?
                </label>
                <form action="/usersearching/ban" method="post" id="form-ban">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="UserID"
                        value="{{ $report->first()->RoleIDTarget == 1 ? Crypt::encrypt($report->first()->UserReported->UserID) : Crypt::encrypt($report->first()->UserReported->FoundationID) }}">
                    <div class="form-group">
                        <label class="col-3">Durasi Ban</label>
                        <div class="col-6">
                            <select name="Duration" class="form-control" name="Duration" id="Duration" required>
                                <option value="32">32 Jam</option>
                                <option value="48">48 Jam</option>
                                <option value="168">168 Jam</option>
                                <option value="1000000000">Permanent</option>
                            </select>
                        </div>
                    </div>
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
