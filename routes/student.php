<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\SantriController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/management/students/content', [SantriController::class, 'getManagementStudentsContent'])->name('admin.management.students.content');
});
