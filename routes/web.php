<?php

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

Route::get('coba', function(){

});

Route::get('/', 'LoginController@login')->name('login');

Route::post('/', 'LoginController@doLogin')->name('doLogin');

Route::get('/logout', 'LoginController@logout');

Route::middleware(['sessionLogin'])->group(function () {

    // Route::get('/halaman/dosen','DosenController@index');

    //Route aktor Admin
    
    Route::get('/halaman/kategori', 'KategoriController@index');
    
    Route::post('/halaman/kategori/simpan', 'KategoriController@create');
    
    Route::post('/halaman/kategori/edit', 'KategoriController@update');
    
    Route::post('/halaman/kategori/hapus', 'KategoriController@delete');
    
    // Route::post('/halaman/dosen/simpan', 'DosenController@create');
    
    // Route::post('/halaman/dosen/edit', 'DosenController@update');
    
    // Route::post('/halaman/dosen/hapus', 'DosenController@delete');

    // Route Aktor Dosen

    Route::get('/halaman/home', 'HomeController@index');
    
    Route::get('/halaman/subkategori','SubkategoriController@index');

    Route::post('/halaman/subkategori/simpan', 'SubkategoriController@create');
    
    Route::post('/halaman/subkategori/edit', 'SubkategoriController@update');
    
    Route::post('/halaman/subkategori/hapus', 'SubkategoriController@delete');
    
    Route::post('/list-aktifitas/simpan', 'ListController@create');
    
    Route::post('/list-aktifitas/hapus', 'ListController@delete');

    Route::post('/list-aktifitas/edit', 'ListController@update');

    Route::get('/list-aktifitas/list-kategori-dokumen', 'ListController@listKategoriDokumen');
    
    Route::get('list-aktifitas/{id_kategori}/{id_sub_kategori}', 'ListController@index');

    // route aktor ketua jurusan
    
    Route::get('/logdosen','LogDosenController@index');
    
    Route::get('/pending/{id_dosen}', 'HistoryController@pending');

    Route::get('/proses/{id_dosen}', 'HistoryController@proses');

    Route::get('/selesai/{id_dosen}', 'HistoryController@selesai');

    Route::get('/semua/{id_dosen}', 'HistoryController@semua');

    Route::post('/filter/{id_status}', 'HistoryController@filter');

    Route::get('/download/{id_dosen}', 'HistoryController@export');

    Route::get('/download/{id_dosen}/{id_status}', 'HistoryController@export');


});


