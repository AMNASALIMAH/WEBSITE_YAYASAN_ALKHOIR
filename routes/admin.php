<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AccountCreateAdminController;
use App\Http\Controllers\Admin\SantriController;

// Admin accounts management routes - protected by auth middleware
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('admin/management/admin-accounts/content', [AccountCreateAdminController::class, 'getManagementAdminAccountsContent'])->name('admin.management.accounts.content');

    // Student management view route
    Route::get('admin/management/data-santri/content', [SantriController::class, 'getManagementStudentsContent'])->name('admin.management.data-santri.content');

    // API routes for admin accounts management
    Route::prefix('api/admin/accounts')->group(function () {
        Route::get('/', [AccountCreateAdminController::class, 'index'])->name('index');
        Route::post('/', [AccountCreateAdminController::class, 'store'])->name('store');
        Route::get('/{adminAccount}', [AccountCreateAdminController::class, 'show'])->name('show');
        Route::put('/{adminAccount}', [AccountCreateAdminController::class, 'update'])->name('update');
        Route::delete('/{adminAccount}', [AccountCreateAdminController::class, 'destroy'])->name('destroy');
        Route::patch('/{adminAccount}/status', [AccountCreateAdminController::class, 'updateStatus'])->name('status');
        Route::delete('/bulk', [AccountCreateAdminController::class, 'bulkDelete'])->name('bulk-delete');
    });
});

// Include student management routes
require __DIR__.'/student.php';