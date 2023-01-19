<?php

// ini adalah controller Transaksi
Use App\Http\Controllers\TransaksiController;

// ini adalah controller Barang
Use App\Http\Controllers\BarangController;

// ini adalah controller distributor
Use App\Http\Controllers\DistributorController;

// ini adalah controller merek
Use App\Http\Controllers\MerekController;

// ini adalah controller rayon
Use App\Http\Controllers\RayonController;


// ini adalah controller rombel
Use App\Http\Controllers\RombelController;

// ini adalah controller datasiswa
Use App\Http\Controllers\DatasiswaController;

// ini adalah controller product
Use App\Http\Controllers\ProductController;
use App\Models\Datasiswa;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('index', function () {
    return view('index');
});

// ini adalah route menuju halaman product
Route::resource('products', ProductController::class);

// ini adalah route menuju halaman datasiswa
Route::resource('datasiswas', DatasiswaController::class);

// ini adalah route menuju halaman rombel
Route::resource('rombels', RombelController::class);

// ini adalah route menuju halaman rayon
Route::resource('rayons', RayonController::class);

// ini adalah route menuju halaman merek
Route::resource('mereks', MerekController::class);

// ini adalah route menuju halaman distributor
Route::resource('distributors', DistributorController::class);

// ini adalah route menuju halaman barang
Route::resource('barangs', BarangController::class);

// ini adalah route menuju halaman transaksi
Route::resource('transaksis', TransaksiController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
