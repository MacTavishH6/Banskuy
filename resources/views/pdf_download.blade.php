<body>
    <div id="content" class="center" style="background-color: #cfc0fa; ">
        <div class="foto" style="max-height: 50px;">
            <img src="{{ env('FTP_URL') }}assets/LogoBanskuy.png" alt="" srcset="" style="max-width: 180px; float: left;">
            <img src="{{ asset('images/Certificate.png') }}" alt="" srcset="" style="float: right;">
        </div>
        <h1 style="text-align: center; clear: both;">Sertifikat Donasi</h1>
        <h6 style="text-align: center">Sertifikat ini diberikan kepada:</h6>
        <h4 style="text-align: center"><b> <span style="">{{ $DonaterName }}</span> </b></h4>
        <h6 style="text-align: center; max-width: 50%; margin: 0 auto">Atas kontribusi dalam memberikan donasi berupa
            {{$DonationType}} dengan judul {{$DonationTItle}} pada
            tanggal {{ date('d M Y', strtotime($DonationDate)) }}</h6>
        <div style="display: block;">
            <div style="margin: 10px 20px 0px; float: left;">
                <h6>Salam Hangat</h6>
                <h5><b>Tim Banskuy</b></h5>
            </div>
            <img src="{{ env('FTP_URL') }}assets/BinusUniv.png" alt="" srcset=""
                style="margin: 10px 20px 0px; max-width: 180px; max-height: 75px; float: right;">
        </div>
        <div style="clear: both"></div>
    </div>
</body>
