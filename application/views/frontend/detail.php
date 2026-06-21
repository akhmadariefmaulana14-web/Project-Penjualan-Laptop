<div class="container mt-4">
    <div class="row g-4">

        <!-- Gambar -->
        <div class="col-md-5">
            <div class="card shadow-sm border-0 rounded-3">
                <img src="<?= base_url() ?>assets/image_laptop/<?= $laptop->img_laptop ?>"
                    class="img-fluid p-3 rounded-3">
            </div>
        </div>

        <!-- Detail -->
        <div class="col-md-7">
            <div class="card shadow-sm border-0 rounded-3 p-4 h-100">

                <h4 class="fw-bold"><?= $laptop->jenis_laptop ?></h4>
                <p class="text-muted"><?= $laptop->nama_merk ?></p>

                <div class="mb-2">
                    <?php for($i=0;$i<5;$i++): ?>
                    <i class="fa fa-star text-warning"></i>
                    <?php endfor; ?>
                </div>

                <h3 class="text-danger fw-bold">
                    Rp <?= number_format($laptop->harga_laptop, 0, ',', '.') ?>
                </h3>

                <p>
                    <strong>Stok:</strong>
                    <span class="badge bg-success"><?= $laptop->stok ?></span>
                </p>

                <hr>

                <h6 class="fw-bold">Deskripsi</h6>
                <p><?= $laptop->desc_laptop ?></p>

                <div class="mt-auto d-flex gap-2">
                    <a href="<?= site_url('cart/insert_cart/' . $laptop->id_laptop) ?>" class="btn btn-warning w-50">
                        <i class="fa fa-shopping-cart"></i> Cart
                    </a>

                    <a href="<?= site_url('wishlist/insert_wishlist/' . $laptop->id_laptop) ?>"
                        class="btn btn-outline-danger w-50">
                        <i class="fa fa-heart"></i> Wishlist
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
