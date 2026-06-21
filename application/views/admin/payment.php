<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-credit-card text-primary mr-2"></i>Metode Pembayaran
    </h1>
</div>

<!-- Alert Sukses -->
<?php if ($success): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-2"></i><?= $success ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
<?php endif; ?>

<!-- Alert Error -->
<?php if ($error): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle mr-2"></i><?= $error ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
<?php endif; ?>



<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-university mr-2"></i>Transfer Bank
        </h6>
        <span class="badge badge-secondary">Klik Simpan untuk update</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th width="40">No</th>
                        <th width="160">Nama Bank</th>
                        <th width="200">Nomor Rekening</th>
                        <th>Atas Nama</th>
                        <th width="110">Status</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($payments as $p): ?>
                        <?php if ($p->payment_type === 'bank_transfer'): ?>

                            <?= form_open('admin/payment/update_bank/' . $p->id) ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td>
                                    <select name="bank_name" class="form-control form-control-sm">
                                        <?php
                                        $banks = ['BCA', 'BRI', 'Mandiri', 'BNI', 'BSI', 'CIMB', 'Danamon', 'Permata'];
                                        foreach ($banks as $b) {
                                            $selected = ($p->bank_name == $b) ? 'selected' : '';
                                            echo '<option value="' . $b . '" ' . $selected . '>' . $b . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="account_number" value="<?= $p->account_number ?>"
                                        class="form-control form-control-sm" placeholder="Contoh: 1234567890">
                                </td>
                                <td>
                                    <input type="text" name="account_holder" value="<?= $p->account_holder ?>"
                                        class="form-control form-control-sm" placeholder="Contoh: PT Toko Jaya">
                                </td>
                                <td class="text-center">
                                    <a href="<?= site_url('admin/payment/toggle_status/' . $p->id) ?>"
                                        class="btn btn-sm btn-icon <?= $p->is_active ? 'btn-success' : 'btn-secondary' ?>"
                                        title="<?= $p->is_active ? 'Aktif, klik untuk nonaktifkan' : 'Nonaktif, klik untuk aktifkan' ?>">
                                        <?= $p->is_active ? '<i class="fas fa-check"></i> Aktif' : '<i class="fas fa-times"></i> Off' ?>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <button type="submit" class="btn btn-sm btn-warning" title="Simpan perubahan">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                </td>
                            </tr>
                            <?= form_close() ?>

                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            <small class="text-muted"><i class="fas fa-info-circle mr-1"></i>Ubah data pada baris lalu klik "Simpan"
                untuk menyimpan per rekening.</small>
        </div>
    </div>
</div>


<?php foreach ($payments as $p): ?>
    <?php if ($p->payment_type === 'qris'): ?>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-dark">
                    <i class="fas fa-qrcode mr-2"></i>Pembayaran QRIS
                </h6>
                <a href="<?= site_url('admin/payment/toggle_status/' . $p->id) ?>"
                    class="btn btn-sm <?= $p->is_active ? 'btn-success' : 'btn-secondary' ?>">
                    <?= $p->is_active ? '<i class="fas fa-check mr-1"></i>Aktif' : '<i class="fas fa-times mr-1"></i>Nonaktif' ?>
                </a>
            </div>
            <div class="card-body">
                <div class="row">

                    <!-- Kolom Kiri: Preview Gambar -->
                    <div class="col-lg-4 mb-3">
                        <label class="font-weight-bold mb-2">Gambar QRIS Saat Ini</label>
                        <div class="border rounded p-3 bg-light d-flex align-items-center justify-content-center"
                            style="min-height: 260px;">
                            <?php if ($p->qris_image): ?>
                                <img src="<?= base_url('uploads/qris/' . $p->qris_image) ?>" alt="QRIS" class="img-fluid"
                                    style="max-height: 240px;" id="qris_preview_img">
                            <?php else: ?>
                                <div class="text-center text-muted">
                                    <i class="fas fa-image fa-3x mb-2 d-block" style="opacity:0.3;"></i>
                                    <span>Belum ada gambar</span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($p->qris_image): ?>
                            <a href="<?= site_url('admin/payment/remove_qris/' . $p->id) ?>"
                                class="btn btn-sm btn-outline-danger mt-3 w-100"
                                onclick="return confirm('Yakin hapus gambar QRIS ini?')">
                                <i class="fas fa-trash mr-1"></i> Hapus Gambar
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Kolom Kanan: Form Upload -->
                    <div class="col-lg-8">
                        <?= form_open_multipart('admin/payment/update_qris/' . $p->id) ?>

                        <div class="form-group">
                            <label class="font-weight-bold">Upload Gambar QRIS Baru</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="qris_image" id="qris_image" accept="image/*"
                                    onchange="previewQRIS(this)">
                                <label class="custom-file-label" for="qris_image">Pilih file gambar...</label>
                            </div>
                            <small class="form-text text-muted">
                                Format: JPG, PNG, GIF, WebP &mdash; Ukuran maksimal 2MB
                            </small>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-upload mr-2"></i>Upload & Simpan QRIS
                            </button>
                        </div>

                        <div class="alert alert-info mt-4 mb-0">
                            <i class="fas fa-info-circle mr-2"></i>
                            <strong>Catatan:</strong> Gambar lama akan otomatis terganti saat upload gambar baru.
                            Pastikan gambar QRIS jelas dan mudah discan oleh customer.
                        </div>

                        <?= form_close() ?>
                    </div>

                </div>
            </div>
        </div>

    <?php endif; ?>
<?php endforeach; ?>



<script>
    // Preview gambar QRIS sebelum upload
    function previewQRIS(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var previewContainer = input.closest('.col-lg-8').previousElementSibling;
                var preview = document.getElementById('qris_preview_img');

                if (!preview) {
                    previewContainer.innerHTML = '<img src="" alt="QRIS" class="img-fluid" style="max-height: 240px;" id="qris_preview_img">';
                    preview = document.getElementById('qris_preview_img');
                }
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0])
            var label = input.nextElementSibling;
            if (label && input.files.length > 0) {
                label.textContent = input.files[0].name;
            }
        }
    }

    document.querySelectorAll('form').forEach(function (form) {
        var action = form.getAttribute('action');
        if (action && action.indexOf('update_bank') !== -1) {
            form.addEventListener('submit', function (e) {
                if (!confirm('Simpan perubahan rekening ini?')) {
                    e.preventDefault();
                }
            });
        }
    });
</script>