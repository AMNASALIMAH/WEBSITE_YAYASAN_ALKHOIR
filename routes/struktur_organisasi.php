<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Struktur_OrganisasiController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/struktur-organisasi', [Struktur_OrganisasiController::class, 'index'])->name('admin.struktur_organisasi.index');
    Route::get('/admin/struktur-organisasi/create', [Struktur_OrganisasiController::class, 'create'])->name('admin.struktur_organisasi.create');
    Route::post('/admin/struktur-organisasi', [Struktur_OrganisasiController::class, 'store'])->name('admin.struktur_organisasi.store');
    Route::get('/admin/struktur-organisasi/{id}/edit', [Struktur_OrganisasiController::class, 'edit'])->name('admin.struktur_organisasi.edit');
    Route::put('/admin/struktur-organisasi/{id}', [Struktur_OrganisasiController::class, 'update'])->name('admin.struktur_organisasi.update');
    Route::delete('/admin/struktur-organisasi/{id}', [Struktur_OrganisasiController::class, 'destroy'])->name('admin.struktur_organisasi.destroy');
});