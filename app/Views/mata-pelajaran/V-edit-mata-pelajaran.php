<?= $this->extend('layouts/dashboard/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form method="POST" action="<?= base_url('mata-pelajaran/update/' . $mata_pelajaran['id']) ?>">
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
                                            <option value="<?= $item['id'] ?>" <?= old('id_tahun_ajaran', $mata_pelajaran['id_tahun_ajaran']) == $item['id'] ? 'selected' : '' ?>>
                                                <?= $item['tahun_ajaran'] ?> (<?= $item['semester'] ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $errors['id_tahun_ajaran'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_mapel">Nama Mapel</label>
                                    <input type="text" name="nama_mapel" id="nama_mapel" value="<?= old('nama_mapel', $mata_pelajaran['nama_mapel']) ?>" placeholder="Masukkan Nama Mapel"
                                        class="form-control <?= isset($errors['nama_mapel']) ? 'is-invalid' : '' ?>" autofocus>
                                    <div class=" invalid-feedback">
                                        <?= $errors['nama_mapel'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="id_guru">Nama Guru</label>
                                    <select name="id_guru" id="id_guru" class="form-control <?= isset($errors['id_guru']) ? 'is-invalid' : '' ?> select2">
                                        <option value="">Pilih</option>
                                        <?php foreach ($pengguna as $item): ?>
                                            <option value="<?= $item['id'] ?>" <?= old('id_guru', $mata_pelajaran['id_guru']) == $item['id'] ? 'selected' : '' ?>><?= $item['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $errors['id_guru'] ?? '' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <a href="<?= base_url('mata-pelajaran') ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<?= $this->endSection() ?>