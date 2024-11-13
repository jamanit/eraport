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
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a href="<?= base_url('siswa/create') ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                </div>
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

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>NISN</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>No. Telepon</th>
                                    <th>Nama Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($siswa as $item): ?>
                                    <tr class="text-nowrap">
                                        <td style="width: 1%;">
                                            <a href="<?= base_url('siswa/edit/' . $item['id']) ?>" class="btn btn-sm btn-warning" title="Ubah Data"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal<?= $item['id'] ?>" title="Hapus Data"><i class="fas fa-trash"></i></a>
                                            <div class="modal fade" id="deleteModal<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Siap untuk Hapus?</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">Pilih "Hapus" di bawah jika Anda ingin menghapus data ini.</div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                            <a href="<?= base_url('siswa/delete/' . $item['id']) ?>" class="btn btn-danger">Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $item['nisn'] ?></td>
                                        <td><?= $item['nama_siswa'] ?></td>
                                        <td><?= $item['jenis_kelamin'] ?></td>
                                        <td><?= $item['tanggal_lahir'] ?></td>
                                        <td class="text-limited"><?= $item['alamat'] ?></td>
                                        <td><?= $item['nomor_telepon'] ?></td>
                                        <td><?= $item['nama_kelas'] ?? '' ?> - <?= $item['tahun_ajaran'] ?? '' ?> (<?= $item['semester'] ?? '' ?>)</td>
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
<style>
    .text-limited {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable();
        table.order([]).draw();
    });
</script>
<?= $this->endSection() ?>