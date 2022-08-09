<div class="row">
    <div class="col">
        <h2>Ganti Password</h2>
    </div>
</div>
<form action="/changepassword" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="UserID" value="{{ Crypt::encrypt($user->UserID) }}">
    <div class="form-row py-1">
        <div class="col-md-2">
            <label for="OldPassword">Password Lama</label>
        </div>
        <div class="col-md-6">
            <input type="password" name="OldPassword" id="OldPassword" class="form-control {{ $errors->has('OldPassword') ? 'is-invalid' : '' }}" required>
            @if ($errors->has('OldPassword'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('OldPassword') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-md-2">
            <label for="NewPassword">Password Baru</label>
        </div>
        <div class="col-md-6">
            <input type="password" name="NewPassword" id="NewPassword"
                class="form-control {{ $errors->has('NewPassword') ? 'is-invalid' : '' }}" required>
            @if ($errors->has('NewPassword'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('NewPassword') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-md-2">
            <label for="ConfirmPassword">Konfirmasi Password</label>
        </div>
        <div class="col-md-6">
            <input type="password" name="NewPassword_confirmation" id="ConfirmPassword" class="form-control" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-6 pr-2">
            <button type="submit" class="float-right py-1 px-5"
                style="border-radius: 20px; background-color: #AC8FFF; border: none;">Simpan</button>
        </div>
    </div>
</form>
