@extends('admin.app')

@section('content')
<div class="animate-in">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Visi, Misi & Tujuan</h1>
                <p class="text-gray-600">Perbarui informasi visi, misi, dan tujuan yayasan</p>
            </div>
            <a href="{{ route('admin.visi_misi.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-lg shadow-lg hover:bg-gray-700 transform hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form Section -->
    <div class="bg-white rounded-xl shadow-lg p-8">
        <form action="{{ route('admin.visi_misi.update', $visiMisi->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')
            
            <!-- Visi Section -->
            <div class="space-y-4">
                <div class="flex items-center mb-4">
                    <div class="p-3 bg-blue-600 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900">Visi</h3>
                </div>
                
                <div>
                    <label for="visi" class="block text-sm font-medium text-gray-700 mb-2">
                        Visi Yayasan <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="visi" 
                        name="visi" 
                        rows="4" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-none @error('visi') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                        placeholder="Masukkan visi yayasan..."
                        required
                    >{{ old('visi', $visiMisi->visi) }}</textarea>
                    @error('visi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Maksimal 2000 karakter</p>
                </div>
            </div>

            <!-- Misi Section -->
            <div class="space-y-4">
                <div class="flex items-center mb-4">
                    <div class="p-3 bg-green-600 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-green-900">Misi</h3>
                </div>
                
                <div>
                    <label for="misi" class="block text-sm font-medium text-gray-700 mb-2">
                        Misi Yayasan <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="misi" 
                        name="misi" 
                        rows="6" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 resize-none @error('misi') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                        placeholder="Masukkan misi yayasan..."
                        required
                    >{{ old('misi', $visiMisi->misi) }}</textarea>
                    @error('misi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Maksimal 2000 karakter</p>
                </div>
            </div>

            <!-- Tujuan Section -->
            <div class="space-y-4">
                <div class="flex items-center mb-4">
                    <div class="p-3 bg-purple-600 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-purple-900">Tujuan</h3>
                </div>
                
                <div>
                    <label for="tujuan" class="block text-sm font-medium text-gray-700 mb-2">
                        Tujuan Yayasan <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="tujuan" 
                        name="tujuan" 
                        rows="6" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 resize-none @error('tujuan') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                        placeholder="Masukkan tujuan yayasan..."
                        required
                    >{{ old('tujuan', $visiMisi->tujuan) }}</textarea>
                    @error('tujuan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Maksimal 2000 karakter</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                <button type="submit" 
                        class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white font-medium rounded-lg shadow-lg hover:from-yellow-600 hover:to-yellow-700 transform hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="black" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-black"> Perbarui Data </span>
                </button>
                
                <a href="{{ route('admin.visi_misi.index') }}" 
                   class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg shadow-lg hover:bg-gray-200 transform hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="black" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                   <span class="text-black"> Batal </span>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
