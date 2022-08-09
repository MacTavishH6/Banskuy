<div class="row mt-3 justify-content-around">
    <div class="">
        <p style="font-size: 280%">VISI</p>
    </div>
</div>

<hr style="background-color: black">

<div class="row justify-content-around">
    <div class="col-12">
        <p style="font-size: 130%">{{$foundation->Visi}}</p>
    </div>
</div>

<hr style="background-color: black">

<div class="row justify-content-around">
    <div class="">
        <p style="font-size: 280%">MISI</p>
    </div>
</div>

<hr style="background-color: black">

<div class="row justify-content-around">
    <div class="col-12">
        <label style="font-size: 130%; white-space: pre-wrap">{{$foundation->Misi}}</label>
    </div>
</div>

<hr style="background-color: black">

<div class="row justify-content-around">
    <div class="">
        <p style="font-size: 280%">LEGALITAS</p>
    </div>
</div>

<hr style="background-color: black">

<div class="row justify-content-around">
    <?php
        $flag = 0;
    ?>
    @foreach ($foundation->document as $doc)
        @if ($doc->ApprovalStatusID == 2)
        <?php
            $flag++;
        ?>      
        @endif
    @endforeach
    @if($flag != 2)
        <div class="col-12">
            <p style="font-size: 130%">Yayasan Ini Belum Terdaftar Memiliki Status Legalitas Secara Hukum</p>
        </div>
    @else
        <div class="col-12">
            <p style="font-size: 130%">1. Terdaftar dan Diawasi Dinas Sosial Pemerintah Provinsi</p>
            <p style="font-size: 130%">2. Terdaftar dan Diawasi Kementerian Sosial Republik Indonesia</p>
        </div>  
    @endif
</div>