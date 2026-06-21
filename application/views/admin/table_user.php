<div class="container-fluid">

    <h1 class="h3 mb-4 font-weight-bold text-dark">Data User</h1>

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
            <h6 class="mb-0 font-weight-bold">List User Terdaftar</h6>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="dataTable">
                    <thead style="background:#e6f2ff !important;" class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $n = 1; foreach ($user as $key) : ?>
                        <tr>
                            <td class="text-center align-middle"><?= $n++ ?></td>

                            <td class="align-middle font-weight-bold">
                                <?= htmlspecialchars($key->nama_user) ?>
                            </td>

                            <td class="align-middle text-center text-muted">
                                @<?= htmlspecialchars($key->username) ?>
                            </td>

                            <td class="align-middle">
                                <?= htmlspecialchars($key->email_user) ?>
                            </td>

                            <td class="align-middle">
                                <small><?= htmlspecialchars($key->alamat_user) ?></small>
                            </td>

                            <td class="text-center align-middle">
                                <?php if ($key->status_user == 'Y') : ?>
                                <span class="badge badge-success px-3 py-2 rounded-pill">
                                    Aktif
                                </span>
                                <?php else : ?>
                                <span class="badge badge-danger px-3 py-2 rounded-pill">
                                    Nonaktif
                                </span>
                                <?php endif ?>
                            </td>

                            <td class="text-center align-middle">
                                <?php if ($key->status_user == 'N') : ?>
                                <a href="<?= site_url('auth/status_user/' . $key->id_user) ?>"
                                    class="btn btn-sm btn-success rounded-pill"
                                    onclick="return confirm('Aktifkan user ini?')">
                                    Aktifkan
                                </a>
                                <?php else : ?>
                                <a href="<?= site_url('auth/status_user/' . $key->id_user) ?>"
                                    class="btn btn-sm btn-secondary rounded-pill text-white"
                                    onclick="return confirm('Nonaktifkan user ini?')">
                                    Nonaktifkan
                                </a>
                                <?php endif ?>
                            </td>
                        </tr>
                        <?php endforeach ?>

                        <?php if (empty($user)) : ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">
                                Tidak ada data user
                            </td>
                        </tr>
                        <?php endif ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>