<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AccountCreateAdminController;
use App\Http\Controllers\Admin\SantriController;

// Admin accounts management routes - protected by auth middleware
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('admin/management/admin-accounts/content', [AccountCreateAdminController::class, 'getManagementAdminAccountsContent'])->name('admin.management.admin-accounts.content');

    // API routes for admin accounts management
    Route::prefix('api/admin/accounts')->group(function () {
        Route::get('/', [AccountCreateAdminController::class, 'index'])->name('admin.accounts.index');
        Route::post('/', [AccountCreateAdminController::class, 'store'])->name('admin.accounts.store');
        Route::get('/{id}', [AccountCreateAdminController::class, 'show'])->name('admin.accounts.show');
        Route::put('/{id}', [AccountCreateAdminController::class, 'update'])->name('admin.accounts.update');
        Route::delete('/{id}', [AccountCreateAdminController::class, 'destroy'])->name('admin.accounts.destroy');
        Route::delete('/bulk', [AccountCreateAdminController::class, 'bulkDestroy'])->name('admin.accounts.bulk-destroy');
    });
});