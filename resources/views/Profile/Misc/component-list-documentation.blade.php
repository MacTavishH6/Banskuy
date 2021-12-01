<div class="row text-center m-3 px-3 py-2" style="border: 1px solid black;">
    <div class="col-4">
        <div class="row">
            <h4>Tipe: <%=data.DonationType%></h4>
        </div>
        <div class="row">
            <h6>Yayasan: <%=data.FoundationName%></h6>
        </div>
        <div class="row">
            <h6>Tanggal Donasi: <%=data.TransactionDate%></h6>
        </div>
    </div>
    <div class="col-8">
        <div class="row text-center">
            <div class="col-4">
                <a href="#">
                    <img src="{{env("FTP_URL")}}assets/BinusUniv.png"
                        alt="UsernamePhotoProfile" style="border: 1px solid black; max-width: 200px;">
                </a>
            </div>
        </div>

    </div>
</div>
