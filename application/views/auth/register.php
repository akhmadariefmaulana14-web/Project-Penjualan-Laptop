<div class="register d-flex align-items-center justify-content-center"
    style="min-height: 80vh; background: #fffbe6; padding: 40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="register-form p-5 rounded-lg shadow-lg"
                    style="background-color: #fff9e6; border-radius: 15px; box-shadow: 0 8px 20px rgba(240, 192, 64, 0.3);">

                    <h2 class="text-center mb-4"
                        style="color: #f0c040; font-weight: 900; font-family: 'Source Code Pro', monospace;">
                        Register User
                    </h2>

                    <?php if ($this->session->flashdata('msg')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"
                        style="background-color:#d9534f; color:#fff; border:none;">
                        <strong>Warning!</strong><br> <?= $this->session->flashdata('msg') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif ?>

                    <form method="POST" action="<?= site_url('auth/register_action') ?>" class="needs-validation"
                        novalidate>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                            value="<?= $this->security->get_csrf_hash() ?>">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label fw-semibold"
                                    style="color:#333;">Username</label>
                                <input type="text" id="username" name="username"
                                    class="form-control form-control-lg" placeholder="Username" required
                                    style="border: 2px solid #f0c040; border-radius: 8px; background-color: #fffef6; padding: 12px;">
                            </div>
                            <div class="col-md-6">
                                <label for="fullname" class="form-label fw-semibold" style="color:#333;">Full
                                    Name</label>
                                <input type="text" id="fullname" name="nama_user"
                                    class="form-control form-control-lg" placeholder="Full Name" required
                                    style="border: 2px solid #f0c040; border-radius: 8px; background-color: #fffef6; padding: 12px;">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold" style="color:#333;">E-mail</label>
                                <input type="email" id="email" name="email_user"
                                    class="form-control form-control-lg" placeholder="E-mail" required
                                    style="border: 2px solid #f0c040; border-radius: 8px; background-color: #fffef6; padding: 12px;">
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label fw-semibold" style="color:#333;">Address</label>
                                <input type="text" id="address" name="alamat_user"
                                    class="form-control form-control-lg" placeholder="Address" required
                                    style="border: 2px solid #f0c040; border-radius: 8px; background-color: #fffef6; padding: 12px;">
                            </div>
                            
                            <div class="col-md-12">
                                <label for="no_hp" class="form-label fw-semibold" style="color:#333;">WhatsApp Number</label>
                                <input type="number" id="no_hp" name="no_hp"
                                    class="form-control form-control-lg" placeholder="e.g. 081234567890" required
                                    style="border: 2px solid #f0c040; border-radius: 8px; background-color: #fffef6; padding: 12px;">
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label fw-semibold"
                                    style="color:#333;">Password</label>
                                <input type="password" id="password" name="password_user"
                                    class="form-control form-control-lg" placeholder="Password" required
                                    style="border: 2px solid #f0c040; border-radius: 8px; background-color: #fffef6; padding: 12px;">
                            </div>
                            <div class="col-md-6">
                                <label for="password-confirm" class="form-label fw-semibold" style="color:#333;">Retype
                                    Password</label>
                                <input type="password" id="password-confirm" name="password-confirm"
                                    class="form-control form-control-lg" placeholder="Retype Password" required
                                    style="border: 2px solid #f0c040; border-radius: 8px; background-color: #fffef6; padding: 12px;">
                                <div id="message" style="margin-top: 5px; font-weight: 600;"></div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning btn-lg w-100 mt-4 fw-bold"
                            style="border-radius: 10px; transition: 0.3s;">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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