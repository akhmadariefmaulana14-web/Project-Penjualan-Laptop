<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 font-weight-bold text-dark">Data Ongkir</h1>

    <!-- Alert -->
    <?php if ($this->session->flashdata('msg')) : ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <strong>Sukses!</strong> <?= $this->session->flashdata('msg') ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php endif; ?>

    <!-- Card -->
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header d-flex justify-content-between align-items-center"
            style="background: linear-gradient(135deg, #ff7a00, #ff5500); color:white;">
            <h6 class="mb-0 font-weight-bold">List Ongkir</h6>
            <button class="btn btn-light btn-sm rounded-pill" data-toggle="modal" data-target="#tambahModal">
                <i class="fas fa-plus"></i> Tambah Data
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="dataTable">
                    <thead style="background:#fff3e6;" class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Kurir</th>
                            <th>Kota Asal</th>
                            <th>Kota Tujuan</th>
                            <th>Biaya</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; foreach ($ongkir as $key): ?>
                        <tr class="text-center align-middle">
                            <td><?= $n++ ?></td>
                            <td><?= htmlspecialchars($key->nama_kurir) ?></td>
                            <td><?= htmlspecialchars($key->kota_asal) ?></td>
                            <td><?= htmlspecialchars($key->kota_tujuan) ?></td>
                            <td class="text-danger font-weight-bold">Rp <?= number_format($key->biaya, 0, ',', '.') ?>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning rounded-pill mr-1" data-toggle="modal"
                                    data-target="#editModal<?= $key->id_ongkir ?>">Edit</button>
                                <a href="<?= site_url('jasakirim/delete_ongkir/' . $key->id_ongkir) ?>"
                                    class="btn btn-sm btn-danger rounded-pill"
                                    onclick="return confirm('Yakin ingin menghapus ongkir ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($ongkir)) : ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">Tidak ada data ongkir.</td>
                        </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL TAMBAH ================= -->
<div class="modal fade" id="tambahModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header" style="background: linear-gradient(135deg, #ff7a00, #ff5500); color:white;">
                <h5 class="modal-title">Tambah Ongkir</h5>
                <button class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <form action="<?= site_url('jasakirim/add_ongkir') ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                        value="<?= $this->security->get_csrf_hash() ?>">

                    <div class="form-group">
                        <label>Nama Kurir</label>
                        <select name="id_kurir" class="form-control" required>
                            <?php foreach ($kurir as $k): ?>
                            <option value="<?= $k->id_kurir ?>"><?= $k->nama_kurir ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kota Asal</label>
                        <select name="id_kota_asal" class="form-control" required>
                            <?php foreach ($kota as $k): ?>
                            <option value="<?= $k->id_kota ?>"><?= $k->nama_kota ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kota Tujuan</label>
                        <select name="id_kota_tujuan" class="form-control" required>
                            <?php foreach ($kota as $k): ?>
                            <option value="<?= $k->id_kota ?>"><?= $k->nama_kota ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Biaya (Rp)</label>
                        <input type="number" class="form-control" name="biaya" placeholder="Contoh: 15000" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button class="btn btn-warning btn-sm text-white rounded-pill">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================= MODAL EDIT ================= -->
<?php foreach ($ongkir as $key): ?>
<div class="modal fade" id="editModal<?= $key->id_ongkir ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header" style="background: linear-gradient(135deg, #ff7a00, #ff5500); color:white;">
                <h5 class="modal-title">Edit Ongkir</h5>
                <button class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <form action="<?= site_url('jasakirim/ongkir_save_edit') ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                        value="<?= $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="id_ongkir" value="<?= $key->id_ongkir ?>">

                    <div class="form-group">
                        <label>Nama Kurir</label>
                        <select name="id_kurir" class="form-control" required>
                            <?php foreach ($kurir as $k): ?>
                            <option value="<?= $k->id_kurir ?>" <?= $k->id_kurir == $key->id_kurir ? 'selected' : '' ?>>
                                <?= $k->nama_kurir ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kota Asal</label>
                        <select name="id_kota_asal" class="form-control" required>
                            <?php foreach ($kota as $k): ?>
                            <option value="<?= $k->id_kota ?>"
                                <?= $k->id_kota == $key->id_kota_asal ? 'selected' : '' ?>>
                                <?= $k->nama_kota ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kota Tujuan</label>
                        <select name="id_kota_tujuan" class="form-control" required>
                            <?php foreach ($kota as $k): ?>
                            <option value="<?= $k->id_kota ?>"
                                <?= $k->id_kota == $key->id_kota_tujuan ? 'selected' : '' ?>>
                                <?= $k->nama_kota ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Biaya (Rp)</label>
                        <input type="number" name="biaya" class="form-control" value="<?= $key->biaya ?>" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button class="btn btn-warning btn-sm text-white rounded-pill">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach ?>
