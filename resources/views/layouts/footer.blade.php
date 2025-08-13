<div class="w-full px-4 md:px-8 py-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Kolom 1 -->
            <div>
                <h2 class="text-2xl font-bold mb-4">Yayasan Al-Khoir</h2>
                <p class="text-gray-400">
                    Menyebarkan kebaikan melalui pendidikan, sosial, dan dakwah.
                    Mari bersama menjadi bagian dari perubahan yang lebih baik.
                </p>
            </div>

            <!-- Kolom 2 -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Navigasi</h3>
                <ul class="space-y-2">
                    <li><a href="{{ url('/') }}" class="hover:text-green-400">Beranda</a></li>
                    <li><a href="#program" class="hover:text-green-400">Program</a></li>
                    <li><a href="#galeri" class="hover:text-green-400">Galeri</a></li>
                    <li><a href="#kontak" class="hover:text-green-400">Kontak</a></li>
                </ul>
            </div>

            <!-- Kolom 3 -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Kontak Kami</h3>
                <ul class="space-y-2 text-gray-400">
                    <li>📍 Jl. Pendidikan No. 123, Bandung</li>
                    <li>📞 +62 812-3456-7890</li>
                    <li>✉️ info@alkhoir.or.id</li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-700 text-center text-sm py-4 text-gray-500 w-full px-4 md:px-20">
            &copy; {{ date('Y') }} Yayasan Al-Khoir. All rights reserved.
        </div>