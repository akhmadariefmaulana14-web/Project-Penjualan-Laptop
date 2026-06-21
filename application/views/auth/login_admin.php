<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $jf ?></title>

    <!-- Bootstrap 5.0.0 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  

    <style>
        body {
            background: linear-gradient(135deg, #f57224, #ff7300);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            max-width: 420px;
            width: 100%;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.25);
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
        }

        .btn-login {
            border-radius: 12px;
            background: #ff7300;
            color: #fff;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .btn-login:hover {
            background: #f57224;
        }

        .btn-back {
            border-radius: 12px;
            background: #6c757d;
            color: #fff;
            font-weight: 500;
        }

        .btn-back:hover {
            background: #5a6268;
        }

        .alert {
            border-radius: 12px;
            transition: opacity 0.5s ease, max-height 0.5s ease;
        }

        @media (max-width: 480px) {
            .login-card {
                margin: 20px;
            }

            .btn-login,
            .btn-back {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-3">
                <h1 class="text-white fw-bold">Welcome Admin</h1>
            </div>
            <div class="login-card p-4">

                <!-- Flash Message -->
                <?php if ($this->session->flashdata('msg')) : ?>
                <div id="flash-msg" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Info:</strong> <?= $this->session->flashdata('msg') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif ?>

                <form method="POST" action="<?= site_url('login_admin/login_action') ?>">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                        value="<?= $this->security->get_csrf_hash() ?>">

                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Enter Email Address..." name="username"
                            required autofocus>
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me">
                        <label class="form-check-label" for="rememberMe">
                            Remember Me
                        </label>
                    </div>

                    <div class="d-grid mb-2">
                        <button type="submit" class="btn btn-login btn-lg">Login</button>
                    </div>

                    <div class="d-grid">
                        <a href="<?= site_url('frontend') ?>" class="btn btn-back btn-lg">
                            <i class="fas fa-home me-2"></i> Kembali ke Frontend
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Auto fade flash message after 3 seconds -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const flash = document.getElementById('flash-msg');
            if (flash) {
                setTimeout(() => {
                    flash.style.opacity = '0';
                    flash.style.maxHeight = '0';
                    setTimeout(() => flash.remove(), 500);
                }, 3000);
            }
        });
    </script>

</body>

</html>
