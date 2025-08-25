@extends('admin.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">{{ $typeLabel }} - Manajemen Konten</h1>
        <p class="text-sm text-gray-500">Kelola data: sejarah, visi, misi & tujuan, profil ketua program, fasilitas.</p>
    </div>

    <div class="mb-4 flex justify-between items-center">
        <a href="{{ route('admin.management.program_unit.create', $type) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition-all">Tambah Data</a>
        <a href="{{ url()->previous() }}" class="text-sm text-gray-600 hover:text-gray-800">Kembali</a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sejarah</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visi</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($items as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $item->id }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700 truncate max-w-xs">{{ \Illuminate\Support\Str::limit(strip_tags($item->sejarah), 80) }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700 truncate max-w-xs">{{ \Illuminate\Support\Str::limit(strip_tags($item->visi), 80) }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.management.program_unit.show', [$type, $item->id]) }}" class="px-3 py-1 text-xs bg-gray-100 text-gray-800 rounded hover:bg-gray-200">Lihat</a>
                                <a href="{{ route('admin.management.program_unit.edit', [$type, $item->id]) }}" class="px-3 py-1 text-xs bg-blue-100 text-blue-800 rounded hover:bg-blue-200">Ubah</a>
                                <form action="{{ route('admin.management.program_unit.destroy', [$type, $item->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 text-xs bg-red-100 text-red-800 rounded hover:bg-red-200">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $items->withQueryString()->links() }}</div>
</div>
@endsection


