<div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-6" data-content="news" data-animate>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">News Management</h1>
            <p class="text-sm text-gray-500">Kelola artikel berita: tambah, ubah, terbitkan, dan arsipkan.</p>
        </div>
        <div class="flex items-center gap-2">
            <div class="relative">
                <input id="news-search" type="text" class="peer ps-9 pe-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-64" placeholder="Cari berita..." oninput="filterTable('news-search','news-tbody')">
         
            </div>
            <button 
                class="px-4 py-2 rounded-lg flex items-center gap-2 shadow-sm transition-all duration-200 transform hover:scale-105" 
                type="button"
                id="add-news-btn"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="text-black">Tambah Berita</span>
            </button>
            <script>
                document.getElementById('add-news-btn').addEventListener('click', function() {
                    openNewsModal();
                });
            </script>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200">
        <table class="w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl. Terbit</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody id="news-tbody" class="divide-y divide-gray-100">
                @forelse($news as $item)
                <tr class="hover:bg-gray-50 transition-colors duration-200" data-news-id="{{ $item->id }}">
                    <td class="px-4 py-3">
                        <div class="font-medium text-gray-900">{{ $item->judul }}</div>
                        @if($item->ringkasan)
                        <div class="text-xs text-gray-500 line-clamp-1">{{ Str::limit($item->ringkasan, 60) }}</div>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-700">{{ $item->penulis }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $item->kategori }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-700">{{ $item->tanggal_terbit->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">
                        @if($item->status === 'published')
                            <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-emerald-200">
                                <svg class="w-2 h-2 text-emerald-600" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3"></circle>
                                </svg>
                                Published
                            </span>
                        @elseif($item->status === 'draft')
                            <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2 py-1 text-xs font-medium text-amber-700 ring-1 ring-amber-200">
                                <svg class="w-2 h-2 text-amber-600" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3"></circle>
                                </svg>
                                Draft
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 rounded-full bg-gray-50 px-2 py-1 text-xs font-medium text-gray-700 ring-1 ring-gray-200">
                                <svg class="w-2 h-2 text-gray-600" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3"></circle>
                                </svg>
                                Archived
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            @if($item->status === 'published')
                            <a href="{{ route('news.show', $item->slug) }}" target="_blank" class="px-3 py-1.5 text-xs rounded-md bg-gray-100 hover:bg-gray-200 transition-colors duration-200" title="Lihat">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            @endif
                            <button class="px-3 py-1.5 text-xs rounded-md bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors duration-200" title="Edit" onclick="editNews({{ $item->id }})">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            @if($item->trashed())
                                <button class="px-3 py-1.5 text-xs rounded-md bg-green-100 text-green-700 hover:bg-green-200 transition-colors duration-200" title="Restore" onclick="restoreNews({{ $item->id }})">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </button>
                                <button class="px-3 py-1.5 text-xs rounded-md bg-red-100 text-red-700 hover:bg-red-200 transition-colors duration-200" title="Hapus Permanen" onclick="forceDeleteNews({{ $item->id }})">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            @else
                                <button class="px-3 py-1.5 text-xs rounded-md bg-red-100 text-red-700 hover:bg-red-200 transition-colors duration-200" title="Hapus" onclick="deleteNews({{ $item->id }})">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 002-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                            <p class="text-lg font-medium text-gray-900 mb-2">Belum ada berita</p>
                            <p class="text-sm text-gray-500">Mulai dengan menambahkan berita pertama Anda.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($news->hasPages())
    <div class="mt-6 flex items-center justify-between text-sm text-gray-600">
        <div>Menampilkan {{ $news->firstItem() ?? 0 }}–{{ $news->lastItem() ?? 0 }} dari {{ $news->total() }} data</div>
        <div class="flex items-center gap-1">
            @if($news->previousPageUrl())
                <a href="{{ $news->previousPageUrl() }}" class="px-3 py-1 rounded-md bg-gray-100 hover:bg-gray-200 transition-colors duration-200">Prev</a>
            @endif
            
            @foreach($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="px-3 py-1 rounded-md {{ $page == $news->currentPage() ? 'bg-blue-600 text-white' : 'bg-gray-100 hover:bg-gray-200' }} transition-colors duration-200">{{ $page }}</a>
            @endforeach
            
            @if($news->nextPageUrl())
                <a href="{{ $news->nextPageUrl() }}" class="px-3 py-1 rounded-md bg-gray-100 hover:bg-gray-200 transition-colors duration-200">Next</a>
            @endif
        </div>
    </div>
    @endif

    <!-- Modal: Tambah/Edit Berita -->
    <div id="modal-news" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                <h3 class="text-xl font-semibold text-gray-900" id="modal-title">Tambah Berita Baru</h3>
                <button class="text-gray-500 hover:text-gray-700 transition-colors duration-200" onclick="closeNewsModal()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <form id="news-form" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                <input type="hidden" id="news-id" name="news_id">
                <input type="hidden" name="_method" id="method-field" value="POST">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Berita *</label>
                        <input type="text" id="judul" name="judul" required 
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                               placeholder="Masukkan judul berita">
                        <div class="text-red-500 text-sm mt-1 hidden" id="judul-error"></div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Terbit *</label>
                        <input type="date" id="tanggal_terbit" name="tanggal_terbit" required 
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <div class="text-red-500 text-sm mt-1 hidden" id="tanggal_terbit-error"></div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select id="kategori" name="kategori" 
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <option value="Umum">Umum</option>
                            <option value="Kegiatan">Kegiatan</option>
                            <option value="Prestasi">Prestasi</option>
                            <option value="Pengumuman">Pengumuman</option>
                            <option value="Pendidikan">Pendidikan</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select id="status" name="status" required 
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="archived">Archived</option>
                        </select>
                        <div class="text-red-500 text-sm mt-1 hidden" id="status-error"></div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Penulis</label>
                        <input type="text" id="penulis" name="penulis" 
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                               placeholder="Nama penulis" value="{{ auth()->user()->name }}">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                        <input type="text" id="tags" name="tags" 
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                               placeholder="Tag1, Tag2, Tag3 (pisahkan dengan koma)">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ringkasan</label>
                    <textarea id="ringkasan" name="ringkasan" rows="3" 
                              class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                              placeholder="Ringkasan singkat berita (opsional)"></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konten Berita *</label>
                    <textarea id="konten" name="konten" rows="8" required 
                              class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                              placeholder="Tulis konten berita lengkap..."></textarea>
                    <div class="text-red-500 text-sm mt-1 hidden" id="konten-error"></div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Sampul</label>
                    <div class="flex items-center space-x-4">
                        <input type="file" id="gambar" name="gambar" accept="image/*" 
                               class="flex-1 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <div id="current-image" class="hidden">
                            <img id="preview-image" src="" alt="Preview" class="w-20 h-20 object-cover rounded-lg">
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                </div>
            </form>
            
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex items-center justify-end gap-3">
                <button class="px-6 py-3 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium transition-all duration-200" onclick="closeNewsModal()">
                    Batal
                </button>
                <button id="save-btn" class="px-6 py-3 rounded-xl bg-white border border-black text-black font-medium transition-all duration-200 transform hover:scale-105" onclick="saveNews()">
                    <span id="save-text">Simpan Berita</span>
                    <div id="save-loading" class="hidden">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Menyimpan...
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div id="toast" class="hidden fixed top-4 right-4 z-50">
    <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-4 max-w-sm">
        <div class="flex items-center">
            <div id="toast-icon" class="flex-shrink-0"></div>
            <div class="ml-3">
                <p id="toast-message" class="text-sm font-medium text-gray-900"></p>
            </div>
            <div class="ml-auto pl-3">
                <button onclick="hideToast()" class="inline-flex text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Image preview functionality
document.getElementById('gambar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview-image');
            preview.src = e.target.result;
            document.getElementById('current-image').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
});

// Close modal when clicking outside
document.getElementById('modal-news').addEventListener('click', function(e) {
    if (e.target === this) {
        closeNewsModal();
    }
});

// Set default date to today
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('tanggal_terbit').value = today;
});
</script>

<style>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Smooth animations */
.modal-enter {
    opacity: 0;
    transform: scale(0.9);
}

.modal-enter-active {
    opacity: 1;
    transform: scale(1);
    transition: opacity 200ms, transform 200ms;
}

.modal-exit {
    opacity: 1;
    transform: scale(1);
}

.modal-exit-active {
    opacity: 0;
    transform: scale(0.9);
    transition: opacity 200ms, transform 200ms;
}
</style>
