<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SejarahController;
use App\Http\Controllers\Admin\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// info_lainnya - berita
Route::get('/Berita', function () {
    return view('info_lainnya.berita.berita');
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
    Route::post('/upload-image', [UploadController::class, 'uploadImage'])->name('upload.image');
});

require __DIR__ . '/auth.php';
