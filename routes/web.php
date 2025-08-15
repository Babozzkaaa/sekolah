<?php

use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KelasGSController;
use App\Http\Controllers\KelasGuruController;
use App\Http\Controllers\KelasSiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('guru')->name('guru.')->group(function () {
        Route::get('/', [GuruController::class, 'getGuru'])->name('list');
        Route::get('/create', [GuruController::class, 'create'])->name('create');
        Route::post('/create', [GuruController::class, 'createData'])->name('createData');
        Route::get('/edit/{id}', [GuruController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [GuruController::class, 'editData'])->name('editData');
        Route::delete('/delete/{id}', [GuruController::class, 'delete'])->name('delete');
    });

    Route::prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/', [SiswaController::class, 'getSiswa'])->name('list');
        Route::get('/create', [SiswaController::class, 'create'])->name('create');
        Route::post('/create', [SiswaController::class, 'createData'])->name('createData');
        Route::get('/edit/{id}', [SiswaController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [SiswaController::class, 'editData'])->name('editData');
        Route::delete('/delete/{id}', [SiswaController::class, 'delete'])->name('delete');
    });
   
    Route::prefix('kelas')->name('kelas.')->group(function () {
        Route::get('/', [KelasController::class, 'getKelas'])->name('list');
        Route::get('/create', [KelasController::class, 'create'])->name('create');
        Route::post('/create', [KelasController::class, 'createData'])->name('createData');
        Route::get('/edit/{id}', [KelasController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [KelasController::class, 'editData'])->name('editData');
        Route::delete('/delete/{id}', [KelasController::class, 'delete'])->name('delete');
    });

    Route::prefix('kelas-guru')->name('kelas-guru.')->group(function () {
        Route::get('/', [KelasGuruController::class, 'getKelasGuru'])->name('list');
        Route::get('/create', [KelasGuruController::class, 'create'])->name('create');
        Route::post('/create', [KelasGuruController::class, 'createData'])->name('createData');
        Route::get('/edit/{id}', [KelasGuruController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [KelasGuruController::class, 'editData'])->name('editData');
        Route::delete('/delete/{id}', [KelasGuruController::class, 'delete'])->name('delete');
    });
    
    Route::prefix('kelas-siswa')->name('kelas-siswa.')->group(function () {
        Route::get('/', [KelasSiswaController::class, 'getKelasSiswa'])->name('list');
        Route::get('/create', [KelasSiswaController::class, 'create'])->name('create');
        Route::post('/create', [KelasSiswaController::class, 'createData'])->name('createData');
        Route::get('/edit/{id}', [KelasSiswaController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [KelasSiswaController::class, 'editData'])->name('editData');
        Route::delete('/delete/{id}', [KelasSiswaController::class, 'delete'])->name('delete');
    });

    Route::get('/gbk', [KelasGSController::class, 'getGuruByKelas'])->name('gbk.list');
    // Route::get('/gbk/{id_kelas}', [KelasGSController::class, 'getGuruByKelas'])->name('gbk.list');
    Route::get('/sbk', [KelasGSController::class, 'getSiswaByKelas'])->name('sbk.list');
    Route::get('/kgs', [KelasGSController::class, 'getKelasGuruSiswa'])->name('kgs.list');
    // Route::get('/sbk/{id_kelas}', [KelasGSController::class, 'getSiswaByKelas'])->name('sbk.list');
    // Route::get('/kgs/{id_kelas}', [KelasGSController::class, 'getKelasGuruSiswa'])->name('kgs.list');

});

require __DIR__.'/auth.php';
