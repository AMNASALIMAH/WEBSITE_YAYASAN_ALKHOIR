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
                <p class="text-sm mb-1">Tentang Kami > <span class="font-medium">Visi-Misi & Tujuan</span></p>
                <h1 class="text-2xl md:text-3xl font-bold">
                    <a href="{{ route('admin.visi_misi.index') }}" class="hover:underline">Visi Misi & Tujuan</a>
                </h1>
            </div>
        </div>
    </section>

    <!-- Konten Visi Misi -->
    <main class="flex-1 bg-white py-16 px-4 md:px-15 text-gray-800">
        <section class="max-w-6xl mx-auto px-4 py-6">
            {{-- Judul: Visi --}}
            <h2 class="text-xl md:text-2xl font-bold text-blue-950 mb-3 border-b-4 border-blue-900 inline-block pb-1">
                Visi
            </h2>

            {{-- Paragraf Visi --}}
            <div class="grid grid-cols-1 gap-6 items-center mb-10">
                <div>
                    @if(isset($visiMisi) && $visiMisi->visi)
                        <p class="text-base leading-relaxed text-justify">
                            {!! nl2br(e($visiMisi->visi)) !!}
                        </p>
                    @else
                        <p class="text-base leading-relaxed text-justify text-gray-400 italic">
                            Data visi belum tersedia.
                        </p>
                    @endif
                </div>
            </div>

            {{-- Judul: Misi --}}
            <h2
                class="text-xl md:text-2xl font-bold text-blue-950 mb-3 mt-6 border-b-4 border-blue-900 inline-block pb-1">
                Misi
            </h2>

            {{-- Paragraf Misi --}}
            <div class="grid grid-cols-1 gap-6 items-center mb-10">
                <div>
                    @if(isset($visiMisi) && $visiMisi->misi)
                        @php
                            // Try to split misi into list if possible (by newline or semicolon)
                            $misiList = preg_split('/\r\n|\r|\n|;/', $visiMisi->misi);
                        @endphp
                        @if(count($misiList) > 1)
                            <ol class="list-decimal pl-5 space-y-2">
                                @foreach($misiList as $misiItem)
                                    @if(trim($misiItem) !== '')
                                        <li class="text-base leading-relaxed text-justify">{!! e(trim($misiItem)) !!}</li>
                                    @endif
                                @endforeach
                            </ol>
                        @else
                            <p class="text-base leading-relaxed text-justify">
                                {!! nl2br(e($visiMisi->misi)) !!}
                            </p>
                        @endif
                    @else
                        <p class="text-base leading-relaxed text-justify text-gray-400 italic">
                            Data misi belum tersedia.
                        </p>
                    @endif
                </div>
            </div>

            <h2
                class="text-xl mb-6 md:text-2xl font-bold text-blue-950 mb-3 border-b-4 border-blue-900 inline-block pb-1">
                Tujuan
            </h2>

            {{-- Paragraf & Gambar (Bagian 1) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if(isset($visiMisi) && $visiMisi->tujuan)
                    @php
                        // Try to split tujuan into list if possible (by newline or semicolon)
                        $tujuanList = preg_split('/\r\n|\r|\n|;/', $visiMisi->tujuan);
                        $colors = [
                            ['bg-blue-800 text-white', 'text-blue-300'],
                            ['bg-gray-100 text-gray-900 border border-gray-300', 'text-gray-400'],
                        ];
                    @endphp
                    @foreach($tujuanList as $idx => $tujuanItem)
                        @if(trim($tujuanItem) !== '')
                            <div class="{{ $colors[$idx % 2][0] }} p-6 rounded-2xl shadow-md">
                                <div class="text-4xl font-bold {{ $colors[$idx % 2][1] }} mb-2">
                                    {{ str_pad($idx+1, 2, '0', STR_PAD_LEFT) }}.
                                </div>
                                <p class="text-lg leading-relaxed">
                                    {!! e(trim($tujuanItem)) !!}
                                </p>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="col-span-2">
                        <p class="text-base leading-relaxed text-justify text-gray-400 italic">
                            Data tujuan belum tersedia.
                        </p>
                    </div>
                @endif
            </div>
        </section>
    </main>


</x-landingpage>
