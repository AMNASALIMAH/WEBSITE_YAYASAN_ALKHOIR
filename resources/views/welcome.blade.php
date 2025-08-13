<x-landingpage>
    <x-slot name="header"></x-slot>
    {{-- Banner Header Section --}}
    <div class="relative w-screen h-[500px] overflow-hidden">
        <img src="{{ asset('assets/images/AMY.png') }}" alt="Header" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/45 flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight  mb-4 text-white">
                Selamat Datang<br>di Yayasan Al-Khoir Indramayu
            </h1>
            <p class="text-lg md:text-2xl text-white">
                Meraih Ilmu Dimana Saja Dan Kapan Saja
            </p>
        </div>
    </div>

    {{-- Kotak-Kotak Program Mengambang & Terpisah --}}
    <div class="relative z-10 -mt-12 px-4 md:px-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Kotak 1 --}}
            <a href="{{ url('/program/majelis') }}" class="block">
                <div
                    class="bg-white border-2 border-blue-900 p-6 rounded-xl shadow-lg flex items-center gap-4 hover:shadow-xl hover:-translate-y-1 transition">
                    <img src="{{ asset('assets/images/logo2.png') }}" alt="Majelis Icon" class="w-10 h-10" />
                    <p class="font-semibold">Majelis Ta'lim Al-Khoir</p>
                </div>
            </a>

            {{-- Kotak 2 --}}
            <a href="{{ url('/program/rumah-tahfidz') }}" class="block">
                <div
                    class="bg-white border-2 border-blue-900 p-6 rounded-xl shadow-lg flex items-center gap-4 hover:shadow-xl hover:-translate-y-1 transition">
                    <img src="{{ asset('assets/images/anak ngaji.png') }}" alt="Rumah Icon" class="w-10 h-10" />
                    <p class="font-semibold">Rumah Tahfidz Al-Khoir</p>
                </div>
            </a>

            {{-- Kotak 3 --}}
            <a href="{{ route('SDT') }}" class="block">
                <div
                    class="bg-white border-2 border-blue-900 p-6 rounded-xl shadow-lg flex items-center gap-4 hover:shadow-xl hover:-translate-y-1 transition">
                    <img src="{{ asset('assets/images/asrama biru.png') }}" alt="SD Icon" class="w-10 h-10" />
                    <p class="font-semibold">Sekolah Dasar Tahfidz</p>
                </div>

                {{-- Kotak 4 --}}

                <a href="{{ url('/program/sd-tahfidz') }}" class="block">
                    <div
                        class="bg-white border-2 border-blue-900 p-6 rounded-xl shadow-lg flex items-center gap-4 hover:shadow-xl hover:-translate-y-1 transition">
                        <img src="{{ asset('assets/images/sd.png') }}" alt="SD Icon" class="w-10 h-10" />
                        <p class="font-semibold">Sekolah Dasar Tahfidz</p>
                    </div>
                </a>
        </div>
    </div>
    {{-- Profil Yayasan --}}
    <section class="mt-20 w-full px-4 md:px-8">
        <h2 class="text-2xl font-bold uppercase mb-6">Profil Yayasan Al-Khoir</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <img src="{{ asset('assets/images/AMY.png') }}" class="rounded-lg " />
            <div>
                <h3 class="text-xl font-bold mb-2">Sejarah Singkat</h3>
                <p class="text-gray-700 mb-4 text-sm">
                    Yayasan Al-Khoir berdiri pada tahun 2017, yang terletak di Jl. Babarlayar no. 43, rt.37,rw.02, desa
                    Terusan, kecamatan. Sindang, kabupaten. Indramayu.
                    Yayasan Alkhoir memiliki 4 program utama yakni; Majelis Ta'lim Al-Khoir, Rumah Tahfidz Quran(RTQ),
                    Mahasantri RTQ dan SD Tahfidz Al-Khoir.
                </p>
                <a href="{{ route('sejarah') }}" class="text-blue-900 font-bold underline">Baca Selengkapnya</a>
            </div>
        </div>
    </section>

    {{-- Berita Kegiatan --}}
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
                        <a href="#" class="text-sm font-semibold text-pink-600 hover:underline">Selengkapnya</a>
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

    {{-- Galeri --}}
    <section class="mt-24 px-4 md:px-20 relative">
        {{-- Layer background yang digelapkan --}}
        <div class="w-full px-4 md:px-8">
            <div class="absolute inset-0 z-0 ">
                <div class="w-full h-full bg-black/80 absolute"></div>
                <div class="w-full h-full bg-cover bg-center"
                    style="background-image: url('{{ asset('assets/images/background.png') }}');"></div>
            </div>
        </div>

        {{-- Konten Galeri --}}
        <div class="relative z-10 py-16">
            {{-- Judul dan tombol --}}
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-1 bg-white rounded-full"></div>
                    <h2 class="text-2xl font-bold text-white">Foto Kegiatan</h2>
                </div>
                <a href="#"
                    class=" font-bold border border-white text-white px-4 py-1.5 rounded-md hover:bg-white hover:text-blue-900 transition">
                    Foto Lainnya
                </a>
            </div>

            {{-- Grid Foto --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($galeri as $index => $foto)
                    <div class="overflow-hidden rounded-lg shadow-lg">
                        <img src="{{ asset($foto) }}" alt="Galeri {{ $index + 1 }}"
                            class="w-full h-40 object-cover">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- Call to Action --}}
    <section class="mt-24 w-full px-4 md:px-20 grid grid-cols-1 md:grid-cols-2 items-center gap-8">
        {{-- Kiri: Teks CTA --}}
        <div>
            <p class="text-xl font-bold text-blue-900 mb-2 flex items-center gap-2">
                <span class="w-8 h-1 bg-blue-900 rounded-full"></span> Daftar Santri
            </p>
            <h3 class="text-3xl md:text-4xl font-extrabold mb-4 leading-snug">
                Gabung Bersama Kami, <br> Mewujudkan Generasi Qurani
            </h3>
            <p class="text-base text-gray-700 mb-6 max-w-xl">
                Ketika niatmu hanya untuk Allah, setiap hafalan menjadi ibadah, bukan beban.
                Jangan khawatir tentang seberapa cepat kamu hafal, khawatirlah jika niatmu mulai pudar
            </p>
            <a href="#"
                class="px-6 py-2 border-2 border-blue-900 text-blue-900 font-semibold rounded hover:bg-blue-900 hover:text-white transition">
                Registrasi
            </a>
        </div>

        {{-- Kanan: Dua Foto --}}
        <div class="flex  flex-col justify-center items-center md:flex-row md:items-center md:justify-end gap-10 ">
            {{-- Kartu 1 --}}
            <div class="w-40 h-60 item rounded-[15px] bg-cover bg-center shadow-2xl transform rotate-[10deg] mt-10"
                style="background-image: url('{{ asset('assets/images/galeri/g1.png') }}');">
            </div>

            {{-- Kartu 2 --}}
            <div class="w-40 h-60 item rounded-[15px] bg-cover bg-center shadow-2xl transform rotate-[10deg] mt-8"
                style="background-image: url('{{ asset('assets/images/galeri/g2.png') }}');">
            </div>
        </div>

    </section>



</x-landingpage>
