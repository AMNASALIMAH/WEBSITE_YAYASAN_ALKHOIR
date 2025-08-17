<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileYayasanController;
Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/admin/management/profile/yayasan', [ProfileYayasanController::class, 'getManagementProfileContentYayasan'])->name('admin.management.profile.yayasan.main');
Route::get('/admin/management/profile/yayasan/content', [ProfileYayasanController::class, 'getManagementProfileContentYayasan'])->name('admin.management.profile.content');

Route::match(['put'], '/admin/management/profile/yayasan/update', [ProfileYayasanController::class, 'updateProfileyayasan'])->name('admin.profile-yayasan.update');

// Debug route to test data retrieval
Route::get('/admin/management/profile/yayasan/debug', [ProfileYayasanController::class, 'debugProfileData'])->name('admin.profile-yayasan.debug');

});
