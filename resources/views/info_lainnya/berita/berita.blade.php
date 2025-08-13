<x-landingpage>
    <x-slot name="header"></x-slot>
    {{-- Banner Header Section --}}
    <div class="relative w-screen h-[500px] overflow-hidden">
        <img src="{{ asset('assets/images/AMY.png') }}" alt="Header" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/45 flex flex-col items-center justify-center text-center px-4">
            <h5 class="text-xl md:text-6xl font-semibold leading-tight  mb-4 text-white">
                Selamat Datang<br>di Yayasan Al-Khoir Indramayu
            </h5>
            <p class="text-lg md:text-2xl text-white">
                Meraih Ilmu Dimana Saja Dan Kapan Saja
            </p>
        </div>

    </div>
    <div class="mt-20 mb-24 w-full px-4 md:px-8">
        <h2 class="text-2xl font-bold mt-5 mb-10 text-center">Berita Kegiatan Yayasan Al-Khoir</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-20 ">
            @for ($i = 0; $i < 3; $i++)
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <img src="{{ asset('assets/images/background.png') }}" alt="Berita"
                        class="w-full h-48 object-cover">
                    <div class="p-4">
                        <p class="text-sm text-gray-500 mb-1">19, Juni 2025</p>
                        <h3 class="text-md font-bold mb-2">Kegiatan Ujian Tahfidz Tengah semester</h3>
                        <p class="text-xs text-gray-600 mb-2">#BeritaRQTAl-Khoir</p>
                        <a href="{{ route('detail_berita') }}"
                            class="text-sm font-semibold text-pink-600 hover:underline">Selengkapnya</a>
                    </div>
                </div>
            @endfor
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('berita') }}"
                class="border border-blue-900 text-black font-bold px-6 py-2 rounded-md hover:bg-blue-900 hover:text-white transition">Berita
                Lainnya</a>
        </div>
    </div>

    @php
        $galeri = [
            'assets/images/galeri/g1.png',
            'assets/images/galeri/g2.png',
            'assets/images/galeri/g3.png',
            'assets/images/galeri/g4.png',
        ];
    @endphp
</x-landingpage>
