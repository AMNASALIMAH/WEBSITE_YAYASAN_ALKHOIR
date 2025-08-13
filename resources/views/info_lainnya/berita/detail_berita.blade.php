<x-landingpage>

    <!-- Hero Section -->
    <section class="relative w-full h-64">
        {{-- Background Image --}}
        <img src="{{ asset('assets/images/AMY.png') }}" alt="Header"
            class="absolute inset-0 w-full h-full object-cover z-0">

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black bg-opacity-40 z-10"></div>

        {{-- Text Content --}}
        <div class="relative z-20 flex items-center justify-center h-full">
            <div class="text-center px-4 md:px-6 lg:px-8 text-white">
                {{-- <p class="text-sm mb-1">Berita > <span class="font-medium">Tentang Berita</span></p> --}}
                {{-- <h1 class="text-2xl md:text-3xl font-bold">Sejarah Singkat</h1> --}}
            </div>
        </div>
    </section>


    <!-- Konten Sejarah -->
    <main class="flex-1 bg-white py-16 px-4 md:px-20 text-gray-800">
        <section class="max-w-6xl mx-auto px-4 py-6">
            {{-- Judul --}}
            <h2 class="text-xl md:text-2xl font-bold text-blue-950 mb-3 border-b-4 border-blue-900 inline-block pb-1">
                Sejarah Yayasan AlKhoir
            </h2>

            {{-- Paragraf & Gambar (Bagian 1) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                {{-- Paragraf --}}
                <div>
                    <p class="text-base leading-relaxed text-justify">
                        Sejarah adalah studi yang sistematis mengenai masa lalu dengan fokus utama pada
                        <span class="underline decoration-2">masa lalu umat manusia</span>.
                        Sebagai sebuah <span class="underline decoration-2">disiplin ilmu</span>, sejarah menganalisis
                        dan menafsirkan <span class="underline decoration-2">bukti</span> untuk menyusun
                        <span class="underline decoration-2">narasi</span> mengenai suatu peristiwa dan menjelaskan
                        penyebabnya. Sebagian ahli teori menggolongkan sejarah sebagai
                        <span class="underline decoration-2">ilmu sosial</span>, sementara yang lain melihatnya sebagai
                        bagian dari <span class="underline decoration-2">ilmu humaniora</span>.
                    </p>
                </div>

                {{-- Gambar --}}
                <div class="flex justify-center md:justify-start">
                    <div class="w-52 h-80 rounded-[15px] bg-cover bg-center shadow-2xl mx-auto"
                        style="background-image: url('{{ asset('assets/images/galeri/g1.png') }}');">
                    </div>
                    <div class="w-52 h-80 rounded-[15px] bg-cover bg-center shadow-2xl mx-auto"
                        style="background-image: url('{{ asset('assets/images/galeri/g1.png') }}');">
                    </div>
                </div>
            </div>

            {{-- Gambar & Paragraf (Bagian 2) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mt-8">
                {{-- Gambar --}}
                <div class="flex justify-center md:justify-start">
                    <div class="w-52 h-80 rounded-[15px] bg-cover bg-center shadow-2xl mx-auto"
                        style="background-image: url('{{ asset('assets/images/galeri/g1.png') }}');">
                    </div>
                    <div class="w-52 h-80 rounded-[15px] bg-cover bg-center shadow-2xl mx-auto"
                        style="background-image: url('{{ asset('assets/images/galeri/g1.png') }}');">
                    </div>
                </div>

                {{-- Paragraf --}}
                <div>
                    <p class="text-base leading-relaxed text-justify">
                        Perdebatan serupa juga terjadi mengenai tujuan sejarah, misalnya, apakah tujuan utamanya
                        bersifat
                        teoretis untuk mengungkap <span class="underline decoration-2">kebenaran</span>, atau praktis
                        untuk
                        mengambil pelajaran dari masa lalu. Dalam pengertian yang lebih umum, istilah sejarah tidak
                        hanya
                        merujuk pada bidang akademis, tetapi juga pada masa lalu itu sendiri, peristiwa di masa lampau,
                        atau
                        naskah-naskah individual tentang masa lalu.
                    </p>
                </div>
            </div>

            {{-- Paragraf Tambahan --}}

            {{-- Navigasi Internal --}}
            {{-- <div class="mt-10 flex gap-4 flex-wrap justify-end">
                <a href="#visi-misi" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                    Visi & Misi
                </a>
                <a href="#tujuan" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                    Tujuan
                </a>
                <a href="#struktur" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                    Struktur Organisasi
                </a>
            </div> --}}
        </section>
    </main>
</x-landingpage>