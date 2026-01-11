<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', function () {
    return \App\Models\Agent::select('id','firstname','lastname','middlename')->get(); // Fetch user
});

Route::get('', function () {
    return \App\Models\User::select('id','firstname','lastname','middlename')->get(); // Fetch user
});

Route::get('/fp/card-member/{id}', [App\Http\Controllers\AccessCardManagement::class, 'CardVerification'])->name('card_verification')->middleware('check.apikey');
Route::get('/fp/agent', [App\Http\Controllers\AccessCardManagement::class, 'FetchAgent'])->name('fetch_agent')->middleware('check.apikey');

// ssh u109152304@82.29.199.13 -p 65002
// PZ/fpit5311!
// cd domains/pimis.org/public_html/admin

// php artisan route:list | grep /fp/agent
// php artisan migrate
