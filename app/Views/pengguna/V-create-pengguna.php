<?= $this->extend('layouts/dashboard/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form method="POST" action="<?= base_url('pengguna/store') ?>">
                <?= csrf_field() ?>
                <?php $errors = validation_errors(); ?>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <?php if (session()->getFlashdata('success') || session()->getFlashdata('error')): ?>
                            <div class="alert <?= session()->getFlashdata('success') ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('success') ?: session()->getFlashdata('error') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" value="<?= old('nama') ?>" placeholder="Masukkan Nama"
                                        class="form-control <?= isset($errors['nama']) ? 'is-invalid' : '' ?>" autofocus>
                                    <div class=" invalid-feedback">
                                        <?= $errors['nama'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" value="<?= old('email') ?>" placeholder=" Masukkan Email"
                                        class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>">
                                    <div class=" invalid-feedback">
                                        <?= $errors['email'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" placeholder="Masukkan Password"
                                        class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">
                                    <div class=" invalid-feedback">
                                        <?= $errors['password'] ?? '' ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirm">Konfirmasi Password</label>
                                    <input type="password" name="password_confirm" id="password_confirm" placeholder="Konfirmasi Password"
                                        class="form-control <?= isset($errors['password_confirm']) ? 'is-invalid' : '' ?>">
                                    <div class=" invalid-feedback">
                                        <?= $errors['password_confirm'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="id_peran">Peran</label>
                                    <select name="id_peran" id="id_peran" class="form-control <?= isset($errors['id_peran']) ? 'is-invalid' : '' ?>">
                                        <option value="">Pilih</option>
                                        <?php foreach ($peran as $item): ?>
                                            <option value="<?= $item['id'] ?>" <?= old('id_peran') == $item['id'] ? 'selected' : '' ?>><?= $item['nama_peran'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $errors['id_peran'] ?? '' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url('pengguna') ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<?= $this->endSection() ?>