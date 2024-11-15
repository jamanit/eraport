<?php
$id_login = (session()->get('loggedUser')['id'] ?? 'ID');

// Fungsi untuk memeriksa apakah URL saat ini mengandung salah satu dari pola yang diberikan
function isActiveMenu($currentUri, $patterns)
{
    return array_reduce($patterns, function ($carry, $pattern) use ($currentUri) {
        return $carry || strpos($currentUri, $pattern) === 0;
    }, false);
}

// Mendapatkan URI saat ini
$currentUri = uri_string();

// Daftar kategori dan subkategori yang relevan untuk menu
$menuCategories = [
    'data-master' => ['peran', 'pengguna', 'tahun-ajaran', 'kelas', 'mata-pelajaran', 'jadwal-pelajaran', 'siswa', 'wali-orang-tua'],
    'rapor-siswa' => ['rapor-siswa'],
    'nilai-siswa' => ['nilai-siswa'],
    'absensi' => ['absensi'],
    // Tambahkan kategori lain di sini sesuai kebutuhan
];

$activeMenu = [];

// Menghitung status aktif untuk setiap kategori menu
foreach ($menuCategories as $category => $patterns) {
    $activeMenu[$category] = isActiveMenu($currentUri, $patterns);
}
?>

<ul class="navbar-nav bg-gradient-costume sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
        <div class="sidebar-brand-icon rotate-n-15-false">
            <img src="<?= base_url('/') ?>images/logo-sekolah.jpg" alt="" class="img-fluid rounded" style="width: 45px;">
        </div>
        <div class="sidebar-brand-text mx-3 font-weight-bold"><?= getenv('app.nickname') ?? 'APP NICKNAME' ?>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $currentUri == 'dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pengelolaan Data
    </div>

    <!-- Nav Item - Data Master Collapse Menu -->
    <?php if ($id_login == '1') { ?>
        <li class="nav-item <?= $activeMenu['data-master'] ? 'active' : '' ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="<?= $activeMenu['data-master'] ? 'true' : 'false' ?>"
                aria-controls="collapseTwo">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Master</span>
            </a>
            <div id="collapseTwo" class="collapse <?= $activeMenu['data-master'] ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= $activeMenu['data-master'] && isActiveMenu($currentUri, ['peran']) ? 'active' : '' ?>" href="<?= base_url('peran') ?>">Peran</a>
                    <a class="collapse-item <?= $activeMenu['data-master'] && isActiveMenu($currentUri, ['pengguna']) ? 'active' : '' ?>" href="<?= base_url('pengguna') ?>">Pengguna</a>
                    <a class="collapse-item <?= $activeMenu['data-master'] && isActiveMenu($currentUri, ['tahun-ajaran']) ? 'active' : '' ?>" href="<?= base_url('tahun-ajaran') ?>">Tahun Ajaran</a>
                    <a class="collapse-item <?= $activeMenu['data-master'] && isActiveMenu($currentUri, ['kelas']) ? 'active' : '' ?>" href="<?= base_url('kelas') ?>">Kelas</a>
                    <a class="collapse-item <?= $activeMenu['data-master'] && isActiveMenu($currentUri, ['mata-pelajaran']) ? 'active' : '' ?>" href="<?= base_url('mata-pelajaran') ?>">Mata Pelajaran</a>
                    <a class="collapse-item <?= $activeMenu['data-master'] && isActiveMenu($currentUri, ['siswa']) ? 'active' : '' ?>" href="<?= base_url('siswa') ?>">Siswa</a>
                    <a class="collapse-item <?= $activeMenu['data-master'] && isActiveMenu($currentUri, ['wali-orang-tua']) ? 'active' : '' ?>" href="<?= base_url('wali-orang-tua') ?>">Wali Orang Tua</a>
                    <a class="collapse-item <?= $activeMenu['data-master'] && isActiveMenu($currentUri, ['jadwal-pelajaran']) ? 'active' : '' ?>" href="<?= base_url('jadwal-pelajaran') ?>">Jadwal Pelajaran</a>
                </div>
            </div>
        </li>
    <?php } ?>

    <!-- Nav Item - Absensi -->
    <li class="nav-item <?= $activeMenu['absensi'] ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('absensi') ?>">
            <i class="fas fa-fw fa-calendar-check"></i>
            <span>Absensi</span>
        </a>
    </li>

    <!-- Nav Item - Nilai Siswa -->
    <li class="nav-item <?= $activeMenu['nilai-siswa'] ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('nilai-siswa') ?>">
            <i class="fas fa-fw fa-marker"></i>
            <span>Nilai Siswa</span>
        </a>
    </li>

    <!-- Nav Item - Nilai Siswa -->
    <li class="nav-item <?= $activeMenu['rapor-siswa'] ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('rapor-siswa') ?>">
            <i class="fas fa-fw fa-book"></i>
            <span>Rapor Siswa</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>