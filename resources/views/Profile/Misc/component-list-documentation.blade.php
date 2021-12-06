<div class="documentaion-container">
    @foreach ($donationTransaction as $transaction)
        <div class="row m-3 px-3 py-2" style="border: 1px solid black;">
            <div class="col-4">
                <div class="row">
                    <div class="col-12">
                        <h4>Tipe Donasi: {{ $transaction->DonationTypeDetail->DonationType->DonationTypeName }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h6>Yayasan: {{ $transaction->Foundation->FoundationName }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h6>Tanggal Donasi: {{ date('d M Y', strtotime($transaction->TransactionDate)) }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-8">
                @if ($transaction->Documentation)
                    @foreach ($transaction->Documentation->DocumentationPhoto as $Photo)
                        <div class="row text-center">
                            <div class="col-4">
                                <img src="{{ env('FTP_URL') }}DocumentationPicture/{{ $Photo->PhotoName }}"
                                    alt="UsernamePhotoProfile"
                                    onerror="this.onerror==null;this.src='{{ env('FTP_URL') }}assets/Smiley.png'"
                                    style="border: 1px solid black; max-width: 200px; max-height: 200px">
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row text-center mt-4">
                        <div class="col-12">
                            <label>No Image</label>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
