<div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-6" data-content="mgmt-finance" data-animate>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Data Keuangan</h1>
            <p class="text-sm text-gray-500">Kelola pemasukan, SPP, dan laporan.</p>
        </div>
        <div class="flex gap-2">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 shadow-sm" onclick="openModal('modal-payment')">
                <i class="fas fa-plus"></i>
                Entri Pembayaran
            </button>
            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg" onclick="showToast('Membuka laporan')">Laporan Bulanan</button>
            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg" onclick="showToast('Memuat riwayat')">Riwayat Pembayaran</button>
            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg" onclick="openModal('modal-spp')">Atur Nominal SPP</button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="rounded-lg border border-gray-200 p-4">
            <div class="text-xs text-gray-500">Pemasukan Bulan Ini</div>
            <div class="mt-1 text-2xl font-semibold text-gray-900">Rp 12.500.000</div>
            <div class="mt-1 text-xs text-emerald-600"><i class="fa-solid fa-arrow-trend-up"></i> +8% dari bulan lalu</div>
        </div>
        <div class="rounded-lg border border-gray-200 p-4">
            <div class="text-xs text-gray-500">Tunggakan</div>
            <div class="mt-1 text-2xl font-semibold text-gray-900">Rp 3.200.000</div>
            <div class="mt-1 text-xs text-amber-600"><i class="fa-solid fa-clock"></i> 14 siswa</div>
        </div>
        <div class="rounded-lg border border-gray-200 p-4">
            <div class="text-xs text-gray-500">Transaksi</div>
            <div class="mt-1 text-2xl font-semibold text-gray-900">238</div>
            <div class="mt-1 text-xs text-gray-500">Total transaksi tahun berjalan</div>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200">
        <table class="w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nominal</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-700">2025-07-30</td>
                    <td class="px-4 py-3 font-medium text-gray-900">Dewi Lestari</td>
                    <td class="px-4 py-3 text-gray-700">5A</td>
                    <td class="px-4 py-3 text-gray-700">Rp 250.000</td>
                    <td class="px-4 py-3 text-gray-700">Transfer</td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <button class="px-3 py-1.5 text-xs rounded-md bg-gray-100 hover:bg-gray-200" title="Kwitansi" onclick="showToast('Mengunduh kwitansi')"><i class="fa-solid fa-receipt"></i></button>
                            <button class="px-3 py-1.5 text-xs rounded-md bg-red-100 text-red-700 hover:bg-red-200" title="Batalkan" onclick="showToast('Transaksi dibatalkan','warning')"><i class="fa-solid fa-ban"></i></button>
                        </div>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-700">2025-07-28</td>
                    <td class="px-4 py-3 font-medium text-gray-900">Rizki Ramadhan</td>
                    <td class="px-4 py-3 text-gray-700">4B</td>
                    <td class="px-4 py-3 text-gray-700">Rp 250.000</td>
                    <td class="px-4 py-3 text-gray-700">Tunai</td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <button class="px-3 py-1.5 text-xs rounded-md bg-gray-100 hover:bg-gray-200" title="Kwitansi" onclick="showToast('Mengunduh kwitansi')"><i class="fa-solid fa-receipt"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal: Entri Pembayaran -->
    <div id="modal-payment" class="hidden fixed inset-0 z-40 items-center justify-center bg-black/40 p-4">
        <div class="w-full max-w-xl bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Entri Pembayaran</h3>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('modal-payment')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Nama Siswa</label>
                        <input type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="Nama siswa">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Kelas</label>
                        <input type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="Mis. 5A">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Nominal</label>
                        <input type="number" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="250000">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Metode</label>
                        <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            <option>Tunai</option>
                            <option>Transfer</option>
                            <option>QRIS</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Catatan</label>
                    <textarea rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="Opsional"></textarea>
                </div>
            </div>
            <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-end gap-2">
                <button class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200" onclick="closeModal('modal-payment')">Batal</button>
                <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700" onclick="closeModal('modal-payment');showToast('Pembayaran tersimpan')">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Modal: Atur Nominal SPP -->
    <div id="modal-spp" class="hidden fixed inset-0 z-40 items-center justify-center bg-black/40 p-4">
        <div class="w-full max-w-md bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Atur Nominal SPP</h3>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('modal-spp')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-5 space-y-4">
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Nominal/Bulan</label>
                    <input type="number" value="250000" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-end gap-2">
                <button class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200" onclick="closeModal('modal-spp')">Batal</button>
                <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700" onclick="closeModal('modal-spp');showToast('Nominal SPP diperbarui')">Simpan</button>
            </div>
        </div>
    </div>
</div>

