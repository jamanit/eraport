<?= $this->extend('layouts/dashboard/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form method="POST" action="<?= base_url('siswa/store') ?>">
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
                                    <label for="nisn">NISN</label>
                                    <input type="text" name="nisn" id="nisn" value="<?= old('nisn') ?>" placeholder="Masukkan NISN"
                                        class="form-control <?= isset($errors['nisn']) ? 'is-invalid' : '' ?>" autofocus>
                                    <div class=" invalid-feedback">
                                        <?= $errors['nisn'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" name="nama_siswa" id="nama_siswa" value="<?= old('nama_siswa') ?>" placeholder="Masukkan Nama Siswa"
                                        class="form-control <?= isset($errors['nama_siswa']) ? 'is-invalid' : '' ?>">
                                    <div class=" invalid-feedback">
                                        <?= $errors['nama_siswa'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control <?= isset($errors['jenis_kelamin']) ? 'is-invalid' : '' ?>">
                                        <option value="">Pilih</option>
                                        <option value="Laki-Laki" <?= old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' ?>>Laki-Laki</option>
                                        <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $errors['jenis_kelamin'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?= old('tanggal_lahir') ?>"
                                        class="form-control <?= isset($errors['tanggal_lahir']) ? 'is-invalid' : '' ?>">
                                    <div class=" invalid-feedback">
                                        <?= $errors['tanggal_lahir'] ?? '' ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" id="alamat" value="<?= old('alamat') ?>" placeholder="Masukkan Alamat"
                                        class="form-control <?= isset($errors['alamat']) ? 'is-invalid' : '' ?>">
                                    <div class=" invalid-feedback">
                                        <?= $errors['alamat'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nomor_telepon">No. Telepon</label>
                                    <input type="text" name="nomor_telepon" id="nomor_telepon" value="<?= old('nomor_telepon') ?>" placeholder="Masukkan No. Telepon"
                                        class="form-control <?= isset($errors['nomor_telepon']) ? 'is-invalid' : '' ?>">
                                    <div class=" invalid-feedback">
                                        <?= $errors['nomor_telepon'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="id_kelas">Nama Kelas</label>
                                    <select name="id_kelas" id="id_kelas" class="form-control <?= isset($errors['id_kelas']) ? 'is-invalid' : '' ?> select2">
                                        <option value="">Pilih</option>
                                        <?php foreach ($kelas as $item): ?>
                                            <option value="<?= $item['id'] ?>" <?= old('id_kelas') == $item['id'] ? 'selected' : '' ?>>
                                                <?= $item['nama_kelas'] ?> - <?= $item['tahun_ajaran'] ?> (<?= $item['semester'] ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $errors['id_kelas'] ?? '' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url('siswa') ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<?= $this->endSection() ?>