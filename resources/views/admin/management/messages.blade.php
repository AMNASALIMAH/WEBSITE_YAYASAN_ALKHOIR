<div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-6" data-content="mgmt-messages" data-animate>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Pesan Masuk</h1>
            <p class="text-sm text-gray-500">Kelola pesan dari halaman kontak.</p>
        </div>
        <div class="flex items-center gap-2">
            <div class="relative">
                <input id="msg-search" type="text" class="peer ps-9 pe-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 w-64" placeholder="Cari pesan..." oninput="filterTable('msg-search','msg-tbody')">
                  {{-- <i class="fa-solid fa-magnifying-glass text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"></i> --}}
            </div>
            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg" onclick="showToast('Ditandai terbaca')">Tandai Sudah Dibaca</button>
            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg" onclick="showToast('Pesan dihapus','warning')">Hapus</button>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200">
        <table class="w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subjek</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody id="msg-tbody" class="divide-y divide-gray-100">
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-900">Farhan Setia</td>
                    <td class="px-4 py-3 text-gray-700">farhan@example.com</td>
                    <td class="px-4 py-3 text-gray-700">Informasi pendaftaran</td>
                    <td class="px-4 py-3 text-gray-700">2025-07-30</td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <button class="px-3 py-1.5 text-xs rounded-md bg-gray-100 hover:bg-gray-200" title="Baca" onclick="openModal('modal-message')"><i class="fa-regular fa-envelope-open"></i></button>
                            <button class="px-3 py-1.5 text-xs rounded-md bg-red-100 text-red-700 hover:bg-red-200" title="Hapus" onclick="showToast('Pesan dihapus','warning')"><i class="fa-regular fa-trash-can"></i></button>
                        </div>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-900">Lina Marlina</td>
                    <td class="px-4 py-3 text-gray-700">lina@example.com</td>
                    <td class="px-4 py-3 text-gray-700">Kerjasama donasi</td>
                    <td class="px-4 py-3 text-gray-700">2025-07-29</td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <button class="px-3 py-1.5 text-xs rounded-md bg-gray-100 hover:bg-gray-200" title="Baca" onclick="openModal('modal-message')"><i class="fa-regular fa-envelope-open"></i></button>
                            <button class="px-3 py-1.5 text-xs rounded-md bg-red-100 text-red-700 hover:bg-red-200" title="Hapus" onclick="showToast('Pesan dihapus','warning')"><i class="fa-regular fa-trash-can"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal: Baca Pesan -->
    <div id="modal-message" class="hidden fixed inset-0 z-40 items-center justify-center bg-black/40 p-4">
        <div class="w-full max-w-xl bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Pesan</h3>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('modal-message')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-5 space-y-2 text-sm">
                <div class="text-gray-500">Dari: Farhan Setia (farhan@example.com)</div>
                <div class="text-gray-500">Tanggal: 2025-07-30</div>
                <div class="pt-2 text-gray-800">Halo admin, saya ingin menanyakan informasi mengenai pendaftaran santri baru. Terima kasih.</div>
            </div>
            <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-end gap-2">
                <button class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200" onclick="closeModal('modal-message')">Tutup</button>
                <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700" onclick="closeModal('modal-message');showToast('Ditandai terbaca')">Tandai Terbaca</button>
            </div>
        </div>
    </div>
</div>

