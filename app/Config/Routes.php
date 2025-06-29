<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('api/review/(:num)', 'ReviewController::index/$1');
$routes->post('api/review', 'ReviewController::create');
$routes->group('profile', function ($routes) {
    $routes->get('/', 'Profile::index');
    $routes->get('read', 'Profile::store');
});
$routes->group('auth', function ($routes) {
    $routes->get('/', 'Auth::index');
    $routes->post('login', 'Auth::index');
    $routes->get('register', 'Auth::showRegister');
    $routes->post('register', 'Auth::register');
    $routes->get('check', 'Auth::checkUser');
    $routes->get('logout', 'Auth::logout');
});
$routes->get('/', 'Home::index');
$routes->group('beranda', function ($routes) {
    $routes->get('read', 'Home::read');
    $routes->get('read_detail/(:hash)', 'Home::read_detail/$1');
    $routes->get('read_detail_pesanan/(:hash)', 'Home::detailPesanan/$1');
    $routes->post('add_cart', 'Home::addCard');
    $routes->get('get_cart', 'Home::getCard');
    $routes->post('checkout', 'Home::prosesCheckout');
    $routes->post('upload', 'Home::upload');
    $routes->get('read_produk', 'Home::readProduk');
});
$routes->group('detail_pesanan', function ($routes) {
    $routes->get('(:hash)', 'DetailPesanan::index/$1');
    $routes->get('read/(:hash)', 'DetailPesanan::store/$1');
});
// $routes->get('detail_pesanan/(:hash)', 'DetailPesanan::detail');
$routes->get('detail/(:hash)', 'Home::detail');
$routes->get('detail_pesanan/(:hash)', 'Home::detail_pesanan');
$routes->get('checkout', 'Home::checkout');
$routes->get('produk', 'Home::produk');
$routes->get('tentang', 'Home::tentang');
$routes->get('cart', 'Home::cart');
$routes->get('admin/beranda', 'Admin\Home::index');
// $routes->get('admin/toko', 'Admin\Home::toko');
$routes->group('admin', ['filter' => 'auth:admin,kasir'], function ($routes) {
    $routes->group('kategori', function ($routes) {
        $routes->get('/', 'Admin\Kategori::index');
        $routes->get('read', 'Admin\Kategori::store');
        $routes->post('add', 'Admin\Kategori::add');
        $routes->put('edit', 'Admin\Kategori::edit');
        $routes->delete('delete/(:hash)', 'Admin\Kategori::delete/$1');
    });

    $routes->group('produk', function ($routes) {
        $routes->get('/', 'Admin\Produk::index');
        $routes->get('read', 'Admin\Produk::store');
        $routes->post('add', 'Admin\Produk::add');
        $routes->put('edit', 'Admin\Produk::edit');
        $routes->delete('delete/(:hash)', 'Admin\Produk::delete/$1');
    });
    $routes->group('variant', function ($routes) {
        $routes->get('read/(:hash)', 'Admin\Variant::store/$1');
        $routes->post('add', 'Admin\Variant::add');
        $routes->put('edit', 'Admin\Variant::edit');
        $routes->delete('delete/(:hash)', 'Admin\Variant::delete/$1');
    });
    $routes->group('pembelian', function ($routes) {
        $routes->get('/', 'Admin\Pembelian::index');
        $routes->get('read', 'Admin\Pembelian::store');
        $routes->post('add', 'Admin\Pembelian::add');
        $routes->put('edit', 'Admin\Pembelian::edit');
        $routes->delete('delete/(:hash)', 'Admin\Pembelian::delete/$1');
    });
    $routes->group('penjualan', function ($routes) {
        $routes->get('/', 'Admin\Penjualan::index');
        $routes->get('struk', 'Admin\Penjualan::struk');
        $routes->get('read', 'Admin\Penjualan::store');
        $routes->post('add', 'Admin\Penjualan::add');
        $routes->put('edit', 'Admin\Penjualan::edit');
        $routes->delete('delete/(:hash)', 'Admin\Penjualan::delete/$1');
    });
    $routes->group('area', function ($routes) {
        $routes->get('/', 'Admin\Area::index');
        $routes->get('read', 'Admin\Area::store');
        $routes->post('add', 'Admin\Area::add');
        $routes->put('edit', 'Admin\Area::edit');
        $routes->delete('delete/(:hash)', 'Admin\Area::delete/$1');
    });

    $routes->group('toko', function ($routes) {
        $routes->get('/', 'Admin\Toko::index');
        $routes->get('read', 'Admin\Toko::store');
        $routes->post('add', 'Admin\Toko::add');
        $routes->put('edit', 'Admin\Toko::edit');
        $routes->delete('delete/(:hash)', 'Admin\Toko::delete/$1');
    });
    $routes->group('pengguna', function ($routes) {
        $routes->get('/', 'Admin\Pengguna::index');
        $routes->get('read', 'Admin\Pengguna::store');
        $routes->get('aktive', 'Admin\Pengguna::aktive');
        $routes->post('add', 'Admin\Pengguna::add');
        $routes->put('edit', 'Admin\Pengguna::edit');
        $routes->delete('delete/(:hash)', 'Admin\Pengguna::delete/$1');
    });
    $routes->group('order', function ($routes) {
        $routes->get('/', 'Admin\Order::index');
        $routes->get('read', 'Admin\Order::store');
        $routes->get('this_day', 'Admin\Order::thisDays');
        $routes->get('read_this_day', 'Admin\Order::readThisDays');
        $routes->get('getPending', 'Admin\Order::getPending');
        $routes->post('add', 'Admin\Order::add');
        $routes->put('edit', 'Admin\Order::edit');
        $routes->delete('delete/(:hash)', 'Admin\Order::delete/$1');
    });
    $routes->group('laporan', function ($routes) {
        $routes->get('pembelian', 'Admin\Laporan::pembelian');
        $routes->get('penjualan', 'Admin\Laporan::penjualan');
        $routes->post('penjualan/data', 'Admin\Laporan::data');
        $routes->get('penjualan/excel', 'Admin\Laporan::excel');
        $routes->get('penjualan/print', 'Admin\Laporan::print');
        $routes->post('pembelian/data', 'Admin\Laporan::pembelian_data');
        $routes->get('pembelian/excel', 'Admin\Laporan::pembelian_excel');
        $routes->get('pembelian/print', 'Admin\Laporan::pembelian_print');
    });
});
