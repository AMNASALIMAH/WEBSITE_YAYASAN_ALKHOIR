<div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-6" data-content="mgmt-programs" data-animate>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Data Program</h1>
            <p class="text-sm text-gray-500">Kelola kategori dan detail setiap program.</p>
        </div>
        <div class="flex items-center gap-2">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 shadow-sm" onclick="openModal('modal-program')">
                <i class="fas fa-plus"></i>
                Tambah Program
            </button>
            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg" onclick="openModal('modal-category')">Kategori</button>
            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg" onclick="showToast('Memuat konten')">Konten</button>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200">
        <table class="w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-900">SD Tahfidz Al-Khoir</td>
                    <td class="px-4 py-3 text-gray-700">Pendidikan</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs">Aktif</span></td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <button class="px-3 py-1.5 text-xs rounded-md bg-blue-100 text-blue-700 hover:bg-blue-200" title="Edit" onclick="openModal('modal-program')"><i class="fa-regular fa-pen-to-square"></i></button>
                            <button class="px-3 py-1.5 text-xs rounded-md bg-red-100 text-red-700 hover:bg-red-200" title="Nonaktifkan" onclick="showToast('Program dinonaktifkan','warning')"><i class="fa-solid fa-toggle-off"></i></button>
                        </div>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-900">RTQ Al-Khoir</td>
                    <td class="px-4 py-3 text-gray-700">Tahfidz</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs">Aktif</span></td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <button class="px-3 py-1.5 text-xs rounded-md bg-blue-100 text-blue-700 hover:bg-blue-200" title="Edit" onclick="openModal('modal-program')"><i class="fa-regular fa-pen-to-square"></i></button>
                            <button class="px-3 py-1.5 text-xs rounded-md bg-red-100 text-red-700 hover:bg-red-200" title="Nonaktifkan" onclick="showToast('Program dinonaktifkan','warning')"><i class="fa-solid fa-toggle-off"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal: Program -->
    <div id="modal-program" class="hidden fixed inset-0 z-40 items-center justify-center bg-black/40 p-4">
        <div class="w-full max-w-xl bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Tambah / Edit Program</h3>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('modal-program')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-5 space-y-4">
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Nama Program</label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="Nama program">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Kategori</label>
                    <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                        <option>Pendidikan</option>
                        <option>Tahfidz</option>
                        <option>Sosial</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Status</label>
                    <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                    </select>
                </div>
            </div>
            <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-end gap-2">
                <button class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200" onclick="closeModal('modal-program')">Batal</button>
                <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700" onclick="closeModal('modal-program');showToast('Program disimpan')">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Modal: Kategori -->
    <div id="modal-category" class="hidden fixed inset-0 z-40 items-center justify-center bg-black/40 p-4">
        <div class="w-full max-w-md bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Kelola Kategori</h3>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('modal-category')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-5 space-y-3">
                <div class="flex items-center gap-2">
                    <input type="text" class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="Tambah kategori baru">
                    <button class="px-3 py-2 rounded-lg bg-blue-600 text-white" onclick="showToast('Kategori ditambahkan')">Tambah</button>
                </div>
                <div class="text-sm text-gray-500">Kategori yang ada:</div>
                <div class="flex flex-wrap gap-2">
                    <span class="px-2 py-1 rounded-md bg-gray-100 text-gray-700 text-xs">Pendidikan</span>
                    <span class="px-2 py-1 rounded-md bg-gray-100 text-gray-700 text-xs">Tahfidz</span>
                    <span class="px-2 py-1 rounded-md bg-gray-100 text-gray-700 text-xs">Sosial</span>
                </div>
            </div>
            <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-end gap-2">
                <button class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200" onclick="closeModal('modal-category')">Tutup</button>
            </div>
        </div>
    </div>
</div>

