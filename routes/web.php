<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false, 'reset' => false]);

Route::group(['middleware' => 'auth'], function ($app) use ($router) {
    $app->get('/', 'DashboardController@dashboard')->name('dashboard');
    $app->prefix('barang')->name('barang.')->group(function ($app) use ($router) {
        $app->get('/', 'BarangController@index')->name('index');
        $app->get('/create', 'BarangController@create')->name('create');
        $app->post('/store', 'BarangController@store')->name('store');
        $app->put('/{id}', 'BarangController@update')->name('update');
        $app->get('/{id}/edit', 'BarangController@edit')->name('edit');
        $app->get('/{id}/show', 'BarangController@show')->name('show');
        $app->put('/{id}/updateStok', 'BarangController@updateStok')->name('update_stok');
        $app->get('/{id}/delete', 'BarangController@destroy')->name('destroy');

        // stok barang masuk 

        $app->prefix('masuk')->name('masuk.')->group(function ($app) use ($router) {
            $app->get('/', 'StokMasukController@index')->name('index');
            $app->get('/create', 'StokMasukController@create')->name('create');
            $app->post('/store', 'StokMasukController@store')->name('store');
        });
    });
    $app->resource('satuan', 'SatuanController')->except(['show', 'destroy']);
    $app->prefix('satuan')->name('satuan.')->group(function ($app) use ($router) {
        $router->get('/{id}/delete', 'SatuanController@destroy')->name('destroy');
    });

    $app->resource('kategori', 'KategoriController')->except(['show']);
    $app->prefix('kategori')->name('kategori.')->group(function ($app) use ($router) {
        $router->get('/{id}/delete', 'KategoriController@destroy')->name('destroy');
    });

    $app->resource('pelanggan', 'PelangganController')->except('show');
    $app->prefix('pelanggan')->name('pelanggan.')->group(function ($app) use ($router) {
        $router->get('/{id}/delete', 'PelangganController@destroy')->name('destroy');
    });

    $app->resource('user', 'UserController')->except('show');
    $app->prefix('user')->name('user.')->group(function ($app) use ($router) {
        $router->get('/{id}/delete', 'UserController@destroy')->name('destroy');
    });


    $app->resource('suplier', 'SuplierController')->except('show');
    $app->prefix('suplier')->name('suplier.')->group(function ($app) use ($router) {
        $router->get('/{id}/delete', 'SuplierController@destroy')->name('destroy');
    });

    $app->prefix('kasir')->name('kasir.')->group(function ($app) use ($router) {
        $app->get('/', 'KasirController@index')->name('index');
        $app->get('/{id}/getBarangById', 'KasirController@getBarangById')->name('getBarangById');
        $app->post('/addToCart', 'KasirController@addToCart')->name('add_to_cart');
        $app->post('/deleteCart', 'KasirController@deleteCart')->name('delete_cart');
        $app->get('/load_table', 'KasirController@loadTable')->name('load_table');
        $app->post('/cancel', 'KasirController@cancel')->name('cancel');
        $app->post('/change_qty', 'KasirController@changeQty')->name('change_qty');
        $app->post('/store', 'KasirController@store')->name('store');
    });
    $app->prefix('transaksi')->name('transaksi.')->group(function ($app) use ($router) {
        $app->prefix('piutang')->name('piutang.')->group(function ($app) use ($router) {
            $app->get('/', 'PiutangController@index')->name('index');
            $app->get('/loadTable', 'PiutangController@loadTable')->name('load_table');
            $app->get('/loadModal/{id}', 'PiutangController@loadModal')->name('load_modal');
            $app->get('/loadData/getPiutangById/{id}', 'PiutangController@getPiutangById')->name('get_piutang_by_id');
            $app->get('/loadKotakAtas', 'PiutangController@loadKotakAtas')->name('load_kotak_atas');
            $app->post('/update', 'PiutangController@updatePiutang')->name('proses_bayar_piutang');
        });
        $app->prefix('return')->name('return.')->group(function ($app) use ($router) {
            $app->prefix('penjualan')->name('penjualan.')->group(function ($app) use ($router) {
                $app->get('/', 'ReturnPenjualanController@index')->name('index');
                $app->get('/create', 'ReturnPenjualanController@create')->name('create');
                $app->get('/getAllTransaksi', 'ReturnPenjualanController@getAllTransaksi')->name('get_all_transaksi');
                $app->get('/loadTable', 'ReturnPenjualanController@loadTable')->name('load_table');
                $app->get('/loadKotak', 'ReturnPenjualanController@loadKotak')->name('load_kotak');
                $app->get('/getTransaksyById/{id}', 'ReturnPenjualanController@getTransaksyById')->name('get_transaksi_by_id');
                $app->get('/loadDataReturn/{id}', 'ReturnPenjualanController@loadDataReturn')->name('load_data_return');
                $app->post('/addCart', 'ReturnPenjualanController@addCart')->name('add_cart');
                $app->post('/deleteReturn', 'ReturnPenjualanController@deleteReturn')->name('delete_return');
                $app->post('/store', 'ReturnPenjualanController@store')->name('submit');
            });
        });
    });
});
