<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\SantriController;

Route::middleware(['auth', 'verified'])->group(function () {
    // Main finance views
    Route::get('/admin/management/finance/content', [FinanceController::class, 'getManagementFinanceContent'])->name('admin.management.finance.content');
    Route::get('/admin/management/finance/pemasukan/content', [FinanceController::class, 'getManagementFinancePemasukan'])->name('admin.management.finance.pemasukan');
    Route::get('/admin/management/finance/pengeluaran/content', [FinanceController::class, 'getManagementFinancePengeluaran'])->name('admin.management.finance.pengeluaran');

    // Simple Laravel CRUD for Income (without JavaScript) - using different URL patterns
    Route::get('/admin/management/finance/income-simple/create', [FinanceController::class, 'createIncome'])->name('admin.management.finance.income.create');
    Route::post('/admin/management/finance/income-simple', [FinanceController::class, 'storeIncomeSimple'])->name('admin.management.finance.income.store.simple');
    Route::get('/admin/management/finance/income-simple/{income}/edit', [FinanceController::class, 'editIncome'])->name('admin.management.finance.income.edit');
    Route::put('/admin/management/finance/income-simple/{income}', [FinanceController::class, 'updateIncomeSimple'])->name('admin.management.finance.income.update.simple');
    Route::get('/admin/management/finance/income-simple/{income}', [FinanceController::class, 'showIncomeSimple'])->name('admin.management.finance.income.show.simple');
    Route::delete('/admin/management/finance/income-simple/{income}', [FinanceController::class, 'deleteIncomeSimple'])->name('admin.management.finance.income.delete.simple');
    
    // Simple Laravel CRUD for Expense (without JavaScript) - using different URL patterns
    Route::get('/admin/management/finance/expense-simple/create', [FinanceController::class, 'createExpense'])->name('admin.management.finance.expense.create');
    Route::post('/admin/management/finance/expense-simple', [FinanceController::class, 'storeExpenseSimple'])->name('admin.management.finance.expense.store.simple');
    Route::get('/admin/management/finance/expense-simple/{expense}/edit', [FinanceController::class, 'editExpense'])->name('admin.management.finance.expense.edit');
    Route::put('/admin/management/finance/expense-simple/{expense}', [FinanceController::class, 'updateExpenseSimple'])->name('admin.management.finance.expense.update.simple');
    Route::get('/admin/management/finance/expense-simple/{expense}', [FinanceController::class, 'showExpenseSimple'])->name('admin.management.finance.expense.show.simple');
    Route::delete('/admin/management/finance/expense-simple/{expense}', [FinanceController::class, 'deleteExpenseSimple'])->name('admin.management.finance.expense.delete.simple');
    
    // SPP Settings CRUD
    Route::get('/admin/management/finance/spp-settings', [FinanceController::class, 'getSppSettings'])->name('admin.management.finance.spp-settings.index');
    Route::post('/admin/management/finance/spp-settings', [FinanceController::class, 'storeSppSetting'])->name('admin.management.finance.spp-settings.store');
    Route::put('/admin/management/finance/spp-settings/{setting}', [FinanceController::class, 'updateSppSetting'])->name('admin.management.finance.spp-settings.update');
    Route::delete('/admin/management/finance/spp-settings/{setting}', [FinanceController::class, 'deleteSppSetting'])->name('admin.management.finance.spp-settings.delete');
    
    // Dashboard statistics
    Route::get('/admin/management/finance/stats', [FinanceController::class, 'getFinanceStats'])->name('admin.management.finance.stats');
});