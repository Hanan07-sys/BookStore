<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
// USER
$routes->get('/login','\App\Modules\User\Controllers\login::index');
$routes->get('/user','\App\Modules\User\Controllers\user::index');
$routes->get('/user/novel','\App\Modules\User\Controllers\user::novel');
$routes->get('/user/(:any)','\App\Modules\User\Controllers\user::detail/$1');
$routes->get('/login/registrasi','\App\Modules\User\Controllers\login::registrasi');
$routes->get('/login/logout','\App\Modules\User\Controllers\login::logout');
// add
$routes->add('/login/auth','\App\Modules\User\Controllers\login::auth');
$routes->add('/login/save','\App\Modules\User\Controllers\login::save');


// ADMIN
$routes->get('/novel','\App\Modules\Admin\Controllers\novel::index');
$routes->get('/home','\App\Modules\Admin\Controllers\home::index');
$routes->get('/genre','\App\Modules\Admin\Controllers\genre::index');
$routes->get('/bahasa','\App\Modules\Admin\Controllers\bahasa::index');
$routes->get('/pengguna','\App\Modules\Admin\Controllers\pengguna::index');
$routes->get('/pengguna/createPengguna','\App\Modules\Admin\Controllers\pengguna::createPengguna');
$routes->get('/pengguna/createAdmin','\App\Modules\Admin\Controllers\pengguna::createAdmin');
$routes->get('/novel/create','\App\Modules\Admin\Controllers\novel::create');
$routes->get('/novel/edit/(:segment)','\App\Modules\Admin\Controllers\novel::edit/$1');
$routes->get('/pengguna/editPengguna/(:segment)','\App\Modules\Admin\Controllers\pengguna::editPengguna/$1');

//add
// $routes->add('Cetak/(:any)', 'App\Modules\Admin\Controllers\Cetak::$1');
$routes->add('/Cetak/pdf','\App\Modules\Admin\Controllers\cetak::pdf');
$routes->add('/Cetak/word','\App\Modules\Admin\Controllers\cetak::word');
$routes->add('/Cetak/excel','\App\Modules\Admin\Controllers\cetak::excel');

$routes->add('/novel/delete/(:any)','\App\Modules\Admin\Controllers\novel::delete/$1');
$routes->add('/novel/save','\App\Modules\Admin\Controllers\novel::save');
$routes->add('/novel/update/(:any)','\App\Modules\Admin\Controllers\novel::update/$1');
$routes->add('/pengguna/updatePengguna/(:any)','\App\Modules\Admin\Controllers\pengguna::updatePengguna/$1');
$routes->add('/genre/simpanGenre','\App\Modules\Admin\Controllers\genre::simpanGenre');
$routes->add('/bahasa/simpanBahasa','\App\Modules\Admin\Controllers\bahasa::simpanBahasa');
$routes->add('/genre/deleteGenre/(:any)','\App\Modules\Admin\Controllers\genre::deleteGenre/$1');
$routes->add('/bahasa/deleteBahasa/(:any)','\App\Modules\Admin\Controllers\bahasa::deleteBahasa/$1');
$routes->add('/pengguna/deletePengguna/(:any)','\App\Modules\Admin\Controllers\pengguna::deletePengguna/$1');
$routes->add('/pengguna/simpanPengguna','\App\Modules\Admin\Controllers\pengguna::simpanPengguna');
$routes->add('/pengguna/simpanAdmin','\App\Modules\Admin\Controllers\pengguna::simpanAdmin');

// slug
$routes->get('/novel/(:any)','\App\Modules\Admin\Controllers\novel::detail/$1');


// $routes->get('/novel/home', 'novel::home');
// $routes->get('/user/novel', 'user::novel');
// // $routes->get('/Login/login', 'novel::login');
// $routes->get('/novel/createPengguna', 'novel::createPengguna');
// $routes->get('/novel/createAdmin', 'novel::createAdmin');
// $routes->get('/novel/pengguna', 'novel::pengguna');
// $routes->get('/novel/create', 'novel::create');
// $routes->get('/novel/genre', 'novel::genre');
// $routes->get('/novel/bahasa', 'novel::bahasa');
// $routes->get('/novel/edit/(:segment)', 'novel::edit/$1');
// $routes->get('/novel/editPengguna/(:segment)', 'novel::editPengguna/$1');
// $routes->get('/novel/deletePengguna/(:num)', 'novel::deletePengguna/$1');
// $routes->get('/novel/deleteBahasa/(:num)', 'novel::deleteBahasa/$1');
// $routes->get('/novel/deleteGenre/(:num)', 'novel::deleteGenre/$1');
// $routes->delete('/novel/(:num)', 'novel::delete/$1');
// $routes->get('/novel/(:any)', 'novel::detail/$1');
// $routes->get('/user/(:any)', 'user::detail/$1');


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
