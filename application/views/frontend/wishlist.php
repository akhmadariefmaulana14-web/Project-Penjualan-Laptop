<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-warning py-2 mb-4">
    <div class="container-fluid">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= site_url('frontend') ?>"
                    class="text-dark text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-dark text-decoration-none">Products</a></li>
            <li class="breadcrumb-item active text-dark" aria-current="page">Wishlist</li>
        </ol>
    </div>
</nav>

<!-- Wishlist -->
<div class="container mb-5">
    <h2 class="text-center text-warning fw-bold mb-4" style="font-family: 'Source Code Pro', monospace;">
        Your Wishlist
    </h2>

    <div class="table-responsive shadow rounded-3">
        <table class="table table-bordered align-middle mb-0">
            <thead class="table-warning text-dark fw-bold">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th class="text-center" style="width:150px;">Add to Cart</th>
                    <th class="text-center" style="width:80px;">Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data_wishlist)) : ?>
                <?php foreach ($data_wishlist as $item) : ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded d-flex justify-content-center align-items-center me-3"
                                style="width:60px; height:60px; font-weight:600; color:#b38f00;">
                                <i class="fa fa-laptop fa-lg"></i>
                            </div>
                            <span><?= htmlspecialchars($item->jenis_laptop) ?></span>
                        </div>
                    </td>
                    <td class="fw-bold"><?= 'Rp ' . number_format($item->harga_laptop, 0, ',', '.') ?></td>
                    <td class="text-center">
                        <a href="<?= site_url('cart/insert_cart_from_wishlist/' . $item->id_laptop) ?>"
                            class="btn btn-warning w-100 fw-bold">
                            Add to Cart
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="<?= site_url('wishlist/remove_wishlist/' . $item->id_laptop) ?>"
                            onclick="return confirm('Are you sure to remove this item from your wishlist?')"
                            class="text-danger fs-5">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
                <?php else : ?>
                <tr>
                    <td colspan="4" class="text-center fst-italic py-4 text-muted">
                        Your wishlist is empty.
                    </td>
                </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>
