@extends('admin.app') {{-- layout dengan sidebar dan navbar --}}

@section('content')
    <h2 class="text-xl font-bold mb-4">Data Sejarah</h2>
    <a href="{{ route('admin.sejarah.create') }}" class="bg-blue-950 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah</a>

    <table class="table-auto w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Judul</th>
                <th class="p-2">Gambar</th>
                <th class="p-2">Konten</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr class="border-t text-center">
                <td class="p-2">{{ $item->judul }}</td>
                <td class="p-2">
                    @if ($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" width="80">
                    @else -
                    @endif
                </td>
                <td class="p-2">{!! $item->konten !!}</td>
                <td class="p-2">
                    <a href="{{ route('admin.sejarah.edit', $item->id) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('admin.sejarah.destroy', $item->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus?')" class="text-red-600 ml-2">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
