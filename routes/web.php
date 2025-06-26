<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StuntingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\GalleryController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/check-form', [StuntingController::class, 'showForm'])->name('stunting.form');
Route::post('/check-stunting', [StuntingController::class, 'check'])->name('stunting.check');
Route::get('/result/{child}', [StuntingController::class, 'result'])->name('stunting.result');
Route::get('/history/{nik}', [StuntingController::class, 'history'])->name('stunting.history');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Admin Routes
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/children', [AdminController::class, 'children'])->name('admin.children');
    Route::get('/children/{child}', [AdminController::class, 'showChild'])->name('admin.children.show');
    Route::get('/measurements', [AdminController::class, 'measurements'])->name('admin.measurements');
    Route::get('/export', [AdminController::class, 'export'])->name('admin.export');
    Route::get('/admin/children/export', [AdminController::class, 'exportChildren'])->name('admin.children.export');

    // Gallery Management
    Route::resource('gallery', GalleryController::class, ['as' => 'admin']);

    // Petugas Management
    Route::get('/petugas', [AdminController::class, 'petugas'])->name('admin.petugas');
    Route::get('/petugas/create', [AdminController::class, 'createPetugas'])->name('admin.petugas.create');
    Route::post('/petugas', [AdminController::class, 'storePetugas'])->name('admin.petugas.store');
    Route::get('/petugas/{user}/edit', [AdminController::class, 'editPetugas'])->name('admin.petugas.edit');
    Route::put('/petugas/{user}', [AdminController::class, 'updatePetugas'])->name('admin.petugas.update');
    Route::delete('/petugas/{user}', [AdminController::class, 'destroyPetugas'])->name('admin.petugas.destroy');

    // Puskesmas Profile
    Route::get('/puskesmas', [AdminController::class, 'puskesmas'])->name('admin.puskesmas');
    Route::put('/puskesmas', [AdminController::class, 'updatePuskesmas'])->name('admin.puskesmas.update');
});

// Petugas Routes
Route::middleware(['petugas'])->prefix('petugas')->group(function () {
    Route::get('/dashboard', [PetugasController::class, 'dashboard'])->name('petugas.dashboard');
    Route::get('/measurement/create', [PetugasController::class, 'createMeasurement'])->name('petugas.measurement.create');
    Route::post('/measurement', [PetugasController::class, 'storeMeasurement'])->name('petugas.measurement.store');
    Route::get('/measurement/history', [PetugasController::class, 'measurementHistory'])->name('petugas.measurement.history');
});
