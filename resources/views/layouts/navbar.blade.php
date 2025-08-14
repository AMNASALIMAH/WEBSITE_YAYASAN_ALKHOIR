@if (Route::has('login'))
    <nav class="bg-blue-950 text-white w-full z-50">
        <div class="w-full px-4 md:px-8">
            <div class="flex justify-between items-center h-16 space-x-4">

                {{-- Logo --}}
                <div class="flex items-center gap-3 shrink-0">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-10 w-auto" />
                    <span class="font-bold text-lg tracking-wide uppercase">Yayasan AlKhoir</span>
                </div>

                {{-- Hamburger Icon (Mobile Only) --}}
                <button class="md:hidden text-3xl focus:outline-none" id="nav-toggle">
                    &#9776;
                </button>

                {{-- Menu Items --}}
                <div id="nav-menu"
                    class="hidden md:flex flex-col md:flex-row md:items-center md:gap-3 absolute md:static top-16 left-0 w-full md:w-auto bg-blue-950 md:bg-transparent px-4 py-3 md:p-0 z-40 shadow md:shadow-none text-sm">

                    <a href="{{ url('/') }}"
                        class="px-3 py-1.5 font-bold hover:bg-white hover:text-blue-900 rounded transition">Beranda</a>
                    {{-- Dropdown Tentang Kami (Click) --}}
                    <div class="relative" data-dropdown>
                        <button type="button"
                            class="px-3 py-1.5 font-bold hover:bg-white hover:text-blue-900 rounded transition flex items-center gap-1 cursor-pointer" data-toggle>
                            Tentang Kami
                            <svg class="w-4 h-4 transform transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20" data-arrow>
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.292l3.71-4.06a.75.75 0 111.1 1.02l-4.25 4.66a.75.75 0 01-1.1 0l-4.25-4.66a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div
                            class="absolute top-full left-0 mt-2 w-52 bg-white text-blue-900 rounded-lg shadow-lg z-50 hidden transition duration-300" data-menu>
                            <a href="{{ route('sejarah') }}"
                                class="block px-4 py-2 hover:bg-blue-100 font-semibold border-b">Sejarah
                                Singkat</a>
                            <a href="{{ route('visi-misi') }}"
                                class="block px-4 py-2 hover:bg-blue-100 font-semibold border-b">Visi, Misi & Tujuan</a>
                            {{-- <a href="{{ route('tujuan') }}"
                                class="block px-4 py-2 hover:bg-blue-100 font-semibold border-b">Tujuan</a> --}}
                            <a href="{{ route('struktur_organisasi') }}" class="block px-4 py-2 hover:bg-blue-100 font-semibold">Struktur
                                Organisasi</a>
                        </div>
                    </div>

                    {{-- Dropdown Program (Click) --}}
                    <div class="relative" data-dropdown>
                        <button type="button"
                            class="px-3 py-1.5 font-bold hover:bg-white hover:text-blue-900 rounded transition flex items-center gap-1 cursor-pointer" data-toggle>
                            Program
                            <svg class="w-4 h-4 transform transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20" data-arrow>
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.292l3.71-4.06a.75.75 0 111.1 1.02l-4.25 4.66a.75.75 0 01-1.1 0l-4.25-4.66a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div
                            class="absolute top-full left-0 mt-2 w-52 bg-white text-blue-900 rounded-lg shadow-lg z-50 hidden transition duration-300" data-menu>
                            <a href="{{ route('SDT') }}" class="block px-4 py-2 hover:bg-blue-100 font-semibold border-b">SD
                                Tahfidz Al-Khoir</a>
                            <a href="{{ route('RTQ') }}" class="block px-4 py-2 hover:bg-blue-100 font-semibold border-b">RTQ
                                Al-Khoir</a>
                            <a href="{{ route('MHS') }}"
                                class="block px-4 py-2 hover:bg-blue-100 font-semibold border-b">Mahasantri RTQ</a>
                            <a href="{{ route('MT') }}" class="block px-4 py-2 hover:bg-blue-100 font-semibold">Majelis Ta'Lim
                                Al-Khoir</a>
                        </div>
                    </div>

                    {{-- Dropdown Informasi Lainnya (Click) --}}
                    <div class="relative" data-dropdown>
                        <button type="button"
                            class="px-3 py-1.5 font-bold hover:bg-white hover:text-blue-900 rounded transition flex items-center gap-1 cursor-pointer" data-toggle>
                            Informasi Lainnya
                            <svg class="w-4 h-4 transform transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20" data-arrow>
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.292l3.71-4.06a.75.75 0 111.1 1.02l-4.25 4.66a.75.75 0 01-1.1 0l-4.25-4.66a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div
                            class="absolute top-full left-0 mt-2 w-52 bg-white text-blue-900 rounded-lg shadow-lg z-50 hidden transition duration-300" data-menu>
                            <a href="{{ route('berita') }}"
                                class="block px-4 py-2 hover:bg-blue-100 font-semibold border-b">Berita</a>
                            <a href="{{ route('daftar_pmb') }}"
                                class="block px-4 py-2 hover:bg-blue-100 font-semibold border-b">PMB</a>
                        </div>
                    </div>

                    <a href="{{ route('galeri') }}"
                        class="px-3 py-1.5 font-bold hover:bg-white hover:text-blue-900 rounded transition">Galeri</a>
                    {{-- <a href="#profil"
                        class="px-3 py-1.5 font-bold hover:bg-white hover:text-blue-900 rounded transition">Informasi
                        Lainnya</a> --}}
                    <a href="{{ route('kontak') }}"
                        class="px-3 py-1.5 font-bold hover:bg-white hover:text-blue-900 rounded transition">Kontak</a>
                </div>
                {{-- Auth Button --}}
                <div class="hidden md:flex items-center gap-2 ml-3">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-3 py-1.5 border border-white hover:bg-white hover:text-blue-900 rounded transition font-bold uppercase text-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-3 py-1.5 border border-white hover:bg-white hover:text-blue-900 rounded transition font-bold uppercase text-sm">
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-3 py-1.5 border border-white hover:bg-white hover:text-blue-900 rounded transition font-bold uppercase text-sm">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            {{-- Auth buttons on mobile --}}
            {{-- <div class="md:hidden flex flex-col gap-2 mt-3 px-2" id="mobile-auth">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-4 py-1.5 border border-white hover:border-green-300 rounded transition font-bold uppercase text-sm">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-1.5 border border-white hover:bg-white hover:text-blue-900 rounded transition font-bold uppercase text-sm">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-4 py-1.5 border border-white hover:bg-white hover:text-blue-900 rounded transition font-bold uppercase text-sm">
                            Register
                        </a>
                    @endif
                @endauth
            </div> --}}
        </div>
    </nav>

    {{-- Script toggle menu mobile --}}
    <script>
        document.getElementById('nav-toggle').addEventListener('click', function() {
            const navMenu = document.getElementById('nav-menu');
            const authMobile = document.getElementById('mobile-auth');
            navMenu.classList.toggle('hidden');
            authMobile.classList.toggle('hidden');
        });

        // Dropdown functionality for desktop navigation
        document.addEventListener('DOMContentLoaded', function() {
            const nav = document.querySelector('nav');
            if (!nav) return;

            // Close all dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!nav.contains(e.target)) {
                    nav.querySelectorAll('[data-menu]').forEach(function(menu) {
                        menu.classList.add('hidden');
                    });
                    nav.querySelectorAll('[data-arrow]').forEach(function(arrow) {
                        arrow.classList.remove('rotate-180');
                    });
                }
            });

            // Toggle dropdowns on click
            nav.querySelectorAll('[data-dropdown]').forEach(function(container) {
                const toggle = container.querySelector('[data-toggle]');
                const menu = container.querySelector('[data-menu]');
                const arrow = toggle ? toggle.querySelector('[data-arrow]') : null;
                
                if (!toggle || !menu) return;

                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Close other dropdowns
                    nav.querySelectorAll('[data-menu]').forEach(function(otherMenu) {
                        if (otherMenu !== menu) {
                            otherMenu.classList.add('hidden');
                        }
                    });
                    nav.querySelectorAll('[data-arrow]').forEach(function(otherArrow) {
                        if (otherArrow !== arrow) {
                            otherArrow.classList.remove('rotate-180');
                        }
                    });

                    // Toggle current dropdown
                    const isHidden = menu.classList.contains('hidden');
                    if (isHidden) {
                        menu.classList.remove('hidden');
                        if (arrow) arrow.classList.add('rotate-180');
                    } else {
                        menu.classList.add('hidden');
                        if (arrow) arrow.classList.remove('rotate-180');
                    }
                });
            });

            // Keep dropdowns open when clicking inside them
            nav.querySelectorAll('[data-menu]').forEach(function(menu) {
                menu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });
        });
    </script>
@endif
