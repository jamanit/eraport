<?= $this->extend('layouts/dashboard/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form method="POST" action="<?= base_url('jadwal-pelajaran/update/' . $jadwal_pelajaran['id']) ?>">
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
                                            <option value="<?= $item['id'] ?>" <?= old('id_tahun_ajaran', $jadwal_pelajaran['id']) == $item['id'] ? 'selected' : '' ?>>
                                                <?= $item['tahun_ajaran'] ?> (<?= $item['semester'] ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $errors['id_tahun_ajaran'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="id_kelas">Nama Kelas</label>
                                    <select name="id_kelas" id="id_kelas" class="form-control <?= isset($errors['id_kelas']) ? 'is-invalid' : '' ?> select2">
                                        <option value="">Pilih</option>
                                        <?php foreach ($kelas as $item): ?>
                                            <option value="<?= $item['id'] ?>" <?= old('id_kelas', $jadwal_pelajaran['id_kelas']) == $item['id'] ? 'selected' : '' ?>>
                                                <?= $item['tahun_ajaran'] ?> (<?= $item['semester'] ?>)-<?= $item['nama_kelas'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $errors['id_kelas'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="id_mapel">Nama Mapel</label>
                                    <select name="id_mapel" id="id_mapel" class="form-control <?= isset($errors['id_mapel']) ? 'is-invalid' : '' ?> select2">
                                        <option value="">Pilih</option>
                                        <?php foreach ($mapel as $item): ?>
                                            <option value="<?= $item['id'] ?>" <?= old('id_mapel', $jadwal_pelajaran['id_mapel']) == $item['id'] ? 'selected' : '' ?>>
                                                <?= $item['tahun_ajaran'] ?> (<?= $item['semester'] ?>)-<?= $item['nama_mapel'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $errors['id_mapel'] ?? '' ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hari">Hari</label>
                                    <select name="hari" id="hari" class="form-control <?= isset($errors['hari']) ? 'is-invalid' : '' ?> select2">
                                        <option value="">Pilih</option>
                                        <option value="Senin" <?= old('hari', $jadwal_pelajaran['hari']) == 'Senin' ? 'selected' : '' ?>>Senin</option>
                                        <option value="Selasa" <?= old('hari', $jadwal_pelajaran['hari']) == 'Selasa' ? 'selected' : '' ?>>Selasa</option>
                                        <option value="Rabu" <?= old('hari', $jadwal_pelajaran['hari']) == 'Rabu' ? 'selected' : '' ?>>Rabu</option>
                                        <option value="Kamis" <?= old('hari', $jadwal_pelajaran['hari']) == 'Kamis' ? 'selected' : '' ?>>Kamis</option>
                                        <option value="Jumat" <?= old('hari', $jadwal_pelajaran['hari']) == 'Jumat' ? 'selected' : '' ?>>Jumat</option>
                                        <option value="Sabtu" <?= old('hari', $jadwal_pelajaran['hari']) == 'Sabtu' ? 'selected' : '' ?>>Sabtu</option>
                                        <option value="Minggu" <?= old('hari', $jadwal_pelajaran['hari']) == 'Minggu' ? 'selected' : '' ?>>Minggu</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $errors['hari'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jam_ke">Jam Ke</label>
                                    <select name="jam_ke" id="jam_ke" class="form-control <?= isset($errors['jam_ke']) ? 'is-invalid' : '' ?> select2">
                                        <option value="">Pilih</option>
                                        <option value="1" <?= old('jam_ke', $jadwal_pelajaran['jam_ke']) == '1' ? 'selected' : '' ?>>1</option>
                                        <option value="2" <?= old('jam_ke', $jadwal_pelajaran['jam_ke']) == '2' ? 'selected' : '' ?>>2</option>
                                        <option value="3" <?= old('jam_ke', $jadwal_pelajaran['jam_ke']) == '3' ? 'selected' : '' ?>>3</option>
                                        <option value="4" <?= old('jam_ke', $jadwal_pelajaran['jam_ke']) == '4' ? 'selected' : '' ?>>4</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $errors['jam_ke'] ?? '' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <a href="<?= base_url('jadwal-pelajaran') ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<?= $this->endSection() ?>