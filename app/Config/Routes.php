<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'KirimEmail::index');
// $routes->get('/dasboard', 'Pages::dashboard');

// Home
$routes->get('/', 'Home::index');

// Pelanggan
$routes->get('/pelanggan', 'Pelanggan::index');
$routes->get('/pelanggan/create', 'Pelanggan::create');
$routes->post('/pelanggan/save', 'Pelanggan::save');
$routes->post('/pelanggan/update/(:num)', 'Pelanggan::update/$1');
$routes->get('/pelanggan/edit/(:segment)', 'Pelanggan::edit/$1');
$routes->post('/pelanggan/edit/(:segment)', 'Pelanggan::edit/$1');
$routes->delete('/pelanggan/(:num)', 'Pelanggan::delete/$1', ['filter' => 'role:Admin']);
$routes->get('/pelanggan/(:any)', 'Pelanggan::detail/$1');
$routes->post('/pelanggan/(:any)', 'Pelanggan::detail/$1');

// Jasa
$routes->get('/jasa', 'Jasa::index');
$routes->get('/jasa/create', 'Jasa::create');
$routes->post('/jasa/save', 'Jasa::save');
$routes->post('/jasa/update/(:num)', 'Jasa::update/$1');
$routes->get('/jasa/edit/(:segment)', 'Jasa::edit/$1');
$routes->post('/jasa/edit/(:segment)', 'Jasa::edit/$1');
$routes->delete('/jasa/(:num)', 'Jasa::delete/$1', ['filter' => 'role:Admin']);

// Layanan
$routes->get('/layanan', 'Layanan::index');
$routes->get('/layanan/create', 'Layanan::create');
$routes->post('/layanan/save', 'Layanan::save');
$routes->post('/layanan/update/(:num)', 'Layanan::update/$1');
$routes->get('/layanan/edit/(:segment)', 'Layanan::edit/$1');
$routes->post('/layanan/edit/(:segment)', 'Layanan::edit/$1');
$routes->delete('/layanan/(:num)', 'Layanan::delete/$1', ['filter' => 'role:Admin']);
// $routes->get('/layanan/(:any)','Layanan::detail/$1');
$routes->get('/layanan/cetak', 'Layanan::cetakStruk');

// Transaksi
$routes->get('/transaksi', 'Transaksi::index');
$routes->get('/transaksi/create', 'Transaksi::create');
$routes->get('/transaksi/get_nama', 'Transaksi::get_nama');
$routes->post('/transaksi/save', 'Transaksi::save');
$routes->get('/transaksi/update/(:num)', 'Transaksi::update/$1');
$routes->post('/transaksi/update/(:num)', 'Transaksi::update/$1');
$routes->get('/transaksi/edit/(:segment)', 'Transaksi::edit/$1');
$routes->post('/transaksi/edit/(:segment)', 'Transaksi::edit/$1');
$routes->get('/transaksi/cari_tanggal', 'Transaksi::cari_tanggal');
$routes->get('/transaksi/cek_transaksi', 'Transaksi::cek_transaksi');
$routes->post('/transaksi/cek_transaksi', 'Transaksi::cek_transaksi');
// $routes->post('/transaksi/hasil_cari', 'Transaksi::hasil_cari');
// $routes->get('/transaksi/hasil_cari', 'Transaksi::hasil_cari');
$routes->get('/transaksi/hasil_cari/(:segment)', 'Transaksi::hasil_cari/$1');
$routes->post('/transaksi/hasil_cari/(:segment)', 'Transaksi::hasil_cari/$1');
$routes->get('/transaksi/open', 'Transaksi::open');
$routes->get('/transaksi/process', 'Transaksi::process');
$routes->get('/transaksi/waiting', 'Transaksi::waiting');
$routes->get('/transaksi/success', 'Transaksi::success');

// User
$routes->get('/users', 'Users::index', ['filter' => 'role:Admin']);
$routes->get('/users/create', 'Users::create', ['filter' => 'role:Admin']);
$routes->post('/users/save', 'Users::save', ['filter' => 'role:Admin']);
$routes->post('/reset-password-users/(:num)', 'Users::reset_password/$1', ['filter' => 'role:Admin']);
$routes->delete('/users/(:segment)', 'Users::delete/$1', ['filter' => 'role:Admin']);

//  Profile
$routes->get('/profil', 'Profil::index');
$routes->post('/profil/(:num)', 'Profil::update_profil/$1');
$routes->get('/password', 'Profil::change_password');
$routes->post('/password/(:num)', 'Profil::update_password/$1');

// Kirim Email
$routes->get('/kirimemail', 'KirimEmail::index');
$routes->post('/kirimemail', 'KirimEmail::index');

// cek views
$routes->get('/kirimemail/cekviewlogin', 'KirimEmail::cekviewlogin');

$routes->get('/laporan', 'Transaksi::laporan');
$routes->get('/about', 'Pages::about');

// Setting
$routes->get('/setting', 'Setting::index');
$routes->post('/setting/save', 'Setting::save');
$routes->get('/setting/update/(:num)', 'Setting::update/$1');
$routes->post('/setting/update/(:num)', 'Setting::update/$1');

// Support
$routes->get('/support', 'Support::index');
$routes->post('/support/save', 'Support::save');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
