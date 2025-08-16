<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SejarahController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/admin.php';
require __DIR__.'/finance.php';
require __DIR__.'/program.php';




Route::get('/admin/news/content', [DashboardController::class, 'getNewsContent'])
    ->middleware(['auth', 'verified'])
    ->name('admin.news.content');

Route::get('/admin/teachers/data', [TeacherController::class, 'getTeachers'])
    ->middleware(['auth', 'verified'])
    ->name('admin.teachers.data');

Route::get('/admin/galery/content', [DashboardController::class, 'getGaleryContent'])
    ->middleware(['auth', 'verified'])
    ->name('admin.galery.content');

Route::match(['PUT', 'POST'], '/admin/teachers/{id}', [TeacherController::class, 'updateTeacher'])
    ->middleware(['auth', 'verified'])
    ->name('admin.teachers.update');

// Manajemen Data (AJAX content routes)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/management/profile/content', [DashboardController::class, 'getManagementProfileContent'])->name('admin.management.profile.content');
    Route::get('/admin/management/teachers/content', [DashboardController::class, 'getManagementTeachersContent'])->name('admin.management.teachers.content');

    Route::get('/admin/management/account/content', [DashboardController::class, 'getManagementAccountContent'])->name('admin.management.account.content');
    Route::get('/admin/management/messages/content', [DashboardController::class, 'getManagementMessagesContent'])->name('admin.management.messages.content');
    Route::get('/admin/management/applications/content', [DashboardController::class, 'getManagementApplicationsContent'])->name('admin.management.applications.content');
   
    
});

// Pretty URLs that render the admin shell and auto-load the correct content
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/news', fn () => view('admin.app', ['initialContent' => 'news']))->name('admin.news');
    Route::get('/admin/galery', fn () => view('admin.app', ['initialContent' => 'galery']))->name('admin.galery');

    Route::prefix('admin/management')->name('admin.management.')->group(function () {
        Route::get('/profile', fn () => view('admin.app', ['initialContent' => 'mgmt-profile']))->name('profile');
        Route::get('/teachers', fn () => view('admin.app', ['initialContent' => 'mgmt-teachers']))->name('teachers');
        Route::get('/students', fn () => view('admin.app', ['initialContent' => 'mgmt-students']))->name('students');
        Route::get('/finance', fn () => view('admin.app', ['initialContent' => 'mgmt-finance']))->name('finance');
        Route::get('/account', fn () => view('admin.app', ['initialContent' => 'mgmt-account']))->name('account');
        Route::get('/messages', fn () => view('admin.app', ['initialContent' => 'mgmt-messages']))->name('messages');
        Route::get('/applications', fn () => view('admin.app', ['initialContent' => 'mgmt-applications']))->name('applications');
        Route::get('/admin-accounts', fn () => view('admin.app', ['initialContent' => 'mgmt-admin-accounts']))->name('admin_accounts');
        Route::get('/programs', fn () => view('admin.app', ['initialContent' => 'mgmt-programs']))->name('programs');
    });
});

// News routes
Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news:slug}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');
Route::get('/admin/news/latest', [App\Http\Controllers\NewsController::class, 'getLatestNews'])->name('admin.news.latest');
// Admin news routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/news', [App\Http\Controllers\NewsController::class, 'adminIndex'])->name('admin.news.index');
    Route::get('/admin/news/{id}', [App\Http\Controllers\NewsController::class, 'showAdmin'])->name('admin.news.show');
    Route::post('/admin/news', [App\Http\Controllers\NewsController::class, 'store'])->name('admin.news.store');
    Route::match(['PUT', 'POST'], '/admin/news/{id}', [App\Http\Controllers\NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/admin/news/{id}', [App\Http\Controllers\NewsController::class, 'destroy'])->name('admin.news.destroy');
    Route::post('/admin/news/{id}/restore', [App\Http\Controllers\NewsController::class, 'restore'])->name('admin.news.restore');
    Route::delete('/admin/news/{id}/force-delete', [App\Http\Controllers\NewsController::class, 'forceDelete'])->name('admin.news.force-delete');

});

// Legacy berita route (redirect to new news system)
Route::get('/Berita', function () {
    return redirect()->route('news.index');
})->name('berita');



Route::get('/Detail Berita', function () {
    return view('info_lainnya.berita.detail_berita');
})->name('detail_berita');

// info_lainnya - pmb
Route::get('/Daftar PMB Alkhoir', function () {
    return view('info_lainnya.pmb.daftar_pmb');
})->name('daftar_pmb');

// tentang kami
Route::get('/Sejarah-singkat', function () {
    return view('tentang_kami.sejarah');
})->name('sejarah');
Route::get('/Visi-Misi', function () {
    return view('tentang_kami.Visi-Misi');
})->name('visi-misi');
Route::get('/Struktur Organisasi', function () {
    return view('tentang_kami.struktur_organisasi');
})->name('struktur_organisasi');

// Program - SD Tahfidz Alkhoir
Route::get('/SD Tahfidz Al-Khoir', function () {
    return view('program.sdt_alkhoir.deskripsi');
})->name('SDT');

//Program -  RTQ Alkhoir
Route::get('RTQ Al-Khoir', function () {
    return view('program.rtq_alkhoir.deskripsi');
})->name('RTQ');

//Program - Mahasantri Alkhoir
Route::get('Mahasantri Al-Khoir', function () {
    return view('program.mhs_alkhoir.deskripsi');
})->name('MHS');

//Program - MT Alkhhoir
Route::get('Majelis Talim Al-Khoir', function () {
    return view('program.mt_alkhoir.deskripsi');
})->name('MT');
Route::get('/Galeri', function () {
    return view('galeri.galeri');
})->name('galeri');
Route::get('/Kontak', function () {
    return view('kontak.kontak');
})->name('kontak');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/admin/sejarah', [SejarahController::class, 'index'])->name('sejarah.index');
    // Route::get('/admin/sejarah/create', [SejarahController::class, 'create'])->name('sejarah.create');
    // Route::post('/admin/sejarah', [SejarahController::class, 'store'])->name('sejarah.store');
    // Route::get('/admin/sejarah/{id}/edit', [SejarahController::class, 'edit'])->name('sejarah.edit');
    // Route::put('/admin/sejarah/{id}', [SejarahController::class, 'update'])->name('sejarah.update');
    // Route::delete('/admin/sejarah/{id}', [SejarahController::class, 'destroy'])->name('sejarah.destroy');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('sejarah', SejarahController::class);
    Route::resource('teachers', TeacherController::class);

    Route::patch('/teachers/{teacher}/toggle-status', [TeacherController::class, 'toggleStatus'])->name('teachers.toggle-status');
    Route::post('/upload-image', [UploadController::class, 'uploadImage'])->name('upload.image');
});

require __DIR__ . '/auth.php';
