<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 font-weight-bold" style="color:#ff6600;">Upload Bukti Pembayaran</h1>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded" role="alert">
            <strong>Gagal!</strong> <?= $this->session->flashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    <?php endif ?>

    <div class="row">
        <!-- Info Transaksi -->
        <div class="col-lg-5 mb-4">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header text-white rounded-top"
                    style="background: linear-gradient(135deg, #ff9933, #ff6600);">
                    <h6 class="mb-0 font-weight-bold"><i class="fas fa-info-circle mr-2"></i>Detail Transaksi</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td class="font-weight-bold" style="width:40%;">Nama User</td>
                            <td>: <?= htmlspecialchars($transaksi->nama_user); ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Merk Laptop</td>
                            <td>: <?= htmlspecialchars($transaksi->nama_merk); ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Jenis Laptop</td>
                            <td>: <?= htmlspecialchars($transaksi->jenis_laptop); ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Qty</td>
                            <td>: <?= htmlspecialchars($transaksi->jumlah); ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Tgl. Transaksi</td>
                            <td>: <?= date('d F Y', strtotime($transaksi->tgl_transaksi)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Form Upload -->
        <div class="col-lg-7 mb-4">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header text-white rounded-top"
                    style="background: linear-gradient(135deg, #ff9933, #ff6600);">
                    <h6 class="mb-0 font-weight-bold"><i class="fas fa-upload mr-2"></i>Pilih Gambar Bukti Transfer</h6>
                </div>

                <div class="card-body">
                    <?= form_open_multipart('user/proses_upload_bukti/' . $transaksi->id_transaksi); ?>

                    <div class="form-group">
                        <label class="font-weight-bold">Bukti Transfer</label>
                        <input type="file" name="bukti" class="form-control-file border rounded p-2" accept="image/*"
                            required>
                        <small class="text-muted mt-1 d-block">Format: JPG, PNG, GIF (Maksimal 2MB)</small>
                    </div>

                    <!-- Preview Gambar -->
                    <div class="form-group">
                        <label class="font-weight-bold">Preview</label>
                        <div id="preview" class="border rounded p-3 text-center"
                            style="min-height: 150px; background:#f8f9fa;">
                            <span class="text-muted"><i class="fas fa-image fa-2x"></i><br>Belum ada
                                gambar</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-secondary rounded-pill px-4">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn text-white rounded-pill px-4"
                            style="background: linear-gradient(135deg, #28a745, #20c997); border:none;">
                            <i class="fas fa-upload mr-1"></i> Upload Sekarang
                        </button>
                    </div>

                    <?= form_close(); ?>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Script Preview Gambar -->
<script>
    $('input[name="bukti"]').change(function (e) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#preview').html('<img src="' + e.target.result + '" class="img-thumbnail" style="max-height:250px;">');
        }
        reader.readAsDataURL(this.files[0]);
    });
</script>