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

Route::get('/testing', function () {
    return view("pages.dashboard");
});
Route::group(['middleware' => 'testing'], function ($app) use ($router) {
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
    });

    $app->resource('satuan', 'SatuanController')->except(['show', 'destroy']);
    $app->prefix('satuan')->name('satuan.')->group(function ($app) use ($router) {
        $router->get('/{id}/delete', 'SatuanController@destroy')->name('destroy');
    });

    $app->resource('kategori', 'KategoriController')->except(['show']);
    $app->prefix('kategori')->name('kategori.')->group(function ($app) use ($router) {
        $router->get('/{id}/delete', 'KategoriController@destroy')->name('destroy');
    });
});
