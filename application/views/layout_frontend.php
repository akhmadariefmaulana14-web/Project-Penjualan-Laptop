<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $jf ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="<?= base_url() ?>assets/img_frontend/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.0.0 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f8f8;
            font-family: 'Open Sans', sans-serif;
            color: #333;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            color: #ff784e;
        }

        .top-bar {
            background-color: #fff;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
        }

        .navbar {
            background-color: #ff5722;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: 600;
        }

        .search-bar input {
            border-radius: 50px 0 0 50px;
            border: none;
            padding: 7px 15px;
        }

        .search-bar button {
            border-radius: 0 50px 50px 0;
            border: none;
            background-color: #fff;
            color: #ff5722;
            padding: 7px 15px;
        }

        .bottom-bar .btn {
            border-radius: 50px;
            border: 1px solid #ff5722;
            color: #ff5722;
            transition: 0.3s;
        }

        .bottom-bar .btn:hover {
            background-color: #ff784e;
            color: #fff;
            border-color: #ff784e;
        }

        .footer {
            background-color: #222;
            color: #ccc;
            padding: 40px 0;
        }

        .footer-widget h5 {
            color: #ff5722;
            margin-bottom: 20px;
        }

        .footer-widget a {
            color: #ccc;
        }

        .footer-widget a:hover {
            color: #ff784e;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%;
            height: auto;
        }

        .product-card-body {
            padding: 10px;
        }

        .product-card-title {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }

        .product-card-price {
            color: #ff5722;
            font-weight: 700;
        }

        .product-card-btn {
            border-radius: 50px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <!-- Top Bar -->
    <div class="top-bar py-1">
        <div class="container d-flex justify-content-between">
            <div><i class="fas fa-envelope"></i> admin@gmail.com</div>
            <div><i class="fas fa-phone-alt"></i>+62-123456789</div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= site_url('frontend') ?>">Home</a>
                    </li>
                </ul>

                <!-- SEARCH FORM -->
                <form class="d-flex search-bar mx-3" id="searchForm">
                    <input class="form-control me-2" type="search" name="keyword" placeholder="Search for a laptop model"
                        required>
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </form>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown">User Account</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <?php if ($this->session->userdata('userName')) : ?>
                            <li><a class="dropdown-item" href="<?= site_url('auth/logout') ?>">Logout</a></li>
                            <li><a class="dropdown-item" href="<?= site_url('user/dashboard') ?>">User Panel</a></li>
                            <?php else : ?>
                            <li><a class="dropdown-item" href="<?= site_url('auth') ?>">User Login</a></li>
                            <li><a class="dropdown-item" href="<?= site_url('auth/register') ?>">Register</a></li>
                            <li><a class="dropdown-item" href="<?= site_url('Login_admin') ?>">Admin Panel</a></li>
                            <?php endif ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bottom Bar -->
    <div class="bottom-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                
            </div>
            <div class="user">
                <?php if ($this->session->userdata('userName')) : ?>
                <a href="<?= site_url('wishlist') ?>" class="btn btn-outline-warning me-2">
                    <i class="fas fa-heart"></i> <?php if (isset($total_wishlist)) : ?>
                    <span>(<?= $total_wishlist ?>)</span>
                    <?php endif ?>
                </a>
                <a href="<?= site_url('cart') ?>" class="btn btn-outline-warning">
                    <i class="fas fa-shopping-cart"></i> <span>(<?= $this->cart->total_items() ?>)</span>
                </a>
                <?php endif ?>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-4" id="mainContent">
        <?= $contents ?>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer-widget">
                        <h5>Get in Touch</h5>
                        <p><i class="fas fa-map-marker-alt"></i> Indonesia</p>
                        <p><i class="fas fa-envelope"></i> admin@gmail.com</p>
                        <p><i class="fas fa-phone"></i>+62-123456789</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-widget">
                        <h5>Follow Us</h5>
                        <a href="#"><i class="fab fa-facebook-f me-2"></i></a>
                        <a href="#"><i class="fab fa-twitter me-2"></i></a>
                        <a href="#"><i class="fab fa-instagram me-2"></i></a>
                        <a href="#"><i class="fab fa-youtube me-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="footer-bottom">
        <div class="container d-flex justify-content-between">
            <div>Copyright <?= date('Y') ?> &copy; MAAI. All Rights Reserved</div>
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AJAX Search -->
    <script>
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            let keyword = this.querySelector('input[name="keyword"]').value;
            if (!keyword) return;

            fetch('<?= site_url('search/ajax_search') ?>?keyword=' + encodeURIComponent(keyword))
                .then(res => res.text())
                .then(html => {
                    document.getElementById('mainContent').innerHTML = html;
                });
        });
    </script>

</body>

</html>
