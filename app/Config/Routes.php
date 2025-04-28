<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('auth', function ($routes) {
    $routes->get('/', 'Auth::index');
    $routes->post('login', 'Auth::index');
    $routes->get('register', 'Auth::showRegister');
    $routes->post('register', 'Auth::register');
    $routes->get('logout', 'Auth::logout');
});
$routes->get('/', 'Home::index');
$routes->group('beranda', function ($routes) {
    $routes->get('read', 'Home::read');
    $routes->get('read_detail/(:hash)', 'Home::read_detail/$1');
    $routes->post('add_cart', 'Home::addCard');
    $routes->get('get_cart', 'Home::getCard');
});
$routes->get('detail/(:hash)', 'Home::detail');
$routes->get('checkout', 'Home::checkout');
$routes->get('cart', 'Home::cart');
$routes->get('admin/beranda', 'Admin\Home::index');
$routes->group('admin', function ($routes) {
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
        $routes->get('read', 'Admin\Penjualan::store');
        $routes->post('add', 'Admin\Penjualan::add');
        $routes->put('edit', 'Admin\Penjualan::edit');
        $routes->delete('delete/(:hash)', 'Admin\Penjualan::delete/$1');
    });
});

