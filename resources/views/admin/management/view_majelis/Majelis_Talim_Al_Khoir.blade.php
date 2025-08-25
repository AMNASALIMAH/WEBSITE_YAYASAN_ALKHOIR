<x-landingpage>

    <style>
        /* CSS-only modal using :target */
        .modal-overlay { opacity: 0; pointer-events: none; transition: opacity 200ms ease; }
        .modal-overlay:target { opacity: 1; pointer-events: auto; }
        .modal-content { transform: translateY(1rem); opacity: 0; transition: all 250ms ease; }
        .modal-overlay:target .modal-content { transform: translateY(0); opacity: 1; }
        /* Tooltip base */
        .tooltip { position: relative; }
        .tooltip:hover .tooltip-panel { opacity: 1; transform: translateY(0); }
        .tooltip-panel { position: absolute; left: 50%; transform: translate(-50%, -4px); bottom: 125%; opacity: 0; transition: all 150ms ease; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <main class="flex-1 bg-white py-12 px-4 md:px-8 lg:px-12 text-gray-800 mt-12">
        <section class="max-w-7xl mx-auto">
            <header class="text-center mb-10">
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-gray-900">Majelis Ta'lim Al-Khoir</h1>
                <p class="mt-3 text-gray-600 max-w-2xl mx-auto">Program dan kegiatan keagamaan yang memberi manfaat bagi jamaah dan masyarakat luas.</p>
            </header>

            @php
                /** @var \Illuminate\Support\Collection|array $majelis_talim_alkhoir */
            @endphp

            @if(isset($majelis_talim_alkhoir) && count($majelis_talim_alkhoir))
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($majelis_talim_alkhoir as $item)
                        @php
                            $title = $item->title ?? $item->name ?? $item->judul ?? 'Program Majelis';
                            $subtitle = $item->subtitle ?? $item->subjudul ?? '';
                            $desc = $item->description ?? $item->deskripsi ?? $item->content ?? $item->sejarah ?? '';
                            $type = $item->type ?? 'majelis';
                            $id = $item->id ?? uniqid('mj-');
                            $created = method_exists($item, 'getAttribute') ? ($item->getAttribute('created_at') ?? null) : null;
                        @endphp

                        <article class="group bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
                            <div class="p-5">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
                                        @if($subtitle)
                                            <p class="text-sm text-gray-500">{{ $subtitle }}</p>
                                        @endif
                                    </div>
                                    <div class="tooltip">
                                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-indigo-50 text-indigo-600">
                                            <!-- info icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 7.5a.75.75 0 10-1.5 0 .75.75 0 001.5 0zM10.875 10.5a.75.75 0 000 1.5h.375v4.125a.75.75 0 001.5 0V12h.375a.75.75 0 000-1.5h-2.25z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        <div class="tooltip-panel z-10 px-3 py-1.5 rounded-md bg-gray-900 text-white text-xs whitespace-nowrap shadow-md">
                                            Tipe: {{ str_replace('-', ' ', ucwords($type)) }}
                                        </div>
                                    </div>
                                </div>

                                @if($desc)
                                    <p class="mt-4 text-sm text-gray-700 line-clamp-3">{{ $desc }}</p>
                                @else
                                    <p class="mt-4 text-sm text-gray-500 italic">Deskripsi belum tersedia.</p>
                                @endif

                                <div class="mt-5 flex items-center justify-between">
                                    <a href="#majelis-{{ $id }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                                 
                                        Lihat Detail
                                    </a>
                                    @if($created)
                                        <span class="text-xs text-gray-500">Dibuat: {{ \Illuminate\Support\Carbon::parse($created)->isoFormat('DD MMM YYYY') }}</span>
                                    @endif
                                </div>
                            </div>
                        </article>

                        <!-- Modal :target -->
                        <div id="majelis-{{ $id }}" class="modal-overlay fixed inset-0 z-40 bg-black/50 flex items-end sm:items-center justify-center p-4">
                            <div class="modal-content w-full sm:max-w-2xl bg-white rounded-2xl shadow-xl overflow-hidden">
                                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900">{{ $title }}</h4>
                                        @if($subtitle)
                                            <p class="text-sm text-gray-500">{{ $subtitle }}</p>
                                        @endif
                                    </div>
                                    <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors" aria-label="Tutup">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6.225 4.811a.75.75 0 011.06 0L12 9.525l4.715-4.714a.75.75 0 111.06 1.06L13.06 10.586l4.715 4.715a.75.75 0 11-1.06 1.06L12 11.646l-4.715 4.715a.75.75 0 11-1.06-1.06l4.714-4.715-4.714-4.715a.75.75 0 010-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>

                                <div class="px-6 py-5">
                                    @php $attributes = method_exists($item, 'getAttributes') ? $item->getAttributes() : []; @endphp
                                    @if(!empty($attributes))
                                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3">
                                            @foreach($attributes as $key => $value)
                                                @continue(in_array($key, ['password']))
                                                <div class="bg-gray-50 rounded-lg p-3">
                                                    <dt class="text-xs uppercase tracking-wide text-gray-500">{{ str_replace('_', ' ', ucfirst($key)) }}</dt>
                                                    <dd class="text-sm text-gray-800 mt-0.5 break-words">{{ is_scalar($value) ? ($value === '' ? '-' : $value) : json_encode($value) }}</dd>
                                                </div>
                                            @endforeach
                                        </dl>
                                    @else
                                        <p class="text-sm text-gray-600">Detail belum tersedia untuk item ini.</p>
                                    @endif
                                </div>

                                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end">
                                    <a href="#" class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-900 text-white text-sm font-medium hover:bg-black transition-colors">Tutup</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="max-w-md mx-auto text-center bg-gradient-to-b from-gray-50 to-white border border-gray-100 rounded-2xl p-8">
                    <div class="mx-auto w-12 h-12 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm0 4.5a.75.75 0 01.75.75v5.25a.75.75 0 01-1.5 0V7.5A.75.75 0 0112 6.75zm0 9a.75.75 0 100 1.5.75.75 0 000-1.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Belum ada data</h3>
                    <p class="mt-2 text-sm text-gray-600">Data Majelis Ta'lim Al-Khoir akan ditampilkan di sini ketika tersedia.</p>
                </div>
            @endif
        </section>
    </main>

</x-landingpage>