<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\majelis_talim_alkhoirController;
use App\Http\Controllers\Admin\RTQ_AlkhoirController;
use App\Http\Controllers\Admin\SD_tahfidz_AlkhoirController;
use App\Http\Controllers\Admin\MahasantriAlkhoirController;
use App\Http\Controllers\Admin\ProgramUnitCrudController;
use App\Http\Controllers\Admin\MajelisDatasController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/management/majelis-talim-alkhoir/content', [majelis_talim_alkhoirController::class, 'getManagementMajelisTalimAlkhoirContent'])->name('admin.management.majelis-talim-alkhoir.content');
    Route::get('/admin/management/rtq-alkhoir/content', [RTQ_AlkhoirController::class, 'getManagementRTQAlkhoirContent'])->name('admin.management.rtq-alkhoir.content');
    Route::get('/admin/management/sd-tahfidz-alkhoir/content', [SD_tahfidz_AlkhoirController::class, 'getManagementSDTahfidzAlkhoirContent'])->name('admin.management.sd-tahfidz-alkhoir.content');
    Route::get('/admin/management/mahasantri-alkhoir/content', [MahasantriAlkhoirController::class, 'getManagementMahasantriAlkhoirContent'])->name('admin.management.mahasantri-alkhoir.content');

    // Generic CRUD routes per program type
    Route::prefix('/admin/management/program-unit')->name('admin.management.program_unit.')->group(function () {
        Route::get('/{type}', [ProgramUnitCrudController::class, 'index'])->name('index');
        Route::get('/{type}/create', [ProgramUnitCrudController::class, 'create'])->name('create');
        Route::post('/{type}', [ProgramUnitCrudController::class, 'store'])->name('store');
        Route::get('/{type}/{id}/edit', [ProgramUnitCrudController::class, 'edit'])->name('edit');
        Route::put('/{type}/{id}', [ProgramUnitCrudController::class, 'update'])->name('update');
        Route::delete('/{type}/{id}', [ProgramUnitCrudController::class, 'destroy'])->name('destroy');
        Route::get('/{type}/{id}', [ProgramUnitCrudController::class, 'show'])->name('show');
    });

    //GET DATA MAJELIS TALIM ALKHOIR
    Route::get('/program/majelis', [MajelisDatasController::class, 'getManagementMajelisTalimAlkhoirData'])->name('admin.management.majelis-talim-alkhoir.data');
});