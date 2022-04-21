<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanKreditController;
use \App\Http\Controllers\KabupatenController;
use \App\Http\Controllers\KecamatanController;
use \App\Http\Controllers\DesaController;
use \App\Http\Controllers\CabangController;
use App\Http\Controllers\MasterItemController;
use \App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return redirect()->route('login');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // check Pincab
    Route::post('pengajuan-kredit/pincabStatusDetailPost',[PengajuanKreditController::class,"ch eckPincabStatusDetailPost"])->name('pengajuan.check.pincab.status.detail.post');
    Route::get('pengajuan-kredit/pincabStatusDetail/{id}',[PengajuanKreditController::class,"checkPincabStatusDetail"])->name('pengajuan.check.pincab.status.detail');
    Route::get('pengajuan-kredit/pincabStatusChange/{id}',[PengajuanKreditController::class,"checkPincabStatusChange"])->name('pengajuan.change.pincab.status');
    Route::get('pengajuan-kredit/pincabStatus',[PengajuanKreditController::class,"checkPincabStatus"])->name('pengajuan.check.pincab.status');
    Route::get('pengajuan-kredit/pincab/{id}',[PengajuanKreditController::class,"checkPincab"])->name('pengajuan.check.pincab');
    // check Staf analisa
    Route::get('pengajuan-kredit/staf-analisa/{id}',[PengajuanKreditController::class,"checkStafAnalisa"])->name('pengajuan.check.stafanalisa');
    // check penyelia
    Route::get('pengajuan-kredit/penyelia-kredit/{id}',[PengajuanKreditController::class,"checkPenyeliaKredit"])->name('pengajuan.check.penyeliakredit');
    Route::post('pengajuan-kredit/jawaban-pengajuan', [PengajuanKreditController::class,"getInsertKomentar"])->name('pengajuan.insertkomentar');
    Route::get('pengajuan-kredit/jawaban-pengajuan/{id}', [PengajuanKreditController::class,"getDetailJawaban"])->name('pengajuan.detailjawaban');
    Route::get('getkecamatan', [PengajuanKreditController::class,"getkecamatan"]);
    Route::get('getdesa', [PengajuanKreditController::class,"getdesa"]);
    Route::resource('pengajuan-kredit', PengajuanKreditController::class);

    Route::resource('kabupaten', KabupatenController::class);
    Route::resource('kecamatan', KecamatanController::class);
    Route::resource('desa', DesaController::class);
    Route::resource('cabang', CabangController::class);
    Route::resource('user', UserController::class);
    Route::get('change-password', [UserController::class, 'changePassword'])->name('change_password');
    Route::put('change-password/{id}', [UserController::class, 'updatePassword'])->name('update_password');
    // master item
    Route::get('/master-item/addEditItem',[MasterItemController::class,'addEditItem']);
    Route::get('data-item-satu',[MasterItemController::class,'dataItemSatu']);
    Route::get('data-item-tiga',[MasterItemController::class,'dataItemtiga']);
    Route::get('data-item-empat',[MasterItemController::class,'dataItemEmpat']);
    Route::resource('master-item', MasterItemController::class);
});

require __DIR__ . '/auth.php';
