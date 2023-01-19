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
Route::post('/agentReg', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('agentReg');
Route::post('/userReg', [App\Http\Controllers\UserController::class, 'create'])->name('userReg');
Route::post('/bailleurReg', [App\Http\Controllers\BailleurController::class, 'create'])->name('bailleurReg');
Route::post('/projetReg', [App\Http\Controllers\ProjetController::class, 'create'])->name('projetReg');
Route::post('/affectationReg', [App\Http\Controllers\AffectationController::class, 'create'])->name('affectationReg');
Route::post('/categorieReg', [App\Http\Controllers\ProductController::class, 'createCat'])->name('categorieReg');
Route::post('/productReg', [App\Http\Controllers\ProductController::class, 'createProd'])->name('productReg');
Route::post('/etBesReg', [App\Http\Controllers\EtatBesoinController::class, 'create'])->name('etBesReg');

Auth::routes();


