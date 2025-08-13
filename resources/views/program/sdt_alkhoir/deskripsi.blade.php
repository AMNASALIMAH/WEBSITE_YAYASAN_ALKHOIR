<x-landingpage>
    {{-- Header Section --}}
    <section class="relative w-full h-64">
        <img src="{{ asset('assets/images/AMY.png') }}" alt="Header"
            class="absolute inset-0 w-full h-full object-cover z-0">
        <div class="absolute inset-0 bg-black bg-opacity-40 z-10"></div>
        <div class="relative z-20 flex items-center justify-center h-full">
            <div class="text-center px-4 md:px-6 lg:px-8 text-white">
                <p class="text-sm mb-1">Program > <span class="font-medium">SD Tahfidz Al-Khoir</span></p>
                <h1 class="text-xl md:text-2xl font-semibold">Tentang SD Tahfidz Al-Khoir</h1>
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <main class="flex-1 bg-white pt-12 pb-16 px-4 md:px-20 text-gray-800">
        <section class="max-w-6xl mx-auto flex flex-col md:flex-row gap-10">

            {{-- Konten Utama --}}
            <div class="md:w-3/4 space-y-10">

                {{-- VISI & MISI --}}
                <div id="visi-misi">
                    <h2 class="text-xl font-bold text-gray-800 border-b border-blue-800 inline-block mb-2">
                        Visi & Misi
                    </h2>

                    {{-- Visi --}}
                    <div class="mb-2">
                        <h3 class="text-base font-medium text-gray-700 mb-1">Visi</h3>
                        <p class="italic text-gray-600 text-baseleading-normal">
                            “SD Tahfidz Al-Khoir menjadi unggulan yang terdepan dalam membentuk generasi Qurani yang
                            mandiri dan berakhlakul karimah.”
                        </p>
                    </div>

                    {{-- Misi --}}
                    <div>
                        <h3 class="text-base font-medium text-gray-700 mb-1">Misi</h3>
                        <ul class="space-y-2 text-base text-gray-700 leading-normal">
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-blue-900 mt-1 mr-2 shrink-0" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                Meningkatkan serta menjaga ilmu yang diraih.
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-blue-900 mt-1 mr-2 shrink-0" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                Melakukan penelitian terapan dan pengabdian masyarakat untuk mengatasi persoalan
                                industri dan masyarakat.
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Pembatas SVG --}}
                <div>
                    <svg viewBox="0 0 1200 20" class="w-full h-6 text-blue-200" preserveAspectRatio="none">
                        <path d="M0,10 C300,20 900,0 1200,10 L1200,20 L0,20 Z" fill="currentColor"></path>
                    </svg>
                </div>

                {{-- TUJUAN --}}
                <div id="tujuan">
                    <h2 class="text-xl font-bold text-gray-800 border-b border-blue-800 inline-block mb-2">
                        Tujuan
                    </h2>
                    <ul class="space-y-2 text-base text-gray-700 leading-normal">
                        @foreach (['Membentuk karakter islami dan akhlakul karimah pada siswa', 'Menghasilkan produk akademik yang memberikan manfaat bagi masyarakat luas', 'Mendorong peserta didik menjadi generasi Qurani yang unggul', 'Menjadi pusat pendidikan Islam terpadu berbasis tahfidz Qur’an'] as $tujuan)
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-blue-900 mt-1 mr-2 shrink-0" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ $tujuan }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Pembatas SVG --}}
                <div>
                    <svg viewBox="0 0 1200 20" class="w-full h-6 text-blue-200" preserveAspectRatio="none">
                        <path d="M0,10 C300,20 900,0 1200,10 L1200,20 L0,20 Z" fill="currentColor"></path>
                    </svg>
                </div>

                {{-- SEJARAH SINGKAT --}}
                <div id="sejarah">
                    <h2 class="text-xl font-bold text-gray-800 border-b border-blue-800 inline-block mb-2">
                        Sejarah Singkat
                    </h2>
                    <div class="flex flex-col md:flex-row items-center gap-4">
                        <img src="{{ asset('assets/images/AMY.png') }}" alt="Sejarah"
                            class="rounded-lg w-64 h-auto shadow-md">
                        <p class="text-base text-gray-700 leading-normal">
                            Yayasan Al-Khoir berdiri pada tahun 2017, berlokasi di Jl. Babarlayar no. 43, RT.37, RW.02,
                            desa Terusan, kecamatan Sindang, kabupaten Indramayu. Yayasan Al-Khoir memiliki 4 program
                            utama yakni: Majelis Ta'lim Al-Khoir, Rumah Tahfidz Quran (RTQ), Mahasantri RTQ, dan SD
                            Tahfidz Al-Khoir.
                        </p>
                    </div>
                </div>
                <div class="my-10">
                    <svg viewBox="0 0 1200 20" class="w-full h-6 text-blue-200" preserveAspectRatio="none">
                        <path d="M0,10 C300,20 900,0 1200,10 L1200,20 L0,20 Z" fill="currentColor"></path>
                    </svg>
                </div>
                <div id="fasilitas" class="max-w-4xl mx-auto">
                    <h2 class="text-xl font-bold text-gray-800 border-b border-blue-800 inline-block mb-2 ">
                        Fasilitas
                    </h2>

                    <div class="flex flex-col gap-4">
                        {{-- Paragraf --}}
                        <p class="text-base text-gray-700 leading-normal">
                            Yayasan Al-Khoir berdiri pada tahun 2017, berlokasi di Jl. Babarlayar no. 43, RT.37, RW.02,
                            desa Terusan, kecamatan Sindang, kabupaten Indramayu. Yayasan Al-Khoir memiliki 4 program
                            utama yakni: Majelis Ta'lim Al-Khoir, Rumah Tahfidz Quran (RTQ), Mahasantri RTQ, dan SD
                            Tahfidz Al-Khoir.
                        </p>

                        {{-- Gambar-gambar --}}
                        <div class="flex flex-wrap gap-4">
                            <div class="w-full sm:w-[48%] md:w-[25%]">
                                <img src="{{ asset('assets/images/AMY.png') }}" alt="Fasilitas"
                                    class="w-full h-auto object-cover shadow-md">
                            </div>
                            <div class="w-full sm:w-[48%] md:w-[25%]">
                                <img src="{{ asset('assets/images/AMY.png') }}" alt="Fasilitas"
                                    class="w-full h-auto object-cover shadow-md">
                            </div>
                            <div class="w-full sm:w-[48%] md:w-[25%]">
                                <img src="{{ asset('assets/images/AMY.png') }}" alt="Fasilitas"
                                    class="w-full h-auto object-cover shadow-md">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="my-10">
                    <svg viewBox="0 0 1200 20" class="w-full h-6 text-blue-200" preserveAspectRatio="none">
                        <path d="M0,10 C300,20 900,0 1200,10 L1200,20 L0,20 Z" fill="currentColor"></path>
                    </svg>
                </div>
                <div id="kepsek">
                    <h2 class="text-xl font-bold text-gray-800 border-b border-blue-800 inline-block mb-2">
                        Kepala Sekolah
                    </h2>
                    <div class="flex flex-col md:flex-row items-center gap-4">
                        <img src="{{ asset('assets/images/AMY.png') }}" alt="Kepsek"
                            class="rounded-lg w-64 h-auto shadow-md">
                        <p class="text-base text-gray-700 leading-normal">
                            Yayasan Al-Khoir berdiri pada tahun 2017, berlokasi di Jl. Babarlayar no. 43, RT.37, RW.02,
                            desa Terusan, kecamatan Sindang, kabupaten Indramayu. Yayasan Al-Khoir memiliki 4 program
                            utama yakni: Majelis Ta'lim Al-Khoir, Rumah Tahfidz Quran (RTQ), Mahasantri RTQ, dan SD
                            Tahfidz Al-Khoir.
                        </p>
                    </div>
                </div>
                {{-- Pembatas SVG --}}
                <div class="my-10">
                    <svg viewBox="0 0 1200 20" class="w-full h-6 text-blue-200" preserveAspectRatio="none">
                        <path d="M0,10 C300,20 900,0 1200,10 L1200,20 L0,20 Z" fill="currentColor"></path>
                    </svg>
                </div>


            </div>


            {{-- SIDEBAR QUICK LINK --}}
            <aside class="md:w-1/4">
                <div class="bg-blue-100 text-blue-900 rounded-lg shadow px-4 py-4 sticky top-20">
                    <h3 class="text-base font-bold mb-3 uppercase tracking-wide border-b border-blue-800 inline-block">
                        Quick Links
                    </h3>
                    <ul class="space-y-2 text-base text-blue-800">
                        <li class="flex items-center gap-2">
                            <div class="bg-yellow-400 rounded-full w-6 h-6 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-900" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <a href="#visi-misi" class="hover:underline">Visi & Misi</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <div class="bg-yellow-400 rounded-full w-6 h-6 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-900" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <a href="#tujuan" class="hover:underline">Tujuan</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <div class="bg-yellow-400 rounded-full w-6 h-6 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-900" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <a href="#sejarah" class="hover:underline">Sejarah Singkat</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <div class="bg-yellow-400 rounded-full w-6 h-6 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-900" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <a href="#fasilitas" class="hover:underline">Fasilitas</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <div class="bg-yellow-400 rounded-full w-6 h-6 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-900" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <a href="#kepsek" class="hover:underline">Kepala Sekolah</a>
                        </li>
                    </ul>

                </div>
            </aside>


        </section>
    </main>
</x-landingpage>
