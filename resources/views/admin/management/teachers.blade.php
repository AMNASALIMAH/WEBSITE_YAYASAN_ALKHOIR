<div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-6" data-content="mgmt-teachers" data-animate>
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
        <div class="space-y-1">
            <h1 class="text-3xl font-bold text-gray-900 text-center w-full">Data Guru</h1>
            <p class="text-gray-600">Kelola daftar guru dan riwayat pengajaran dengan mudah</p>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <!-- Search Bar -->
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        
                </div>
                <input id="teacher-search" type="text" 
                       class=" w-96 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-gray-400" 
                       placeholder="Cari guru berdasarkan nama, mapel..." 
                       oninput="filterTeachers()">
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-2">
                <button onclick="openTeacherModal()" 
                        class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span class="text-black">Tambah Guru</span>
                </button>
          
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-blue-600">Total Guru</p>
                    <p class="text-2xl font-bold text-blue-900" id="total-teachers">0</p>
                </div>
                <div class="p-3 bg-blue-500 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-green-600">Guru Aktif</p>
                    <p class="text-2xl font-bold text-green-900" id="active-teachers">0</p>
                </div>
                <div class="p-3 bg-green-500 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-6 border border-yellow-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-yellow-600">Guru Nonaktif</p>
                    <p class="text-2xl font-bold text-yellow-900" id="inactive-teachers">0</p>
                </div>
                <div class="p-3 bg-yellow-500 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-purple-600">Mapel</p>
                    <p class="text-2xl font-bold text-purple-900" id="total-subjects">0</p>
                </div>
                <div class="p-3 bg-purple-500 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Teachers Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <span>Guru</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                </svg>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Mata Pelajaran</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody id="teacher-tbody" class="divide-y divide-gray-200">
                    <!-- Dynamic content will be loaded here -->
                </tbody>
            </table>
        </div>
        
        <!-- Empty State -->
        <div id="empty-state" class="hidden text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data guru</h3>
            <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan guru pertama Anda.</p>
            <div class="mt-6">
                <button onclick="openTeacherModal()" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Guru
                </button>
            </div>
        </div>
        
        <!-- Loading State -->
        <div id="loading-state" class="text-center py-12">
            <div class="inline-flex items-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-gray-600">Memuat data guru...</span>
            </div>
        </div>
    </div>

    <!-- Modal: Tambah/Edit Guru -->
    <div id="teacher-modal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <form id="teacher-form" enctype="multipart/form-data">
                    <div class="bg-white px-6 pt-6 pb-4">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-gray-900" id="modal-title">Tambah Guru Baru</h3>
                            <button type="button" onclick="closeTeacherModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="space-y-6">
                            <!-- Photo Upload -->
                            <div class="flex justify-center">
                                <div class="relative">
                                    <div id="photo-preview" class="w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <label for="foto" class="absolute bottom-0 right-0 bg-blue-600 text-white p-1 rounded-full cursor-pointer hover:bg-blue-700 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </label>
                                    <input type="file" id="foto" name="foto" accept="image/*" class="hidden" onchange="previewPhoto(this)">
                                </div>
                            </div>

                            <!-- Basic Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                                    <input type="text" id="nama" name="nama" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                           placeholder="Masukkan nama lengkap">
                                </div>
                                
                                <div>
                                    <label for="mapel" class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran *</label>
                                    <input type="text" id="mapel" name="mapel" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                           placeholder="Contoh: Tahfidz, Fiqih">
                                </div>
                                
                                <div>
                                    <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon *</label>
                                    <input type="tel" id="telepon" name="telepon" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                           placeholder="08xx-xxxx-xxxx">
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" id="email" name="email"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                           placeholder="email@example.com">
                                </div>
                                
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                                    <select id="status" name="status" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="tanggal_bergabung" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Bergabung</label>
                                    <input type="date" id="tanggal_bergabung" name="tanggal_bergabung"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <div class="space-y-4">
                                <div>
                                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                    <textarea id="alamat" name="alamat" rows="3"
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                              placeholder="Masukkan alamat lengkap"></textarea>
                                </div>
                                
                                <div>
                                    <label for="kualifikasi" class="block text-sm font-medium text-gray-700 mb-2">Kualifikasi Pendidikan</label>
                                    <textarea id="kualifikasi" name="kualifikasi" rows="2"
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                              placeholder="Pendidikan terakhir dan sertifikasi"></textarea>
                                </div>
                                
                                <div>
                                    <label for="pengalaman" class="block text-sm font-medium text-gray-700 mb-2">Pengalaman Mengajar</label>
                                    <textarea id="pengalaman" name="pengalaman" rows="2"
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                              placeholder="Riwayat pengalaman mengajar"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3">
                        <button type="button" onclick="closeTeacherModal()"
                                class="px-6 py-2.5 border border-black text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" id="submit-btn"
                                class="px-6 py-2.5 bg-white text-black font-medium rounded-lg hover:bg-blue-700 transition-colors flex items-center border border-black">
                            <svg class="w-4 h-4 mr-2 text-black" fill="none" stroke="black" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                           <span class="text-black">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Detail Guru -->
    <div id="teacher-detail-modal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="detail-modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-6 pt-6 pb-4">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-900" id="detail-modal-title">Detail Guru</h3>
                        <button type="button" onclick="closeTeacherDetailModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <div id="teacher-detail-content" class="space-y-6">
                        <!-- Teacher photo and basic info -->
                        <div class="flex items-center space-x-4">
                            <div id="detail-photo" class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 id="detail-nama" class="text-xl font-semibold text-gray-900">-</h4>
                                <p id="detail-mapel" class="text-gray-600">-</p>
                                <span id="detail-status" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">-</span>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                            <h5 class="font-medium text-gray-900">Informasi Kontak</h5>
                            <div class="space-y-2">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span id="detail-telepon" class="text-gray-700">-</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <span id="detail-email" class="text-gray-700">-</span>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span id="detail-alamat" class="text-gray-700">-</span>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="space-y-4">
                            <div>
                                <h5 class="font-medium text-gray-900 mb-2">Tanggal Bergabung</h5>
                                <p id="detail-tanggal-bergabung" class="text-gray-700">-</p>
                            </div>
                            
                            <div>
                                <h5 class="font-medium text-gray-900 mb-2">Kualifikasi Pendidikan</h5>
                                <p id="detail-kualifikasi" class="text-gray-700">-</p>
                            </div>
                            
                            <div>
                                <h5 class="font-medium text-gray-900 mb-2">Pengalaman Mengajar</h5>
                                <p id="detail-pengalaman" class="text-gray-700">-</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3">
                    <button type="button" onclick="closeTeacherDetailModal()"
                            class="px-6 py-2.5 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Tutup
                    </button>
                    <button type="button" onclick="editTeacherFromDetail()"
                            class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        Edit
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="hidden fixed top-4 right-4 z-50">
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-4 max-w-sm">
            <div class="flex items-center">
                <div id="toast-icon" class="flex-shrink-0">
                    <!-- Icon will be inserted here -->
                </div>
                <div class="ml-3">
                    <p id="toast-message" class="text-sm font-medium text-gray-900"></p>
                </div>
                <div class="ml-auto pl-3">
                    <button onclick="hideToast()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Teacher Management -->
<script>
let teachers = [];
let currentTeacherId = null;
let isArchiveView = false;

// Initialize the page
document.addEventListener('DOMContentLoaded', function() {
    loadTeachers();
});

// Load teachers data
async function loadTeachers() {
    try {
        showLoading(true);
        console.log('Loading teachers data...');
        
        const response = await fetch('/admin/teachers/data');
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const result = await response.json();
        console.log('API response:', result);
        
        if (result.success) {
            teachers = result.data;
            console.log('Teachers loaded:', teachers.length, 'records');
            renderTeachers();
            updateStats();
        } else {
            console.error('API returned error:', result);
            showToast('Gagal memuat data guru', 'error');
        }
    } catch (error) {
        console.error('Error loading teachers:', error);
        showToast('Terjadi kesalahan saat memuat data', 'error');
    } finally {
        showLoading(false);
    }
}

// Render teachers in table
function renderTeachers() {
    const tbody = document.getElementById('teacher-tbody');
    const emptyState = document.getElementById('empty-state');
    
    if (teachers.length === 0) {
        tbody.innerHTML = '';
        emptyState.classList.remove('hidden');
        return;
    }
    
    emptyState.classList.add('hidden');
    
    const filteredTeachers = isArchiveView 
        ? teachers.filter(t => t.deleted_at !== null)
        : teachers.filter(t => t.deleted_at === null);
    
    tbody.innerHTML = filteredTeachers.map(teacher => `
        <tr class="hover:bg-gray-50 transition-colors duration-200">
            <td class="px-6 py-4">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                            ${teacher.foto ? 
                                `<img src="/storage/${teacher.foto}" alt="${teacher.nama}" class="w-full h-full object-cover">` :
                                `<svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>`
                            }
                        </div>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-900">${teacher.nama}</div>
                        <div class="text-sm text-gray-500">${teacher.email || '-'}</div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    ${teacher.mapel}
                </span>
            </td>
            <td class="px-6 py-4 text-sm text-gray-900">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <span>${teacher.telepon}</span>
                </div>
            </td>
            <td class="px-6 py-4">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${teacher.status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                    ${teacher.status === 'aktif' ? 'Aktif' : 'Nonaktif'}
                </span>
            </td>
            <td class="px-6 py-4 text-right text-sm font-medium">
                <div class="flex items-center justify-end space-x-2">
                    <button onclick="viewTeacher(${teacher.id})" 
                            class="text-gray-400 hover:text-gray-600 transition-colors" 
                            title="Detail">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                    <button onclick="editTeacher(${teacher.id})" 
                            class="text-blue-400 hover:text-blue-600 transition-colors" 
                            title="Edit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button onclick="deleteTeacher(${teacher.id})" 
                            class="text-red-400 hover:text-red-600 transition-colors" 
                            title="Hapus">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>
    `).join('');
}

// Update statistics
function updateStats() {
    const totalTeachers = teachers.filter(t => t.deleted_at === null).length;
    const activeTeachers = teachers.filter(t => t.status === 'aktif' && t.deleted_at === null).length;
    const inactiveTeachers = teachers.filter(t => t.status === 'nonaktif' && t.deleted_at === null).length;
    const uniqueSubjects = [...new Set(teachers.filter(t => t.deleted_at === null).map(t => t.mapel))].length;
    
    document.getElementById('total-teachers').textContent = totalTeachers;
    document.getElementById('active-teachers').textContent = activeTeachers;
    document.getElementById('inactive-teachers').textContent = inactiveTeachers;
    document.getElementById('total-subjects').textContent = uniqueSubjects;
}

// Filter teachers
function filterTeachers() {
    const searchTerm = document.getElementById('teacher-search').value.toLowerCase();
    const rows = document.querySelectorAll('#teacher-tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
}

// Show/hide loading state
function showLoading(show) {
    const loadingState = document.getElementById('loading-state');
    const tbody = document.getElementById('teacher-tbody');
    
    if (show) {
        loadingState.classList.remove('hidden');
        tbody.innerHTML = '';
    } else {
        loadingState.classList.add('hidden');
    }
}

// Modal functions
function openTeacherModal(teacherId = null) {
    currentTeacherId = teacherId;
    const modal = document.getElementById('teacher-modal');
    const title = document.getElementById('modal-title');
    const form = document.getElementById('teacher-form');
    
    if (teacherId) {
        title.textContent = 'Edit Guru';
        const teacher = teachers.find(t => t.id === teacherId);
        if (teacher) {
            fillTeacherForm(teacher);
        }
    } else {
        title.textContent = 'Tambah Guru Baru';
        form.reset();
        resetPhotoPreview();
    }
    
    modal.classList.remove('hidden');
}

function closeTeacherModal() {
    const modal = document.getElementById('teacher-modal');
    modal.classList.add('hidden');
    currentTeacherId = null;
}

function openTeacherDetailModal() {
    const modal = document.getElementById('teacher-detail-modal');
    modal.classList.remove('hidden');
}

function closeTeacherDetailModal() {
    const modal = document.getElementById('teacher-detail-modal');
    modal.classList.add('hidden');
}

// Form handling
function fillTeacherForm(teacher) {
    document.getElementById('nama').value = teacher.nama;
    document.getElementById('mapel').value = teacher.mapel;
    document.getElementById('telepon').value = teacher.telepon;
    document.getElementById('email').value = teacher.email || '';
    document.getElementById('status').value = teacher.status;
    
    // Format date for HTML date input (YYYY-MM-DD)
    const tanggalBergabung = teacher.tanggal_bergabung ? 
        new Date(teacher.tanggal_bergabung).toISOString().split('T')[0] : '';
    document.getElementById('tanggal_bergabung').value = tanggalBergabung;
    
    document.getElementById('alamat').value = teacher.alamat || '';
    document.getElementById('kualifikasi').value = teacher.kualifikasi || '';
    document.getElementById('pengalaman').value = teacher.pengalaman || '';
    
    if (teacher.foto) {
        document.getElementById('photo-preview').innerHTML = 
            `<img src="/storage/${teacher.foto}" alt="${teacher.nama}" class="w-full h-full object-cover">`;
    } else {
        resetPhotoPreview();
    }
}

function resetPhotoPreview() {
    document.getElementById('photo-preview').innerHTML = `
        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
    `;
}

function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photo-preview').innerHTML = 
                `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// CRUD operations
async function saveTeacher(formData) {
    try {
        const url = currentTeacherId 
            ? `/admin/teachers/${currentTeacherId}` 
            : '/admin/teachers';
        
        const method = currentTeacherId ? 'PUT' : 'POST';
        
        // Add CSRF token to form data for PUT requests
        if (method === 'PUT') {
            formData.append('_method', 'PUT');
        }
        
        // Debug: Log form data
        console.log('Form data being sent:');
        for (let [key, value] of formData.entries()) {
            console.log(key + ': ' + value);
        }
        
        const response = await fetch(url, {
            method: 'POST', // Always use POST for Laravel form handling
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            showToast(result.message, 'success');
            closeTeacherModal();
            loadTeachers();
        } else {
            // Handle validation errors
            if (result.errors) {
                let errorMessage = 'Validasi gagal:\n';
                Object.keys(result.errors).forEach(field => {
                    errorMessage += `- ${result.errors[field][0]}\n`;
                });
                showToast(errorMessage, 'error');
            } else {
                showToast(result.message || 'Terjadi kesalahan', 'error');
            }
        }
    } catch (error) {
        console.error('Error saving teacher:', error);
        showToast('Terjadi kesalahan saat menyimpan data', 'error');
    }
}

async function viewTeacher(teacherId) {
    try {
        const response = await fetch(`/admin/teachers/${teacherId}`);
        const result = await response.json();
        
        if (result.success) {
            const teacher = result.data;
            fillTeacherDetail(teacher);
            openTeacherDetailModal();
        }
    } catch (error) {
        console.error('Error viewing teacher:', error);
        showToast('Terjadi kesalahan saat memuat detail', 'error');
    }
}

function fillTeacherDetail(teacher) {
    document.getElementById('detail-nama').textContent = teacher.nama;
    document.getElementById('detail-mapel').textContent = teacher.mapel;
    document.getElementById('detail-telepon').textContent = teacher.telepon;
    document.getElementById('detail-email').textContent = teacher.email || '-';
    document.getElementById('detail-alamat').textContent = teacher.alamat || '-';
    document.getElementById('detail-tanggal-bergabung').textContent = teacher.tanggal_bergabung ? new Date(teacher.tanggal_bergabung).toLocaleDateString('id-ID') : '-';
    document.getElementById('detail-kualifikasi').textContent = teacher.kualifikasi || '-';
    document.getElementById('detail-pengalaman').textContent = teacher.pengalaman || '-';
    
    const statusElement = document.getElementById('detail-status');
    statusElement.textContent = teacher.status === 'aktif' ? 'Aktif' : 'Nonaktif';
    statusElement.className = `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${teacher.status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`;
    
    const photoElement = document.getElementById('detail-photo');
    if (teacher.foto) {
        photoElement.innerHTML = `<img src="/storage/${teacher.foto}" alt="${teacher.nama}" class="w-full h-full object-cover">`;
    } else {
        photoElement.innerHTML = `
            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        `;
    }
}

async function deleteTeacher(teacherId) {
    if (!confirm('Apakah Anda yakin ingin menghapus guru ini?')) {
        return;
    }
    
    try {
        const response = await fetch(`/admin/teachers/${teacherId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            showToast(result.message, 'success');
            loadTeachers();
        } else {
            showToast(result.message || 'Terjadi kesalahan', 'error');
        }
    } catch (error) {
        console.error('Error deleting teacher:', error);
        showToast('Terjadi kesalahan saat menghapus data', 'error');
    }
}

function editTeacher(teacherId) {
    openTeacherModal(teacherId);
}

function editTeacherFromDetail() {
    closeTeacherDetailModal();
    setTimeout(() => editTeacher(currentTeacherId), 300);
}



// Toast notification
function showToast(message, type = 'info') {
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toast-message');
    const toastIcon = document.getElementById('toast-icon');
    
    // Handle multi-line messages
    if (typeof message === 'string' && message.includes('\n')) {
        toastMessage.innerHTML = message.replace(/\n/g, '<br>');
    } else {
        toastMessage.textContent = message;
    }
    
    let iconHtml = '';
    let bgColor = '';
    
    switch (type) {
        case 'success':
            iconHtml = '<svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>';
            bgColor = 'border-green-200';
            break;
        case 'error':
            iconHtml = '<svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>';
            bgColor = 'border-red-200';
            break;
        default:
            iconHtml = '<svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>';
            bgColor = 'border-blue-200';
    }
    
    toastIcon.innerHTML = iconHtml;
    toast.className = `fixed top-4 right-4 z-50 ${bgColor}`;
    toast.classList.remove('hidden');
    
    // Show error messages longer
    const duration = type === 'error' ? 8000 : 5000;
    setTimeout(() => {
        hideToast();
    }, duration);
}

function hideToast() {
    const toast = document.getElementById('toast');
    toast.classList.add('hidden');
}

// Form submission
document.getElementById('teacher-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    console.log('Form submitted');
    console.log('Current teacher ID:', currentTeacherId);
    
    const formData = new FormData(this);
    
    // Debug: Check if required fields are present
    const requiredFields = ['nama', 'mapel', 'telepon', 'status'];
    requiredFields.forEach(field => {
        const value = formData.get(field);
        console.log(`${field}: ${value}`);
        if (!value) {
            console.warn(`Missing required field: ${field}`);
        }
    });
    
    saveTeacher(formData);
});
</script>

