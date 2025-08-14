<div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-6" data-content="mgmt-profile" data-animate>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Profil Yayasan</h1>
            <p class="text-sm text-gray-500">Perbarui informasi yayasan: visi, misi, sejarah, dan kontak.</p>
        </div>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 shadow-sm" onclick="openModal('modal-profile')">
            <i class="fas fa-pen"></i>
            Tambah/Perbarui Profil
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="rounded-lg border border-gray-200 p-4">
            <div class="text-xs text-gray-500">Visi</div>
            <div class="mt-1 text-gray-800">Menjadi lembaga pendidikan yang unggul dalam pembinaan akhlak dan tahfidz Al-Qur'an.</div>
        </div>
        <div class="rounded-lg border border-gray-200 p-4">
            <div class="text-xs text-gray-500">Misi</div>
            <ul class="mt-1 list-disc list-inside text-gray-800 space-y-1">
                <li>Menyelenggarakan pendidikan berkualitas.</li>
                <li>Mengembangkan program tahfidz berkelanjutan.</li>
                <li>Menanamkan nilai-nilai keislaman.</li>
            </ul>
        </div>
        <div class="rounded-lg border border-gray-200 p-4 md:col-span-2">
            <div class="text-xs text-gray-500">Sejarah Singkat</div>
            <div class="mt-1 text-gray-800">Yayasan Al-Khoir berdiri pada tahun 2010 dan berfokus pada pendidikan Qur'ani serta pembinaan karakter.</div>
        </div>
        <div class="rounded-lg border border-gray-200 p-4">
            <div class="text-xs text-gray-500">Kontak</div>
            <div class="mt-1 text-gray-800">Jl. Contoh No. 123, Kota, Indonesia<br/>Telp: 0812-3456-7890<br/>Email: info@alkhoir.or.id</div>
        </div>
        <div class="rounded-lg border border-gray-200 p-4">
            <div class="text-xs text-gray-500">Media Sosial</div>
            <div class="mt-1 text-gray-800 flex items-center gap-3">
                <a class="text-blue-600 hover:underline" href="#">Facebook</a>
                <a class="text-blue-400 hover:underline" href="#">Twitter</a>
                <a class="text-pink-600 hover:underline" href="#">Instagram</a>
            </div>
        </div>
    </div>

    <!-- Modal: Edit Profil -->
    <div id="modal-profile" class="hidden fixed inset-0 z-40 items-center justify-center bg-black/40 p-4">
        <div class="w-full max-w-2xl bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Tambah / Perbarui Profil</h3>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('modal-profile')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-5 space-y-4">
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Visi</label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" value="Menjadi lembaga pendidikan yang unggul dalam pembinaan akhlak dan tahfidz Al-Qur'an.">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Misi</label>
                    <textarea rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">Menyelenggarakan pendidikan berkualitas.\nMengembangkan program tahfidz berkelanjutan.\nMenanamkan nilai-nilai keislaman.</textarea>
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Sejarah Singkat</label>
                    <textarea rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">Yayasan Al-Khoir berdiri pada tahun 2010 dan berfokus pada pendidikan Qur'ani serta pembinaan karakter.</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Telepon</label>
                        <input type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" value="0812-3456-7890">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Email</label>
                        <input type="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" value="info@alkhoir.or.id">
                    </div>
                </div>
            </div>
            <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-end gap-2">
                <button class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200" onclick="closeModal('modal-profile')">Batal</button>
                <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700" onclick="closeModal('modal-profile');showToast('Profil diperbarui')">Simpan</button>
            </div>
        </div>
    </div>
</div>

