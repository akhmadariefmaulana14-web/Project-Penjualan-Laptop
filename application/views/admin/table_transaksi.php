<div class="container-fluid">

    <h1 class="h3 mb-4 font-weight-bold" style="color:#224abe !important;">Data Transaksi</h1>

    <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded" role="alert">
            <strong>Success!</strong> <?= $this->session->flashdata('msg') ?>
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    <?php endif ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded" role="alert">
            <strong>Error!</strong> <?= $this->session->flashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    <?php endif ?>

    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header text-white d-flex justify-content-between align-items-center rounded-top"
            style="background: linear-gradient(135deg, #4e73df, #224abe) !important;">
            <h6 class="mb-0 font-weight-bold text-white">List Transaksi</h6>
            
            <a href="<?= site_url('transaksi/cetak_pdf') ?>" target="_blank" class="btn btn-sm btn-light rounded-pill font-weight-bold text-primary shadow-sm" style="transition: 0.3s;">
                <i class="fas fa-file-pdf text-danger"></i> Cetak Laporan PDF
            </a>
            </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="dataTable">
                    <thead style="background:#e6f2ff !important;" class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Tgl. Transaksi</th>
                            <th>Nama User</th>
                            <th>Merk Laptop</th>
                            <th>Jenis Laptop</th>
                            <th>Qty</th>
                            <th>Metode Pembayaran</th>
                            <th>Bukti Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $n = 1;
                        foreach ($transaksi as $key): ?>
                            <tr style="transition:0.2s;">
                                <td class="text-center align-middle"><?= $n++ ?></td>
                                <td class="align-middle"><?= date('d F Y', strtotime($key->tgl_transaksi)); ?></td>
                                <td class="align-middle"><?= htmlspecialchars($key->nama_user) ?></td>
                                <td class="align-middle text-center"><?= htmlspecialchars($key->nama_merk) ?></td>
                                <td class="align-middle"><?= htmlspecialchars($key->jenis_laptop) ?></td>
                                <td class="text-center align-middle"><?= htmlspecialchars($key->jumlah) ?></td>

                                <td class="text-center align-middle">
                                    <?php
                                    // Mencegah error Undefined property dengan mengecek apakah datanya ada
                                    $metode = isset($key->metode_pembayaran) ? $key->metode_pembayaran : '-';
                                    
                                    if ($metode == 'Transfer') {
                                        echo '<span style="background:#e6f0ff;color:#0066cc;padding:6px 12px;border-radius:20px;font-weight:600;">Transfer Bank</span>';
                                    } elseif ($metode == 'QRIS') {
                                        echo '<span style="background:#e6fff2;color:#00a65a;padding:6px 12px;border-radius:20px;font-weight:600;">QRIS</span>';
                                    } else {
                                        echo '<span style="background:#f5f5f5;color:#999;padding:6px 12px;border-radius:20px;font-weight:600;">' . htmlspecialchars($metode) . '</span>';
                                    }
                                    ?>
                                </td>

                                <td class="text-center align-middle">
                                    <?php if (!empty($key->bukti_bayar)): ?>
                                        <a href="#" data-toggle="modal" data-target="#modalBukti<?= $key->id_transaksi; ?>">
                                            <img src="<?= base_url('assets/uploads/bukti/' . $key->bukti_bayar); ?>"
                                                class="img-thumbnail" width="80" height="80" style="cursor:pointer;">
                                        </a>
                                    <?php else: ?>
                                        <span class="text-danger font-weight-bold">Kosong</span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center align-middle">
                                    <?php if ($key->status == 'Y'): ?>
                                        <span
                                            style="background:#e6fff2;color:#00a65a;padding:6px 12px;border-radius:20px;font-weight:600;">
                                            Sudah Dikonfirmasi
                                        </span>
                                    <?php else: ?>
                                        <span
                                            style="background:#ffecec;color:#ff4d4f;padding:6px 12px;border-radius:20px;font-weight:600;">
                                            Belum DiKonfirmasi
                                        </span>
                                    <?php endif ?>
                                </td>

                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-center gap-2">
                                        
                                        <?php
                                            $no_hp = isset($key->no_hp) ? $key->no_hp : ''; 
                                            
                                            if (substr($no_hp, 0, 1) == '0') {
                                                $no_hp = '62' . substr($no_hp, 1);
                                            }
                                            
                                            $pesan = "Halo kak " . $key->nama_user . ", terimakasih sudah memesan laptop " . $key->nama_merk . " di website kami. Pesanan Anda sedang kami proses.";
                                        ?>
                                        <a class="btn btn-sm text-white rounded-pill"
                                            style="background: linear-gradient(135deg, #25D366, #128C7E); border:none; white-space: nowrap;"
                                            href="https://wa.me/<?= $no_hp ?>?text=<?= urlencode($pesan) ?>" 
                                            target="_blank"
                                            title="Hubungi Customer">
                                            <i class="fab fa-whatsapp"></i> WA
                                        </a>

                                        <?php if ($key->status == 'N'): ?>
                                            <a class="btn btn-sm text-white rounded-pill"
                                                style="background: linear-gradient(135deg, #28a745, #20c997); border:none; white-space: nowrap;"
                                                href="<?= site_url('transaksi/status_transaksi/' . $key->id_transaksi) ?>"
                                                onclick="return confirm('Tandai sebagai sudah dibayar?')">
                                                <i class="fas fa-check"></i> Konfirmasi
                                            </a>
                                        <?php else: ?>
                                            <a class="btn btn-sm text-white rounded-pill"
                                                style="background: linear-gradient(135deg, #6c757d, #495057); border:none; white-space: nowrap;"
                                                href="<?= site_url('transaksi/status_transaksi/' . $key->id_transaksi) ?>"
                                                onclick="return confirm('Ubah ke belum dibayar?')">
                                                <i class="fas fa-undo"></i> Batal
                                            </a>
                                        <?php endif ?>

                                        <button type="button" class="btn btn-sm btn-danger rounded-pill"
                                            style="white-space: nowrap;" onclick="bukaModalHapus(
                                            <?= $key->id_transaksi ?>,
                                            '<?= htmlspecialchars(addslashes($key->nama_user)) ?>',
                                            '<?= htmlspecialchars(addslashes($key->jenis_laptop)) ?>'
                                        )">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if (empty($transaksi)): ?>
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">Tidak ada data transaksi.</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>

            <?php foreach ($transaksi as $key): ?>
                <?php if (!empty($key->bukti_bayar)): ?>
                    <div class="modal fade" id="modalBukti<?= $key->id_transaksi; ?>" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header" style="background: linear-gradient(135deg, #4e73df, #224abe) !important;">
                                    <h5 class="modal-title text-white">Bukti Pembayaran - <?= $key->nama_user; ?></h5>
                                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="<?= base_url('assets/uploads/bukti/' . $key->bukti_bayar); ?>"
                                        class="img-fluid" style="max-height: 500px;">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-lg border-0 shadow-lg" style="border-left: 5px solid #ff4d4f !important;">
                <div class="modal-body p-4">
                    <div class="text-center mb-3">
                        <div
                            style="width:64px;height:64px;border-radius:50%;background:#ffecec;display:inline-flex;align-items:center;justify-content:center;">
                            <i class="fas fa-trash-alt fa-2x" style="color:#ff4d4f;"></i>
                        </div>
                    </div>
                    <h5 class="text-center font-weight-bold mb-2">Hapus Transaksi?</h5>
                    <p class="text-center text-muted mb-3" style="font-size:14px;">Data yang dihapus tidak dapat
                        dikembalikan.</p>

                    <div class="bg-light rounded-lg p-3 mb-4" style="font-size:14px;">
                        <span class="text-muted">Nama:</span> <strong id="previewNama">-</strong><br>
                        <span class="text-muted">Laptop:</span> <strong id="previewProduk">-</strong>
                    </div>

                    <?php echo form_open('admin/hapus_transaksi'); ?>
                    <input type="hidden" name="id_hapus" id="inputIdHapus" value="">
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light rounded-pill px-4"
                            data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                            <i class="fas fa-trash-alt"></i> Ya, Hapus
                        </button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function bukaModalHapus(id, nama, produk) {
            document.getElementById('previewNama').textContent = nama;
            document.getElementById('previewProduk').textContent = produk;
            document.getElementById('inputIdHapus').value = id;
            $('#deleteModal').modal('show');
        }

        function tutupModal() {
            $('#deleteModal').modal('hide');
            document.getElementById('inputIdHapus').value = '';
        }
    </script>

</div>