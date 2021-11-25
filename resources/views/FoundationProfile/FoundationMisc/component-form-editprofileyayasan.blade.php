    <div class="row mt-4">
        
        <div class="col-3 text-center px-0">
            <img src="https://www.banskuy.com/banskuy.com/Basnkuy2022/assets/BinusUniv.png" alt="UsernamePhotoProfile"
                style="border-radius: 50%; border: 1px solid black; width: 100px">
            <p>Edit Photo</p>
        </div>
        <div class="col-9 mt-4">
            <h2>{{ $foundation->Username ? $foundation->Username : '-' }}</h2>
        </div>
    </div>
    <form id='formupdatefoundationprofile' action="/updatefoundationprofile" method="POST">
        @csrf
        @method("PUT")
        <input type="hidden" name="FoundationID" value="{{ Crypt::encrypt($foundation->FoundationID) }}">
        <div class="form-row py-1">
            <div class="col-2">
                <label for="FoundationName">Foundation Name</label>
            </div>
            <div class="col-6">
                <input type="text" name="FoundationName" id="FoundationName" class="form-control"
                    value="{{ old('FoundationName') ? old('FoundationName') : $foundation->FoundationName }}"
                    class="form-control @error('FoundationName') is-invalid @enderror" required>
                @error('FoundationName')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-row py-1">
            <div class="col-2">
                <label for="Username">Username</label>
            </div>
            <div class="col-6">
                <input type="text" name="Username" id="Username" value="{{ old('Username') ? old('Username') : $foundation->Username }}" 
                    class="form-control @error('Username') is-invalid @enderror" required>
                @error('Username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-row py-1">
            <div class="col-2">
                <label for="Email">Email</label>
            </div>
            <div class="col-6">
                <input type="email" name="Email" id="Email" value="{{ old('Email') ? old('Email') : $foundation->Email }}"
                    class="form-control @error('Email') is-invalid @enderror" required>
                @error('Email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-row py-1">
            <div class="col-2">
                <label for="FoundationPhone">Phone Number</label>
            </div>
            <div class="col-6">
                <input type="tel" name="FoundationPhone" id="FoundationPhone"
                    value="{{ old('FoundationPhone') ? old('FoundationPhone') : $foundation->FoundationPhone }}"
                    class="form-control @error('FoundationPhone') is-invalid @enderror" required>
                @error('FoundationPhone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-row py-1">
            <div class="col-2">
                <label for="Visi">Visi</label>
            </div>
            <div class="col-6">
                <input type="text" name="Visi" id="Visi"
                    value="{{ old('Visi') ? old('Visi') : $foundation->Visi }}"
                    class="form-control @error('Visi') is-invalid @enderror" required>
                @error('Visi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-row py-1">
            <div class="col-2">
                <label for="Misi">Misi</label>
            </div>
            <div class="col-6">
                <textarea name="Misi" id="Misi" style="resize: none;" 
                    class="form-control @error('Misi') is-invalid @enderror" required>{{ old('Misi') ? old('Misi') : $foundation->Misi }}</textarea>
                @error('Misi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-row py-1">
            <div class="col-2">
                <label for="Address">Address</label>
            </div>
            <div class="col-6">
                <textarea name="Address" id="Address" style="resize: none;" class="form-control @error('Address') is-invalid @enderror" required>{{ old('Address') ? old('Address') : ($foundation->Address ? $foundation->Address->Address : '') }}</textarea>
                @error('Address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-row py-1">
            <div class="col-2">
                <label for="Country">Country</label>
            </div>
            <div class="col-6">
                <select name="Country" id="Country" class="form-control @error('Country') is-invalid @enderror" required>
                    <option value="1" selected>Indonesia</option>
                </select>
                @error('Country')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-row py-1">
            <div class="col-2">
                <label for="Province">Province</label>
            </div>
            <div class="col-6">
                <select name="Province" id="Province" class="form-control @error('Province') is-invalid @enderror"
                    required></select>
            </div>
            @error('Province')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-row py-1">
            <div class="col-2">
                <label for="City">City</label>
            </div>
            <div class="col-6">
                <select name="City" id="City" class="form-control @error('City') is-invalid @enderror"
                    required></select>
            </div>
            @error('City')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row mt-4 mb-5">
            <div class="col-2"></div>
            <div class="col-6 pr-2">
                <button type="submit" class="float-right py-1 px-5 text-white"
                    style="border-radius: 20px; background-color: #AC8FFF; border: none;">Save</button>
            </div>
        </div>
    </form>
     {{-- untuk Get --}}