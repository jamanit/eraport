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

                    <form method="POST" action="<?= base_url('tahun-ajaran/store') ?>">
                        <?= csrf_field() ?>
                        <?php $errors = validation_errors(); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tahun_ajaran">Tahun Ajaran</label>
                                    <input type="text" name="tahun_ajaran" id="tahun_ajaran" value="<?= old('tahun_ajaran') ?>" placeholder="Masukkan Tahun Ajaran"
                                        class="form-control <?= isset($errors['tahun_ajaran']) ? 'is-invalid' : '' ?>" autofocus>
                                    <div class=" invalid-feedback">
                                        <?= $errors['tahun_ajaran'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <select name="semester" id="semester" class="form-control <?= isset($errors['semester']) ? 'is-invalid' : '' ?>">
                                        <option value="">Pilih</option>
                                        <option value="Ganjil" <?= old('semester') == 'Ganjil' ? 'selected' : '' ?>>Ganjil</option>
                                        <option value="Genap" <?= old('semester') == 'Genap' ? 'selected' : '' ?>>Genap</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $errors['semester'] ?? '' ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mulai">Mulai</label>
                                    <input type="date" name="mulai" id="mulai" value="<?= old('mulai') ?>" placeholder="Masukkan Mulai"
                                        class="form-control <?= isset($errors['mulai']) ? 'is-invalid' : '' ?>" autofocus>
                                    <div class=" invalid-feedback">
                                        <?= $errors['mulai'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="selesai">Selesai</label>
                                    <input type="date" name="selesai" id="selesai" value="<?= old('selesai') ?>" placeholder="Masukkan Mulai"
                                        class="form-control <?= isset($errors['selesai']) ? 'is-invalid' : '' ?>" autofocus>
                                    <div class=" invalid-feedback">
                                        <?= $errors['selesai'] ?? '' ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url('tahun-ajaran') ?>" class="btn btn-secondary">Kembali</a>
                    </form>

                </div>
            </div>
        </div>

    </div>

</div>
<?= $this->endSection() ?>