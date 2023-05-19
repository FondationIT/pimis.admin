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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/etBesReg', [App\Http\Controllers\EtatBesoinController::class, 'create'])->name('etBesReg');
Route::post('/proformaReg', [App\Http\Controllers\EtatBesoinController::class, 'proforma'])->name('proformaReg');
Route::post('/pvReg', [App\Http\Controllers\EtatBesoinController::class, 'pv'])->name('pvReg');

Auth::routes();


