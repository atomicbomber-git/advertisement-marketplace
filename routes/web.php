<?php

use App\Http\Controllers\PenjualController;
use App\Http\Controllers\PenjualRegistrationController;
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
    return redirect()->route("login");
});

Route::resource("penjual", class_basename(PenjualController::class));
Route::resource("penjual-registrasi", class_basename(PenjualRegistrationController::class))->only(["create", "store"]);