<div class="row">
    <div class="col-3 text-center px-0">
        <img src="https://www.banskuy.com/banskuy.com/Basnkuy2022/assets/BinusUniv.png" alt="UsernamePhotoProfile"
            style="border-radius: 50%; border: 1px solid black; width: 100px">
        <p>Edit Photo</p>
    </div>
    <div class="col-9">
        <h2>My UserName</h2>
    </div>
</div>
<form>
    <div class="form-row py-1">
        <div class="col-2">
            <label for="FirstName">First Name</label>
        </div>
        <div class="col-6">
            <input type="text" name="FirstName" id="FirstName" class="form-control">
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-2">
            <label for="LastName">Last Name</label>
        </div>
        <div class="col-6">
            <input type="text" name="LastName" id="LastName" class="form-control">
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-2">
            <label for="Username">Username</label>
        </div>
        <div class="col-6">
            <input type="text" name="Username" id="Username" class="form-control">
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-2">
            <label for="Email">Email</label>
        </div>
        <div class="col-6">
            <input type="email" name="Email" id="Email" class="form-control">
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-2">
            <label for="PhoneNumber">Phone Number</label>
        </div>
        <div class="col-6">
            <input type="tel" name="PhoneNumber" id="PhoneNumber" class="form-control">
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-2">
            <label for="Gender">Gender</label>
        </div>
        <div class="col-6">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="Gender" id="Gender" value="1">
                <label class="form-check-label" for="Male">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="Gender" id="Gender" value="2">
                <label class="form-check-label" for="Female">Female</label>
            </div>
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-2">
            <label for="Address">Address</label>
        </div>
        <div class="col-6">
            <textarea name="Address" id="Address" class="form-control" style="resize: none;">
                                                        </textarea>
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-2">
            <label for="Country">Country</label>
        </div>
        <div class="col-6">
            <select name="Country" id="Country" class="form-control"></select>
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-2">
            <label for="Province">Province</label>
        </div>
        <div class="col-6">
            <select name="Province" id="Province" class="form-control"></select>
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-2">
            <label for="City">City</label>
        </div>
        <div class="col-6">
            <select name="City" id="City" class="form-control"></select>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-6 pr-2">
            <button type="submit" class="float-right py-1 px-5"
                style="border-radius: 20px; background-color: #AC8FFF; border: none;">Save</button>
        </div>
    </div>
</form>
