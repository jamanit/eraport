<?= $this->extend('layouts/dashboard/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form method="POST" action="<?= base_url('peran/store') ?>">
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
                                    <label for="nama_peran">Nama Peran</label>
                                    <input type="text" name="nama_peran" id="nama_peran" value="<?= old('nama_peran') ?>" placeholder="Masukkan Nama Peran"
                                        class="form-control <?= isset($errors['nama_peran']) ? 'is-invalid' : '' ?>" autofocus>
                                    <div class=" invalid-feedback">
                                        <?= $errors['nama_peran'] ?? '' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url('peran') ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<?= $this->endSection() ?>