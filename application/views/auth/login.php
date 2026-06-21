<div class="login d-flex align-items-center justify-content-center"
    style="min-height: 80vh; background: #fffbe6; padding: 40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="login-form p-5 rounded-lg shadow-lg"
                    style="background-color: #fff9e6; border-radius: 15px; box-shadow: 0 8px 20px rgba(240, 192, 64, 0.3);">

                    <h2 class="text-center mb-4"
                        style="color: #f0c040; font-weight: 900; font-family: 'Source Code Pro', monospace;">
                        Login User
                    </h2>

                    <!-- Flash Message -->
                    <?php if ($this->session->flashdata('msg')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"
                        style="background-color:#d9534f; color:#fff; border:none;">
                        <strong>Warning!</strong><br> <?= $this->session->flashdata('msg') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif ?>

                    <form method="POST" action="<?= site_url('auth/login_action') ?>" class="needs-validation"
                        novalidate>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                            value="<?= $this->security->get_csrf_hash() ?>">

                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold" style="color: #333;">E-mail /
                                Username</label>
                            <input id="username" class="form-control form-control-lg" type="text"
                                placeholder="E-mail / Username" name="username" required
                                style="border: 2px solid #f0c040; border-radius: 8px; background-color: #fffef6;">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold" style="color: #333;">Password</label>
                            <input id="password" class="form-control form-control-lg" type="password"
                                placeholder="Password" name="password" required
                                style="border: 2px solid #f0c040; border-radius: 8px; background-color: #fffef6;">
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="keep_signed_in" name="keep_signed_in">
                            <label class="form-check-label" for="keep_signed_in" style="color: #555;">Keep me signed
                                in</label>
                        </div>

                        <button type="submit" class="btn btn-warning btn-lg w-100 fw-bold"
                            style="border-radius: 10px; transition: 0.3s;">
                            Login
                        </button>

                        <div class="mt-3 text-center">
                            <a href="<?= site_url('auth/forgot_password') ?>"
                                style="color: #f0c040; text-decoration: underline;">Forgot Password?</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    /* Input focus effect */
    .form-control:focus {
        border-color: #ffcc00;
        box-shadow: 0 0 8px rgba(240, 192, 64, 0.5);
        outline: none;
        background-color: #fffef6;
    }

    /* Button hover effect */
    .btn-warning:hover {
        background-color: #e6b800;
    }
</style>
