<div 
    x-data="{ openModal: false, modalPesan: null }" 
    class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-6" 
    data-content="mgmt-messages" 
    data-animate
>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Pesan Masuk</h1>
            <p class="text-sm text-gray-500">Kelola pesan dari halaman kontak.</p>
        </div>
        {{-- Fitur pencarian dan aksi massal dapat diimplementasikan dengan form jika diperlukan --}}
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200">
        <table class="w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pesan</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($pesan as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">
                            {{ $item->nama_depan }}{{ $item->nama_belakang ? ' ' . $item->nama_belakang : '' }}
                        </td>
                        <td class="px-4 py-3 text-gray-700">{{ $item->email }}</td>
                        <td class="px-4 py-3 text-gray-700 max-w-xs truncate" title="{{ $item->pesan }}">
                            {{ \Illuminate\Support\Str::limit($item->pesan, 40) }}
                        </td>
                        <td class="px-4 py-3 text-gray-700">
                            {{ $item->created_at ? $item->created_at->format('Y-m-d H:i') : '-' }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex justify-end gap-2">
                                <button 
                                    class="px-3 py-1.5 text-xs rounded-md bg-gray-100 hover:bg-gray-200" 
                                    title="Baca"
                                    @click="openModal = true; modalPesan = {{ $item->toJson() }}"
                                    type="button"
                                >
                                    <i class="fa-regular fa-envelope-open"></i>
                                </button>
                                <form action="{{ route('kontak.delete', ['id' => $item->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 text-xs rounded-md bg-red-100 text-red-700 hover:bg-red-200" title="Hapus">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada pesan masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Detail Pesan (TailwindCSS + Alpine.js) -->
    <div 
        x-show="openModal" 
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
        @keydown.escape.window="openModal = false"
    >
        <div 
            class="bg-white rounded-xl shadow-xl max-w-lg w-full mx-4"
            @click.away="openModal = false"
        >
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900 text-lg">Detail Pesan</h3>
                <button class="text-gray-500 hover:text-gray-700" @click="openModal = false">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="px-6 py-4 space-y-3" x-show="modalPesan">
                <div>
                    <span class="block text-xs text-gray-500">Nama</span>
                    <span class="block font-medium text-gray-900" x-text="modalPesan?.nama_depan + (modalPesan?.nama_belakang ? ' ' + modalPesan?.nama_belakang : '')"></span>
                </div>
                <div>
                    <span class="block text-xs text-gray-500">Email</span>
                    <span class="block text-gray-900" x-text="modalPesan?.email"></span>
                </div>
                <div>
                    <span class="block text-xs text-gray-500">No HP</span>
                    <span class="block text-gray-900" x-text="modalPesan?.no_hp"></span>
                </div>
                <div>
                    <span class="block text-xs text-gray-500">Tanggal</span>
                    <span class="block text-gray-900" x-text="modalPesan?.created_at ? new Date(modalPesan.created_at).toLocaleString('id-ID') : '-'"></span>
                </div>
                <div>
                    <span class="block text-xs text-gray-500">Pesan</span>
                    <div class="block text-gray-900 whitespace-pre-line" x-text="modalPesan?.pesan"></div>
                </div>
            </div>
            <div class="px-6 py-3 border-t border-gray-100 flex justify-end">
                <button class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700" @click="openModal = false">Tutup</button>
            </div>
        </div>
    </div>
</div>
