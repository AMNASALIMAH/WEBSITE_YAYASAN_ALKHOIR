<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Visi_MisiController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/visi-misi', [Visi_MisiController::class, 'index'])->name('admin.visi_misi.index');
    Route::get('/admin/visi-misi/create', [Visi_MisiController::class, 'create'])->name('admin.visi_misi.create');
    Route::post('/admin/visi-misi', [Visi_MisiController::class, 'store'])->name('admin.visi_misi.store');
    Route::get('/admin/visi-misi/{id}/edit', [Visi_MisiController::class, 'edit'])->name('admin.visi_misi.edit');
    Route::put('/admin/visi-misi/{id}', [Visi_MisiController::class, 'update'])->name('admin.visi_misi.update');
    Route::delete('/admin/visi-misi/{id}', [Visi_MisiController::class, 'destroy'])->name('admin.visi_misi.destroy');
});