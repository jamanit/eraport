<?= $this->extend('layouts/dashboard/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <?php if (session()->getFlashdata('success') || session()->getFlashdata('error')): ?>
        <div class="alert <?= session()->getFlashdata('success') ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?: session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row mb-5">
                <div class="col-md-6">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Peserta Didik</th>
                                <td>: <?= $rapor_siswa['nama_siswa']; ?></td>
                            </tr>
                            <tr>
                                <th>NIS/NISN</th>
                                <td>: <?= $rapor_siswa['nisn']; ?></td>
                            </tr>
                            <tr>
                                <th>Nama Sekolah</th>
                                <td>: SMAN 11 KERINCI</td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-md-6">
                    <table>
                        <thead>
                            <tr>
                                <th>Kelas/Semester</th>
                                <td>: <?= $rapor_siswa['nama_kelas']; ?>/<?= $rapor_siswa['semester']; ?></td>
                            </tr>
                            <tr>
                                <th>Tahun Pelajaran</th>
                                <td>: <?= $rapor_siswa['tahun_ajaran']; ?></td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th rowspan="3">No.</th>
                        <th rowspan="3">Mata Pelajaran</th>
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
                    <?php
                    $i = 1;
                    $total_pengetahuan = 0;
                    $total_praktik = 0;
                    $total_akhir = 0; // Total Nilai Akhir
                    $jumlah_mapel = 0;
                    foreach ($nilai_siswa as $item):
                        // Menjumlahkan nilai pengetahuan dan praktik
                        $pengetahuan_angka = $item['nilai_hasil_pengetahuan_angka'];
                        $praktik_angka = $item['nilai_hasil_praktik_angka'];

                        // Misalnya bobot pengetahuan 60% dan praktik 40% (atau sesuaikan)
                        $nilai_akhir = (0.6 * $pengetahuan_angka) + (0.4 * $praktik_angka);

                        // Tambahkan ke total
                        $total_pengetahuan += $pengetahuan_angka;
                        $total_praktik += $praktik_angka;
                        $total_akhir += $nilai_akhir;
                        $jumlah_mapel++;
                    ?>
                        <tr class="text-nowrap">
                            <td class="text-center"><?= $i++; ?></td>
                            <td><?= $item['nama_mapel']; ?></td>
                            <td class="text-center"><?= $item['kkm']; ?></td>
                            <td class="text-center"><?= $pengetahuan_angka; ?></td>
                            <td class="text-center"><?= $item['nilai_hasil_pengetahuan_huruf']; ?></td>
                            <td class="text-center"><?= $praktik_angka; ?></td>
                            <td class="text-center"><?= $item['nilai_hasil_praktik_huruf']; ?></td>
                            <td class="text-center"><?= $item['sikap_efektif_predikat']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Jumlah Nilai</th>
                        <td colspan="6">: <?= $total_pengetahuan + $total_praktik; ?></td>
                    </tr>
                    <tr>
                        <th colspan="2">Nilai Rata-Rata</th>
                        <td colspan="6">: <?= $jumlah_mapel > 0 ? round($total_akhir / $jumlah_mapel, 2) : 'Tidak ada data'; ?></td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row mb-5">
                <div class="col-md-6">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Peserta Didik</th>
                                <td>: <?= $rapor_siswa['nama_siswa']; ?></td>
                            </tr>
                            <tr>
                                <th>NIS/NISN</th>
                                <td>: <?= $rapor_siswa['nisn']; ?></td>
                            </tr>
                            <tr>
                                <th>Nama Sekolah</th>
                                <td>: SMAN 11 KERINCI</td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-md-6">
                    <table>
                        <thead>
                            <tr>
                                <th>Kelas/Semester</th>
                                <td>: <?= $rapor_siswa['nama_kelas']; ?>/<?= $rapor_siswa['semester']; ?></td>
                            </tr>
                            <tr>
                                <th>Tahun Pelajaran</th>
                                <td>: <?= $rapor_siswa['tahun_ajaran']; ?></td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-5">
                    <form action="<?= base_url('rapor-siswa/save-ekstra-kurikulier') ?>" method="POST">
                        <?= csrf_field() ?>
                        <?php $errors = validation_errors(); ?>
                        <input type="hidden" name="id_rapor_siswa" value="<?= $rapor_siswa['id_rapor_siswa'] ?>">
                        <input type="hidden" name="id_ekstra_kurikuler" value="<?= $ekstra_kurikuler['id'] ?? '' ?>">

                        <label for="" class="font-weight-bold">Kegiatan Ekstra Kurikuler</label>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Kegiatan</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" name="jenis_kegiatan_1" class="form-control" value="<?= $ekstra_kurikuler['jenis_kegiatan_1'] ?? '' ?>"></td>
                                        <td><input type="text" name="nilai_1" class="form-control" value="<?= $ekstra_kurikuler['nilai_1'] ?? '' ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" name="jenis_kegiatan_2" class="form-control" value="<?= $ekstra_kurikuler['jenis_kegiatan_2'] ?? '' ?>"></td>
                                        <td><input type="text" name="nilai_2" class="form-control" value="<?= $ekstra_kurikuler['nilai_2'] ?? '' ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="text" name="jenis_kegiatan_3" class="form-control" value="<?= $ekstra_kurikuler['jenis_kegiatan_3'] ?? '' ?>"></td>
                                        <td><input type="text" name="nilai_3" class="form-control" value="<?= $ekstra_kurikuler['nilai_3'] ?? '' ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><input type="text" name="jenis_kegiatan_4" class="form-control" value="<?= $ekstra_kurikuler['jenis_kegiatan_4'] ?? '' ?>"></td>
                                        <td><input type="text" name="nilai_4" class="form-control" value="<?= $ekstra_kurikuler['nilai_4'] ?? '' ?>"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>

                <div class="col-md-6 mb-5">
                    <form action="<?= base_url('rapor-siswa/save-kepribadian') ?>" method="POST">
                        <?= csrf_field() ?>
                        <?php $errors = validation_errors(); ?>
                        <input type="hidden" name="id_rapor_siswa" value="<?= $rapor_siswa['id_rapor_siswa'] ?>">
                        <input type="hidden" name="id_kepribadian" value="<?= $kepribadian['id'] ?? '' ?>">

                        <label for="" class="font-weight-bold">Kepribadian</label>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Aspek</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" name="aspek_1" class="form-control" value="<?= $kepribadian['aspek_1'] ?? '' ?>"></td>
                                        <td><input type="text" name="keterangan_1" class="form-control" value="<?= $kepribadian['keterangan_1'] ?? '' ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" name="aspek_2" class="form-control" value="<?= $kepribadian['aspek_2'] ?? '' ?>"></td>
                                        <td><input type="text" name="keterangan_2" class="form-control" value="<?= $kepribadian['keterangan_2'] ?? '' ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="text" name="aspek_3" class="form-control" value="<?= $kepribadian['aspek_3'] ?? '' ?>"></td>
                                        <td><input type="text" name="keterangan_3" class="form-control" value="<?= $kepribadian['keterangan_3'] ?? '' ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><input type="text" name="aspek_4" class="form-control" value="<?= $kepribadian['aspek_4'] ?? '' ?>"></td>
                                        <td><input type="text" name="keterangan_4" class="form-control" value="<?= $kepribadian['keterangan_4'] ?? '' ?>"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>

                <div class="col-6 mb-5">
                    <label for="" class="font-weight-bold">Ketidakhadiran</label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sakit</td>
                                <td><?= $absensi['sakit']; ?></td>
                            </tr>
                            <tr>
                                <td>Izin</td>
                                <td><?= $absensi['izin']; ?></td>
                            </tr>
                            <tr>
                                <td>Tanpa Keterangan</td>
                                <td><?= $absensi['tanpa_keterangan']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6 mb-5">
                    <form action="<?= base_url('rapor-siswa/save-catatan') ?>" method="POST">
                        <?= csrf_field() ?>
                        <?php $errors = validation_errors(); ?>
                        <input type="hidden" name="id_rapor_siswa" value="<?= $rapor_siswa['id_rapor_siswa'] ?? '' ?>">

                        <div class="form-group">
                            <label for="catatan" class="font-weight-bold">Catatan Wali Kelas</label>
                            <textarea name="catatan" id="catatan" class="form-control"><?= $rapor_siswa['catatan'] ?? '' ?></textarea>
                        </div>

                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>

                <?php if ($rapor_siswa['semester'] == 'Genap') { ?>
                    <div class="col-md-6 mb-5">
                        <form action="<?= base_url('rapor-siswa/save-keputusan') ?>" method="POST">
                            <?= csrf_field() ?>
                            <?php $errors = validation_errors(); ?>
                            <input type="hidden" name="id_rapor_siswa" value="<?= $rapor_siswa['id_rapor_siswa'] ?? '' ?>">

                            <div class="form-group">
                                <label for="catatan" class="font-weight-bold">Keputusan:</label>
                                <p>Dengan memperhatikan hasil yang dicapai, Maka ditetapkan</p>
                                <select name="hasil_keputusan" id="hasil_keputusan" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="Naik Kelas" <?= $rapor_siswa['hasil_keputusan'] && $rapor_siswa['hasil_keputusan'] == 'Naik Kelas' ? 'selected' : '' ?>>Naik Kelas</option>
                                    <option value="Tinggal Kelas" <?= $rapor_siswa['hasil_keputusan'] && $rapor_siswa['hasil_keputusan'] == 'Tinggal Kelas' ? 'selected' : '' ?>>Tinggal Kelas</option>
                                </select>
                            </div>

                            <button class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>

    <div class="d-flex">
        <div class="form-group">
            <a href="<?= base_url('rapor-siswa/list/' . $rapor_siswa['id_kelas']) ?>" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="form-group ml-3">
            <a href="<?= base_url('rapor-siswa/print/' . $rapor_siswa['id_rapor_siswa']) ?>" class="btn btn-secondary" target="_blank">Print Rapor Siswa</a>
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