<div class="container-fluid">

    <h1 class="h3 mb-4 font-weight-bold text-dark">Data Laptop</h1>

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
            style="background: linear-gradient(135deg, #4e73df, #224abe); color:white;">
            <h6 class="mb-0 font-weight-bold">List Laptop</h6>
            <button type="button" class="btn btn-light btn-sm rounded-pill" data-toggle="modal"
                data-target="#tambahModal">
                <i class="fas fa-plus text-primary"></i> Tambah Data
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="dataTable">
                    <thead style="background:#e6f2ff;" class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Laptop</th>
                            <th>Jenis</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $n = 1; foreach ($laptop as $key) : ?>
                        <tr>
                            <td class="text-center align-middle"><?= $n++ ?></td>

                            <td class="align-middle">
                                <img src="<?= base_url('assets/image_laptop/' . $key->img_laptop) ?>"
                                    style="width:70px; border-radius:6px;">
                            </td>

                            <td class="align-middle"><?= $key->nama_merk ?></td>
                            <td class="align-middle"><?= $key->jenis_laptop ?></td>
                            <td class="align-middle"><?= $key->desc_laptop ?></td>

                            <td class="align-middle text-danger font-weight-bold">
                                Rp <?= number_format($key->harga_laptop, 0, ',', '.') ?>
                            </td>

                            <td class="align-middle text-center"><?= $key->stok ?></td>

                            <td class="text-center align-middle">
                                <button type="button" class="btn btn-sm btn-primary rounded-pill mr-1"
                                    data-toggle="modal" data-target="#editModal<?= $key->id_laptop ?>">
                                    Edit
                                </button>

                                <a href="<?= site_url('laptop/delete_jenis_laptop/' . $key->id_laptop) ?>"
                                    class="btn btn-sm btn-danger rounded-pill"
                                    onclick="return confirm('Yakin hapus data?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach ?>

                        <?php if (empty($laptop)) : ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-3">
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

<div class="modal fade" id="tambahModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header" style="background: linear-gradient(135deg, #4e73df, #224abe); color:white;">
                <h5 class="modal-title">Tambah Laptop</h5>
                <button class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <form action="<?= site_url('laptop/jenis_laptop_add') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                        value="<?= $this->security->get_csrf_hash() ?>">

                    <div class="form-group">
                        <label>Merk</label>
                        <select name="id_merk" class="form-control" required>
                            <?php foreach ($merk as $m) : ?>
                            <option value="<?= $m->id_merk ?>"><?= $m->nama_merk ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jenis Laptop</label>
                        <input type="text" name="jenis_laptop" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="desc_laptop" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga_laptop" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="img_laptop" class="form-control" required>
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
<div class="modal fade" id="editModal<?= $key->id_laptop ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header" style="background: linear-gradient(135deg, #4e73df, #224abe); color:white;">
                <h5 class="modal-title">Edit Laptop</h5>
                <button class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <form action="<?= site_url('laptop/jenis_save_edit') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                        value="<?= $this->security->get_csrf_hash() ?>">

                    <input type="hidden" name="id_laptop" value="<?= $key->id_laptop ?>">

                    <div class="form-group">
                        <label>Merk</label>
                        <select name="id_merk" class="form-control">
                            <?php foreach ($merk as $m) : ?>
                            <option value="<?= $m->id_merk ?>" <?= $m->id_merk == $key->id_merk ? 'selected' : '' ?>>
                                <?= $m->nama_merk ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jenis Laptop</label>
                        <input type="text" name="jenis_laptop" value="<?= $key->jenis_laptop ?>"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="desc_laptop" class="form-control"><?= $key->desc_laptop ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga_laptop" value="<?= $key->harga_laptop ?>"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" value="<?= $key->stok ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Gambar (opsional)</label>
                        <input type="file" name="img_laptop" class="form-control">
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