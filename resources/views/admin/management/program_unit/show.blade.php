@extends('admin.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-800">Detail - {{ $typeLabel }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.management.program_unit.edit', [$type, $item->id]) }}" class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Ubah</a>
            <form action="{{ route('admin.management.program_unit.destroy', [$type, $item->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-2">Sejarah</h2>
            <div class="prose max-w-none text-gray-700">{!! nl2br(e($item->sejarah)) !!}</div>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-2">Visi</h2>
            <div class="prose max-w-none text-gray-700">{!! nl2br(e($item->visi)) !!}</div>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-2">Misi & Tujuan</h2>
            <div class="prose max-w-none text-gray-700">{!! nl2br(e($item->misi_tujuan)) !!}</div>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-2">Profil Ketua Program</h2>
            <div class="prose max-w-none text-gray-700">{!! nl2br(e($item->profil_ketua_program)) !!}</div>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-2">Fasilitas</h2>
            <div class="prose max-w-none text-gray-700">{!! nl2br(e($item->fasilitas)) !!}</div>
        </div>
    </div>

    <div>
        <a href="{{ route('admin.management.program_unit.index', $type) }}" class="text-sm text-gray-600 hover:text-gray-800">Kembali ke daftar</a>
    </div>
</div>
@endsection


