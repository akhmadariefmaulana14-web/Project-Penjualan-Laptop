<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 font-weight-bold text-dark">Data Kota</h1>

    <!-- Alert -->
    <?php if ($this->session->flashdata('msg')) : ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <strong>Success!</strong> <?= $this->session->flashdata('msg') ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php endif ?>

    <!-- Card -->
    <div class="card shadow-sm border-0 rounded-lg col-lg-8 px-0">
        <div class="card-header d-flex justify-content-between align-items-center"
            style="background: linear-gradient(135deg, #ff7a00, #ff5500); color:white;">
            <h6 class="mb-0 font-weight-bold">List Kota</h6>
            <button type="button" class="btn btn-light btn-sm rounded-pill" data-toggle="modal"
                data-target="#tambahModal">
                <i class="fas fa-plus"></i> Tambah Data
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="dataTable">
                    <thead style="background:#fff3e6;" class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Kota</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; foreach ($kota as $key) : ?>
                        <tr>
                            <td class="text-center align-middle"><?= $n++ ?></td>
                            <td class="align-middle"><?= htmlspecialchars($key->nama_kota) ?></td>
                            <td class="text-center align-middle">
                                <button class="btn btn-sm btn-warning rounded-pill mr-1" data-toggle="modal"
                                    data-target="#editModal<?= $key->id_kota ?>">
                                    Edit
                                </button>
                                <a href="<?= site_url('jasakirim/delete_kota/' . $key->id_kota) ?>"
                                    class="btn btn-sm btn-danger rounded-pill"
                                    onclick="return confirm('Yakin hapus data?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach ?>

                        <?php if (empty($kota)) : ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">
                                Tidak ada data
                            </td>
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
                <h5 class="modal-title">Tambah Kota</h5>
                <button class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <form action="<?= site_url('jasakirim/add_kota') ?>" method="POST">
                <div class="modal-body">

                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                        value="<?= $this->security->get_csrf_hash() ?>">

                    <div class="form-group">
                        <label>Nama Kota</label>
                        <input type="text" class="form-control" name="nama_kota" placeholder="Nama Kota" required>
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
<?php foreach ($kota as $key) : ?>
<div class="modal fade" id="editModal<?= $key->id_kota ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header" style="background: linear-gradient(135deg, #ff7a00, #ff5500); color:white;">
                <h5 class="modal-title">Edit Kota</h5>
                <button class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <form action="<?= site_url('jasakirim/kota_save_edit') ?>" method="POST">
                <div class="modal-body">

                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                        value="<?= $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="id_kota" value="<?= $key->id_kota ?>">

                    <div class="form-group">
                        <label>Nama Kota</label>
                        <input type="text" class="form-control" name="nama_kota"
                            value="<?= htmlspecialchars($key->nama_kota) ?>" required>
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
