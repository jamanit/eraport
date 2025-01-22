<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'C_auth::login');

$routes->get('register', 'C_auth::register');
$routes->get('login', 'C_auth::login');
$routes->post('register', 'C_auth::register');
$routes->post('login', 'C_auth::login');
$routes->get('logout', 'C_auth::logout');

$routes->get('dashboard', 'C_dashboard::index', ['filter' => 'auth']);

$routes->group('peran', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'C_peran::index');
    $routes->get('create', 'C_peran::create');
    $routes->post('store', 'C_peran::store');
    $routes->get('edit/(:num)', 'C_peran::edit/$1');
    $routes->post('update/(:num)', 'C_peran::update/$1');
    $routes->get('delete/(:num)', 'C_peran::delete/$1');
});

$routes->group('pengguna', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'C_pengguna::index');
    $routes->get('create', 'C_pengguna::create');
    $routes->post('store', 'C_pengguna::store');
    $routes->get('edit/(:num)', 'C_pengguna::edit/$1');
    $routes->post('update/(:num)', 'C_pengguna::update/$1');
    $routes->get('delete/(:num)', 'C_pengguna::delete/$1');
});

$routes->group('profil', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'C_profil::index');
    $routes->get('create', 'C_profil::create');
    $routes->post('store', 'C_profil::store');
    $routes->get('edit/(:num)', 'C_profil::edit/$1');
    $routes->post('update/(:num)', 'C_profil::update/$1');
    $routes->get('delete/(:num)', 'C_profil::delete/$1');
});

$routes->group('kelas', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'C_kelas::index');
    $routes->get('create', 'C_kelas::create');
    $routes->post('store', 'C_kelas::store');
    $routes->get('edit/(:num)', 'C_kelas::edit/$1');
    $routes->post('update/(:num)', 'C_kelas::update/$1');
    $routes->get('delete/(:num)', 'C_kelas::delete/$1');
});

$routes->group('mata-pelajaran', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'C_mata_pelajaran::index');
    $routes->get('create', 'C_mata_pelajaran::create');
    $routes->post('store', 'C_mata_pelajaran::store');
    $routes->get('edit/(:num)', 'C_mata_pelajaran::edit/$1');
    $routes->post('update/(:num)', 'C_mata_pelajaran::update/$1');
    $routes->get('delete/(:num)', 'C_mata_pelajaran::delete/$1');
});

$routes->group('tahun-ajaran', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'C_tahun_ajaran::index');
    $routes->get('create', 'C_tahun_ajaran::create');
    $routes->post('store', 'C_tahun_ajaran::store');
    $routes->get('edit/(:num)', 'C_tahun_ajaran::edit/$1');
    $routes->post('update/(:num)', 'C_tahun_ajaran::update/$1');
    $routes->get('delete/(:num)', 'C_tahun_ajaran::delete/$1');
});

$routes->group('siswa', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'C_siswa::index');
    $routes->get('create', 'C_siswa::create');
    $routes->post('store', 'C_siswa::store');
    $routes->get('edit/(:num)', 'C_siswa::edit/$1');
    $routes->post('update/(:num)', 'C_siswa::update/$1');
    $routes->get('delete/(:num)', 'C_siswa::delete/$1');
});

$routes->group('wali-orang-tua', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'C_wali_orang_tua::index');
    $routes->get('create', 'C_wali_orang_tua::create');
    $routes->post('store', 'C_wali_orang_tua::store');
    $routes->get('edit/(:num)', 'C_wali_orang_tua::edit/$1');
    $routes->post('update/(:num)', 'C_wali_orang_tua::update/$1');
    $routes->get('delete/(:num)', 'C_wali_orang_tua::delete/$1');
});

$routes->group('absensi', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'C_absensi::index');

    $routes->get('edit/(:num)/(:any)', 'C_absensi::edit/$1/$2');
    $routes->post('get-siswa/(:num)', 'C_absensi::get_siswa/$1');

    $routes->post('update/(:num)/(:any)', 'C_absensi::update/$1/$2');
});

$routes->group('jadwal-pelajaran', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'C_jadwal_pelajaran::index');
    $routes->get('create', 'C_jadwal_pelajaran::create');
    $routes->post('store', 'C_jadwal_pelajaran::store');
    $routes->get('edit/(:num)', 'C_jadwal_pelajaran::edit/$1');
    $routes->post('update/(:num)', 'C_jadwal_pelajaran::update/$1');
    $routes->get('delete/(:num)', 'C_jadwal_pelajaran::delete/$1');
});

$routes->group('nilai-siswa', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'C_nilai_siswa::index');

    $routes->get('edit/(:num)/(:num)', 'C_nilai_siswa::edit/$1/$2');
    $routes->get('get-siswa/(:num)/(:num)', 'C_nilai_siswa::get_siswa/$1/$2');

    $routes->post('update/(:num)/(:num)', 'C_nilai_siswa::update/$1/$2');
});

$routes->group('rapor-siswa', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'C_rapor_siswa::index');
    $routes->get('list/(:num)', 'C_rapor_siswa::list/$1');
    $routes->get('get-siswa/(:num)', 'C_rapor_siswa::get_siswa/$1');
    $routes->get('show/(:num)', 'C_rapor_siswa::show/$1');

    $routes->post('save-ekstra-kurikulier', 'C_rapor_siswa::save_ekstra_kurikuler');
    $routes->post('save-kepribadian', 'C_rapor_siswa::save_kepribadian');
    $routes->post('save-catatan', 'C_rapor_siswa::save_catatan');
    $routes->post('save-keputusan', 'C_rapor_siswa::save_keputusan');

    $routes->get('print/(:num)', 'C_rapor_siswa::print/$1');
});

$routes->group('rapor-saya', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'C_rapor_saya::index');
    $routes->get('list/(:num)', 'C_rapor_saya::list/$1');
    $routes->get('show/(:num)', 'C_rapor_saya::show/$1');
    $routes->get('print/(:num)', 'C_rapor_saya::print/$1');
});

$routes->group('profil-saya', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'C_profil_saya::index');
    $routes->get('create', 'C_profil_saya::create');
    $routes->post('store', 'C_profil_saya::store');
    $routes->get('edit/(:num)', 'C_profil_saya::edit/$1');
    $routes->post('update/(:num)', 'C_profil_saya::update/$1');
    $routes->get('delete/(:num)', 'C_profil_saya::delete/$1');
});
