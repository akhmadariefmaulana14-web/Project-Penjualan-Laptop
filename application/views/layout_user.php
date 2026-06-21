
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $jf ?> </title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">


    <style>
        /* ------------------ Sidebar ------------------ */
        /* Sidebar background */
        .sidebar.bg-gradient-primary {
            background: linear-gradient(180deg, #ff7300 0%, #ff5a00 100%) !important;
        }

        /* Sidebar active link */
        .sidebar .nav-item.active>.nav-link {
            background: #ff9e3f !important;
            box-shadow: 0 4px 15px rgba(255, 115, 0, 0.4);
            border-radius: 0.35rem;
            color: white;
        }

        /* Sidebar link hover */
        .sidebar .nav-item .nav-link:hover {
            background-color: #ff9e3f;
            border-radius: 0.35rem;
            color: white;
        }

        /* Sidebar collapse inner link */
        .collapse-inner a.collapse-item.active,
        .collapse-inner a.collapse-item:hover {
            color: #ff7300 !important;
            font-weight: 600;
        }

        /* ------------------ Topbar ------------------ */
        .topbar .nav-link span {
            color: #ff7300;
            font-weight: 600;
        }

        .topbar .nav-link:hover span {
            color: #ff9e3f;
        }

        /* ------------------ Scroll to top ------------------ */
        .scroll-to-top {
            background-color: #ff7300 !important;
        }

        .scroll-to-top:hover {
            background-color: #ff9e3f !important;
        }

        /* ------------------ Logout modal ------------------ -->*/
        #logoutModal .btn-primary {
            background-color: #ff7300;
            border-color: #ff7300;
            color: white;
        }

        #logoutModal .btn-primary:hover,
        #logoutModal .btn-primary:focus {
            background-color: #ff9e3f;
            border-color: #ff9e3f;
            color: white;
        }

        /* Dropdown logout hover */
        .dropdown-menu .dropdown-item:hover,
        .dropdown-menu .dropdown-item:focus {
            background-color: #ff7300 !important;
            color: white !important;
        }

        /* User cart badge */
        .cart-badge {
            background-color: #ff5a00;
            color: white;
            border-radius: 50%;
            font-size: 0.75rem;
            padding: 2px 6px;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar - User Menu -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="<?= site_url('Frontend') ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laptop"></i>
                </div>
                <div class="sidebar-brand-text mx-3">User Panel</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Home -->
            <li class="nav-item <?= $this->uri->segment(1) == 'Frontend' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('Frontend') ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span>
                </a>
            </li>

            <!-- Nav Item - Laptop -->
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('Frontend') ?>">
                    <i class="fas fa-fw fa-laptop"></i>
                    <span>Pesan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('user/transaksi'); ?>">
                    <i class="fas fa-credit-card"></i>
                    <span>Transaksi</span>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('user/transaksi'); ?>">
                    <i class="fas fa-credit-card"></i>
                    <span>Riwayat</span>
                </a>
            </li> -->

            <!-- Nav Item - Cart -->
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('cart') ?>">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Cart (<?= $this->cart->total_items() ?>)</span>
                </a>
            </li>

            <!-- Nav Item - Wishlist -->
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('wishlist') ?>">
                    <i class="fas fa-fw fa-heart"></i>
                    <span>Wishlist</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - User Account -->
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('auth') ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span><?= isset($user_frontend) ? $user_frontend : 'Account' ?></span>
                </a>
            </li>

            <!-- Sidebar Toggler -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Cart -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle p-0" href="<?= site_url('cart') ?>" role="button">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="badge badge-danger cart-badge"><?= $this->cart->total_items() ?></span>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small"><?= isset($user_frontend) ? $user_frontend : 'Guest' ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url() ?>assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <?php
                                $userName = $this->session->userdata('userName');
                                if ($userName): ?>
                                    <a class="dropdown-item" href="<?= site_url('auth/logout') ?>">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout (<?= $userName ?>)
                                    </a>
                                <?php else: ?>
                                    <a class="dropdown-item" href="<?= site_url('auth') ?>">
                                        <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Login
                                    </a>
                                    <a class="dropdown-item" href="<?= site_url('auth/register') ?>">
                                        <i class="fas fa-user-plus fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Register
                                    </a>
                                <?php endif; ?>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?= $contents ?>
                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © Laptop Store <?= date('Y') ?></span>
                    </div>
                </div>
            </footer>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to logout?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= site_url('auth/logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

</body>

</html>