<!-- Sidebar Utama -->
<aside class="w-56 min-h-screen bg-blue-950 text-white flex flex-col px-2 pt-1 pb-6 overflow-y-auto">
    {{-- Logo --}}
    <div class="flex items-center space-x-3">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-10 w-10 rounded" />
        <a href="{{ url('/') }}">
            <span class="text-base font-bold leading-tight">
                YAYASAN<br>AL-KHOIR
            </span>
        </a>
    </div>

    {{-- Garis pembatas --}}
    <div class="border-b border-gray-300 mt-3 mb-4 w-full"></div>

    <nav class="space-y-2 text-sm">

        <a href="{{ route('dashboard') }}"
            class="flex  items-center gap-2 font-semibold  text-white hover:bg-white hover:text-blue-950">
            <x-heroicon-o-home class="w-4 h-4" /> Dashboard
        </a>

        <!-- Master Data untuk publik-->
        <div x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center gap-2 w-full text-left font-semibold  text-white hover:bg-white hover:text-blue-950">
                <x-heroicon-o-folder class="w-4 h-4" /> Data Info Yayasan
                <x-heroicon-o-chevron-down class="ml-1 w-4 h-4 transform"
                    x-bindx-bind:class="open ? 'rotate-180' : ''" />
            </button>

            <div x-show="open" class="ml-4 space-y-1 mt-2">
                <!-- Tentang Kami -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-2 w-full text-left font-semibold  text-white hover:bg-white hover:text-blue-950">
                        <x-heroicon-o-chevron-right class="ml-1 w-4 h-4 transform"
                            x-bind:class="open ? 'rotate-90' : ''" />
                        <x-heroicon-o-building-library class="w-4 h-4" /> Tentang Kami
                    </button>
                    <div x-show="open" class="ml-4 space-y-1">
                        <a href="{{ route('admin.sejarah.index') }}" class="block font-semibold  text-white hover:bg-white hover:text-blue-950 {{ request()->routeIs('admin.sejarah.*') ? 'bg-gray-200' : '' }}">📖
                            Sejarah</a>
                        <a href="#" class="block font-semibold  text-white hover:bg-white hover:text-blue-950">🎯
                            Visi-Misi & Tujuan</a>
                        <a href="#" class="block font-semibold  text-white hover:bg-white hover:text-blue-950">👥
                            Struktur</a>
                    </div>
                </div>

                <!-- Program -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-2 w-full text-left font-semibold  text-white hover:bg-white hover:text-blue-950">
                        <x-heroicon-o-chevron-right class="ml-1 w-4 h-4 transform"
                            x-bind:class="open ? 'rotate-90' : ''" />
                        <x-heroicon-o-book-open class="w-4 h-4" /> Program
                    </button>
                    <div x-show="open" class="ml-4 space-y-1">
                        <a href="#" class="block font-semibold  text-white hover:bg-white hover:text-blue-950">🏷️
                            Kategori</a>
                        <a href="#" class="block font-semibold  text-white hover:bg-white hover:text-blue-950">📄
                            Daftar</a>
                        <a href="#" class="block font-semibold  text-white hover:bg-white hover:text-blue-950">📝
                            Konten</a>
                    </div>
                </div>

                <!-- Informasi Lainnya -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-2 w-full text-left font-semibold  text-white hover:bg-white hover:text-blue-950">
                        <x-heroicon-o-chevron-right class="ml-1 w-4 h-4 transform"
                            x-bind:class="open ? 'rotate-90' : ''" />
                        <x-heroicon-o-document-text class="w-4 h-4" /> Informasi

                    </button>
                    <div x-show="open" class="ml-4 space-y-1">
                        <a href="#" class="block font-semibold  text-white hover:bg-white hover:text-blue-950">🗞️
                            Berita</a>
                        <a href="#" class="block font-semibold  text-white hover:bg-white hover:text-blue-950">📥
                            PMB</a>
                        <a href="#" class="block font-semibold  text-white hover:bg-white hover:text-blue-950">📅
                            Agenda</a>
                    </div>
                </div>

                <!-- Galeri -->
                <a href="#"
                    class="flex items-center gap-2 font-semibold  text-white hover:bg-white hover:text-blue-950">
                    <x-heroicon-o-photo class="w-4 h-4" /> Galeri
                </a>
            </div>
        </div>

        <!-- Manajemen Data -->
        <div x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center gap-2 w-full text-left font-semibold  text-white hover:bg-white hover:text-blue-950">
                <x-heroicon-o-folder class="w-4 h-4" /> Manejemen Data
                <x-heroicon-o-chevron-down class="ml-1 w-4 h-4 transform"
                    x-bindx-bind:class="open ? 'rotate-180' : ''" />


            </button>

            <div x-show="open" class="ml-4 space-y-2 mt-2">
                <!-- Data Guru -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-2 w-full text-left font-semibold text-white hover:bg-white hover:text-blue-950">
                        <x-heroicon-o-chevron-right class="ml-1 w-4 h-4 transform"
                            x-bind:class="open ? 'rotate-90' : ''" />👨‍🏫 Data Guru

                    </button>
                    <div x-show="open" class="ml-4 space-y-1">
                        <a href="#" class="block font-semibold text-white hover:bg-white hover:text-blue-950">📋
                            Daftar Guru</a>
                        <a href="#" class="block font-semibold text-white hover:bg-white hover:text-blue-950">➕
                            Tambah Guru</a>
                        <a href="#" class="block font-semibold text-white hover:bg-white hover:text-blue-950">🗂️
                            Riwayat / Arsip</a>
                    </div>
                </div>

                <!-- Data Santri -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-2 w-full text-left font-semibold text-white hover:bg-white hover:text-blue-950">
                        <x-heroicon-o-chevron-right class="ml-1 w-4 h-4 transform"
                            x-bind:class="open ? 'rotate-90' : ''" />👨‍🎓 Data Santri

                    </button>
                    <div x-show="open" class="ml-4 space-y-1">
                        <a href="#" class="block font-semibold text-white hover:bg-white hover:text-blue-950">📋
                            Daftar Santri</a>
                        <a href="#" class="block font-semibold text-white hover:bg-white hover:text-blue-950">➕
                            Tambah Santri</a>
                        <a href="#" class="block font-semibold text-white hover:bg-white hover:text-blue-950">🏫
                            Kelas / Tingkatan</a>
                        <a href="#" class="block font-semibold text-white hover:bg-white hover:text-blue-950">📦
                            Alumni / Keluar</a>
                    </div>
                </div>

                <!-- Pemasukan SPP -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-2 w-full text-left font-semibold text-white hover:bg-white hover:text-blue-950">
                        <x-heroicon-o-chevron-right class="ml-1 w-4 h-4 transform"
                            x-bind:class="open ? 'rotate-90' : ''" />💰 Pemasukan SPP

                    </button>
                    <div x-show="open" class="ml-4 space-y-1">
                        <a href="#" class="block font-semibold text-white hover:bg-white hover:text-blue-950">💵
                            Entri Pembayaran</a>
                        <a href="#" class="block font-semibold text-white hover:bg-white hover:text-blue-950">📊
                            Laporan Bulanan</a>
                        <a href="#" class="block font-semibold text-white hover:bg-white hover:text-blue-950">🧾
                            Riwayat Pembayaran</a>
                        <a href="#" class="block font-semibold text-white hover:bg-white hover:text-blue-950">⚙️
                            Atur Nominal SPP</a>
                    </div>
                </div>
            </div>
        </div>



        <!-- Kontak -->
        <a href="#"
            class="flex items-center gap-2 font-semibold  text-white hover:bg-white hover:text-blue-950">
            <x-heroicon-o-phone class="w-4 h-4" /> Kontak
        </a>

        <!-- Pengguna -->
        <a href="#"
            class="flex items-center gap-2 font-semibold  text-white hover:bg-white hover:text-blue-950">
            <x-heroicon-o-users class="w-4 h-4" /> Pengguna
        </a>
    </nav>
</aside>
