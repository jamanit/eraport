<?= $this->extend('layouts/auth/main') ?>

<?= $this->section('content') ?>
<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-header">
                <div class="text-center">
                    <img src="<?= base_url('/') ?>images/logo-sekolah.jpg" alt="Logo" class="img-fluid rounded" style="width: 70px">
                    <h1 class="h3 text-gray-900 mb-4 font-weight-bold mt-1"><?= getenv('app.name') ?></h1>
                </div>
            </div>
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h6 text-gray-900 mb-4 font-weight-bold"><?= $title ?></h1>
                    </div>

                    <?php if (session()->getFlashdata('success') || session()->getFlashdata('error')): ?>
                        <div class="alert <?= session()->getFlashdata('success') ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?: session()->getFlashdata('error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <form method="post" class="user" action="<?= site_url('register') ?>">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="nama" id="nama" value="<?= old('nama') ?>" placeholder="Masukkan Nama" autofocus required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="email" id="email" value="<?= old('email') ?>" placeholder="Masukkan Email" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">Registrasi</button>
                    </form>

                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?= site_url('login') ?>">Sudah punya akun? Login!</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<?= $this->endSection() ?>