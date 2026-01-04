<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangHeaderController;
use App\Http\Controllers\PegawaiHeaderController;
use App\Http\Controllers\TransaksiHeaderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/viewIndex', function () {
//     return view(table_barang_Controller::class, 'index');
// });

Route::get('/viewIndex', [BarangController::class, 'indexBarang']);
Route::get('/viewTambah', [BarangController::class, 'tambahBarang']);
Route::post('/viewTambah/post', [BarangController::class, 'insertBarang']);
Route::get('/viewEdit/{id}', [BarangController::class, 'viewEdit']);
Route::put('/putUpdate/{id}', [BarangController::class, 'putUpdate']);
Route::DELETE('/delete/{id}', [BarangController::class, 'delete']);


//Transaksi

// Route::get('/transaksi', [TransaksiHeaderController::class, 'index']);
Route::resource('/transaksi', TransaksiHeaderController::class);


//Barang
Route::resource('/barang', BarangHeaderController::class);

//Pegawai
Route::resource('/pegawai', PegawaiHeaderController::class);

// Route::view('/viewIndexLagi', 'pages.viewIndex');
