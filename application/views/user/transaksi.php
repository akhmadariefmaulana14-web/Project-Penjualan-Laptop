<div class="container-fluid">

    <h1 class="h3 mb-4 font-weight-bold" style="color:#ff6600;">Data Transaksi</h1>

    <?php if ($this->session->flashdata('msg')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded" role="alert">
            <strong>Success!</strong> <?= $this->session->flashdata('msg') ?>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    <?php endif ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded" role="alert">
            <strong>Error!</strong> <?= $this->session->flashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    <?php endif ?>

    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header text-white d-flex justify-content-between align-items-center rounded-top"
            style="background: linear-gradient(135deg, #ff9933, #ff6600);">
            <h6 class="mb-0 font-weight-bold">List Transaksi</h6>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="dataTable">

                    <thead style="background:#fff3e6;" class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Tgl. Transaksi</th>
                            <th>Nama</th>
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
                        <?php
                        $n = 1;
                        $last_id = null;
                        foreach ($transaksi as $key):
                            ?>
                            <tr style="transition:0.2s;">
                                <td class="text-center align-middle"><?= $n++ ?></td>
                                <td class="align-middle"><?= date('d F Y', strtotime($key->tgl_transaksi)); ?></td>
                                <td class="align-middle"><?= htmlspecialchars($key->nama_user) ?></td>
                                <td class="text-center align-middle"><?= htmlspecialchars($key->nama_merk) ?></td>
                                <td class="align-middle"><?= htmlspecialchars($key->jenis_laptop) ?></td>
                                <td class="text-center align-middle"><?= htmlspecialchars($key->jumlah) ?></td>

                                <td class="text-center align-middle">
                                    <?php if ($last_id != $key->id_transaksi): ?>
                                        <?php if (!empty($key->bukti_bayar) && !empty($key->metode_pembayaran)): ?>
                                            <span class="badge badge-primary"><?= $key->metode_pembayaran ?></span>
                                        <?php else: ?>
                                            <span class="text-muted" style="font-size:13px;">Belum dipilih</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>

                                
                                <td class="text-center align-middle">
                                    <?php if ($last_id != $key->id_transaksi): ?>
                                        <?php if (!empty($key->bukti_bayar)): ?>
                                            <a href="#" data-toggle="modal" data-target="#modalBukti<?= $key->id_transaksi; ?>">
                                                <img src="<?= base_url('assets/uploads/bukti/' . $key->bukti_bayar); ?>"
                                                    class="img-thumbnail" width="80">
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">Belum Diupload</span>
                                        <?php endif; ?>
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
                                            Belum Dikonfirmasi
                                        </span>
                                    <?php endif ?>
                                </td>

                                <td class="text-center align-middle">
                                    <?php if ($last_id != $key->id_transaksi): ?>
                                        <div class="d-flex justify-content-center align-items-center" style="gap: 8px;">
                                            <?php if ($key->status != 'Y'): ?>
                                                <?php if (!empty($key->bukti_bayar)): ?>
                                                    <button type="button" class="btn btn-sm btn-warning rounded-pill" style="min-width: 85px;" onclick="bukaModalBayar(
                                                         '<?= $key->id_transaksi ?>',
                                                         '<?= htmlspecialchars(addslashes($key->nama_user)) ?>',
                                                         '<?= htmlspecialchars(addslashes($key->jenis_laptop)) ?>'
                                                     )">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                <?php else: ?>
                                                    <button type="button" class="btn btn-sm btn-success rounded-pill" style="min-width: 85px;" onclick="bukaModalBayar(
                                                         '<?= $key->id_transaksi ?>',
                                                         '<?= htmlspecialchars(addslashes($key->nama_user)) ?>',
                                                         '<?= htmlspecialchars(addslashes($key->jenis_laptop)) ?>'
                                                     )">
                                                        <i class="fas fa-credit-card"></i> Bayar
                                                    </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            
                                            <button type="button" class="btn btn-sm btn-danger rounded-pill" style="min-width: 85px;" onclick="bukaModalHapus(
                                                <?= $key->id_transaksi ?>,
                                                '<?= htmlspecialchars(addslashes($key->nama_user)) ?>',
                                                '<?= htmlspecialchars(addslashes($key->jenis_laptop)) ?>'
                                            )">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <?php
                            $last_id = $key->id_transaksi;
                        endforeach;
                        ?>

                        <?php if (empty($transaksi)): ?>
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">
                                    Tidak ada data transaksi.
                                </td>
                            </tr>
                        <?php endif ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <?php foreach ($transaksi as $key): ?>
        <?php if (!empty($key->bukti_bayar)): ?>
            <div class="modal fade" id="modalBukti<?= $key->id_transaksi; ?>" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Bukti Pembayaran - <?= $key->nama_user; ?></h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="<?= base_url('assets/uploads/bukti/' . $key->bukti_bayar); ?>" class="img-fluid"
                                style="max-height: 500px;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <div class="modal fade" id="modalBayar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-lg border-0 shadow-lg" style="border-left:5px solid #00a65a !important;">
                <div class="modal-header" style="background:linear-gradient(135deg,#00a65a,#00c853);color:white;">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-credit-card mr-2"></i>Pembayaran</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body p-4">
                    <div class="bg-light rounded-lg p-3 mb-4" style="font-size:14px;">
                        <span class="text-muted">Nama:</span> <strong id="bayarNama">-</strong><br>
                        <span class="text-muted">Produk:</span> <strong id="bayarProduk">-</strong>
                    </div>

                    <form action="<?= base_url('user/proses_bayar') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                            value="<?= $this->security->get_csrf_hash() ?>">
                        <input type="hidden" name="id_transaksi" id="bayarIdTransaksi" value="">

                        <div class="form-group">
                            <label class="font-weight-bold">Metode Pembayaran</label>
                            <select class="form-control" name="metode_pembayaran" id="pilihMetode"
                                onchange="gantiMetode()">
                                <option value="">-- Pilih Metode --</option>
                                
                                <?php if (!empty($qris) && $qris->qris_image): ?>
                                <option value="QRIS">QRIS</option>
                                <?php endif; ?>

                                <?php if (!empty($banks)): ?>
                                <option value="Transfer">Transfer Bank</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <?php if (!empty($qris) && $qris->qris_image): ?>
                        <div class="d-none mb-3" id="areaQRIS">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white py-2">
                                    <i class="fas fa-qrcode mr-1"></i> Scan QRIS
                                </div>
                                <div class="card-body text-center p-3">
                                    <img src="<?= base_url('uploads/qris/' . $qris->qris_image) ?>" alt="QRIS" class="img-fluid" style="max-width:200px;">
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($banks)): ?>
                        <div class="d-none mb-3" id="areaTransfer">
                            <div class="card border-info">
                                <div class="card-header py-2" style="background:#0891b2;color:white;">
                                    <i class="fas fa-university mr-1"></i> Transfer Bank
                                </div>
                                <div class="card-body p-3">
                                    <?php 
                                    $bg_colors = ['#f0f8ff', '#fff8f0', '#fff5f5', '#f8fff0', '#f5f0ff'];
                                    $i = 0;
                                    foreach ($banks as $bank): 
                                        $bg = $bg_colors[$i % count($bg_colors)];
                                    ?>
                                    
                                    <div class="p-2 mb-2 rounded" style="background:<?= $bg ?>;">
                                        <strong class="text-primary"><?= htmlspecialchars($bank->bank_name) ?></strong> a.n. <?= htmlspecialchars($bank->account_holder ?: '-') ?><br>
                                        <span class="font-weight-bold" style="font-size:16px;"><?= htmlspecialchars($bank->account_number ?: '-') ?></span>
                                        <button type="button" class="btn btn-outline-primary btn-sm ml-2"
                                            onclick="salinRek('<?= htmlspecialchars($bank->account_number) ?>', this)">
                                            <i class="fas fa-copy"></i> Salin
                                        </button>
                                    </div>
                                    
                                    <?php $i++; endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label class="font-weight-bold">Upload Bukti Pembayaran</label>
                            <input type="file" name="bukti_bayar" class="form-control-file" accept="image/*" required>
                            <small class="text-muted">Format: JPG, PNG (Maks. 2MB)</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-light rounded-pill px-4"
                                data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success rounded-pill px-4"><i
                                    class="fas fa-check mr-1"></i>Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-lg border-0 shadow-lg" style="border-left:5px solid #ff4d4f !important;">
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
                    <?php echo form_open('user/hapus_transaksi'); ?>
                    <input type="hidden" name="id_hapus" id="inputIdHapus" value="">
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light rounded-pill px-4"
                            data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                            <i class="fas fa-trash-alt"></i> Ya, Hapus
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function bukaModalBayar(id, nama, produk) {
            document.getElementById('bayarIdTransaksi').value = id;
            document.getElementById('bayarNama').textContent = nama;
            document.getElementById('bayarProduk').textContent = produk;
            document.getElementById('pilihMetode').value = '';
            var areaQRIS = document.getElementById('areaQRIS');
            var areaTransfer = document.getElementById('areaTransfer');
            
            if (areaQRIS) areaQRIS.classList.add('d-none');
            if (areaTransfer) areaTransfer.classList.add('d-none');

            $('#modalBayar').modal('show');
        }

        function gantiMetode() {
            var val = document.getElementById('pilihMetode').value;
            
            var areaQRIS = document.getElementById('areaQRIS');
            var areaTransfer = document.getElementById('areaTransfer');
            
            if(areaQRIS) areaQRIS.classList.add('d-none');
            if(areaTransfer) areaTransfer.classList.add('d-none');

            if (val == 'QRIS' && areaQRIS) {
                areaQRIS.classList.remove('d-none');
            } else if (val == 'Transfer' && areaTransfer) {
                areaTransfer.classList.remove('d-none');
            }
        }

        function salinRek(nomor, btn) {
            navigator.clipboard.writeText(nomor).then(function () {
                var original = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i> Tersalin';
                btn.classList.replace('btn-outline-primary', 'btn-success');
                setTimeout(function () {
                    btn.innerHTML = original;
                    btn.classList.replace('btn-success', 'btn-outline-primary');
                }, 1500);
            });
        }

        function bukaModalHapus(id, nama, produk) {
            document.getElementById('previewNama').textContent = nama;
            document.getElementById('previewProduk').textContent = produk;
            document.getElementById('inputIdHapus').value = id;
            $('#deleteModal').modal('show');
        }
    </script>

</div>