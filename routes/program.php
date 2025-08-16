<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProgramController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/management/programs/content', [ProgramController::class, 'getManagementProgramsContent'])->name('admin.management.programs.content');
    
    // CRUD Routes
    Route::get('/admin/programs', [ProgramController::class, 'index'])->name('admin.programs.index');
    Route::post('/admin/programs', [ProgramController::class, 'store'])->name('admin.programs.store');
    Route::get('/admin/programs/{program}', [ProgramController::class, 'show'])->name('admin.programs.show');
    Route::put('/admin/programs/{program}', [ProgramController::class, 'update'])->name('admin.programs.update');
    Route::delete('/admin/programs/{program}', [ProgramController::class, 'destroy'])->name('admin.programs.destroy');
    
    // Additional Routes
    Route::patch('/admin/programs/{program}/toggle-status', [ProgramController::class, 'toggleStatus'])->name('admin.programs.toggle-status');
    Route::get('/admin/programs/categories', [ProgramController::class, 'getCategories'])->name('admin.programs.categories');
});
