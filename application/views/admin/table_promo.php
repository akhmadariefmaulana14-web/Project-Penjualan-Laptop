<div class="container-fluid">

    <h1 class="h3 mb-4 font-weight-bold" style="color:#224abe !important;">Data Promo</h1>

    <?php if ($this->session->flashdata('msg')) : ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded" role="alert">
        <strong>Success!</strong> <?= $this->session->flashdata('msg') ?>
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    <?php endif ?>

    <div class="card shadow-sm border-0 rounded-lg">

        <div class="card-header text-white d-flex justify-content-between align-items-center rounded-top"
            style="background: linear-gradient(135deg, #4e73df, #224abe) !important;">
            <h6 class="mb-0 font-weight-bold">List Kode Promo</h6>
            <button class="btn btn-light btn-sm font-weight-bold rounded-pill text-primary" data-toggle="modal"
                data-target="#tambahModal">
                <i class="fas fa-plus"></i> Tambah Data
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="dataTable">

                    <thead style="background:#e6f2ff !important;" class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Kode Promo</th>
                            <th>Nilai (%)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $n = 1; foreach ($promo as $key) : ?>
                        <tr>
                            <td class="text-center align-middle"><?= $n++ ?></td>
                            <td class="align-middle font-weight-bold"><?= htmlspecialchars($key->kode_promo) ?></td>
                            <td class="text-center align-middle">
                                <span
                                    style="background:#e6f2ff !important;color:#224abe !important;padding:5px 12px;border-radius:20px;font-weight:600;">
                                    <?= htmlspecialchars($key->nilai) ?>%
                                </span>
                            </td>

                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center">

                                    <button class="btn btn-sm text-white rounded-pill mr-2"
                                        style="background: linear-gradient(135deg, #36b9cc, #258391) !important; border:none;"
                                        data-toggle="modal" data-target="#editModal<?= $key->id_promo ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    <a class="btn btn-sm text-white rounded-pill"
                                        style="background: linear-gradient(135deg, #ff4d4f, #d63031) !important; border:none;"
                                        href="<?= site_url('promo/delete_promo/' . $key->id_promo) ?>"
                                        onclick="return confirm('Yakin ingin menghapus promo ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>

                                </div>
                            </td>
                        </tr>
                        <?php endforeach ?>

                        <?php if (empty($promo)) : ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Tidak ada data promo.
                            </td>
                        </tr>
                        <?php endif ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>


<div class="modal fade" id="tambahModal">
    <div class="modal-dialog">
        <div class="modal-content border-0 rounded-lg shadow-sm">

            <div class="modal-header text-white" style="background: linear-gradient(135deg, #4e73df, #224abe) !important;">
                <h5 class="modal-title font-weight-bold">Tambah Kode Promo</h5>
                <button class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="POST" action="<?= site_url('promo/add_promo') ?>">
                <div class="modal-body">

                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                        value="<?= $this->security->get_csrf_hash() ?>">

                    <div class="form-group">
                        <label>Kode Promo</label>
                        <input type="text" name="kode_promo" class="form-control" placeholder="Contoh: DISKON10"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Nilai (%)</label>
                        <input type="number" name="nilai" class="form-control" placeholder="Contoh: 10" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm rounded-pill" data-dismiss="modal">Batal</button>
                    <button class="btn btn-sm text-white rounded-pill px-4"
                        style="background: linear-gradient(135deg, #4e73df, #224abe) !important; border:none;">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


<?php foreach ($promo as $key) : ?>
<div class="modal fade" id="editModal<?= $key->id_promo ?>">
    <div class="modal-dialog">
        <div class="modal-content border-0 rounded-lg shadow-sm">

            <div class="modal-header text-white" style="background: linear-gradient(135deg, #4e73df, #224abe) !important;">
                <h5 class="modal-title font-weight-bold">Edit Kode Promo</h5>
                <button class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="POST" action="<?= site_url('promo/edit_promo') ?>">
                <div class="modal-body">

                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                        value="<?= $this->security->get_csrf_hash() ?>">

                    <input type="hidden" name="id_promo" value="<?= $key->id_promo ?>">

                    <div class="form-group">
                        <label>Kode Promo</label>
                        <input type="text" name="kode_promo" class="form-control"
                            value="<?= htmlspecialchars($key->kode_promo) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Nilai (%)</label>
                        <input type="number" name="nilai" class="form-control"
                            value="<?= htmlspecialchars($key->nilai) ?>" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm rounded-pill" data-dismiss="modal">Batal</button>
                    <button class="btn btn-sm text-white rounded-pill px-4"
                        style="background: linear-gradient(135deg, #4e73df, #224abe) !important; border:none;">
                        Update
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php endforeach ?>