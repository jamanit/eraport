<?= $this->extend('layouts/dashboard/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form method="POST" action="<?= base_url('wali-orang-tua/update/' . $wali_orang_tua['id']) ?>">
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
                                    <label for="id_siswa">Nama Siswa</label>
                                    <select name="id_siswa" id="id_siswa" class="form-control <?= isset($errors['id_siswa']) ? 'is-invalid' : '' ?> select2">
                                        <option value="">Pilih</option>
                                        <?php foreach ($siswa as $item): ?>
                                            <option value="<?= $item['id'] ?>" <?= old('id_siswa', $wali_orang_tua['id_siswa']) == $item['id'] ? 'selected' : '' ?>><?= $item['nama_siswa'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $errors['id_siswa'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_wali">Nama Wali Orang Tua</label>
                                    <input type="text" name="nama_wali" id="nama_wali" value="<?= old('nama_wali', $wali_orang_tua['nama_wali']) ?>" placeholder="Masukkan Nama Wali"
                                        class="form-control <?= isset($errors['nama_wali']) ? 'is-invalid' : '' ?>" autofocus>
                                    <div class=" invalid-feedback">
                                        <?= $errors['nama_wali'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="hubungan">Hubungan</label>
                                    <input type="text" name="hubungan" id="hubungan" value="<?= old('hubungan', $wali_orang_tua['hubungan']) ?>" placeholder="Masukkan Hubungan"
                                        class="form-control <?= isset($errors['hubungan']) ? 'is-invalid' : '' ?>">
                                    <div class=" invalid-feedback">
                                        <?= $errors['hubungan'] ?? '' ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomor_telepon">No. Telepon</label>
                                    <input type="text" name="nomor_telepon" id="nomor_telepon" value="<?= old('nomor_telepon', $wali_orang_tua['nomor_telepon']) ?>" placeholder="Masukkan No. Telepon"
                                        class="form-control <?= isset($errors['nomor_telepon']) ? 'is-invalid' : '' ?>">
                                    <div class=" invalid-feedback">
                                        <?= $errors['nomor_telepon'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" id="alamat" value="<?= old('alamat', $wali_orang_tua['alamat']) ?>" placeholder="Masukkan Alamat"
                                        class="form-control <?= isset($errors['alamat']) ? 'is-invalid' : '' ?>">
                                    <div class=" invalid-feedback">
                                        <?= $errors['alamat'] ?? '' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <a href="<?= base_url('wali-orang-tua') ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<?= $this->endSection() ?>