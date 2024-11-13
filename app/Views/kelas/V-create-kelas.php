<?= $this->extend('layouts/dashboard/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form method="POST" action="<?= base_url('kelas/store') ?>">
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
                                    <label for="id_tahun_ajaran">Tahun Ajaran</label>
                                    <select name="id_tahun_ajaran" id="id_tahun_ajaran" class="form-control <?= isset($errors['id_tahun_ajaran']) ? 'is-invalid' : '' ?> select2">
                                        <option value="">Pilih</option>
                                        <?php foreach ($tahun_ajaran as $item): ?>
                                            <option value="<?= $item['id'] ?>" <?= old('id_tahun_ajaran') == $item['id'] ? 'selected' : '' ?>>
                                                <?= $item['tahun_ajaran'] ?> (<?= $item['semester'] ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $errors['id_tahun_ajaran'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_kelas">Nama Kelas</label>
                                    <input type="text" name="nama_kelas" id="nama_kelas" value="<?= old('nama_kelas') ?>" placeholder="Masukkan Nama kelas"
                                        class="form-control <?= isset($errors['nama_kelas']) ? 'is-invalid' : '' ?>" autofocus>
                                    <div class=" invalid-feedback">
                                        <?= $errors['nama_kelas'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="id_guru_wali">Nama Guru Wali</label>
                                    <select name="id_guru_wali" id="id_guru_wali" class="form-control <?= isset($errors['id_guru_wali']) ? 'is-invalid' : '' ?> select2">
                                        <option value="">Pilih</option>
                                        <?php foreach ($pengguna as $item): ?>
                                            <option value="<?= $item['id'] ?>" <?= old('id_guru_wali') == $item['id'] ? 'selected' : '' ?>><?= $item['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $errors['id_guru_wali'] ?? '' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url('kelas') ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<?= $this->endSection() ?>