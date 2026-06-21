<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
        <h1 class="h3 text-gray-900 font-weight-bold mb-2 mb-md-0">Dashboard</h1>
        <small class="text-muted">Overview of your store's performance</small>
    </div>

    <!-- Cards Row -->
    <div class="row">

        <?php $total = $total_penjualan; ?>

        <!-- Total Penjualan Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm rounded-lg border-0"
                style="background: linear-gradient(135deg, #ff9933, #ff6600); color: #fff;">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-uppercase font-weight-bold small mb-2">Total Pembelian</div>
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

        <!-- Jumlah Laptop Card
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm rounded-lg border-0"
                style="background: linear-gradient(135deg, #ffcc66, #ff9933); color: #fff;">
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
        </div> -->

        <!-- Jumlah User Card
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm rounded-lg border-0"
                style="background: linear-gradient(135deg, #ffd699, #ffcc66); color: #fff;">
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
        </div> -->

        <!-- Jumlah Transaksi Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm rounded-lg border-0"
                style="background: linear-gradient(135deg, #ff9966, #ff4d4d); color: #fff;">
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