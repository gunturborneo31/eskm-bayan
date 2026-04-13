<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\JenisKelaminController;
use App\Http\Controllers\UsiaController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\SaranMasukanController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\NilaiUnsurController;
use App\Http\Controllers\RekapTotalController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\SubJenisController;
use Illuminate\Support\Facades\Route;
use App\Support\BagianOptions;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/portal', [PortalController::class, 'index']);
Route::get('/portal/{slug}', [PortalController::class, 'slug']);
Route::get('/', [DashboardController::class, 'welcome']);
Route::view('/remake', 'home');

Route::get('/login', function () {
    if (session()->has('user_id')) {
        $role = session('keterangan', 'admin');
        $bagian = BagianOptions::csvForRole($role);
        $tw = (int) ceil((int) date('m') / 3);
        $tahun = date('Y');

        return redirect("/rekapTotal?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw={$tw}&Tahun={$tahun}&bagian={$bagian}&keterangan=" . urlencode($role));
    }

    return view('login');
})->name('login');

Route::post('/login', [DashboardController::class, 'store'])->name('login.store');
Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

Route::get('/skm', function () {
    $bagianList = collect(BagianOptions::idNameMap())
        ->map(fn ($name) => strtoupper($name))
        ->toArray();

    return view('skm', compact('bagianList'));
});

Route::get('/terimakasih', function () {
    return view('terimakasih');
});

// Route::get('word', function () {
//     return view('word');
// });

Route::get('export', [WordController::class,'export'])->name('export');
Route::get('/exports', function () {
    return view('exports');
});

Route::resource('dashboard', DashboardController::class)->only(['index']);

Route::middleware('admin.session')->group(function () {
    Route::resource('dashboardAdmin', DashboardController::class)->except(['store']);
    Route::resource('jenisKelamin', JenisKelaminController::class);
    Route::resource('usia', UsiaController::class);
    Route::resource('pekerjaan', PekerjaanController::class);
    Route::resource('pendidikan', PendidikanController::class);
    Route::resource('saranDanMasukan', SaranMasukanController::class);
    Route::resource('nilaiRekap', NilaiController::class);
    Route::resource('nilaiUnsur', NilaiUnsurController::class);
    Route::resource('rekapTotal', RekapTotalController::class);
    Route::resource('pengaturanAdmin', PengaturanController::class);

    Route::get('exports/download', [ExportController::class, 'export'])->name('exports.download');

    Route::get('/sub-jenis', [SubJenisController::class, 'index'])->name('subjenis.index');
});

// Offline SKM Admin
Route::middleware('admin.session')->group(function () {
    Route::get('/admin/offline-skm', function () {
        return view('admin.offline-skm');
    })->name('admin.offline-skm');
    Route::post('/admin/import-offline-skm', [\App\Http\Controllers\OfflineSkmController::class, 'import'])->name('admin.import-offline-skm');
});

// API endpoints (AJAX)
Route::prefix('sub-jenis')->group(function () {
    Route::get('/list',   [SubJenisController::class, 'list']);   // ?bagian=1&q=xyz
    Route::middleware('admin.session')->group(function () {
        Route::get('/bagian/list', [SubJenisController::class, 'bagianList']);
        Route::post('/bagian/store', [SubJenisController::class, 'bagianStore']);
        Route::put('/bagian/{id}', [SubJenisController::class, 'bagianUpdate']);
        Route::delete('/bagian/{id}', [SubJenisController::class, 'bagianDestroy']);
        Route::post('/store', [SubJenisController::class, 'store']);
        Route::put('/jenis',  [SubJenisController::class, 'updateJenis']);
        Route::delete('/jenis', [SubJenisController::class, 'destroyJenis']);
        Route::put('/{id}',   [SubJenisController::class, 'update']);
        Route::delete('/{id}',[SubJenisController::class, 'destroy']);
    });
});


