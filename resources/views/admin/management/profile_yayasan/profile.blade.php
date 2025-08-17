@extends('admin.app')

@section('content')

<div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-6" data-content="mgmt-profile" data-animate>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Profil Yayasan</h1>
            <p class="text-sm text-gray-500">Perbarui informasi yayasan: visi, misi, sejarah, dan kontak.</p>
        </div>
        <a href="#form-profile" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 shadow-sm">
            <i class="fas fa-pen"></i>
            Tambah/Perbarui Profil
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700">Terjadi kesalahan:</p>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    @php
        // Ambil data yayasan, gunakan data pertama jika ada
        $profile = isset($yayasan_data) && count($yayasan_data) > 0 ? $yayasan_data[0] : null;
        $visi = $profile->visi ?? '-';
        $misi = $profile->misi ?? '-';
        $sejarah = $profile->sejarah ?? '-';
        $telepon = $profile->telepon ?? '-';
        $email = $profile->email ?? '-';
        $alamat = $profile->alamat ?? '-';
        $facebook = $profile->facebook ?? null;
        $twitter = $profile->twitter ?? null;
        $instagram = $profile->instagram ?? null;
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="rounded-lg border border-gray-200 p-4">
            <div class="text-xs text-gray-500">Visi</div>
            <div class="mt-1 text-gray-800">{{ $visi }}</div>
        </div>
        <div class="rounded-lg border border-gray-200 p-4">
            <div class="text-xs text-gray-500">Misi</div>
            @if($misi && $misi !== '-')
                <ul class="mt-1 list-disc list-inside text-gray-800 space-y-1">
                    @foreach(preg_split('/\r\n|\r|\n/', $misi) as $item)
                        @if(trim($item) !== '')
                            <li>{{ $item }}</li>
                        @endif
                    @endforeach
                </ul>
            @else
                <div class="mt-1 text-gray-800">-</div>
            @endif
        </div>
        <div class="rounded-lg border border-gray-200 p-4 md:col-span-2">
            <div class="text-xs text-gray-500">Sejarah Singkat</div>
            <div class="mt-1 text-gray-800">{{ $sejarah }}</div>
        </div>
        <div class="rounded-lg border border-gray-200 p-4">
            <div class="text-xs text-gray-500">Kontak</div>
            <div class="mt-1 text-gray-800">
                {{ $alamat }}<br/>
                Telp: {{ $telepon }}<br/>
                Email: {{ $email }}
            </div>
        </div>
        <div class="rounded-lg border border-gray-200 p-4">
            <div class="text-xs text-gray-500">Media Sosial</div>
            <div class="mt-1 text-gray-800 flex items-center gap-3">
                @if($facebook)
                    <a class="text-blue-600 hover:underline" href="{{ $facebook }}" target="_blank">Facebook</a>
                @endif
                @if($twitter)
                    <a class="text-blue-400 hover:underline" href="{{ $twitter }}" target="_blank">Twitter</a>
                @endif
                @if($instagram)
                    <a class="text-pink-600 hover:underline" href="{{ $instagram }}" target="_blank">Instagram</a>
                @endif
                @if(!$facebook && !$twitter && !$instagram)
                    <span>-</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Form: Edit Profil -->
    <div id="form-profile" class="mt-10">
        <div class="w-full max-w-2xl bg-white rounded-xl shadow-xl overflow-hidden mx-auto border border-gray-200">
            <form action="{{ route('admin.profile-yayasan.update') }}" method="POST" class="space-y-0" id="profile-form">
                @csrf
                @method('PUT')
                <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                    <h3 class="font-semibold text-gray-900">Tambah / Perbarui Profil</h3>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Visi</label>
                        <input type="text" name="visi" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" value="{{ old('visi', $visi !== '-' ? $visi : '') }}">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Misi</label>
                        <textarea name="misi" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">{{ old('misi', $misi !== '-' ? $misi : '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Sejarah Singkat</label>
                        <textarea name="sejarah" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">{{ old('sejarah', $sejarah !== '-' ? $sejarah : '') }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Telepon</label>
                            <input type="text" name="telepon" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" value="{{ old('telepon', $telepon !== '-' ? $telepon : '') }}">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" value="{{ old('email', $email !== '-' ? $email : '') }}">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Alamat</label>
                        <input type="text" name="alamat" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" value="{{ old('alamat', $alamat !== '-' ? $alamat : '') }}">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Facebook</label>
                            <input type="text" name="facebook" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" value="{{ old('facebook', $facebook) }}">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Twitter</label>
                            <input type="text" name="twitter" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500" value="{{ old('twitter', $twitter) }}">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Instagram</label>
                            <input type="text" name="instagram" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" value="{{ old('instagram', $instagram) }}">
                        </div>
                    </div>
                </div>
                <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-end gap-2">
                    <a href="#" class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200">Batal</a>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700" id="submit-btn">
                        <span id="submit-text">Simpan</span>
                        <span id="submit-loading" class="hidden">
                            <i class="fas fa-spinner fa-spin mr-2"></i>
                            Menyimpan...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection