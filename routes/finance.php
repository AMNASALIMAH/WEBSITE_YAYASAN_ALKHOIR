<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\SantriController;

Route::middleware(['auth', 'verified'])->group(function () {
    // Main finance views
    Route::get('/admin/management/finance/content', [FinanceController::class, 'getManagementFinanceContent'])->name('admin.management.finance.content');
    Route::get('/admin/management/finance/pemasukan', [FinanceController::class, 'getManagementFinancePemasukan'])->name('admin.management.finance.pemasukan');
    Route::get('/admin/management/finance/pengeluaran', [FinanceController::class, 'getManagementFinancePengeluaran'])->name('admin.management.finance.pengeluaran');
    
    // Income CRUD
    Route::get('/admin/management/finance/income/{income}', [FinanceController::class, 'showIncome'])->name('admin.management.finance.income.show');
    Route::post('/admin/management/finance/income', [FinanceController::class, 'storeIncome'])->name('admin.management.finance.income.store');
    Route::put('/admin/management/finance/income/{income}', [FinanceController::class, 'updateIncome'])->name('admin.management.finance.income.update');
    Route::delete('/admin/management/finance/income/{income}', [FinanceController::class, 'deleteIncome'])->name('admin.management.finance.income.delete');
    
    // Expense CRUD
    Route::get('/admin/management/finance/expense/{expense}', [FinanceController::class, 'showExpense'])->name('admin.management.finance.expense.show');
    Route::post('/admin/management/finance/expense', [FinanceController::class, 'storeExpense'])->name('admin.management.finance.expense.store');
    Route::put('/admin/management/finance/expense/{expense}', [FinanceController::class, 'updateExpense'])->name('admin.management.finance.expense.update');
    Route::delete('/admin/management/finance/expense/{expense}', [FinanceController::class, 'deleteExpense'])->name('admin.management.finance.expense.delete');
    Route::patch('/admin/management/finance/expense/{expense}/approve', [FinanceController::class, 'approveExpense'])->name('admin.management.finance.expense.approve');
    
    // SPP Settings CRUD
    Route::get('/admin/management/finance/spp-settings', [FinanceController::class, 'getSppSettings'])->name('admin.management.finance.spp-settings.index');
    Route::post('/admin/management/finance/spp-settings', [FinanceController::class, 'storeSppSetting'])->name('admin.management.finance.spp-settings.store');
    Route::put('/admin/management/finance/spp-settings/{setting}', [FinanceController::class, 'updateSppSetting'])->name('admin.management.finance.spp-settings.update');
    Route::delete('/admin/management/finance/spp-settings/{setting}', [FinanceController::class, 'deleteSppSetting'])->name('admin.management.finance.spp-settings.delete');
    
    // Dashboard statistics
    Route::get('/admin/management/finance/stats', [FinanceController::class, 'getFinanceStats'])->name('admin.management.finance.stats');
});