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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_kelas">Tahun Ajaran</label>
                                <input type="text" name="" id="" class="form-control" value="<?= $kelas['tahun_ajaran'] ?> (<?= $kelas['semester'] ?>)" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_kelas">Kelas</label>
                                <input type="text" name="" id="" class="form-control" value="<?= $kelas['nama_kelas'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_kelas">Mata Pelajaran</label>
                                <input type="text" name="" id="" class="form-control" value="<?= $mapel['nama_mapel'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Aksi</label>
                                <div>
                                    <a href="<?= base_url('nilai-siswa/get-siswa/' . $kelas['id_kelas'] . '/' . $mapel['id_mapel']) ?>" class="btn btn-primary">Tampilkan Data</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (session()->getFlashdata('success') || session()->getFlashdata('error')): ?>
                        <div class="alert <?= session()->getFlashdata('success') ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?: session()->getFlashdata('error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('nilai-siswa/update/' . $kelas['id_kelas'] . '/' . $mapel['id_mapel'])  ?>" method="POST">
                        <?= csrf_field() ?>
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th rowspan="3">Nama Siswa</th>
                                    <th rowspan="3">KKM</th>
                                    <th colspan="5">Nilai Hasil Belajar</th>
                                </tr>
                                <tr>
                                    <th colspan="2">Pengetahuan</th>
                                    <th colspan="2">Praktik</th>
                                    <th>Sikap</th>
                                </tr>
                                <tr>
                                    <th>Angka</th>
                                    <th>Huruf</th>
                                    <th>Angka</th>
                                    <th>Huruf</th>
                                    <th>Predikat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($nilai_siswa as $item): ?>
                                    <tr class="text-nowrap">
                                        <td><?= esc($item['nama_siswa']); ?></td>
                                        <td><input type="number" name="kkm_<?= $item['id_siswa']; ?>" id="kkm" value="<?= $item['kkm']; ?>" class="form-control"></td>
                                        <td><input type="number" name="nilai_hasil_pengetahuan_angka_<?= $item['id_siswa']; ?>" id="kkm" value="<?= $item['kkm']; ?>" class="form-control"></td>
                                        <td><input type="text" name="nilai_hasil_pengetahuan_huruf_<?= $item['id_siswa']; ?>" id="nilai_hasil_pengetahuan_huruf" value="<?= $item['nilai_hasil_pengetahuan_huruf']; ?>" class="form-control"></td>
                                        <td><input type="number" name="nilai_hasil_praktik_angka_<?= $item['id_siswa']; ?>" id="nilai_hasil_praktik_angka" value="<?= $item['nilai_hasil_praktik_angka']; ?>" class="form-control"></td>
                                        <td><input type="text" name="nilai_hasil_praktik_huruf_<?= $item['id_siswa']; ?>" id="nilai_hasil_praktik_huruf" value="<?= $item['nilai_hasil_praktik_huruf']; ?>" class="form-control"></td>
                                        <td><input type="text" name="sikap_efektif_predikat_<?= $item['id_siswa']; ?>" id="sikap_efektif_predikat" value="<?= $item['sikap_efektif_predikat']; ?>" class="form-control"></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Perbarui Nilai Siswa</button>
                        </div>
                    </form>

                </div>
                <div class="card-footer">
                    <a href="<?= base_url('nilai-siswa') ?>" class="btn btn-secondary">Kembali</a>

                </div>
            </div>

        </div>
    </div>
    <?= $this->endSection() ?>