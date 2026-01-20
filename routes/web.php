<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Services\NotificationService;
use App\Http\Controllers\AccessCardManagement;

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
Route::get('/fp/user/business-card/{id}', [AccessCardManagement::class, 'BusinessCardDisplay'])->name('business_card.show');

Route::get('/notifications', function (NotificationService $notify) {
    try {
        return response()->json(
            $notify->getUserNotifications(Auth::user()->agent)
        );
    } catch (\Throwable $th) {
        //throw $th;
        return response()->json(['error' => 'Unable to fetch notifications', 'message' => $th->getMessage()], 500);
    }

})->name('notification.fetch');

// Route::post('/notifications/mark-read', function (NotificationService $notify) {
//     $notify->markAsRead(auth()->id());
//     return response()->json(['status' => 'ok']);
// })->name('notification.read');

Route::get('/scanner', [AccessCardManagement::class, 'scanIndex'])->name('scanner.index');
Route::post('/scanner/result', [AccessCardManagement::class, 'storeScanResult'])->name('scanner.result');
Route::post('/scanner/upload-image', [AccessCardManagement::class, 'uploadQrImage'])->name('scanner.upload-image');
