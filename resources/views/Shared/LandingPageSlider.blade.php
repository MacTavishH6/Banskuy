
<style>
    /* Slider Start Here */

    .slider {
            margin-bottom: 1%;
        }

        .carousel-inner {
            max-height: 700px;
            width: 100%;
        }

        .carousel-item img {
            max-height: 700px;
            width: 100%;
        }
</style>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{env("FTP_URL")}}Forum/image/img1.png" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Yayasan Mutiara Bunda</h5>
                <p>anak anak sedang belajar matematika dasar dengan kakak pembina</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{env("FTP_URL")}}Forum/image/img2.jpg" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Yayasan Mutiara Bunda</h5>
                <p>Proses Pemberian Donasi oleh salah satu donatur melalui Banskuy.com</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{env("FTP_URL")}}Forum/image/img3.jpg" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Yayasan Mutiara Bunda</h5>
                <p>Kegiatan mengasah kemampuan diri anak anak Yayasan Mutiara Bunda</p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>