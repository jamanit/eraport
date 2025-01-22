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
                                <label for="">Aksi</label>
                                <div>
                                    <a href="<?= base_url('rapor-siswa/get-siswa/' . $kelas['id_kelas']) ?>" class="btn btn-primary">Tampilkan Data</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <?php if (session()->getFlashdata('success') || session()->getFlashdata('error')): ?>
                                <div class="alert <?= session()->getFlashdata('success') ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('success') ?: session()->getFlashdata('error') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rapor_siswa as $item): ?>
                                        <tr class="text-nowrap">

                                            <td><?= esc($item['nama_siswa']); ?></td>
                                            <td style="width: 1%;" class="text-nowrap">
                                                <a href="<?= base_url('rapor-siswa/show/' . $item['id_rapor_siswa']) ?>" class="btn btn-sm btn-info" title="Lihat Data"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('rapor-siswa') ?>" class="btn btn-secondary">Kembali</a>

                </div>
            </div>

        </div>
    </div>
    <?= $this->endSection() ?>

    <?= $this->section('style') ?>
    <?= $this->endSection() ?>

    <?= $this->section('script') ?>
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable();
            table.order([]).draw();
        });
    </script>
    <?= $this->endSection() ?>