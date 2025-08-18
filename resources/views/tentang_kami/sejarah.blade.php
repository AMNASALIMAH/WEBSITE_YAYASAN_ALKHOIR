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
                <p class="text-sm mb-1">Tentang Kami > <span class="font-medium">Sejarah Singkat</span></p>
                <h1 class="text-2xl md:text-3xl font-bold">Sejarah Singkat</h1>
            </div>
        </div>
    </section>

    <!-- Konten Sejarah -->
    <main class="flex-1 bg-white py-16 px-4 md:px-20 text-gray-800">
        <section class="max-w-6xl mx-auto px-4 py-6">
            {{-- Judul --}}
            <h2 class="text-xl md:text-2xl font-bold text-blue-950 mb-3 border-b-4 border-blue-900 inline-block pb-1">
                {{ $sejarah->judul ?? 'Sejarah Yayasan AlKhoir' }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                {{-- Paragraf --}}
                <div class="prose max-w-none">
                    {!! $sejarah->konten ?? '<em>Belum ada data sejarah yang tersedia.</em>' !!}
                </div>

                {{-- Gambar --}}
                <div class="flex justify-center md:justify-start gap-4">
                    @if(!empty($sejarah->gambar))
                        <div class="w-52 h-80 rounded-[15px] bg-cover bg-center shadow-2xl mx-auto"
                            style="background-image: url('{{ asset('storage/' . $sejarah->gambar) }}');">
                        </div>
                    @else
                        <div class="w-52 h-80 rounded-[15px] bg-cover bg-center shadow-2xl mx-auto bg-gray-200 flex items-center justify-center text-gray-400">
                            <span>Tidak ada gambar</span>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
</x-landingpage>
