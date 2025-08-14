<div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-6" data-content="mgmt-students" data-animate>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Data Santri</h1>
            <p class="text-sm text-gray-500">Kelola daftar santri dan penempatan kelas.</p>
        </div>
        <div class="flex items-center gap-2">
            <div class="relative">
                <input id="student-search" type="text" class="peer ps-9 pe-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 w-64" placeholder="Cari santri..." oninput="filterTable('student-search','student-tbody')">
                  {{-- <i class="fa-solid fa-magnifying-glass text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"></i> --}}
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 shadow-sm" onclick="openModal('modal-student')">
                <i class="fas fa-plus"></i>
                Tambah Santri
            </button>
            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg" onclick="openModal('modal-classes')">Kelas / Tingkatan</button>
            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg" onclick="showToast('Memuat data alumni')">Alumni / Keluar</button>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200">
        <table class="w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orang Tua</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody id="student-tbody" class="divide-y divide-gray-100">
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-700">2025001</td>
                    <td class="px-4 py-3 font-medium text-gray-900">Ahmad Zidan</td>
                    <td class="px-4 py-3 text-gray-700">5A</td>
                    <td class="px-4 py-3 text-gray-700">Bapak Budi</td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <button class="px-3 py-1.5 text-xs rounded-md bg-gray-100 hover:bg-gray-200" title="Detail" onclick="openModal('modal-student-detail')"><i class="fa-regular fa-id-card"></i></button>
                            <button class="px-3 py-1.5 text-xs rounded-md bg-blue-100 text-blue-700 hover:bg-blue-200" title="Edit" onclick="openModal('modal-student')"><i class="fa-regular fa-pen-to-square"></i></button>
                            <button class="px-3 py-1.5 text-xs rounded-md bg-red-100 text-red-700 hover:bg-red-200" title="Hapus" onclick="showToast('Data dihapus','warning')"><i class="fa-regular fa-trash-can"></i></button>
                        </div>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-700">2025002</td>
                    <td class="px-4 py-3 font-medium text-gray-900">Salsa Nabila</td>
                    <td class="px-4 py-3 text-gray-700">4B</td>
                    <td class="px-4 py-3 text-gray-700">Ibu Sari</td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <button class="px-3 py-1.5 text-xs rounded-md bg-gray-100 hover:bg-gray-200" title="Detail" onclick="openModal('modal-student-detail')"><i class="fa-regular fa-id-card"></i></button>
                            <button class="px-3 py-1.5 text-xs rounded-md bg-blue-100 text-blue-700 hover:bg-blue-200" title="Edit" onclick="openModal('modal-student')"><i class="fa-regular fa-pen-to-square"></i></button>
                            <button class="px-3 py-1.5 text-xs rounded-md bg-red-100 text-red-700 hover:bg-red-200" title="Hapus" onclick="showToast('Data dihapus','warning')"><i class="fa-regular fa-trash-can"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal: Tambah/Edit Santri -->
    <div id="modal-student" class="hidden fixed inset-0 z-40 items-center justify-center bg-black/40 p-4">
        <div class="w-full max-w-xl bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Tambah / Edit Santri</h3>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('modal-student')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">NIS</label>
                        <input type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="Nomor Induk Siswa">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="Nama lengkap">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Kelas</label>
                        <input type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="Mis. 5A">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Orang Tua/Wali</label>
                        <input type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="Nama orang tua/wali">
                    </div>
                </div>
            </div>
            <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-end gap-2">
                <button class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200" onclick="closeModal('modal-student')">Batal</button>
                <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700" onclick="closeModal('modal-student');showToast('Data santri disimpan')">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Modal: Detail Santri -->
    <div id="modal-student-detail" class="hidden fixed inset-0 z-40 items-center justify-center bg-black/40 p-4">
        <div class="w-full max-w-md bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Detail Santri</h3>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('modal-student-detail')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-5 space-y-2 text-sm">
                <div class="flex items-center justify-between"><span class="text-gray-500">NIS</span><span class="font-medium text-gray-900">2025001</span></div>
                <div class="flex items-center justify-between"><span class="text-gray-500">Nama</span><span class="font-medium text-gray-900">Ahmad Zidan</span></div>
                <div class="flex items-center justify-between"><span class="text-gray-500">Kelas</span><span class="font-medium text-gray-900">5A</span></div>
                <div class="flex items-center justify-between"><span class="text-gray-500">Orang Tua</span><span class="font-medium text-gray-900">Bapak Budi</span></div>
            </div>
            <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-end gap-2">
                <button class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200" onclick="closeModal('modal-student-detail')">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Modal: Kelas / Tingkatan -->
    <div id="modal-classes" class="hidden fixed inset-0 z-40 items-center justify-center bg-black/40 p-4">
        <div class="w-full max-w-md bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Kelas / Tingkatan</h3>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('modal-classes')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-5 space-y-3">
                <div class="flex items-center gap-2">
                    <input type="text" class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="Tambah kelas (mis. 6A)">
                    <button class="px-3 py-2 rounded-lg bg-blue-600 text-white" onclick="showToast('Kelas ditambahkan')">Tambah</button>
                </div>
                <div class="text-sm text-gray-500">Kelas yang ada:</div>
                <div class="flex flex-wrap gap-2">
                    <span class="px-2 py-1 rounded-md bg-gray-100 text-gray-700 text-xs">4A</span>
                    <span class="px-2 py-1 rounded-md bg-gray-100 text-gray-700 text-xs">4B</span>
                    <span class="px-2 py-1 rounded-md bg-gray-100 text-gray-700 text-xs">5A</span>
                    <span class="px-2 py-1 rounded-md bg-gray-100 text-gray-700 text-xs">5B</span>
                </div>
            </div>
            <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-end gap-2">
                <button class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200" onclick="closeModal('modal-classes')">Tutup</button>
            </div>
        </div>
    </div>
</div>

