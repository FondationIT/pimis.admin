<?php
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
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/etBesReg', [App\Http\Controllers\EtatBesoinController::class, 'create'])->name('etBesReg');
Route::post('/etBesApp', [App\Http\Controllers\EtatBesoinController::class, 'approuve'])->name('etBesApp');

Route::post('/proformaReg', [App\Http\Controllers\EtatBesoinController::class, 'proforma'])->name('proformaReg');
Route::post('/pvReg', [App\Http\Controllers\EtatBesoinController::class, 'pv'])->name('pvReg');
Route::post('/pvAttrReg', [App\Http\Controllers\EtatBesoinController::class, 'pvAttr'])->name('pvAttrReg');
Route::post('/brReg', [App\Http\Controllers\EtatBesoinController::class, 'br'])->name('brReg');
Route::post('/diReg', [App\Http\Controllers\EtatBesoinController::class, 'di'])->name('diReg');
Route::post('/ndReg', [App\Http\Controllers\EtatBesoinController::class, 'nd'])->name('ndReg');
Route::post('/trReg', [App\Http\Controllers\EtatBesoinController::class, 'tr'])->name('trReg');
Route::post('/msReg', [App\Http\Controllers\EtatBesoinController::class, 'miss'])->name('msReg');
Route::post('/ctrReg', [App\Http\Controllers\EtatBesoinController::class, 'ctr'])->name('ctrReg');
Route::post('/jpReg', [App\Http\Controllers\EtatBesoinController::class, 'jp'])->name('jpReg');



