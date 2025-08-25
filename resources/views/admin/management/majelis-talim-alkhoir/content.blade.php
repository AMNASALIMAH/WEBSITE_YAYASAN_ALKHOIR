@extends('admin.app')

@section('content')

<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Majelis Ta'lim Al-Khoir</h2>
        <p class="text-gray-600 mb-6">Kelola konten program: sejarah, visi, misi & tujuan, profil ketua program, fasilitas.</p>
        <a href="{{ route('admin.management.program_unit.index', 'majelis-talim-alkhoir') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-all">Buka Manajemen</a>
    </div>
</div>

@endsection