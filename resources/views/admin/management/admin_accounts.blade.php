<div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-6" data-content="mgmt-admin-accounts" data-animate>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Data Akun Pengurus</h1>
            <p class="text-sm text-gray-500">Kelola admin, peran, dan status akses.</p>
        </div>
        <div class="flex items-center gap-2">
            <div class="relative">
                <input id="admin-search" type="text" class="peer ps-9 pe-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 w-56" placeholder="Cari admin..." oninput="filterTable('admin-search','admin-tbody')">
                  {{-- <i class="fa-solid fa-magnifying-glass text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"></i> --}}
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 shadow-sm" onclick="openModal('modal-admin')">
                <i class="fas fa-user-plus"></i>
                Tambah Akun
            </button>
            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg">Kelola Peran</button>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200">
        <table class="w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peran</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody id="admin-tbody" class="divide-y divide-gray-100">
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-900">Ahmad Fauzi</td>
                    <td class="px-4 py-3 text-gray-700">ahmad@example.com</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded-md bg-blue-50 text-blue-700 text-xs">Super Admin</span></td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs">Aktif</span></td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <button class="px-3 py-1.5 text-xs rounded-md bg-gray-100 hover:bg-gray-200" title="Reset Password" onclick="showToast('Link reset dikirim')"><i class="fa-solid fa-key"></i></button>
                            <button class="px-3 py-1.5 text-xs rounded-md bg-blue-100 text-blue-700 hover:bg-blue-200" title="Edit" onclick="openModal('modal-admin')"><i class="fa-regular fa-pen-to-square"></i></button>
                            <button class="px-3 py-1.5 text-xs rounded-md bg-red-100 text-red-700 hover:bg-red-200" title="Nonaktifkan" onclick="showToast('Akun dinonaktifkan','warning')"><i class="fa-solid fa-user-slash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-900">Siti Rahma</td>
                    <td class="px-4 py-3 text-gray-700">siti@example.com</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded-md bg-purple-50 text-purple-700 text-xs">Editor</span></td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded-full bg-amber-50 text-amber-700 text-xs">Pending</span></td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <button class="px-3 py-1.5 text-xs rounded-md bg-gray-100 hover:bg-gray-200" title="Kirim Undangan" onclick="showToast('Undangan dikirim')"><i class="fa-regular fa-paper-plane"></i></button>
                            <button class="px-3 py-1.5 text-xs rounded-md bg-blue-100 text-blue-700 hover:bg-blue-200" title="Edit" onclick="openModal('modal-admin')"><i class="fa-regular fa-pen-to-square"></i></button>
                            <button class="px-3 py-1.5 text-xs rounded-md bg-red-100 text-red-700 hover:bg-red-200" title="Hapus" onclick="showToast('Akun dihapus','warning')"><i class="fa-regular fa-trash-can"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal: Tambah/Edit Admin -->
    <div id="modal-admin" class="hidden fixed inset-0 z-40 items-center justify-center bg-black/40 p-4">
        <div class="w-full max-w-xl bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Tambah / Edit Akun Admin</h3>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('modal-admin')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Nama</label>
                        <input type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="Nama lengkap">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Email</label>
                        <input type="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="email@domain.com">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Peran</label>
                        <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            <option>Super Admin</option>
                            <option>Admin</option>
                            <option>Editor</option>
                            <option>Viewer</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Status</label>
                        <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            <option>Aktif</option>
                            <option>Pending</option>
                            <option>Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Password</label>
                        <input type="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Konfirmasi Password</label>
                        <input type="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="••••••••">
                    </div>
                </div>
            </div>
            <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-end gap-2">
                <button class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200" onclick="closeModal('modal-admin')">Batal</button>
                <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700" onclick="closeModal('modal-admin');showToast('Akun tersimpan')">Simpan</button>
            </div>
        </div>
    </div>
</div>

