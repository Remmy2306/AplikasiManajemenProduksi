<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ControllerDTY;

// 🔹 Halaman Login
Route::get('/login', [LoginController::class, 'tampil_login'])->middleware('guest');
Route::post('/proses_login', [LoginController::class, 'login'])->middleware('guest');
Route::get('/blok', [LoginController::class, 'tampil_blok']);
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

// 🔹 Data Laporan
Route::get('/dataLaporan', [ViewController::class, 'tampil_dataLaporan'])->middleware('auth');
Route::get('/InputLaporan', [ViewController::class, 'tampil_inputLaporan'])->middleware('auth');
Route::post('/simpanLaporan', [ViewController::class, 'simpan_laporan'])->middleware('auth');
Route::get('/hapusLaporan/{id_penjualan}', [ViewController::class, 'delete_laporan'])->middleware('auth');
Route::get('/ubahLaporan/{id_penjualan}', [ViewController::class, 'edit_laporan'])->middleware('auth');
Route::post('/updateLaporan/{id_penjualan}', [ViewController::class, 'update_laporan'])->middleware('auth');
Route::get('/cariLaporan', [ViewController::class, 'cari_laporan'])->middleware('auth');

// 🔹 Data Pelanggan
Route::get('/dataPelanggan', [ViewController::class, 'tampil_dataPelanggan'])->middleware('auth');
Route::get('/InputPelanggan', [ViewController::class, 'tampil_inputPelanggan'])->middleware('auth');
Route::post('/simpanPelanggan', [ViewController::class, 'simpan_pelanggan'])->middleware('auth');
Route::get('/ubahPelanggan/{id_pelanggan}', [ViewController::class, 'edit_pelanggan'])->middleware('auth');
Route::post('/updatePelanggan/{id_pelanggan}', [ViewController::class, 'update_pelanggan'])->middleware('auth');
Route::get('/hapusPelanggan/{id_pelanggan}', [ViewController::class, 'delete_pelanggan'])->middleware('auth');

// 🔹 Data Produk
Route::get('/dataProduk', [ViewController::class, 'tampil_halamanProduk'])->middleware('auth');
Route::get('/InputProduk', [ViewController::class, 'tampil_inputProduk'])->middleware('auth');
Route::post('/simpanProduk', [ViewController::class, 'simpan_produk'])->middleware('auth');
Route::get('/ubahProduk/{id_produk}', [ViewController::class, 'edit_produk'])->middleware('auth');
Route::post('/updateProduk/{id_produk}', [ViewController::class, 'update_produk'])->middleware('auth');
Route::get('/hapusProduk/{id_produk}', [ViewController::class, 'delete_produk'])->middleware('auth');

// 🔹 Barang Masuk
Route::get('/barangMasuk', [ControllerDTY::class, 'tampil_barang_masuk'])->middleware('auth');
Route::get('/inputBarangMasuk', [ControllerDTY::class, 'form_barang_masuk'])->middleware('auth');
Route::post('/simpanBarangMasuk', [ControllerDTY::class, 'simpan_barang_masuk'])->middleware('auth');
Route::get('/editBarangMasuk/{id}', [ControllerDTY::class, 'edit_barang_masuk'])->middleware('auth');
Route::post('/updateBarangMasuk/{id}', [ControllerDTY::class, 'update_barang_masuk'])->middleware('auth');
Route::get('/hapusBarangMasuk/{id}', [ControllerDTY::class, 'delete_barang_masuk'])->middleware('auth');

// 🔹 Barang Diproses
Route::get('/barangDiproses', [ControllerDTY::class, 'tampil_barang_diproses'])->middleware('auth');
Route::get('/inputBarangDiproses', [ControllerDTY::class, 'form_barang_diproses'])->middleware('auth');
Route::post('/simpanBarangDiproses', [ControllerDTY::class, 'simpan_barang_diproses'])->middleware('auth');
Route::get('/editBarangDiproses/{id}', [ControllerDTY::class, 'edit_barang_diproses'])->middleware('auth');
Route::post('/updateBarangDiproses/{id}', [ControllerDTY::class, 'update_barang_diproses'])->middleware('auth');
Route::get('/hapusBarangDiproses/{id}', [ControllerDTY::class, 'delete_barang_diproses'])->middleware('auth');

// 🔹 Barang Keluar
Route::get('/barangKeluar', [ControllerDTY::class, 'tampil_barang_keluar'])->middleware('auth');
Route::get('/inputBarangKeluar', [ControllerDTY::class, 'form_barang_keluar'])->middleware('auth');
Route::post('/simpanBarangKeluar', [ControllerDTY::class, 'simpan_barang_keluar'])->middleware('auth');
Route::get('/editBarangKeluar/{id}', [ControllerDTY::class, 'edit_barang_keluar'])->middleware('auth');
Route::post('/updateBarangKeluar/{id}', [ControllerDTY::class, 'update_barang_keluar'])->middleware('auth');
Route::get('/hapusBarangKeluar/{id}', [ControllerDTY::class, 'delete_barang_keluar'])->middleware('auth');
