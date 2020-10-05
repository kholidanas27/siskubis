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

Route::get('/', 'Front\IndexController@index');
Route::get('/single', 'Front\IndexController@single')->name('single');
Route::get('/pengumuman', 'Front\PengumumanController@index')->name('pengumuman');
Route::get('/pengumuman/{slug}', 'Front\PengumumanController@show');

Auth::routes();
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {
	Route::get('/', 'Admin\HomeController@index')->name('admin.home');
	Route::get('/inkubator', 'Inkubator\InkubatorController@index')->name('admin.inkubator');
	Route::get('/inkubator/{view}', 'Inkubator\InkubatorController@tampil')->name('admin.inkubator.view');
	Route::get('/tenant', 'Tenant\TenantController@index')->name('admin.tenant');
	Route::get('/tenant/{kategori}', 'Tenant\TenantController@kategori')->name('admin.tenant-kategori');
	Route::get('/tenant/{kategori}/{id}', 'Tenant\TenantController@detail')->name('admin.tenant-detail');
	Route::get('/chat', 'Chat\ChatController@index')->name('admin.chat');
});

Route::group(['prefix' => 'inkubator', 'middleware' => ['role:inkubator']], function () {
	Route::get('/', 'Inkubator\HomeController@index')->name('inkubator.home');
	Route::get('/tenant', 'Tenant\TenantController@index')->name('inkubator.tenant');
	Route::get('/tenant/{kategori}', 'Tenant\TenantController@kategori')->name('inkubator.tenant-kategori');
	Route::get('/tenant/{kategori}/{id}', 'Tenant\TenantController@detail')->name('inkubator.tenant-detail');

	Route::get('/mentor', 'Mentor\MentorController@index')->name('inkubator.mentor');
	Route::get('/produk', 'Produk\ProdukController@index')->name('inkubator.produk');
	Route::get('/aktifitas', 'Produk\ProdukController@index')->name('inkubator.aktifitas');
	Route::get('/keuangan', 'Produk\ProdukController@index')->name('inkubator.keuangan');
	Route::get('/pencapaian', 'Produk\ProdukController@index')->name('inkubator.pencapaian');
	Route::get('/laporan', 'Produk\ProdukController@index')->name('inkubator.laporan');
	Route::get('/surat', 'Persuratan\PersuratanController@index')->name('inkubator.surat');
	//Route::get('/event', 'Produk\ProdukController@index')->name('inkubator.event');
	//Route::get('/berita', 'Produk\ProdukController@index')->name('inkubator.berita');
	//Route::get('/pengumuman', 'Produk\ProdukController@index')->name('inkubator.pengumuman');
	Route::get('/event', 'Event\EventController@index')->name('inkubator.event-list');
	Route::get('/event/calendar', 'Event\EventController@calendar')->name('inkubator.event-calendar');
	Route::get('/pengumuman', 'Pengumuman\PengumumanController@index')->name('inkubator.pengumuman');
	Route::get('/pengumuman/nontenant', 'Pengumuman\PengumumanController@tenant')->name('inkubator.non-tenant');
	Route::get('/pengumuman/search', 'Pengumuman\PengumumanController@search');
	Route::get('/pengumuman/tambah', 'Pengumuman\PengumumanController@tambah')->name('inkubator.tambah');
	Route::post('/pengumuman/store', 'Pengumuman\PengumumanController@store')->name('inkubator.store');
	Route::get('/pengumuman/{slug}', 'Pengumuman\PengumumanController@show');
	Route::get('/pengumuman/edit/{id}', 'Pengumuman\PengumumanController@edit')->name('inkubator.edit-id');;
	Route::put('/pengumuman/update/{id}', 'Pengumuman\PengumumanController@update')->name('inkubator.update-id');;
	Route::get('/pengumuman/hapus/{id}', 'Pengumuman\PengumumanController@hapus');
	Route::get('/kategori', 'Pengumuman\KategoriController@index')->name('inkubator.kategori');
	Route::get('/kategori/{id}', 'Pengumuman\KategoriController@kategori')->name('inkubator.kategori-id');
	Route::get('/pengumuman/status/{id}', 'Pengumuman\PengumumanController@status');
	Route::get('/berita', 'Berita\BeritaController@index')->name('inkubator.berita');
	Route::get('/chat', 'Chat\ChatController@index')->name('inkubator.chat');
	Route::get('/pesan', 'Pesan\PesanController@index')->name('inkubator.pesan');
	Route::get('/profile', 'Profile\ProfileUserController@index')->name('inkubator.profile');
});

Route::group(['prefix' => 'mentor', 'middleware' => ['role:mentor']], function () {
	Route::get('/', 'Mentor\HomeController@index')->name('mentor.home');
	Route::get('/chat', 'Chat\ChatController@index')->name('mentor.chat');
	Route::get('/pengumuman', 'Mentor\MentorController@pengumuman')->name('mentor.pengumuman');
	Route::get('/pengumuman/nontenant', 'Mentor\MentorController@tenant')->name('mentor.non-tenant');
	Route::get('/pengumuman/search', 'Mentor\MentorController@search');
	Route::get('/pengumuman/{slug}', 'Mentor\MentorController@show');
	Route::get('/kategori/{id}', 'Mentor\MentorController@kategori')->name('mentor.kategori');
});

Route::group(['prefix' => 'tenant', 'middleware' => ['role:tenant']], function () {
	Route::get('/', 'Tenant\HomeController@index')->name('tenant.home');
	Route::get('/chat', 'Chat\ChatController@index')->name('tenant.chat');
	Route::get('/pengumuman', 'Tenant\TenantController@pengumuman')->name('tenant.pengumuman');
	Route::get('/pengumuman/nontenant', 'Tenant\TenantController@tenant')->name('tenant.non-tenant');
	Route::get('/pengumuman/search', 'Tenant\TenantController@search');
	Route::get('/pengumuman/{slug}', 'Tenant\TenantController@show');
	Route::get('/kategori/{id}', 'Tenant\TenantController@kategori')->name('tenant.kategori');
});

Route::group(['prefix' => 'user', 'middleware' => ['role:user']], function () {
	Route::get('/', 'User\HomeController@index')->name('user.home');
	Route::get('/chat', 'Chat\ChatController@index')->name('user.chat');
	Route::get('/pengumuman', 'User\UserController@pengumuman');
	Route::get('/pengumuman/{slug}', 'User\UserController@show');
});
