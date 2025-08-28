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
            <a href="{{ url('/MajelisTalimAl-Khoir') }}" class="block">
                <div
                    class="bg-white border-2 border-blue-900 p-6 rounded-xl shadow-lg flex items-center gap-4 hover:shadow-xl hover:-translate-y-1 transition">
                    <img src="{{ asset('assets/images/logo2.png') }}" alt="Majelis Icon" class="w-10 h-10" />
                    <p class="font-semibold">Majelis Ta'lim Al-Khoir</p>
                </div>
            </a>

            {{-- Kotak 2 --}}
            <a href="{{ url('/MahasantriAl-Khoir') }}" class="block">
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

                <a href="{{ url('/RTQAlKhoir') }}" class="block">
                    <div
                        class="bg-white border-2 border-blue-900 p-6 rounded-xl shadow-lg flex items-center gap-4 hover:shadow-xl hover:-translate-y-1 transition">
                        <img src="{{ asset('assets/images/sd.png') }}" alt="SD Icon" class="w-10 h-10" />
                        <p class="font-semibold">RTQ Al-Khoir</p>
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
        <div id="news-section" class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- News cards will be loaded here dynamically -->
            <div class="col-span-full text-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
                <p class="mt-4 text-gray-600">Memuat berita terbaru...</p>
            </div>
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('news.index') }}"
                class="inline-flex items-center px-6 py-3 border border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 002-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                Lihat Semua Berita
            </a>
        </div>
    </div>

    <script>
    // Load latest news on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadLatestNews();
    });

    function loadLatestNews() {
        fetch('/admin/news/latest')
            .then(response => response.json())
            .then(news => {
                const newsSection = document.getElementById('news-section');
                
                if (news.length === 0) {
                    newsSection.innerHTML = `
                        <div class="col-span-full text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 002-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada berita</h3>
                            <p class="text-gray-500">Berita akan muncul di sini setelah admin menambahkan konten.</p>
                        </div>
                    `;
                    return;
                }

                const newsHTML = news.map(item => `
                    <article class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100">
                        <div class="relative overflow-hidden">
                            <img src="${item.gambar ? '/storage/' + item.gambar : '{{ asset('assets/images/background.png') }}'}" 
                                 alt="${item.judul}"
                                 class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 backdrop-blur-sm">
                                    ${item.kategori}
                                </span>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                ${new Date(item.tanggal_terbit).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}
                            </div>
                            
                            <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-300 line-clamp-2">
                                ${item.judul}
                            </h3>
                            
                            ${item.ringkasan ? `<p class="text-gray-600 mb-4 line-clamp-2">${item.ringkasan}</p>` : ''}
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    ${item.penulis}
                                </div>
                                
                                <a href="/news/${item.slug}" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium transition-all duration-300 group-hover:translate-x-1">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                `).join('');

                newsSection.innerHTML = newsHTML;
            })
            .catch(error => {
                console.error('Error loading news:', error);
                const newsSection = document.getElementById('news-section');
                newsSection.innerHTML = `
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 text-red-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Gagal memuat berita</h3>
                        <p class="text-gray-500">Terjadi kesalahan saat memuat berita terbaru.</p>
                    </div>
                `;
            });
    }
    </script>

    <style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Smooth animations for news cards */
    article {
        animation: fadeInUp 0.6s ease-out;
    }

    article:nth-child(1) { animation-delay: 0.1s; }
    article:nth-child(2) { animation-delay: 0.2s; }
    article:nth-child(3) { animation-delay: 0.3s; }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Hover effects */
    article:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    /* Image zoom effect */
    article img {
        transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }

    article:hover img {
        transform: scale(1.1);
    }
    </style>

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
