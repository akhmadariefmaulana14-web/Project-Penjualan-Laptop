<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-warning py-2 mb-4">
    <div class="container-fluid">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= site_url('frontend') ?>"
                    class="text-dark text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-dark text-decoration-none">Products</a></li>
            <li class="breadcrumb-item active text-dark" aria-current="page">Cart</li>
        </ol>
    </div>
</nav>

<!-- Cart -->
<div class="container mb-5">
    <div class="row g-4">
        
        <!-- Cart Items (Kiri) -->
        <div class="col-lg-8">
            <h2 class="text-warning fw-bold mb-3" style="font-family: 'Source Code Pro', monospace;">Your Cart</h2>
            <div class="shadow rounded-3 p-3 bg-white">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">
                        <thead class="table-warning text-dark fw-bold">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th class="text-center" style="width: 150px;">Quantity</th>
                                <th>Total</th>
                                <th style="width:120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($this->cart->contents()) : ?>
                            <?php foreach ($this->cart->contents() as $items) : ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded d-flex justify-content-center align-items-center me-3"
                                            style="width:60px; height:60px; color:#b38f00; font-weight:600;">
                                            <i class="fa fa-laptop fa-lg"></i>
                                        </div>
                                        <span><?= htmlspecialchars($items['name']) ?></span>
                                    </div>
                                </td>
                                
                                <td class="fw-bold"><?= 'Rp ' . number_format($items['price'], 0, ',', '.') ?></td>
                                
                                <!-- KOLOM QUANTITY -->
                                <td>
                                    <form action="<?= site_url('cart/update_item') ?>" method="POST" class="d-flex justify-content-center align-items-center">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                        <input type="hidden" name="rowid" value="<?= $items['rowid'] ?>">
                                        
                                        <button type="submit" name="action" value="minus" class="btn btn-outline-secondary btn-sm px-2 py-0" style="border-radius: 4px 0 0 4px;">
                                           <i class="fa fa-minus fa-xs"></i>
                                        </button>
                                        
                                        <input type="text" name="qty" value="<?= $items['qty'] ?>" 
                                               class="form-control text-center px-1 py-0" 
                                               style="width: 45px; border-radius: 0; pointer-events: none; font-weight: bold;" 
                                               readonly>
                                        
                                        <button type="submit" name="action" value="plus" class="btn btn-outline-secondary btn-sm px-2 py-0" style="border-radius: 0 4px 4px 0;">
                                           <i class="fa fa-plus fa-xs"></i>
                                        </button>
                                    </form>
                                </td>

                                <td class="fw-bold">
                                    <?= 'Rp ' . number_format($items['qty'] * $items['price'], 0, ',', '.') ?>
                                </td>
                                
                                <td class="text-center">
                                    <a href="<?= site_url('cart/remove_item/' . $items['rowid']) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure want to remove this item?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                            <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center fst-italic py-4 text-muted">Your cart is empty.</td>
                            </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Cart Summary (Kanan) -->
        <div class="col-lg-4">
            <div class="shadow rounded-3 p-3 bg-white">
                <!-- Coupon -->
                <form action="<?= site_url('cart/redeem_code') ?>" method="POST" class="d-flex mb-3">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                        value="<?= $this->security->get_csrf_hash() ?>">
                    <input type="text" name="kode_promo" class="form-control rounded-start"
                        placeholder="Coupon Code">
                    <button type="submit" class="btn btn-warning rounded-end fw-bold">Apply Code</button>
                </form>

                <!-- Summary -->
                <h3 class="text-warning fw-bold mb-3" style="font-family: 'Source Code Pro', monospace;">Cart Summary</h3>
                
                <p class="d-flex justify-content-between">Sub Total 
                    <span class="fw-bold"><?= 'Rp ' . number_format($this->cart->total(), 0, ',', '.') ?></span>
                </p>
                
                <?php if ($this->session->tempdata('coupon')) : ?>
                <p class="d-flex justify-content-between text-success">Discount (<?= $this->session->tempdata('coupon') ?>%) 
                    <span class="fw-bold">- Rp <?= number_format($this->cart->total() * ($this->session->tempdata('coupon') / 100), 0, ',', '.') ?></span>
                </p>
                <h4 class="d-flex justify-content-between fw-bold">Grand Total 
                    <span><?= 'Rp ' . number_format($this->cart->total() - ($this->cart->total() * ($this->session->tempdata('coupon') / 100)), 0, ',', '.') ?></span>
                </h4>
                <?php else : ?>
                <h4 class="d-flex justify-content-between fw-bold">Grand Total 
                    <span><?= 'Rp ' . number_format($this->cart->total(), 0, ',', '.') ?></span>
                </h4>
                <?php endif ?>

                <a href="<?= site_url('checkout') ?>" class="btn btn-warning w-100 fw-bold mt-3">Checkout</a>
            </div>
        </div>

    </div>
</div>