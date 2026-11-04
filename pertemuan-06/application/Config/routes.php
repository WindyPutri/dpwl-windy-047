<?php
// Nama Berkas: application/config/routes.php

$route = [];

// Route P2/P3
$route['default_controller'] = 'Home';
$route['info/(:any)'] = 'Home/info/$1';

$route['login'] = 'Auth/login';
$route['auth/login'] = 'Auth/login';
$route['auth/logout'] = 'Auth/logout';

$route['admin'] = 'Admin/index';

// Route P4: CRUD Admin
$route['admin/madmin'] = 'Madmin_controller/index';
$route['admin/madmin/tambah'] = 'Madmin_controller/tambah';
$route['admin/madmin/ubah/(:any)'] = 'Madmin_controller/ubah/$1';
$route['admin/madmin/hapus/(:any)'] = 'Madmin_controller/hapus/$1';

// Route P5: CRUD Mobil
$route['admin/mobil'] = 'Mobil_controller/index';
$route['admin/mobil/tambah'] = 'Mobil_controller/tambah';
$route['admin/mobil/ubah/(:any)'] = 'Mobil_controller/ubah/$1';
$route['admin/mobil/hapus/(:any)'] = 'Mobil_controller/hapus/$1';

// Route P6: Katalog
$route['katalog'] = 'Katalog_controller/index';
$route['katalog/detail/(:any)'] = 'Katalog_controller/detail/$1';

// Route autentikasi penyewa
$route['auth/register'] = 'Auth/register';
$route['auth/login-penyewa'] = 'Auth/login_penyewa';
$route['penyewa/profil'] = 'Penyewa_controller/profil';