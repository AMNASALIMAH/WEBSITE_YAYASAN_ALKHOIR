@extends('admin.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8" data-content="mgmt-students" id="students-content">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Manajemen Data Santri</h1>
                    <p class="mt-2 text-sm text-gray-600">Kelola data santri dengan mudah dan efisien</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <button id="addStudentBtn" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Santri
                    </button>
                </div>
            </div>
        </div>

        <!-- Filters and Search Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-2">Cari Santri</label>
                    <input type="text" id="searchInput" placeholder="Nama, NIS, atau Kelas..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                </div>
                <div>
                    <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="statusFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        <option value="">Semua Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                        <option value="lulus">Lulus</option>
                        <option value="pindah">Pindah</option>
                    </select>
                </div>
                <div>
                    <label for="programFilter" class="block text-sm font-medium text-gray-700 mb-2">Program</label>
                    <select id="programFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        <option value="">Semua Program</option>
                        @if(isset($programs) && count($programs) > 0)
                            @foreach($programs as $program)
                                <option value="{{ isset($program->id) ? $program->id : '' }}">{{ isset($program->name) ? $program->name : 'Program Tidak Diketahui' }}</option>
                            @endforeach
                        @else
                            <option value="">Tidak ada program tersedia</option>
                        @endif
                    </select>
                </div>
                <div class="flex items-end">
                    <button id="resetFiltersBtn" class="w-full px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                        Reset Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Bulk Actions -->
        <div id="bulkActions" class="hidden bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span id="selectedCount" class="text-sm text-gray-600"></span>
                    <button id="bulkDeleteBtn" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Terpilih
                    </button>
                </div>
            </div>
        </div>

        <!-- Students Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left">
                                <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="studentsTableBody" class="bg-white divide-y divide-gray-200">
                        @if(isset($students) && count($students) > 0)
                            @foreach($students as $student)
                                <tr class="hover:bg-gray-50 transition-colors duration-150" data-student-id="{{ $student->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="student-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" value="{{ $student->id }}">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover" 
                                                 src="{{ $student->foto ? asset('storage/' . $student->foto) : asset('assets/images/default-avatar.png') }}" 
                                                 alt="{{ $student->nama_lengkap }}"
                                                 onerror="this.onerror=null; this.src='{{ asset('assets/images/default-avatar.png') }}';">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $student->nis }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $student->nama_lengkap }}</div>
                                        <div class="text-sm text-gray-500">{{ $student->nama_panggilan ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $student->program->name ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $student->kelas }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($student->status === 'aktif') bg-green-100 text-green-800
                                            @elseif($student->status === 'nonaktif') bg-red-100 text-red-800
                                            @elseif($student->status === 'lulus') bg-blue-100 text-blue-800
                                            @elseif($student->status === 'pindah') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            @if($student->status === 'aktif') Aktif
                                            @elseif($student->status === 'nonaktif') Nonaktif
                                            @elseif($student->status === 'lulus') Lulus
                                            @elseif($student->status === 'pindah') Pindah
                                            @else {{ $student->status }}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <button onclick="studentManager.editStudent({{ $student->id }})" 
                                                    class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200"
                                                    title="Edit Santri">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                            <button onclick="studentManager.deleteStudent({{ $student->id }})" 
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                                    title="Hapus Santri">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            
            <!-- Loading State -->
            <div id="loadingState" class="hidden p-8 text-center">
                <div class="inline-flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-gray-600">Memuat data...</span>
                </div>
            </div>
            
            <!-- Empty State -->
            <div id="emptyState" class="{{ isset($students) && count($students) > 0 ? 'hidden' : '' }} p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data santri</h3>
                <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan santri baru.</p>
            </div>
        </div>

        <!-- Pagination -->
        <div id="pagination" class="mt-6 flex items-center justify-between {{ isset($students) && count($students) > 0 ? '' : 'hidden' }}">
            <div class="flex-1 flex justify-between sm:hidden">
                <button id="prevPageMobile" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Sebelumnya
                </button>
                <button id="nextPageMobile" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Selanjutnya
                </button>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        @if(isset($students) && count($students) > 0)
                            Menampilkan <span id="showingFrom">1</span> sampai <span id="showingTo">{{ count($students) }}</span> dari <span id="totalItems">{{ $students->total() }}</span> hasil
                        @else
                            Menampilkan <span id="showingFrom">0</span> sampai <span id="showingTo">0</span> dari <span id="totalItems">0</span> hasil
                        @endif
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <button id="prevPage" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="pageNumbers" class="flex">
                            <!-- Page numbers will be generated here -->
                        </div>
                        <button id="nextPage" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Student Modal -->
<div id="studentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 id="modalTitle" class="text-lg font-medium text-gray-900">Tambah Santri Baru</h3>
                <button id="closeModal" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <form id="studentForm" class="space-y-6">
                @csrf
                <input type="hidden" id="studentId" name="student_id">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="space-y-4">
                        <h4 class="text-md font-medium text-gray-900 border-b pb-2">Informasi Pribadi</h4>
                        
                        <div>
                            <label for="nis" class="block text-sm font-medium text-gray-700 mb-1">NIS *</label>
                            <input type="text" id="nis" name="nis" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                            <div id="nisError" class="hidden text-red-600 text-sm mt-1"></div>
                        </div>
                        
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                            <div id="nama_lengkapError" class="hidden text-red-600 text-sm mt-1"></div>
                        </div>
                        
                        <div>
                            <label for="nama_panggilan" class="block text-sm font-medium text-gray-700 mb-1">Nama Panggilan</label>
                            <input type="text" id="nama_panggilan" name="nama_panggilan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir *</label>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                <div id="tempat_lahirError" class="hidden text-red-600 text-sm mt-1"></div>
                            </div>
                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir *</label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                <div id="tanggal_lahirError" class="hidden text-red-600 text-sm mt-1"></div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin *</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <div id="jenis_kelaminError" class="hidden text-red-600 text-sm mt-1"></div>
                            </div>
                            <div>
                                <label for="agama" class="block text-sm font-medium text-gray-700 mb-1">Agama *</label>
                                <input type="text" id="agama" name="agama" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                <div id="agamaError" class="hidden text-red-600 text-sm mt-1"></div>
                            </div>
                        </div>
                        
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat *</label>
                            <textarea id="alamat" name="alamat" rows="3" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200"></textarea>
                            <div id="alamatError" class="hidden text-red-600 text-sm mt-1"></div>
                        </div>
                    </div>
                    
                    <!-- Academic Information -->
                    <div class="space-y-4">
                        <h4 class="text-md font-medium text-gray-900 border-b pb-2">Informasi Akademik</h4>
                        
                        <div>
                            <label for="program_id" class="block text-sm font-medium text-black mb-1">Program *</label>
                            <select id="program_id" name="program_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-black focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                <option value="" class="text-black">Pilih Program</option>
                                @if(isset($programs) && count($programs) > 0)
                                    @foreach($programs as $program)
                                        <option value="{{ isset($program->id) ? $program->id : '' }}" class="text-black">
                                            {{ isset($program->name) ? $program->name : 'Program Tidak Diketahui' }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" class="text-black">Tidak ada program tersedia</option>
                                @endif
                            </select>
                            <div id="program_idError" class="hidden text-black text-sm mt-1"></div>
                        </div>
                        
                        <div>
                            <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas *</label>
                            <input type="text" id="kelas" name="kelas" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                            <div id="kelasError" class="hidden text-red-600 text-sm mt-1"></div>
                        </div>
                        
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                            <select id="status" name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                <option value="">Pilih Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                                <option value="lulus">Lulus</option>
                                <option value="pindah">Pindah</option>
                            </select>
                            <div id="statusError" class="hidden text-red-600 text-sm mt-1"></div>
                        </div>
                        
                        <div>
                            <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Masuk *</label>
                            <input type="date" id="tanggal_masuk" name="tanggal_masuk" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                            <div id="tanggal_masukError" class="hidden text-red-600 text-sm mt-1"></div>
                        </div>
                        
                        <div>
                            <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                            <input type="file" id="foto" name="foto" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                            <div id="fotoError" class="hidden text-red-600 text-sm mt-1"></div>
                            <div id="currentFoto" class="hidden mt-2">
                                <img id="fotoPreview" src="" alt="Current photo" class="w-20 h-20 object-cover rounded-lg border">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Parent Information -->
                <div class="space-y-4">
                    <h4 class="text-md font-medium text-gray-900 border-b pb-2">Informasi Orang Tua</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_ortu" class="block text-sm font-medium text-gray-700 mb-1">Nama Orang Tua *</label>
                            <input type="text" id="nama_ortu" name="nama_ortu" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                            <div id="nama_ortuError" class="hidden text-red-600 text-sm mt-1"></div>
                        </div>
                        
                        <div>
                            <label for="telepon_ortu" class="block text-sm font-medium text-gray-700 mb-1">Telepon Orang Tua *</label>
                            <input type="text" id="telepon_ortu" name="telepon_ortu" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                            <div id="telepon_ortuError" class="hidden text-red-600 text-sm mt-1"></div>
                        </div>
                    </div>
                    
                    <div>
                        <label for="email_ortu" class="block text-sm font-medium text-gray-700 mb-1">Email Orang Tua</label>
                        <input type="email" id="email_ortu" name="email_ortu" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        <div id="email_ortuError" class="hidden text-red-600 text-sm mt-1"></div>
                    </div>
                </div>
                
                <!-- Additional Information -->
                <div class="space-y-4">
                    <h4 class="text-md font-medium text-gray-900 border-b pb-2">Informasi Tambahan</h4>
                    
                    <div>
                        <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                        <textarea id="catatan" name="catatan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200" placeholder="Catatan khusus tentang santri..."></textarea>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button type="button" id="cancelBtn" class="px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit" id="submitBtn" class="px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                        <span id="submitBtnText">Simpan</span>
                        <div id="submitBtnLoading" class="hidden inline-flex items-center ml-2">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Menyimpan...
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mt-4">Konfirmasi Hapus</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus santri ini? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="flex justify-center space-x-3 mt-4">
                <button id="cancelDelete" class="px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                    Batal
                </button>
                <button id="confirmDelete" class="px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Success/Error Toast -->
<div id="toast" class="fixed top-4 right-4 z-50 hidden">
    <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-4 max-w-sm">
        <div class="flex items-center">
            <div id="toastIcon" class="flex-shrink-0"></div>
            <div class="ml-3">
                <p id="toastMessage" class="text-sm font-medium text-gray-900"></p>
            </div>
            <div class="ml-auto pl-3">
                <button id="closeToast" class="inline-flex text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Include Tailwind CSS via CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Include JavaScript -->
<script src="{{ asset('js/santri_account.js') }}"></script>

@endsection
