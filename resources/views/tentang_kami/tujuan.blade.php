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
                <p class="text-sm mb-1">Tentang Kami > <span class="font-medium">Tujuan</span></p>
                <h1 class="text-2xl md:text-3xl font-bold">Tujuan</h1>
            </div>
        </div>
    </section>


    <!-- Konten Sejarah -->
    <main class="flex-1 bg-white py-16 px-4 md:px-20 text-gray-800">
        <section class="max-w-6xl mx-auto px-4 py-6">
            {{-- Judul --}}
            <h2 class="text-xl mb-6 md:text-2xl font-bold text-blue-950 mb-3 border-b-4 border-blue-900 inline-block pb-1">
                Tujuan
            </h2>

            {{-- Paragraf & Gambar (Bagian 1) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Box 1 -->
                <div class="bg-blue-800 text-white p-6 rounded-2xl shadow-md">
                    <div class="text-4xl font-bold text-blue-300 mb-2">01.</div>
                    <p class="text-lg leading-relaxed">
                        Menghasilkan lulusan yang berkualitas, mandiri, dan berdaya juang tinggi
                    </p>
                </div>
                 <!-- Box 2 -->
               <div class="bg-gray-100 text-gray-900 p-6 rounded-2xl shadow-md border border-gray-300">
                    <div class="text-4xl font-bold text-gray-400 mb-2">02.</div>
                    <p class="text-lg leading-relaxed">
                        Menghasilkan produk akademik yang memberikan manfaat bagi masyarakat luas
                    </p>
                </div>
                <!-- Box 3 -->
                <div class="bg-gray-100 text-gray-900 p-6 rounded-2xl shadow-md border border-gray-300">
                    <div class="text-4xl font-bold text-gray-400 mb-2">02.</div>
                    <p class="text-lg leading-relaxed">
                        Menghasilkan produk akademik yang memberikan manfaat bagi masyarakat luas
                    </p>
                </div>
                {{-- box 4 --}}
                 <div class="bg-blue-800 text-white p-6 rounded-2xl shadow-md">
                    <div class="text-4xl font-bold text-blue-300 mb-2">01.</div>
                    <p class="text-lg leading-relaxed">
                        Menghasilkan lulusan yang berkualitas, mandiri, dan berdaya juang tinggi
                    </p>
                </div>
            </div>

          
        </section>
    </main>
</x-landingpage>
