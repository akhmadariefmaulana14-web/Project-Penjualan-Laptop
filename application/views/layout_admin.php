<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $jf ?> </title>

    <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        /* ------------------ Sidebar ------------------ */
        /* Sidebar background - Diubah menjadi Hitam */
        .sidebar.bg-gradient-primary {
            background: #000000 !important;
        }

        /* Sidebar active link - Menggunakan Abu-abu gelap agar terlihat */
        .sidebar .nav-item.active>.nav-link {
            background: #222222 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
            border-radius: 0.35rem;
            color: white;
        }

        /* Sidebar link hover */
        .sidebar .nav-item .nav-link:hover {
            background-color: #222222;
            border-radius: 0.35rem;
            color: white;
        }

        /* Sidebar collapse inner link */
        .collapse-inner a.collapse-item.active,
        .collapse-inner a.collapse-item:hover {
            color: #000000 !important;
            font-weight: 600;
        }

        /* Sidebar collapse heading - Diubah menjadi Hitam */
        .collapse-inner .collapse-header {
            color: #000000 !important;
            font-weight: 700;
        }

        /* ------------------ Topbar ------------------ */
        .topbar .nav-link span {
            color: #000000;
            font-weight: 600;
        }

        .topbar .nav-link:hover span {
            color: #555555;
        }

        /* ------------------ Scroll to top ------------------ */
        .scroll-to-top {
            background-color: #000000 !important;
        }

        .scroll-to-top:hover {
            background-color: #333333 !important;
        }

        /* ------------------ Logout modal ------------------ */
        #logoutModal .btn-primary {
            background-color: #000000;
            border-color: #000000;
            color: white;
        }

        #logoutModal .btn-primary:hover,
        #logoutModal .btn-primary:focus {
            background-color: #333333;
            border-color: #333333;
            color: white;
        }

        /* Dropdown logout hover */
        .dropdown-menu .dropdown-item:hover,
        .dropdown-menu .dropdown-item:focus {
            background-color: #000000 !important;
            color: white !important;
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('admin') ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laptop"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li
                class="nav-item <?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == '' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('admin') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Laptop</div>

            <li
                class="nav-item <?= in_array($this->uri->segment(2), ['merk_laptop', 'jenis_laptop']) ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="<?= in_array($this->uri->segment(2), ['merk_laptop', 'jenis_laptop']) ? 'true' : 'false' ?>"
                    aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-laptop"></i>
                    <span>Data Laptop</span>
                </a>
                <div id="collapseTwo"
                    class="collapse <?= in_array($this->uri->segment(2), ['merk_laptop', 'jenis_laptop']) ? 'show' : '' ?>"
                    aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Laptop</h6>
                        <a class="collapse-item <?= $this->uri->segment(2) == 'merk_laptop' ? 'active' : '' ?>"
                            href="<?= site_url('laptop/merk_laptop') ?>">Merk Laptop</a>
                        <a class="collapse-item <?= $this->uri->segment(2) == 'jenis_laptop' ? 'active' : '' ?>"
                            href="<?= site_url('laptop/jenis_laptop') ?>">Jenis Laptop</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

            <li
                class="nav-item <?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'user_data' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('admin/user_data') ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Users</span>
                </a>
            </li>

            <li class="nav-item <?= $this->uri->segment(2) == 'transaksi' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('admin/transaksi') ?>">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span>Transaksi</span>
                </a>
            </li>

            <hr class="sidebar-divider">


            <div class="sidebar-heading">Pengaturan</div>

            <li class="nav-item <?= $this->uri->segment(1) == 'promo' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('promo') ?>">
                    <i class="fas fa-fw fa-coins"></i>
                    <span>Promo</span>
                </a>
            </li>


            <li
                class="nav-item <?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'payment' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('admin/payment') ?>">
                    <i class="fas fa-fw fa-credit-card"></i>
                    <span>Metode Pembayaran</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item <?= in_array($this->uri->segment(2), ['kota', 'kurir', 'ongkir']) ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="<?= in_array($this->uri->segment(2), ['kota', 'kurir', 'ongkir']) ? 'true' : 'false' ?>"
                    aria-controls="collapseThree">
                    <i class="fas fa-fw fa-box-open"></i>
                    <span>Jasa Kirim</span>
                </a>
                <div id="collapseThree"
                    class="collapse <?= in_array($this->uri->segment(2), ['kota', 'kurir', 'ongkir']) ? 'show' : '' ?>"
                    aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Jasa Kirim</h6>
                        <a class="collapse-item <?= $this->uri->segment(2) == 'kota' ? 'active' : '' ?>"
                            href="<?= site_url('jasakirim/kota') ?>">Kota</a>
                        <a class="collapse-item <?= $this->uri->segment(2) == 'kurir' ? 'active' : '' ?>"
                            href="<?= site_url('jasakirim/kurir') ?>">Kurir</a>
                        <a class="collapse-item <?= $this->uri->segment(2) == 'ongkir' ? 'active' : '' ?>"
                            href="<?= site_url('jasakirim/ongkir') ?>">Ongkir</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user_admin ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url() ?>assets/img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <div class="container-fluid">
                    <?= $contents ?>
                </div>
                </div>
            </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="<?= site_url('Frontend') ?>">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
        <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url() ?>assets/alert/dist/sweetalert2.all.min.js"></script>
        <script src="<?= base_url() ?>assets/alert/alert.js"></script>

        <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

        <script src="<?= base_url() ?>assets/vendor/chart.js/Chart.min.js"></script>

        <script src="<?= base_url() ?>assets/js/demo/chart-area-demo.js"></script>
        <script src="<?= base_url() ?>assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>