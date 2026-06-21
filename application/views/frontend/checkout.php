<?php
function rupiah($angka)
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}
?>

<nav aria-label="breadcrumb" class="bg-warning py-2 mb-4">
    <div class="container-fluid">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= site_url('frontend') ?>"
                    class="text-dark text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-dark text-decoration-none">Products</a></li>
            <li class="breadcrumb-item active text-dark" aria-current="page">Checkout</li>
        </ol>
    </div>
</nav>

<!-- Checkout -->
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="shadow rounded-3 p-4 bg-white">
                <h2 class="fw-bold mb-3">Billing</h2>
                <form action="<?= site_url('transaksi/insert_transaksi') ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                        value="<?= $this->security->get_csrf_hash() ?>">

                    <!-- Cart Total -->
                    <h2 class="text-warning fw-bold mt-4">Cart Total</h2>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between"><span>Sub
                                Total</span><span><?= rupiah($this->cart->total()) ?></span></div>
                        <div class="d-flex justify-content-between"><span>Shipping
                                Cost</span><span><?= rupiah(10000) ?></span></div>
                        <?php 
                        $ongkir = 10000;
                        $total_cart = $this->cart->total();
                        if ($this->session->tempdata('coupon')):
                            $discount = $total_cart * ($this->session->tempdata('coupon') / 100);
                            $grand_total = $total_cart + $ongkir - $discount;
                        ?>
                        <div class="d-flex justify-content-between text-success"><span>Discount
                                (<?= $this->session->tempdata('coupon') ?>%)</span><span>-
                                <?= rupiah($discount) ?></span></div>
                        <div class="d-flex justify-content-between fw-bold"><span>Grand
                                Total</span><span><?= rupiah($grand_total) ?></span></div>
                        <?php else: 
                            $grand_total = $total_cart + $ongkir;
                        ?>
                        <div class="d-flex justify-content-between fw-bold"><span>Grand
                                Total</span><span><?= rupiah($grand_total) ?></span></div>
                        <?php endif; ?>

                    </div>

                    <!-- Payment -->
                    <h2 class="text-warning fw-bold mt-4">Payment Methods</h2>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="payment" id="payment-3"
                            value="Check Payment" required>
                        <label class="form-check-label fw-bold" for="payment-3">Confirmation Manual Payment to Admin
                            Laptop</label>
                    </div>

                    <button type="submit" class="btn btn-warning btn-lg fw-bold w-100 mt-3">Place Order</button>
                </form>
            </div>
        </div>
    </div>
</div>
