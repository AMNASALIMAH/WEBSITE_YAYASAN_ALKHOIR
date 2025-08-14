<div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-6" data-content="mgmt-applications" data-animate>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Formulir Masuk</h1>
            <p class="text-sm text-gray-500">Kelola dan verifikasi pendaftaran santri baru.</p>
        </div>
        <div class="flex items-center gap-2">
            <div class="relative">
                <input id="apps-search" type="text" class="peer ps-9 pe-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 w-64" placeholder="Cari pendaftar..." oninput="filterTable('apps-search','apps-tbody')">
                  {{-- <i class="fa-solid fa-magnifying-glass text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"></i> --}}
            </div>
            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg" onclick="showToast('Export dimulai')">Export</button>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200">
        <table class="w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asal Sekolah</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody id="apps-tbody" class="divide-y divide-gray-100">
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-900">M. Ikhsan</td>
                    <td class="px-4 py-3 text-gray-700">SD Negeri 01</td>
                    <td class="px-4 py-3 text-gray-700">SD Tahfidz</td>
                    <td class="px-4 py-3 text-gray-700">2025-07-30</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded-full bg-amber-50 text-amber-700 text-xs">Review</span></td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <button class="px-3 py-1.5 text-xs rounded-md bg-gray-100 hover:bg-gray-200" title="Detail" onclick="openModal('modal-app-detail')"><i class="fa-regular fa-eye"></i></button>
                            <button class="px-3 py-1.5 text-xs rounded-md bg-emerald-100 text-emerald-700 hover:bg-emerald-200" title="Terima" onclick="showToast('Pendaftaran diterima')"><i class="fa-solid fa-check"></i></button>
                            <button class="px-3 py-1.5 text-xs rounded-md bg-red-100 text-red-700 hover:bg-red-200" title="Tolak" onclick="showToast('Pendaftaran ditolak','warning')"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-900">Nur Aisyah</td>
                    <td class="px-4 py-3 text-gray-700">SD Swasta 02</td>
                    <td class="px-4 py-3 text-gray-700">RTQ</td>
                    <td class="px-4 py-3 text-gray-700">2025-07-28</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs">Diterima</span></td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <button class="px-3 py-1.5 text-xs rounded-md bg-gray-100 hover:bg-gray-200" title="Detail" onclick="openModal('modal-app-detail')"><i class="fa-regular fa-eye"></i></button>
                            <button class="px-3 py-1.5 text-xs rounded-md bg-blue-100 text-blue-700 hover:bg-blue-200" title="Cetak" onclick="showToast('Mencetak berkas')"><i class="fa-solid fa-print"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal: Detail Aplikasi -->
    <div id="modal-app-detail" class="hidden fixed inset-0 z-40 items-center justify-center bg-black/40 p-4">
        <div class="w-full max-w-2xl bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Detail Pendaftaran</h3>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('modal-app-detail')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <div class="text-gray-500">Nama</div>
                    <div class="font-medium text-gray-900">M. Ikhsan</div>
                </div>
                <div>
                    <div class="text-gray-500">Program</div>
                    <div class="font-medium text-gray-900">SD Tahfidz</div>
                </div>
                <div>
                    <div class="text-gray-500">Asal Sekolah</div>
                    <div class="font-medium text-gray-900">SD Negeri 01</div>
                </div>
                <div>
                    <div class="text-gray-500">Tanggal</div>
                    <div class="font-medium text-gray-900">2025-07-30</div>
                </div>
                <div class="md:col-span-2">
                    <div class="text-gray-500">Catatan</div>
                    <div class="font-medium text-gray-900">Tertarik program tahfidz intensif.</div>
                </div>
            </div>
            <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-end gap-2">
                <button class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200" onclick="closeModal('modal-app-detail')">Tutup</button>
            </div>
        </div>
    </div>
</div>

