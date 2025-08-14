<div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-6" data-content="galery" data-animate>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Galeri</h1>
            <p class="text-sm text-gray-500">Kelola gambar kegiatan dan dokumentasi yayasan.</p>
        </div>
        <div class="flex items-center gap-2">
            <div class="relative">
                <input id="gallery-search" type="text" class="peer ps-9 pe-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-64" placeholder="Cari gambar...">
                  {{-- <i class="fa-solid fa-magnifying-glass text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"></i> --}}
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 shadow-sm" onclick="openModal('modal-gallery')">
                <i class="fas fa-cloud-arrow-up"></i>
                Upload Gambar
            </button>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4" id="gallery-grid">
        <div class="group relative overflow-hidden rounded-lg border border-gray-200">
            <img src="{{ asset('assets/images/galeri/g1.png') }}" alt="Galeri 1" class="w-full h-40 object-cover transition duration-300 group-hover:scale-105">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition"></div>
            <div class="absolute bottom-2 left-2 right-2 flex items-center justify-between text-white text-xs">
                <span>Kegiatan 1</span>
                <div class="space-x-1">
                    <button class="px-2 py-1 rounded bg-white/20 hover:bg-white/30" title="Lihat"><i class="fa-regular fa-eye"></i></button>
                    <button class="px-2 py-1 rounded bg-white/20 hover:bg-white/30" title="Hapus" onclick="showToast('Gambar dihapus','warning')"><i class="fa-regular fa-trash-can"></i></button>
                </div>
            </div>
        </div>
        <div class="group relative overflow-hidden rounded-lg border border-gray-200">
            <img src="{{ asset('assets/images/galeri/g2.png') }}" alt="Galeri 2" class="w-full h-40 object-cover transition duration-300 group-hover:scale-105">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition"></div>
            <div class="absolute bottom-2 left-2 right-2 flex items-center justify-between text-white text-xs">
                <span>Kegiatan 2</span>
                <div class="space-x-1">
                    <button class="px-2 py-1 rounded bg-white/20 hover:bg-white/30" title="Lihat"><i class="fa-regular fa-eye"></i></button>
                    <button class="px-2 py-1 rounded bg-white/20 hover:bg-white/30" title="Hapus" onclick="showToast('Gambar dihapus','warning')"><i class="fa-regular fa-trash-can"></i></button>
                </div>
            </div>
        </div>
        <div class="group relative overflow-hidden rounded-lg border border-gray-200">
            <img src="{{ asset('assets/images/AMY.png') }}" alt="Galeri 3" class="w-full h-40 object-cover transition duration-300 group-hover:scale-105">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition"></div>
            <div class="absolute bottom-2 left-2 right-2 flex items-center justify-between text-white text-xs">
                <span>Kegiatan 3</span>
                <div class="space-x-1">
                    <button class="px-2 py-1 rounded bg-white/20 hover:bg-white/30" title="Lihat"><i class="fa-regular fa-eye"></i></button>
                    <button class="px-2 py-1 rounded bg-white/20 hover:bg-white/30" title="Hapus" onclick="showToast('Gambar dihapus','warning')"><i class="fa-regular fa-trash-can"></i></button>
                </div>
            </div>
        </div>
        <div class="group relative overflow-hidden rounded-lg border border-gray-200">
            <img src="{{ asset('assets/images/asrama.png') }}" alt="Galeri 4" class="w-full h-40 object-cover transition duration-300 group-hover:scale-105">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition"></div>
            <div class="absolute bottom-2 left-2 right-2 flex items-center justify-between text-white text-xs">
                <span>Kegiatan 4</span>
                <div class="space-x-1">
                    <button class="px-2 py-1 rounded bg-white/20 hover:bg-white/30" title="Lihat"><i class="fa-regular fa-eye"></i></button>
                    <button class="px-2 py-1 rounded bg-white/20 hover:bg-white/30" title="Hapus" onclick="showToast('Gambar dihapus','warning')"><i class="fa-regular fa-trash-can"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Upload Gambar -->
    <div id="modal-gallery" class="hidden fixed inset-0 z-40 items-center justify-center bg-black/40 p-4">
        <div class="w-full max-w-lg bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Upload Gambar</h3>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('modal-gallery')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-5 space-y-4">
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Judul</label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="Judul gambar">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">File Gambar</label>
                    <input type="file" accept="image/*" class="w-full border border-gray-300 rounded-lg px-3 py-2 file:mr-3 file:py-2 file:px-3 file:rounded-md file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Deskripsi (opsional)</label>
                    <textarea rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="Deskripsi singkat"></textarea>
                </div>
            </div>
            <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-end gap-2">
                <button class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200" onclick="closeModal('modal-gallery')">Batal</button>
                <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700" onclick="closeModal('modal-gallery');showToast('Gambar diupload')">Upload</button>
            </div>
        </div>
    </div>
</div>