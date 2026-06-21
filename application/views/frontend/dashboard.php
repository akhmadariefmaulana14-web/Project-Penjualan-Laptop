<div class="container-fluid my-4">

    <div class="row">
        <!-- Sidebar Brand -->
        <div class="col-lg-3 mb-3">
            <div class="list-group shadow-sm rounded">
                <a href="#" class="d-inline-block px-3 py-1 mb-2 bg-warning text-dark rounded hover-scale"> <i
                        class="fa fa-home me-2"></i> List Brand Laptop</a>
                <?php foreach ($brand_laptop as $key) : ?>
                <a href="<?= site_url('search/search_by_brand/' . $key->id_merk) ?>"
                    class="list-group-item list-group-item-action d-flex align-items-center hover-bg-warning">
                    <i class="fa fa-laptop me-2"></i> <?= $key->nama_merk ?>
                </a>
                <?php endforeach ?>
            </div>
        </div>

        <!-- Main Banner & Promo Images -->
        <div class="col-lg-6 mb-3">
            <div id="mainCarousel" class="carousel slide shadow rounded" data-bs-ride="carousel">
                <div class="carousel-inner rounded">
                    <div class="carousel-item active">
                        <img src="<?= base_url() ?>assets/img_frontend/slider-1.jpeg" class="d-block w-100 rounded"
                            alt="Banner 1">
                    </div>
                    <div class="carousel-item">
                        <img src="<?= base_url() ?>assets/img_frontend/slider-2.jpeg" class="d-block w-100 rounded"
                            alt="Banner 2">
                    </div>
                    <div class="carousel-item">
                        <img src="<?= base_url() ?>assets/img_frontend/slider-3.jpeg" class="d-block w-100 rounded"
                            alt="Banner 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-2"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-2"></span>
                </button>
            </div>
        </div>

        <!-- Right Promo Images -->
        <div class="col-lg-3 mb-3 d-none d-lg-block">
            <div class="mb-3 d-flex flex-column gap-2">
                <img src="<?= base_url() ?>assets/img_frontend/mac.jpg" class="img-fluid rounded shadow-sm"
                    alt="Promo 1">
                <img src="<?= base_url() ?>assets/img_frontend/mac-2.jpg" class="img-fluid rounded shadow-sm"
                    alt="Promo 2">
            </div>
        </div>
    </div>

    <!-- Brand Slider -->
    <div class="mb-4">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3 text-center">
            <div class="col"><img src="<?= base_url() ?>assets/img_frontend/rog.jpg"
                    class="img-fluid brand-hover rounded shadow-sm" alt=""></div>
            <div class="col"><img src="<?= base_url() ?>assets/img_frontend/lenopo.png"
                    class="img-fluid brand-hover rounded shadow-sm" alt=""></div>
            <div class="col"><img src="<?= base_url() ?>assets/img_frontend/predator.png"
                    class="img-fluid brand-hover rounded shadow-sm" alt=""></div>
            <div class="col"><img src="<?= base_url() ?>assets/img_frontend/razor.jpg"
                    class="img-fluid brand-hover rounded shadow-sm" alt=""></div>
            <div class="col"><img src="<?= base_url() ?>assets/img_frontend/msi.jpg"
                    class="img-fluid brand-hover rounded shadow-sm" alt=""></div>
            <div class="col"><img src="<?= base_url() ?>assets/img_frontend/dell.jpg"
                    class="img-fluid brand-hover rounded shadow-sm" alt=""></div>
        </div>
    </div>

    <!-- Featured Products -->
    <h4 class="mb-3">Products</h4>
    <div class="row g-3">
        <?php foreach ($laptop as $key) : ?>
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm rounded hover-scale">

                <img src="<?= base_url() ?>assets/image_laptop/<?= $key->img_laptop ?>" class="card-img-top">

                <div class="card-body d-flex flex-column">

                    <h6 class="fw-bold"><?= $key->jenis_laptop ?></h6>

                    <div class="mb-2">
                        <?php for($i=0;$i<5;$i++): ?>
                        <i class="fa fa-star text-warning"></i>
                        <?php endfor; ?>
                    </div>

                    <p class="text-danger fw-bold">
                        Rp <?= number_format($key->harga_laptop, 0, ',', '.') ?>
                    </p>

                    <div class="mt-auto d-flex flex-column gap-2">

                        <!-- DETAIL -->
                        <a href="<?= site_url('frontend/detail_laptop/' . $key->id_laptop) ?>" class="btn btn-sm btn-dark w-100">
                            <i class="fa fa-eye"></i> Detail
                        </a>

                        <div class="d-flex gap-1">
                            <a href="<?= site_url('cart/insert_cart/' . $key->id_laptop) ?>"
                                class="btn btn-sm btn-warning w-50">
                                <i class="fa fa-shopping-cart"></i>
                            </a>

                            <a href="<?= site_url('wishlist/insert_wishlist/' . $key->id_laptop) ?>"
                                class="btn btn-sm btn-outline-danger w-50">
                                <i class="fa fa-heart"></i>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</div>

<style>
    .hover-bg-warning:hover {
        background-color: #f0c040 !important;
        color: #1a1a1a;
        font-weight: 600;
    }

    .hover-scale {
        transition: transform 0.3s;
    }

    .hover-scale:hover {
        transform: scale(1.05);
    }

    .brand-hover {
        transition: transform 0.3s;
    }

    .brand-hover:hover {
        transform: scale(1.1);
    }
</style>
