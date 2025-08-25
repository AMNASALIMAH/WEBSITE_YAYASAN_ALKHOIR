@extends('admin.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Ubah Data - {{ $typeLabel }}</h1>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('admin.management.program_unit.update', [$type, $item->id]) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Sejarah</label>
                <textarea name="sejarah" rows="4" class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Tuliskan sejarah...">{{ old('sejarah', $item->sejarah) }}</textarea>
                @error('sejarah')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Visi</label>
                <textarea name="visi" rows="3" class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Tuliskan visi...">{{ old('visi', $item->visi) }}</textarea>
                @error('visi')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Misi & Tujuan</label>
                <textarea name="misi_tujuan" rows="4" class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Tuliskan misi & tujuan...">{{ old('misi_tujuan', $item->misi_tujuan) }}</textarea>
                @error('misi_tujuan')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Profil Ketua Program</label>
                <textarea name="profil_ketua_program" rows="4" class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Tuliskan profil ketua program...">{{ old('profil_ketua_program', $item->profil_ketua_program) }}</textarea>
                @error('profil_ketua_program')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Fasilitas</label>
                <textarea name="fasilitas" rows="4" class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Tuliskan fasilitas...">{{ old('fasilitas', $item->fasilitas) }}</textarea>
                @error('fasilitas')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Perbarui</button>
                <a href="{{ route('admin.management.program_unit.index', $type) }}" class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection


