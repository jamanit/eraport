<?= $this->extend('layouts/dashboard/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="row">
        <!-- Area Chart -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <?php if (session()->getFlashdata('success') || session()->getFlashdata('error')): ?>
                        <div class="alert <?= session()->getFlashdata('success') ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?: session()->getFlashdata('error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?= base_url('profil/update/' . $profil['id']) ?>">
                        <?= csrf_field() ?>
                        <?php $errors = validation_errors(); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" value="<?= old('email', $profil['email']) ?>" placeholder="Masukkan Email"
                                        class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" readonly>
                                    <div class=" invalid-feedback">
                                        <?= $errors['email'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_peran">Nama Peran</label>
                                    <input type="text" name="nama_peran" id="nama_peran" value="<?= old('nama_peran', $profil['nama_peran']) ?>" placeholder="Masukkan Nama Peran"
                                        class="form-control <?= isset($errors['nama_peran']) ? 'is-invalid' : '' ?>" readonly>
                                    <div class=" invalid-feedback">
                                        <?= $errors['nama_peran'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" value="<?= old('nama', $profil['nama']) ?>" placeholder="Masukkan Nama"
                                        class="form-control <?= isset($errors['nama']) ? 'is-invalid' : '' ?>">
                                    <div class=" invalid-feedback">
                                        <?= $errors['nama'] ?? '' ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" placeholder="Masukkan Password"
                                        class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">
                                    <div class=" invalid-feedback">
                                        <?= $errors['password'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirm">Konfirmasi Password</label>
                                    <input type="password" name="password_confirm" id="password_confirm" placeholder="Konfirmasi Password"
                                        class="form-control <?= isset($errors['password_confirm']) ? 'is-invalid' : '' ?>">
                                    <div class=" invalid-feedback">
                                        <?= $errors['password_confirm'] ?? '' ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </form>

                </div>
            </div>
        </div>

    </div>

</div>
<?= $this->endSection() ?>