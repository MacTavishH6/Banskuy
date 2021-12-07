
<style>
    /* Slider Start Here */

    .slider {
            margin-bottom: 10%;
        }

        .carousel-inner {

            max-height: 300px;
            width: 100%;
        }

        .carousel-item img {
            max-height: 300px;
            width: 100%;
        }
</style>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="width: 75%">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{env("FTP_URL")}}Forum/image/img1.png" alt="First slide" onerror="this.onerror==null;this.src='{{ env('FTP_URL') }}assets/Smiley.png'">
            <div class="carousel-caption d-none d-md-block">
                <h5>Money</h5>
                <p>Bantu sesasama dengan memberikan uang</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{env("FTP_URL")}}Forum/image/img2.jpg" alt="Second slide" onerror="this.onerror==null;this.src='{{ env('FTP_URL') }}assets/Smiley.png'">
            <div class="carousel-caption d-none d-md-block">
                <h5>Stuff</h5>
                <p>Bantu sesasama dengan memberikan barang</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{env("FTP_URL")}}Forum/image/img3.jpg" alt="Third slide" onerror="this.onerror==null;this.src='{{ env('FTP_URL') }}assets/Smiley.png'">
            <div class="carousel-caption d-none d-md-block">
                <h5>Comunity Service</h5>
                <p>Bantu sesasama dengan memberikan jasa</p>
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