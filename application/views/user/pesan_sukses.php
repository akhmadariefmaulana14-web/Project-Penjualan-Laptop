<div class="text-center mt-4">
    <a href="<?= base_url('user/dashboard') ?>" class="btn btn-primary btn-lg">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
    </a>
</div>
<div class="alert alert-success">
    <h5><i class="fas fa-check-circle"></i> Pesanan Berhasil!</h5>
    <p>Pesanan Anda telah berhasil diproses.</p>
    <a href="<?= base_url('user/dashboard') ?>" class="btn btn-sm btn-primary mt-2">
        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
    </a>
</div>

<div class="container-fluid">

    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
        <h1 class="h3 text-gray-900 font-weight-bold mb-2 mb-md-0">Pesanan Berhasil</h1>
        <small class="text-muted">Terima kasih telah berbelanja</small>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card shadow-sm rounded-lg border-0 mb-4">
                <div class="card-body py-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                    </div>
                    <h3 class="font-weight-bold text-success mb-3">Pesanan Anda Berhasil!</h3>
                    <p class="text-muted mb-4">Pesanan Anda sedang diproses. Silakan cek dashboard untuk melihat status
                        pesanan.</p>

                    <!-- TOMBOL KEMBALI -->
                    <a href="<?= base_url('user/dashboard') ?>"
                        class="btn btn-lg text-white font-weight-bold shadow-sm mr-2"
                        style="background: linear-gradient(135deg, #ff9933, #ff6600); border: none; border-radius: 8px; padding: 12px 30px;">
                        <i class="fas fa-tachometer-alt mr-2"></i> Kembali ke Dashboard
                    </a>
                    <a href="<?= base_url('home') ?>" class="btn btn-lg btn-outline-secondary font-weight-bold"
                        style="border-radius: 8px; padding: 12px 30px;">
                        <i class="fas fa-shopping-bag mr-2"></i> Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>