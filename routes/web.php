<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceCancellationForPelangganController;
use App\Http\Controllers\InvoiceForPelangganController;
use App\Http\Controllers\InvoiceForPenjualController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganProfileController;
use App\Http\Controllers\PelangganRegistrasiController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\PenjualForPembeliController;
use App\Http\Controllers\ProdukForPenjualController;
use App\Http\Controllers\PenjualProfileController;
use App\Http\Controllers\PenjualRegistrationController;
use App\Http\Controllers\ProdukForPelanggan;
use App\Http\Controllers\ProdukThumbController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    "register" => false,
    "reset" => false,
    "confirm" => false,
    "verify" => false,
]);

Route::get('/', function () {
    return redirect()->route("home");
});

Route::get("/home", [HomeController::class, "index"])
    ->name("home");

Route::resource("penjual", class_basename(PenjualController::class))
    ->only(["index"]);

Route::resource("pelanggan", class_basename(PelangganController::class))
    ->only(["index"]);

Route::resource("penjual-registrasi", class_basename(PenjualRegistrationController::class))
    ->only(["create", "store"]);

Route::resource("pelanggan-registrasi", class_basename(PelangganRegistrasiController::class))
    ->only(["create", "store"]);

Route::resource("penjual-profile", class_basename(PenjualProfileController::class))
    ->only(["edit", "update"])
    ->parameter("penjual-profile", "penjual");

Route::resource("pelanggan-profile", class_basename(PelangganProfileController::class))
    ->only(["edit", "update"])
    ->parameter("pelanggan-profile", "pelanggan");

Route::resource("penjual.produk-for-penjual", class_basename(ProdukForPenjualController::class))
    ->parameter("produk-for-penjual", "produk")
    ->shallow();

Route::resource("produk-thumb", class_basename(ProdukThumbController::class))
    ->parameter("produk-thumb", "produk")
    ->only(["show"]);

Route::resource("penjual.produk-for-pelanggan", class_basename(ProdukForPelanggan::class))
    ->parameter("produk-for-pelanggan", "produk:kode")
    ->only(["show"]);

Route::resource("penjual-for-pembeli", class_basename(PenjualForPembeliController::class))
    ->parameter("penjual-for-pembeli", "penjual")
    ->only(["show"]);

Route::resource("pelanggan.invoice-for-pelanggan", class_basename(InvoiceForPelangganController::class))
    ->parameter("invoice-for-pelanggan", "invoice")
    ->only(["index", "edit", "show"])
    ->scoped();

Route::resource("penjual.invoice-for-penjual", class_basename(InvoiceForPenjualController::class))
    ->parameter("invoice-for-penjual", "invoice")
    ->only(["index", "edit", "update", "show"])
    ->scoped();

Route::resource("kategori-produk", class_basename(KategoriProdukController::class));
