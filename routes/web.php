<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

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

Route::get('/', [DashboardController::class, 'welcome']);
Route::get('/remake', [DashboardController::class, 'welcome']);

Route::get('/login', function () {
    return view('login');
});

Route::get('/skm', function () {
    return view('skm');
});

Route::get('/terimakasih', function () {
    return view('terimakasih');
});

// Route::get('word', function () {
//     return view('word');
// });

Route::get('export', [WordController::class,'export'])->name('export');
// Route::get('exportword', 'exportword')->name('exportword');


Route::resource('dashboard', DashboardController::class);
Route::resource('dashboardAdmin', DashboardController::class);
Route::resource('jenisKelamin', JenisKelaminController::class);
Route::resource('usia', UsiaController::class);
Route::resource('pekerjaan', PekerjaanController::class);
Route::resource('pendidikan', PendidikanController::class);
Route::resource('saranDanMasukan', SaranMasukanController::class);
Route::resource('nilaiRekap', NilaiController::class);
Route::resource('nilaiUnsur', NilaiUnsurController::class);
Route::resource('rekapTotal', RekapTotalController::class);
Route::resource('pengaturanAdmin', PengaturanController::class);

Route::controller(ExportController::class)->group(function(){
    Route::get('exportJenkel', 'exportJenkel')->name('exportJenkel');
    Route::get('exportUsia', 'exportUsia')->name('exportUsia');
    Route::get('exportPekerjaan', 'exportPekerjaan')->name('exportPekerjaan');
    Route::get('exportPendidikan', 'exportPendidikan')->name('exportPendidikan');
    Route::get('exportSaranMasukan', 'exportSaranMasukan')->name('exportSaranMasukan');
    Route::get('exportResume', 'exportResume')->name('exportResume');
});

