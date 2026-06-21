<div class="container-fluid">

    <h1 class="h3 mb-4 font-weight-bold text-dark">Data Merk Laptop</h1>

    <?php if ($this->session->flashdata('msg')) : ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <strong>Success!</strong> <?= $this->session->flashdata('msg') ?>
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    <?php endif ?>

    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header d-flex justify-content-between align-items-center"
            style="background: linear-gradient(135deg, #4e73df, #224abe) !important; color:white !important;">
            <h6 class="mb-0 font-weight-bold">List Merk Laptop</h6>

            <button type="button" class="btn btn-light btn-sm rounded-pill" data-toggle="modal"
                data-target="#tambahModal">
                <i class="fas fa-plus text-primary"></i> Tambah Data
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="dataTable">
                    <thead style="background:#e6f2ff !important;" class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Merk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $n = 1; foreach ($laptop as $key) : ?>
                        <tr>
                            <td class="text-center align-middle"><?= $n++ ?></td>

                            <td class="align-middle font-weight-bold">
                                <?= htmlspecialchars($key->nama_merk) ?>
                            </td>

                            <td class="text-center align-middle">
                                <button type="button" class="btn btn-sm btn-primary rounded-pill mr-1"
                                    data-toggle="modal" data-target="#editModal<?= $key->id_merk ?>">
                                    Edit
                                </button>

                                <a href="<?= site_url('laptop/merk_delete/' . $key->id_merk) ?>"
                                    class="btn btn-sm btn-danger rounded-pill"
                                    onclick="return confirm('Yakin hapus merk ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach ?>

                        <?php if (empty($laptop)) : ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">
                                Tidak ada data merk
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
        <div class="modal-content">

            <div class="modal-header" style="background: linear-gradient(135deg, #4e73df, #224abe) !important; color:white !important;">
                <h5 class="modal-title">Tambah Merk Laptop</h5>
                <button class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" action="<?= site_url('laptop/merk_add') ?>">
                <div class="modal-body">

                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                        value="<?= $this->security->get_csrf_hash() ?>">

                    <div class="form-group">
                        <label>Nama Merk</label>
                        <input type="text" name="nama_merk" class="form-control" placeholder="Contoh: ASUS, Acer"
                            required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary btn-sm text-white">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($laptop as $key) : ?>
<div class="modal fade" id="editModal<?= $key->id_merk ?>">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header" style="background: linear-gradient(135deg, #4e73df, #224abe) !important; color:white !important;">
                <h5 class="modal-title">Edit Merk Laptop</h5>
                <button class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" action="<?= site_url('laptop/merk_save_edit') ?>">
                <div class="modal-body">

                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                        value="<?= $this->security->get_csrf_hash() ?>">

                    <input type="hidden" name="id_merk" value="<?= $key->id_merk ?>">

                    <div class="form-group">
                        <label>Nama Merk</label>
                        <input type="text" name="nama_merk" class="form-control"
                            value="<?= htmlspecialchars($key->nama_merk) ?>" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary btn-sm text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach ?>