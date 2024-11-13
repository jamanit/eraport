<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('/') ?>sbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('/') ?>sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        /* Styling untuk kotak dengan border */
        .bordered-box {
            border: 1px solid #ccc;
            /* Warna border */
            padding: 10px;
            /* Ruang di dalam kotak */
            min-height: 150px;
            /* Ukuran minimal tinggi kotak */
            border-radius: 5px;
            /* Sudut kotak sedikit melengkung */
            font-family: inherit;
            /* Meniru font dari halaman */
            font-size: 14px;
            /* Ukuran font yang sesuai */
            overflow-y: auto;
            /* Jika teks terlalu panjang, scroll muncul */
        }

        /* Memastikan kotak bisa lebih besar jika diperlukan */
        .bordered-box[contenteditable="true"]:empty:before {
            content: attr(data-placeholder);
            color: #aaa;
        }
    </style>


    <style>
        /* Pengaturan untuk print halaman A4 */
        @page {
            size: A4;
            margin: 0;
        }

        /* CSS untuk memastikan elemen berada di halaman A4 */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Nunito', sans-serif;
            font-size: 12pt;
            line-height: 1.5;
            background-color: gray;
        }

        .page1 {
            margin-left: auto;
            margin-right: auto;
            width: 210mm;
            /* A4 width */
            height: 297mm;
            /* A4 height */
            padding: 10mm;
            box-sizing: border-box;
            page-break-after: always;
            background-color: #fff;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .page2 {
            margin-left: auto;
            margin-right: auto;
            width: 210mm;
            /* A4 width */
            height: 297mm;
            /* A4 height */
            padding: 10mm;
            box-sizing: border-box;
            background-color: #fff;
            margin-bottom: 20px;
        }

        /* Menghilangkan border dan margin saat print */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .page1 {
                width: 210mm;
                height: 297mm;
                padding-top: 20mm;
                padding-bottom: 20mm;
                padding-left: 10px;
                padding-right: 10px;
                page-break-after: always;
                box-sizing: border-box;
            }

            .page2 {
                width: 210mm;
                height: 297mm;
                padding-top: 20mm;
                padding-bottom: 20mm;
                padding-left: 10px;
                padding-right: 10px;
                box-sizing: border-box;
            }
        }
    </style>

</head>

<body>
    <div class="ctr">
        <div class="page1">
            <div class="row mb-5">
                <div class="col-6">
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
                <div class="col-6">
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

            <table class="table table-bordered small">
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

        <div class="page2">
            <div class="row mb-5">
                <div class="col-6">
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
                <div class="col-6">
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
                <div class="col-6 mb-5">
                    <label for="" class="font-weight-bold">Kegiatan Ekstra Kurikuler</label>
                    <div class="table-responsive">
                        <table class="table table-bordered small">
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
                                    <td><?= $ekstra_kurikuler['jenis_kegiatan_1'] ?? '' ?></td>
                                    <td><?= $ekstra_kurikuler['nilai_1'] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><?= $ekstra_kurikuler['jenis_kegiatan_2'] ?? '' ?></td>
                                    <td><?= $ekstra_kurikuler['nilai_2'] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><?= $ekstra_kurikuler['jenis_kegiatan_3'] ?? '' ?></td>
                                    <td><?= $ekstra_kurikuler['nilai_3'] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><?= $ekstra_kurikuler['jenis_kegiatan_4'] ?? '' ?></td>
                                    <td><?= $ekstra_kurikuler['nilai_4'] ?? '' ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-6 mb-5">
                    <label for="" class="font-weight-bold">Kepribadian</label>
                    <div class="table-responsive">
                        <table class="table table-bordered small">
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
                                    <td><?= $kepribadian['aspek_1'] ?? '' ?></td>
                                    <td><?= $kepribadian['keterangan_1'] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><?= $kepribadian['aspek_2'] ?? '' ?></td>
                                    <td><?= $kepribadian['keterangan_2'] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><?= $kepribadian['aspek_3'] ?? '' ?></td>
                                    <td><?= $kepribadian['keterangan_3'] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><?= $kepribadian['aspek_4'] ?? '' ?></td>
                                    <td><?= $kepribadian['keterangan_4'] ?? '' ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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

                <div class="col-6 mb-5">
                    <div class="form-group">
                        <label for="catatan" class="font-weight-bold">Catatan Wali Kelas</label>
                        <!-- Ganti textarea dengan div yang memiliki border -->
                        <div class="bordered-box" contenteditable="true"><?= $rapor_siswa['catatan'] ?? '' ?></div>
                    </div>
                </div>

                <?php if ($rapor_siswa['semester'] == 'Genap') { ?>
                    <div class="col-6 mb-5">
                        <div class="form-group">
                            <label for="catatan" class="font-weight-bold">Keputusan:</label>
                            <h6>Dengan memperhatikan hasil yang dicapai,</h6>
                            <h6> Maka ditetapkan <strong><?= $rapor_siswa['hasil_keputusan'] ?></strong></h6>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="row mt-5">
                <div class="col-4 text-center">
                    <p class="m-0">Mengetahui</p>
                    <p class="m-0">Orang Tua/Wali</p>
                    <p class="mt-5 mb-5"></p>
                    <p class="m-0">......................................................</p>
                    <hr class="mb-0 mt-0" style="width: 80%; border-top: 1px solid black;">
                </div>
                <div class="col-4 text-center">
                    <p class="m-0">Kepala Sekolah</p>
                    <p class="mt-5 mb-5"></p>
                    <p class="m-0">......................................................</p>
                    <hr class="mb-0 mt-0" style="width: 80%; border-top: 1px solid black;">
                    <p class="m-0">NIP: ......................................................</p>
                </div>
                <div class="col-4 text-center">
                    <p class="m-0">Wali Kelas</p>
                    <p class="mt-5 mb-5"></p>
                    <p class="m-0">......................................................</p>
                    <hr class="mb-0 mt-0" style="width: 80%; border-top: 1px solid black;">
                    <p class="m-0">NIP: ......................................................</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('/') ?>sbadmin2/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('/') ?>sbadmin2//bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('/') ?>sbadmin2/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('/') ?>sbadmin2/js/sb-admin-2.min.js"></script>

    <script>
        // Fungsi ini akan dipanggil saat halaman selesai dimuat
        window.onload = function() {
            // Memanggil fungsi print browser
            window.print();
        };
    </script>
</body>

</html>