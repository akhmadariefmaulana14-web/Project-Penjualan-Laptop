<div class="container-fluid">

    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
        <h1 class="h3 text-gray-900 font-weight-bold mb-2 mb-md-0">Dashboard</h1>
        <small class="text-muted">Overview of your store's performance</small>
    </div>

    <div class="row">

        <?php
        $total = 0;
        foreach ($total_penjualan as $key) {
            $total += $key->subtotal;
        }
        ?>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm rounded-lg border-0"
                style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: #fff;">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-uppercase font-weight-bold small mb-2">Total Penjualan</div>
                        <div class="h5 font-weight-bold">
                            Rp <?= number_format($total, 0, ',', '.') ?>
                        </div>
                    </div>
                    <div class="display-4 opacity-25">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm rounded-lg border-0"
                style="background: linear-gradient(135deg, #2193b0, #6dd5ed); color: #fff;">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-uppercase font-weight-bold small mb-2">Jumlah Laptop</div>
                        <div class="h5 font-weight-bold">
                            <?= $laptop ?>
                        </div>
                    </div>
                    <div class="display-4 opacity-25">
                        <i class="fas fa-laptop"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm rounded-lg border-0"
                style="background: linear-gradient(135deg, #2980b9, #2c3e50); color: #fff;">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-uppercase font-weight-bold small mb-2">Jumlah User</div>
                        <div class="h5 font-weight-bold">
                            <?= $user ?>
                        </div>
                    </div>
                    <div class="display-4 opacity-25">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm rounded-lg border-0"
                style="background: linear-gradient(135deg, #36d1dc, #5b86e5); color: #fff;">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-uppercase font-weight-bold small mb-2">Jumlah Transaksi</div>
                        <div class="h5 font-weight-bold">
                            <?= $transaksi ?>
                        </div>
                    </div>
                    <div class="display-4 opacity-25">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>