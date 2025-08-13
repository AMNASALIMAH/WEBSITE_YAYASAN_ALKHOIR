<x-landingpage>
    <main class="flex-1 bg-white py-16 px-4 md:px-20 text-gray-800">
    <section class="max-w-7xl mx-auto px-4 py-6">
        {{-- Judul --}}
        <h2 class="text-xl md:text-2xl font-bold text-blue-950 mb-8 border-b-4 border-blue-900 inline-block pb-1">
            Galeri Kegiatan
        </h2>

        {{-- Galeri Grid --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
            @php
                $images = [
                    'AMY_01', 'g1', 'g2', 'g3',
                    'g4', 'g1', 'g2', 'g3'
                ];
            @endphp

            @foreach($images as $image)
                <div class="overflow-hidden rounded-lg shadow hover:shadow-lg transition">
                    <img src="{{ asset('assets/images/galeri/' . $image . '.png') }}" 
                         alt="{{ $image }}" 
                         class="w-full h-48 object-cover hover:scale-105 duration-300">
                </div>
            @endforeach
        </div>
    </section>
</main>

</x-landingpage>