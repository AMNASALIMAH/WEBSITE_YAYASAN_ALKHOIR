<x-landingpage>
    <main class="bg-white py-12 px-4 md:px-16 text-gray-800 mt-20">
    {{-- Formulir Kontak --}}
    <div class="bg-gray-100 rounded-lg shadow-md p-6 w-full mb-10">
        <h2 class="text-lg md:text-xl font-bold text-white bg-blue-900 px-4 py-2 rounded-t-md mb-6">
            Hubungi Kami
        </h2>
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" placeholder="Nama Depan *" class="p-3 rounded border w-full" required>
                <input type="text" placeholder="Nama Belakang" class="p-3 rounded border w-full">
                <input type="text" placeholder="No. HP *" class="p-3 rounded border w-full" required>
                <input type="email" placeholder="Alamat Email *" class="p-3 rounded border w-full" required>
            </div>

            <textarea placeholder="Pesan" class="w-full mt-4 p-3 rounded border h-28" required></textarea>

            {{-- <label class="block mt-4 mb-1 text-sm font-medium text-gray-700">
                Ketik karakter di bawah ini *
            </label>
            <input type="text" class="w-full p-3 rounded border mb-2" required>
            <div class="bg-white w-32 h-10 flex items-center justify-center text-xl font-mono mb-4 shadow-inner">
                p s† 5 ʂ
            </div> --}}
            <p class="text-xs text-gray-600 mb-4">Ini membantu kami mencegah spam, terima kasih.</p>

            <button type="submit" class="bg-blue-900 text-white px-6 py-2 rounded shadow hover:bg-blue-800 transition">
                Kirim 
            </button> 
            {{-- ✈️ --}}
        </form>
    </div>

    {{-- Informasi Kontak --}}
    <div class="bg-blue-50 rounded-lg shadow-md p-6 w-full">
        <h2 class="text-lg md:text-xl font-bold text-white bg-blue-900 px-4 py-2 rounded-t-md mb-6">
            Hubungi Kami Sekarang!
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 text-center">
            {{-- Telepon --}}
            <div class="flex flex-col items-center">
                <div class="text-3xl text-blue-900 mb-2">📞</div>
                <h3 class="text-lg font-semibold text-blue-900">Nomor Telepon</h3>
                <p class="text-gray-700">+62 812-3456-7890</p>
            </div>

            {{-- Email --}}
            <div class="flex flex-col items-center">
                <div class="text-3xl text-blue-900 mb-2">📧</div>
                <h3 class="text-lg font-semibold text-blue-900">Email</h3>
                <p class="text-gray-700 text-sm">info@yayasancontoh.org</p>
                <p class="text-gray-700 text-sm">kontak@yayasancontoh.org</p>
            </div>

            {{-- Lokasi --}}
            <div class="flex flex-col items-center">
                <div class="text-3xl text-blue-900 mb-2">📍</div>
                <h3 class="text-lg font-semibold text-blue-900">Lokasi</h3>
                <p class="text-gray-700 text-sm">Jl. Contoh No. 123, Jakarta Selatan, Indonesia</p>
            </div>

            {{-- Jam Kerja --}}
            <div class="flex flex-col items-center">
                <div class="text-3xl text-blue-900 mb-2">🕒</div>
                <h3 class="text-lg font-semibold text-blue-900">Jam Kerja</h3>
                <p class="text-gray-700 text-sm">Senin - Sabtu</p>
                <p class="text-gray-700 text-sm">09:00 - 18:00 WIB</p>
            </div>
        </div>
    </div>
</main>



</x-landingpage>
