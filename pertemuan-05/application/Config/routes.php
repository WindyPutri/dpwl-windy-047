<?php
// Nama Berkas - application\config\routes.php
$route = [];

// Route P2/P3 - dipertahankan, penyesuaian terhadap penulisan nama Controller.
$route['default_controller'] = 'home';
$route['info/(:any)'] = 'home/info/$1';
$route['login'] = 'auth/login';
$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';
$route['admin'] = 'admin/index';

// Route P4: semua proses CRUD admin dipindahkan di URL admin/madmin.
$route['admin/madmin'] = 'Madmin_controller/index';
$route['admin/madmin/tambah'] = 'Madmin_controller/tambah';
$route['admin/madmin/ubah/(:any)'] = 'Madmin_controller/ubah/$1';
$route['admin/madmin/hapus/(:any)'] = 'Madmin_controller/hapus/$1';

// Route P5
// dari href(menu), diproses ke Mobil_controller dengan mengerjakan method index() yang memanggil admin\mobil_view
$route['admin/mobil'] = 'Mobil_controller/index';               

