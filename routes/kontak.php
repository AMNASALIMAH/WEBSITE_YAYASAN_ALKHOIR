

<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PesanController;
Route::get('/Kontak', [PesanController::class, 'index'])->name('kontak');
Route::post('/Kontak/store', [PesanController::class, 'store'])->name('kontak.store');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/management/messages/content', [PesanController::class, 'getManagementMessagesContent'])->name('admin.management.messages.content');
    Route::delete('/Kontak/delete/{id}', [PesanController::class, 'delete'])->name('kontak.delete');

});
?>