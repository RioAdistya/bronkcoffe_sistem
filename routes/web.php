<?php
  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\DetailProdukController;
use App\Http\Controllers\DetailBahanBakuController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ForecastController;
use App\Http\Controllers\Auth\LoginController;

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
    return view('main');
});
  
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/logout',[LoginController::class, 'logout'])->name('logout');
});

// Auth Owner
Route::middleware(['auth', 'user-access:owner'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
  
// Auth Produksi
Route::middleware(['auth', 'user-access:produksi'])->group(function () {
    Route::get('/produksi/home', [HomeController::class, 'produksiHome'])->name('produksi.home');
});
  
// Auth Kedai
Route::middleware(['auth', 'user-access:kedai'])->group(function () {
    Route::get('/kedai/home', [HomeController::class, 'kedaiHome'])->name('kedai.home');
});

// Owner Home 
Route::get('/ownerMitra', function () {
    return view('ownerMitra');
});

Route::get('/editOwner', function () {
    return view('editOwner');
});

// CRU KARYAWAN KEDAI
Route::get('/karyawanKedai', [KaryawanController::class, 'indexKedai']);
Route::get('/karyawanKedai/tambah', [KaryawanController::class, 'createKedai']);
Route::patch('/karyawanKedai/store', [KaryawanController::class, 'storeKedai']);
Route::get('/karyawanKedai/edit/{id}', [KaryawanController::class, 'editKedai']);
Route::patch('/karyawanKedai/update/{id}', [KaryawanController::class, 'updateKedai']);
// Route::get('/karyawanKedai/delete/{id}', [KaryawanController::class, 'destroy']);

// CRU KARYAWAN PRODUKSI
Route::get('/karyawanProduksi', [KaryawanController::class, 'indexProduksi']);
Route::get('/karyawanProduksi/tambah', [KaryawanController::class, 'createProduksi']);
Route::patch('/karyawanProduksi/store', [KaryawanController::class, 'storeProduksi']);
Route::get('/karyawanProduksi/edit/{id}', [KaryawanController::class, 'editProduksi']);
Route::patch('/karyawanProduksi/update/{id}', [KaryawanController::class, 'updateProduksi']);

// RU OWNER
Route::get('/ownerMitra', [OwnerController::class, 'index']);
Route::get('/ownerMitra/edit/{id}', [OwnerController::class, 'edit']);
Route::patch('/ownerMitra/update/{id}', [OwnerController::class, 'update']);

// Kedai Home
Route::get('/profilKaryawanKedai', [KaryawanController::class, 'indexKedaiHome']);
Route::get('/karyawanProduksi/detail/{id}', [KaryawanController::class, 'indexProduksiDetail']);

// Produksi Home
Route::get('/karyawanKedai/detail/{id}', [KaryawanController::class, 'indexKedaiDetail']);
Route::get('/profilKaryawanProduksi', [KaryawanController::class, 'indexProduksiHome']);

// Produksi Produk
Route::get('/produksiStockKopi', [DetailProdukController::class, 'indexProduksiStockKopi']);
Route::get('/ownerStockKopi', [DetailProdukController::class, 'indexOwnerStockKopi']);
Route::get('/kedaiStockKopi', [DetailProdukController::class, 'indexKedaiStockKopi']);
Route::get('/stockKopi/tambah', [DetailProdukController::class, 'createStockKopi']);
Route::patch('/stockKopi/store', [DetailProdukController::class, 'storeStockKopi']);
Route::get('/produksiStockKopi/detail/{namaProduk}', [DetailProdukController::class, 'indexProduksiStockKopiDetail']);
Route::get('/ownerStockKopi/detail/{namaProduk}', [DetailProdukController::class, 'indexOwnerStockKopiDetail']);
Route::get('/kedaiStockKopi/detail/{namaProduk}', [DetailProdukController::class, 'indexKedaiStockKopiDetail']);
Route::get('/stockKopi/edit/{namaProduk}/{kategori}', [DetailProdukController::class, 'editStockKopi']);
Route::get('/stockKopi/update/{namaProduk}/{kategori}/{jumlahStok}/{hargaPer100Gram}', [DetailProdukController::class, 'updateStockKopi']);

// Produksi Bahan Baku
Route::get('/produksiBahanBaku', [DetailBahanBakuController::class, 'indexProduksiBahanBaku']);
Route::get('/ownerBahanBaku', [DetailBahanBakuController::class, 'indexOwnerBahanBaku']);
Route::get('/produksiBahanBaku/detail/{namaProduk}', [DetailBahanBakuController::class, 'indexProduksiBahanBakuDetail']);
Route::get('/ownerBahanBaku/detail/{namaProduk}', [DetailBahanBakuController::class, 'indexOwnerBahanBakuDetail']);
Route::get('/bahanBaku/tambah', [DetailBahanBakuController::class, 'createBahanBaku']);
Route::patch('/bahanBaku/store', [DetailBahanBakuController::class, 'storeBahanBaku']);
Route::get('/bahanBaku/edit/{namaBahan}', [DetailBahanBakuController::class, 'editBahanBaku']);
Route::get('/bahanBaku/update/{namaBahan}/{kuantitas}/{hargaSatuan}/{keterangan}', [DetailBahanBakuController::class, 'updateBahanBaku']);

// Penjualan
Route::get('/kedaiPenjualan/{month}', [DetailPenjualanController::class, 'createPenjualan']);
Route::patch('/penjualan/store', [DetailPenjualanController::class, 'storePenjualan']);
Route::get('/penjualan/edit/{idPenjualan}', [DetailPenjualanController::class, 'editPenjualan']);
Route::get('/penjualan/update/{idPenjualan}', [DetailPenjualanController::class, 'updatePenjualan']);

// Dashboard
Route::get('/home', [ForecastController::class, 'indexOwnerBijiKopiDashboard'])->name('home');
Route::get('/kedai/home', [DetailProdukController::class, 'indexKedaiStockKopiDashboard'])->name('kedai.home');
Route::get('/produksi/home', [DetailBahanBakuController::class, 'indexProduksiBahanBakuDashboard'])->name('produksi.home');

// Forcast
Route::get('/ownerPrediksiPasar/{produk}/{kategori}/{tahun}', [ForecastController::class, 'indexForecastPasar']);
Route::get('/ownerPrediksiStok/{tahun}', [ForecastController::class, 'indexForecastBijiKopi']);
Route::get('/kedaiPrediksiPasar/{produk}/{kategori}/{tahun}', [ForecastController::class, 'indexForecastPasarKedai']);
Route::get('/produksiPrediksiStok/{tahun}', [ForecastController::class, 'indexForecastBijiKopiProduksi']);

// Rekap Keuangan
Route::get('/ownerRekapitulasi', [DetailPenjualanController::class, 'indexOwnerRekap']);
Route::get('/ownerRekapitulasiDetail/{periode}', [DetailPenjualanController::class, 'indexOwnerRekapDetail']);