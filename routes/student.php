<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SantriController;

Route::middleware(['auth', 'verified'])->group(function () {
  
    
    
    // API routes for CRUD operations
    Route::prefix('admin/students')->name('admin.students.')->group(function () {
        Route::get('/', [SantriController::class, 'index'])->name('index');
        Route::post('/', [SantriController::class, 'store'])->name('store');
        Route::get('/{student}', [SantriController::class, 'show'])->name('show');
        Route::put('/{student}', [SantriController::class, 'update'])->name('update');
        Route::delete('/{student}', [SantriController::class, 'destroy'])->name('destroy');
        Route::patch('/{student}/status', [SantriController::class, 'updateStatus'])->name('status');
        Route::delete('/bulk', [SantriController::class, 'bulkDelete'])->name('bulk-delete');
    });
});
