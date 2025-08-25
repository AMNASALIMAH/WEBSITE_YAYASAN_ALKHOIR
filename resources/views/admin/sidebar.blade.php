<!-- Sidebar Utama -->
<aside id="admin-sidebar" class="w-64 min-h-screen bg-blue-950 text-white flex flex-col px-2 pt-1 pb-6 overflow-y-auto flex-shrink-0 relative z-10 max-w-none">
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

    <nav class="space-y-2 text-sm flex-1">

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

            <div 
                x-show="open" 
                x-transition 
                @click.away="open = false" 
                class="ml-4 space-y-1 mt-2"
                @mouseenter="open = true" 
                @mouseleave="open = true"
            >
                <!-- Tentang Kami -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-2 w-full text-left font-semibold  text-white hover:bg-white hover:text-blue-950">
                        <x-heroicon-o-chevron-right class="ml-1 w-4 h-4 transform"
                            x-bind:class="open ? 'rotate-90' : ''" />
                        <x-heroicon-o-building-library class="w-4 h-4" /> Tentang Kami
                    </button>
                    <div 
                        x-show="open" 
                        x-transition 
                        @click.away="open = false"
                        class="ml-4 space-y-1"
                        @mouseenter="open = true" 
                        @mouseleave="open = true"
                    >
                        <a href="{{ route('admin.sejarah.index') }}" class="block font-semibold  text-white hover:bg-white hover:text-blue-950 {{ request()->routeIs('admin.sejarah.*') ? 'bg-gray-200' : '' }}">📖
                            Sejarah</a>
                        <a href="{{ route('admin.visi_misi.index') }}" class="block font-semibold  text-white hover:bg-white hover:text-blue-950">🎯
                            Visi-Misi & Tujuan</a>
                        <a href="{{ route('admin.struktur_organisasi.index') }}" class="block font-semibold  text-white hover:bg-white hover:text-blue-950">👥
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
                    <div 
                        x-show="open" 
                        x-transition 
                        @click.away="open = false"
                        class="ml-4 space-y-1"
                        @mouseenter="open = true" 
                        @mouseleave="open = true"
                    >
                        <a href="{{ route('admin.management.majelis-talim-alkhoir.content') }}" class="block font-semibold  text-white hover:bg-white hover:text-blue-950">🏷️
                            majelis ta'lim alkhoir</a>
                        <a href="{{ route('admin.management.rtq-alkhoir.content') }}" class="block font-semibold  text-white hover:bg-white hover:text-blue-950">📄
                            RTQ Alkhoir</a>
                        <a href="{{ route('admin.management.sd-tahfidz-alkhoir.content') }}" class="block font-semibold  text-white hover:bg-white hover:text-blue-950">📝
                            SD tahfidz Alkhoir</a>
                        <a href="{{ route('admin.management.mahasantri-alkhoir.content') }}" class="block font-semibold  text-white hover:bg-white hover:text-blue-950">📝
                            Mahasantri Alkhoir</a>
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
                    <div 
                        x-show="open" 
                        x-transition 
                        @click.away="open = false"
                        class="ml-4 space-y-1"
                        @mouseenter="open = true" 
                        @mouseleave="open = true"
                    >
                        <a href="#" onclick="loadContent('news')" class="block font-semibold  text-white hover:bg-white hover:text-blue-950 cursor-pointer">🗞️
                            Berita</a>
                        <a href="#" class="block font-semibold  text-white hover:bg-white hover:text-blue-950">📥
                            PMB</a>
                        <a href="#" class="block font-semibold  text-white hover:bg-white hover:text-blue-950">📅
                            Agenda</a>
                        <a href="#" onclick="loadContent('galery')" class="block font-semibold  text-white hover:bg-white hover:text-blue-950 cursor-pointer">🖼️
                            Galeri</a>
                    </div>
                    
                </div>

                <!-- Galeri -->
                {{-- <a href="#"
                    class="flex items-center gap-2 font-semibold  text-white hover:bg-white hover:text-blue-950">
                    <x-heroicon-o-photo class="w-4 h-4" /> Galeri
                </a> --}}
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

            <div 
                x-show="open" 
                x-transition 
                @click.away="open = false" 
                class="ml-4 space-y-2 mt-2"
                @mouseenter="open = true" 
                @mouseleave="open = true"
            >
                <a href="#" onclick="loadContent('mgmt-profile')" class="block font-semibold text-white hover:bg-white hover:text-blue-950 cursor-pointer">🏛️ Profil Yayasan</a>
          
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-2 w-full text-left font-semibold  text-white hover:bg-white hover:text-blue-950">
                        <span class="ml-1">▶️</span> 🗂️ Kategori Class
                    </button>
                    <div 
                        x-show="open" 
                        x-transition 
                        @click.away="open = false"
                        class="ml-4 space-y-1"
                        @mouseenter="open = true" 
                        @mouseleave="open = true"
                    >
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-2 w-full text-left font-semibold text-white hover:bg-white hover:text-blue-950">
                            <x-heroicon-o-chevron-right class="ml-1 w-4 h-4 transform"
                                x-bind:class="open ? 'rotate-90' : ''" />👨‍🏫 Data Guru
                        </button>
                        <div 
                            x-show="open" 
                            x-transition 
                            @click.away="open = false"
                            class="ml-4 space-y-1"
                            @mouseenter="open = true" 
                            @mouseleave="open = true"
                        >
                            <a href="#" onclick="loadContent('mgmt-teachers')" class="block font-semibold text-white hover:bg-white hover:text-blue-950 cursor-pointer">📋 Daftar Guru</a>
                            <a href="#" class="block font-semibold text-white hover:bg-white hover:text-blue-950">🏫 Kelas Guru</a>
                        </div>
                    </div>
    

                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-2 w-full text-left font-semibold text-white hover:bg-white hover:text-blue-950">
                            <x-heroicon-o-chevron-right class="ml-1 w-4 h-4 transform"
                                x-bind:class="open ? 'rotate-90' : ''" />👨‍🎓 Data Santri
                        </button>
                        <div 
                            x-show="open" 
                            x-transition 
                            @click.away="open = false"
                            class="ml-4 space-y-1"
                            @mouseenter="open = true" 
                            @mouseleave="open = true"
                        >
                            <a href="#" onclick="loadContent('mgmt-students')" class="block font-semibold text-white hover:bg-white hover:text-blue-950 cursor-pointer">📋 Daftar Santri</a>
                            <a href="#" class="block font-semibold text-white hover:bg-white hover:text-blue-950">➕ Tambah Santri</a>
                            <a href="#" class="block font-semibold text-white hover:bg-white hover:text-blue-950">🏫 Kelas / Tingkatan</a>
                            <a href="#" class="block font-semibold text-white hover:bg-white hover:text-blue-950">📦 Alumni / Keluar</a>
                        </div>
                    </div>
                    </div>

                    

                    
                    
                </div>

         
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-2 w-full text-left font-semibold text-white hover:bg-white hover:text-blue-950">
                        <x-heroicon-o-chevron-right class="ml-1 w-4 h-4 transform"
                            x-bind:class="open ? 'rotate-90' : ''" />💰 Data Keuangan
                    </button>
                    <div 
                        x-show="open" 
                        x-transition 
                        @click.away="open = false"
                        class="ml-4 space-y-1"
                        @mouseenter="open = true" 
                        @mouseleave="open = true"
                    >
                        <a href="#" onclick="loadContent('mgmt-finance')" class="block font-semibold text-white hover:bg-white hover:text-blue-950 cursor-pointer">📊 Laporan Keuangan</a>
                        <a href="#" onclick="loadContent('mgmt-finance-pemasukan')" class="block font-semibold text-white hover:bg-white hover:text-blue-950 cursor-pointer">💵 Pemasukan</a>
                        <a href="#" onclick="loadContent('mgmt-finance-pengeluaran')" class="block font-semibold text-white hover:bg-white hover:text-blue-950 cursor-pointer">💸 Pengeluaran</a>
                    </div>
                </div>
                <a href="#" onclick="loadContent('mgmt-account')" class="block font-semibold text-white hover:bg-white hover:text-blue-950 cursor-pointer">👤 Perbarui Akun Profil</a>
                <a href="#" onclick="loadContent('mgmt-messages')" class="block font-semibold text-white hover:bg-white hover:text-blue-950 cursor-pointer">✉️ Pesan Masuk</a>
                <a href="#" onclick="loadContent('mgmt-applications')" class="block font-semibold text-white hover:bg-white hover:text-blue-950 cursor-pointer">📝 Formulir Masuk</a>
                <a href="#" onclick="loadContent('mgmt-admin-accounts')" class="block font-semibold text-white hover:bg-white hover:text-blue-950 cursor-pointer">🧑‍💼 Data Akun Pengurus</a>
                <a href="#" onclick="loadContent('mgmt-programs')" class="block font-semibold text-white hover:bg-white hover:text-blue-950 cursor-pointer">📚 Data Program</a>
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
        
        <!-- Sidebar User Info -->
        <div class="mt-8 mb-4 px-3">
            <div class="flex items-center space-x-3">
                <div class="bg-white rounded-full h-10 w-10 flex items-center justify-center text-blue-900 font-bold text-lg uppercase">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-semibold text-white text-base">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-blue-200">Admin</div>
                </div>
            </div>
            <div class="mt-3 flex flex-col gap-1">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 text-sm text-blue-200 hover:text-white hover:underline">
                    <x-heroicon-o-user class="w-4 h-4" /> Profil Saya
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 text-sm text-blue-200 hover:text-white hover:underline w-full text-left">
                        <x-heroicon-o-arrow-left-on-rectangle class="w-4 h-4" /> Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>
</aside>
