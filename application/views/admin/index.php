<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= base_url('assets/img/home/home4.jpg') ?>" class="d-block h-50 w-100" alt="Hijab Closet collection">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Hijab Closet collection</h5>
                    <p>This is the collection in our store.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/img/home/home5.jpg') ?>" class="d-block h-50 w-100" alt="New Arrival">
                <div class="carousel-caption d-none d-md-block">
                    <h5>New Arrival</h5>
                    <p>Our new baby is here!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/img/home/home9.jpg') ?>" class="d-block h-50 w-100" alt="Hot selling!">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Hot selling!</h5>
                    <p>This is the hot selling collection in our store.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->