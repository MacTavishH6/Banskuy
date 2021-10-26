<div class="row mb-4">
    <div class="col-9">
        <h2>Update Document</h2>
    </div>
</div>

<form action="">
    <div class="form-row py-1">
        <div class="col-2">
            <label for="FirstName">Owner Identity Card</label>
        </div>
        <div class="col-6">
            <input type="file" name="OwnerIdentityCard" id="OwnerIdentityCard" class="form-control">
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-2">
            <label for="FirstName">Foundation Certificate</label>
        </div>
        <div class="col-6">
            <input type="file" name="FoundationCertificate" id="FoundationCertificate" class="form-control">
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-2">
            <label for="FirstName">Foundation Operational Permit</label>
        </div>
        <div class="col-6">
            <input type="file" name="FoundationOperationalPermit" id="FoundationOperationalPermit" class="form-control">
        </div>
    </div>
    <div class="form-row py-1">
        <div class="col-2">
            <label for="FirstName">Foundation Registration Permit</label>
        </div>
        <div class="col-6">
            <input type="file" name="FoundationRegistrationPermit" id="FoundationRegistrationPermit" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-6 pr-2">
            <button type="submit" class="float-right py-1 px-5 text-white"
                    style="border-radius: 20px; background-color: #AC8FFF; border: none;">Save</button>
        </div>
    </div>
</form>

<div class="mt-5 mb-4">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Document Name</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Owner Identity Card</td>
                <td>
                    <button type="submit" class="py-1 px-4 text-white"
                    style="border-radius: 20px; background-color: #9ACD32; border: none;">Accepted</button>
                </td>
                <td>
                    <button type="submit" class="py-1 px-4 text-white"
                    style="border-radius: 20px; background-color: #AC8FFF; border: none;">Detail</button>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Foundation Certificate</td>
                <td>
                    <button type="submit" class="py-1 px-4 text-white"
                    style="border-radius: 20px; background-color: #FF0000; border: none;">Denied</button>
                </td>
                <td>
                    <button type="submit" class="py-1 px-4 text-white"
                    style="border-radius: 20px; background-color: #AC8FFF; border: none;">Detail</button>
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Foundation Operational Permit</td>
                <td>
                    <button type="submit" class="py-1 px-4 text-white"
                    style="border-radius: 20px; background-color: #FF8C00; border: none;">Pending</button>
                </td>
                <td>
                    <button type="submit" class="py-1 px-4 text-white"
                    style="border-radius: 20px; background-color: #AC8FFF; border: none;">Detail</button>
                </td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td>Foundation Registration Permit</td>
                <td>
                    <button type="submit" class="py-1 px-4 text-white"
                    style="border-radius: 20px; background-color: #FF8C00; border: none;">Pending</button>
                </td>
                <td>
                    <button type="submit" class="py-1 px-4 text-white"
                    style="border-radius: 20px; background-color: #AC8FFF; border: none;">Detail</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div>
    <p class="" style="color: #FF0000; font-size: 120%">
        For security purpose, all document must be verified before accepting donation
    </p>
</div>