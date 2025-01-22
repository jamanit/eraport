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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">NISN</label>
                                <input type="text" name="" id="" value="<?= $profil_saya['nisn'] ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="" id="" value="<?= $profil_saya['nama_siswa'] ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <input type="text" name="" id="" value="<?= $profil_saya['jenis_kelamin'] ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input type="text" name="" id="" value="<?= date('d-m-Y', strtotime($profil_saya['tanggal_lahir'])) ?>" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" name="" id="" value="<?= $profil_saya['alamat'] ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Nomor Telepon</label>
                                <input type="text" name="" id="" value="<?= $profil_saya['nomor_telepon'] ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <input type="text" name="" id="" value="<?= $profil_saya['nama_kelas'] ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Tahun Ajaran</label>
                                <input type="text" name="" id="" value="<?= $profil_saya['tahun_ajaran'] . ' (' . $profil_saya['semester'] . ')' ?>" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-3">Ubah Password</h5>
                    <form method="POST" action="<?= base_url('profil-saya/update/' . $profil_saya['id']) ?>">
                        <?= csrf_field() ?>
                        <?php $errors = validation_errors(); ?>

                        <div class="row">
                            <div class="col-md-6">
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