<div class="container-fluid mb-4">
    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php if (empty($laptop)) : ?>
        <div class="col-12">
            <div class="alert alert-warning text-center">
                Laptop <?= $merk->nama_merk ?> Tidak Ditemukan
            </div>
        </div>
        <?php endif ?>

        <?php foreach ($laptop as $key) : ?>
        <div class="col">
            <div class="card h-100 shadow-sm border-0 rounded-3 product-card">
                <img src="<?= base_url() ?>assets/image_laptop/<?= $key->img_laptop ?>" class="card-img-top rounded-top-3"
                    alt="<?= $key->jenis_laptop ?>">
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title"><?= $key->jenis_laptop ?></h6>
                    <div class="mb-2">
                        <?php for($i=0;$i<5;$i++): ?>
                        <i class="fa fa-star text-warning"></i>
                        <?php endfor; ?>
                    </div>
                    <p class="text-danger fw-bold">Rp <?= number_format($key->harga_laptop, 0, ',', '.') ?></p>
                    <div class="mt-auto d-flex justify-content-between">
                        <a href="<?= site_url('frontend/detail_laptop/' . $key->id_laptop) ?>" class="btn btn-sm btn-dark w-100">
                            <i class="fa fa-eye"></i> Detail
                        </a>
                        &nbsp;
                        <a href="<?= site_url('cart/insert_cart_from_search/' . $key->id_laptop) ?>"
                            class="btn btn-warning w-50 me-1 btn-cart"><i class="fa fa-shopping-cart"></i></a>
                        <a href="<?= site_url('wishlist/insert_wishlist_from_search/' . $key->id_laptop) ?>"
                            class="btn btn-outline-danger w-50 ms-1 btn-wishlist"><i class="fa fa-heart"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>

<style>
    .product-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    }

    .btn-cart,
    .btn-wishlist,
    .btn-detail {
        transition: transform 0.2s;
    }

    .btn-cart:hover,
    .btn-wishlist:hover,
    .btn-detail:hover {
        transform: scale(1.05);
    }

    .card-title {
        font-weight: 600;
        font-size: 0.95rem;
    }

    .product-card .card-body {
        display: flex;
        flex-direction: column;
    }
</style>
