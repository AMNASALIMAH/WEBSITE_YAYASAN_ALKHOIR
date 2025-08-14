<div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-6" data-content="mgmt-account" data-animate>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Perbarui Akun Profil</h1>
            <p class="text-sm text-gray-500">Kelola detail akun pribadi Anda.</p>
        </div>
        <a href="/profile" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm">Buka Halaman Profil</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="col-span-1 md:col-span-1 rounded-lg border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-lg font-semibold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <div class="font-medium text-gray-900">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="text-sm text-gray-600">{{ auth()->user()->email ?? 'admin@example.com' }}</div>
                </div>
            </div>
            <div class="mt-4 text-xs text-gray-500">Bergabung: {{ (auth()->user()->created_at ?? now())->format('d M Y') }}</div>
        </div>
        <div class="col-span-1 md:col-span-2 rounded-lg border border-gray-200 p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Nama</label>
                    <input type="text" value="{{ auth()->user()->name ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Email</label>
                    <input type="email" value="{{ auth()->user()->email ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Password Baru</label>
                    <input type="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="••••••••">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="••••••••">
                </div>
            </div>
            <div class="mt-4 flex items-center justify-end">
                <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700" onclick="showToast('Perubahan disimpan')">Simpan Perubahan</button>
            </div>
        </div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-blue-800 text-sm">
        Tips: Anda dapat mengelola informasi profil yang lebih lengkap di halaman profil.
    </div>
</div>

