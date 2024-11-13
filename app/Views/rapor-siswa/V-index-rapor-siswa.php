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
                    <?php if (session()->getFlashdata('success') || session()->getFlashdata('error')): ?>
                        <div class="alert <?= session()->getFlashdata('success') ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?: session()->getFlashdata('error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Nama Kelas</th>
                                    <th>Nama Guru Wali</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kelas as $item): ?>
                                    <tr class="text-nowrap">
                                        <td style="width: 1%;">
                                            <a href="<?= base_url('rapor-siswa/list/' . $item['id_kelas']) ?>" class="btn btn-sm btn-info" title="Lihat Data"><i class="fas fa-eye"></i></a>
                                        </td>
                                        <td><?= $item['tahun_ajaran'] ?? '' ?> (<?= $item['semester'] ?? '' ?>)</td>
                                        <td><?= $item['nama_kelas'] ?? '' ?></td>
                                        <td><?= $item['nama_guru_wali'] ?? '' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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