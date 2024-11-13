<?= $this->extend('layouts/dashboard/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <form action="<?= base_url('absensi/get-siswa/' . $jadwal_pelajaran['id_jadwal_pelajaran']) ?>" method="POST">
                                    <?= csrf_field() ?>
                                    <?php $errors = validation_errors(); ?>
                                    <div class="d-flex align-items-center">
                                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= isset($tanggal) ? $tanggal : date('Y-m-d') ?>">
                                        <button type="submit" class="btn btn-primary ml-1">Pilih</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <?php if (session()->getFlashdata('success') || session()->getFlashdata('error')): ?>
                                <div class="alert <?= session()->getFlashdata('success') ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('success') ?: session()->getFlashdata('error') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <form action="<?= base_url('absensi/update/' . $jadwal_pelajaran['id_jadwal_pelajaran']  . '/' . (isset($tanggal) ? $tanggal : date('Y-m-d'))) ?>" method="POST">
                                <?= csrf_field() ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Siswa</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($absensi as $item): ?>
                                            <tr class="text-nowrap">

                                                <td><?= esc($item['nama_siswa']); ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <input type="radio" name="status_<?= $item['id_siswa']; ?>" value="Hadir" <?= $item['status'] == 'Hadir' ? 'checked' : ''; ?>>
                                                            <label class="m-0 ml-1">Hadir</label>
                                                        </div>
                                                        <div class="d-flex align-items-center ml-2">
                                                            <input type="radio" name="status_<?= $item['id_siswa']; ?>" value="Sakit" <?= $item['status'] == 'Sakit' ? 'checked' : ''; ?>>
                                                            <label class="m-0 ml-1">Sakit</label>
                                                        </div>
                                                        <div class="d-flex align-items-center m-2">
                                                            <input type="radio" name="status_<?= $item['id_siswa']; ?>" value="Izin" <?= $item['status'] == 'Izin' ? 'checked' : ''; ?>>
                                                            <label class="m-0 ml-1">Izin</label>
                                                        </div>
                                                        <div class="d-flex align-items-center ml-2">
                                                            <input type="radio" name="status_<?= $item['id_siswa']; ?>" value="Tanpa Keterangan" <?= $item['status'] == 'Tanpa Keterangan' ? 'checked' : ''; ?>>
                                                            <label class="m-0 ml-1">Tanpa Keterangan</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <textarea name="keterangan_<?= $item['id_siswa']; ?>" class="form-control" rows="1"><?= esc($item['keterangan']); ?></textarea>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Perbarui Absensi</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('absensi') ?>" class="btn btn-secondary">Kembali</a>

                </div>
            </div>

        </div>
    </div>
    <?= $this->endSection() ?>