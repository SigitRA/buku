<?php

use App\Http\Controllers\DepartementController;
use App\Http\Controllers\UserController; //mendaftarkan controler yang akan digunakan
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RakController;

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PenyimapananController;
use App\Http\Controllers\PenyimpananController;

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



Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');

Route::middleware('auth')->group(
    function () {
        Route::get('/', function () {
            return view('home', ['title' => 'Home']);
        })->name('home');
        Route::get('password', [UserController::class, 'password'])->name('password');
        Route::post('password', [UserController::class, 'password_action'])->name('password.action');
        Route::get('logout', [UserController::class, 'logout'])->name('logout');


        // Route Position
        Route::resource('positions', PositionController::class);
        Route::resource('departements', DepartementController::class);
        Route::resource('users', UserController::class);
        Route::resource('bukus', BukuController::class);
        Route::get('departement/export-pdf', [DepartementController::class, 'exportPdf'])->name('departements.exportPdf');
        Route::get('user/export-pdf', [UserController::class, 'exportPdf'])->name('users.exportPdf');
        Route::get('position/export-excel', [PositionController::class, 'exportExcel'])->name('position.exportExcel');
        Route::resource('penyimpanans', PenyimpananController::class);
        Route::get('search/buku', [BukuController::class, 'autocomplete'])->name('search.buku');
        Route::resource('bukus', BukuController::class);
        Route::get('chart-line', [PenyimpananController::class, 'chartLine'])->name('penyimpanans.chartLine');
        Route::get('chart-line-ajax', [PenyimpananController::class, 'chartLineAjax'])->name('penyimpanans.chartLineAjax');
    }
);
