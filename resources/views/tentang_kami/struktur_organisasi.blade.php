<x-landingpage>
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
                    <p class="text-sm mb-1">Tentang Kami > <span class="font-medium">Struktur Organisasi</span></p>
                    <h1 class="text-2xl md:text-3xl font-bold">Struktur Organisasi</h1>
                </div>
            </div>
        </section>


        <!-- Konten Sejarah -->
        <<main class="flex-1 bg-white py-16 px-4 md:px-20 text-gray-800">
            <section class="bg-white py-12 max-w-6xl mx-auto px-4">
                {{-- Judul --}}
                <div class="text-center mb-20 ">
                    <p
                        class="text-sm font-semibold text-blue-900 tracking-widest uppercase underline underline-offset-4 decoration-blue-900">
                        Struktur Organisasi
                    </p>
                    <h2 class="text-2xl md:text-4xl font-bold text-gray-900 mt-2">
                        Daftar Struktural
                    </h2>
                </div>


                {{-- Ketua --}}
                <div class="text-center mb-12">
                    <img class="mx-auto h-65 w-64 rounded-xl object-cover"
                        src="{{ asset('assets/images/struktural/ketua.png') }}" alt="Ketua">
                    <h3 class="mt-4 text-xl font-semibold text-gray-900">Dr.Muhammad Zaedi M.Ag</h3>
                    <p class="text-gray-500">Ketua Yayasan</p>
                </div>


                {{-- Tim Lain --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    {{-- Person 1 --}}
                    <div class="text-center">
                        <img class="mx-auto h-48 w-48 rounded-xl object-cover"
                            src="{{ asset('assets/images/struktur/lindsay.jpg') }}" alt="Lindsay Walton">
                        <h3 class="mt-4 text-lg font-semibold text-gray-900">Lindsay Walton</h3>
                        <p class="text-gray-500">Sekretaris</p>
                    </div>

                    {{-- Person 2 --}}
                    <div class="text-center">
                        <img class="mx-auto h-48 w-48 rounded-xl object-cover"
                            src="{{ asset('assets/images/struktur/courtney.jpg') }}" alt="Courtney Henry">
                        <h3 class="mt-4 text-lg font-semibold text-gray-900">Courtney Henry</h3>
                        <p class="text-gray-500">Bendahara</p>
                    </div>

                    {{-- Person 3 --}}
                    <div class="text-center">
                        <img class="mx-auto h-48 w-48 rounded-xl object-cover"
                            src="{{ asset('assets/images/struktur/tom.jpg') }}" alt="Tom Cook">
                        <h3 class="mt-4 text-lg font-semibold text-gray-900">Tom Cook</h3>
                        <p class="text-gray-500">Penanggung Jawab</p>
                    </div>
                </div>
            </section>
            </main>

    </x-landingpage>

</x-landingpage>
