


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Program - Yayasan Al-Khoir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="{{ asset('js/program-management.js') }}" defer></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        @keyframes scaleIn {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .fade-in { animation: fadeIn 0.5s ease-out; }
        .slide-in { animation: slideIn 0.3s ease-out; }
        .scale-in { animation: scaleIn 0.2s ease-out; }
        .transition-all { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .hover-lift:hover { transform: translateY(-2px); box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1); }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen">
    <div class="container mx-auto px-4 py-8" x-data="programManager()">
        <!-- Header Section -->
        <div class="text-center mb-12 fade-in">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                Manajemen Program
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Kelola program-program Yayasan Al-Khoir dengan mudah dan efisien
            </p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover-lift transition-all">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Program</p>
                        <p class="text-3xl font-bold text-gray-900" x-text="programs.length">0</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-list text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover-lift transition-all">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Program Aktif</p>
                        <p class="text-3xl font-bold text-green-600" x-text="activeProgramsCount">0</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover-lift transition-all">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Kategori</p>
                        <p class="text-3xl font-bold text-purple-600" x-text="categories.length">0</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-tags text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 mb-8 justify-center">
            <button @click="openModal('create')" 
                    data-action="new-program"
                    class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover-lift transition-all flex items-center gap-3">
                <i class="fas fa-plus text-lg"></i>
                Tambah Program Baru
            </button>
            <button @click="openModal('category')" 
                    class="bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover-lift transition-all flex items-center gap-3">
                <i class="fas fa-tags text-lg"></i>
                Kelola Kategori
            </button>
            <button @click="exportToCSV()" 
                    class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover-lift transition-all flex items-center gap-3">
                <i class="fas fa-download text-lg"></i>
                Export CSV
            </button>
            <button @click="printPrograms()" 
                    class="bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover-lift transition-all flex items-center gap-3">
                <i class="fas fa-print text-lg"></i>
                Cetak
            </button>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
            <div class="flex flex-col lg:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" x-model="searchQuery" 
                               placeholder="Cari program..." 
                               class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <select x-model="statusFilter" class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                    <select x-model="categoryFilter" class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <option value="">Semua Kategori</option>
                        <template x-for="category in categories" :key="category">
                            <option :value="category" x-text="category"></option>
                        </template>
                    </select>
                </div>
            </div>
            
            <!-- Results Summary -->
            <div class="mt-4 pt-4 border-t border-gray-100">
                <p class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold" x-text="filteredPrograms.length"></span> dari <span class="font-semibold" x-text="programs.length"></span> program
                    <span x-show="searchQuery || statusFilter || categoryFilter" x-text="` (difilter)`"></span>
                </p>
            </div>
        </div>

        <!-- Programs Table -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- Loading State -->
            <div x-show="loading" class="p-12 text-center">
                <div class="inline-flex items-center gap-3">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                    <span class="text-gray-600">Memuat data program...</span>
                </div>
            </div>
            
            <!-- Table Content -->
            <div x-show="!loading" class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="px-4 md:px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Program</th>
                            <th class="px-4 md:px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                            <th class="px-4 md:px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="hidden md:table-cell px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Dibuat</th>
                            <th class="px-4 md:px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <template x-for="program in filteredPrograms" :key="program.id">
                            <tr class="hover:bg-gray-50 transition-all duration-200">
                                <td class="px-4 md:px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 md:w-10 md:h-10 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl flex items-center justify-center mr-3 md:mr-4">
                                            <i class="fas fa-graduation-cap text-blue-600 text-sm md:text-base"></i>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <div class="font-semibold text-gray-900 text-sm md:text-base truncate" x-text="program.name"></div>
                                            <div class="text-xs md:text-sm text-gray-500 truncate" x-text="program.description || 'Tidak ada deskripsi'"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 md:px-6 py-4">
                                    <span class="inline-flex items-center px-2 md:px-3 py-1 rounded-full text-xs md:text-sm font-medium bg-purple-100 text-purple-800" x-text="program.category"></span>
                                </td>
                                <td class="px-4 md:px-6 py-4">
                                    <span :class="program.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'" 
                                          class="inline-flex items-center px-2 md:px-3 py-1 rounded-full text-xs md:text-sm font-medium" x-text="program.status === 'active' ? 'Aktif' : 'Nonaktif'"></span>
                                </td>
                                <td class="hidden md:table-cell px-6 py-4 text-sm text-gray-500" x-text="formatDate(program.created_at)"></td>
                                <td class="px-4 md:px-6 py-4">
                                    <div class="flex justify-end gap-1 md:gap-2">
                                        <button @click="editProgram(program)" 
                                                class="p-1.5 md:p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all" 
                                                title="Edit Program">
                                            <i class="fas fa-edit text-sm md:text-base"></i>
                                        </button>
                                        <button @click="toggleStatus(program)" 
                                                :class="program.status === 'active' ? 'text-orange-600 hover:bg-orange-50' : 'text-green-600 hover:bg-green-50'"
                                                class="p-1.5 md:p-2 rounded-lg transition-all" 
                                                :title="program.status === 'active' ? 'Nonaktifkan' : 'Aktifkan'">
                                            <i :class="program.status === 'active' ? 'fas fa-toggle-off' : 'fas fa-toggle-on'" class="text-sm md:text-base"></i>
                                        </button>
                                        <button @click="deleteProgram(program)" 
                                                class="p-1.5 md:p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all" 
                                                title="Hapus Program">
                                            <i class="fas fa-trash text-sm md:text-base"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            
            <!-- Empty State -->
            <div x-show="filteredPrograms.length === 0" class="text-center py-12">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-folder-open text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada program ditemukan</h3>
                <p class="text-gray-500 mb-4">Coba ubah filter pencarian atau tambah program baru.</p>
                <button @click="openModal('create')" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-all">
                    Tambah Program Pertama
                </button>
            </div>
        </div>

        <!-- Create/Edit Program Modal -->
        <div x-show="showModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                
                <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full scale-in">
                    <div class="bg-white px-6 py-4">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-gray-900" x-text="editingProgram ? 'Edit Program' : 'Tambah Program Baru'"></h3>
                            <button @click="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        
                        <form @submit.prevent="saveProgram()" class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Program</label>
                                <input type="text" x-model="form.name" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                       placeholder="Masukkan nama program">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                <textarea x-model="form.description" rows="3"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                          placeholder="Deskripsi program (opsional)"></textarea>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <select x-model="form.category" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                    <option value="">Pilih kategori</option>
                                    <template x-for="category in categories" :key="category">
                                        <option :value="category" x-text="category"></option>
                                    </template>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select x-model="form.status" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                    <option value="active">Aktif</option>
                                    <option value="inactive">Nonaktif</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Program (Opsional)</label>
                                <input type="file" @change="handleImageUpload" accept="image/*"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            </div>
                            
                            <div class="flex justify-end gap-3 pt-4">
                                <button type="button" @click="closeModal()"
                                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all">
                                    Batal
                                </button>
                                <button type="submit"
                                        class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all flex items-center gap-2">
                                    <i class="fas fa-save"></i>
                                    <span x-text="editingProgram ? 'Update' : 'Simpan'"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Management Modal -->
        <div x-show="showCategoryModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                
                <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full scale-in">
                    <div class="bg-white px-6 py-4">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-gray-900">Kelola Kategori</h3>
                            <button @click="closeCategoryModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex gap-2">
                                <input type="text" x-model="newCategory" 
                                       placeholder="Nama kategori baru"
                                       class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                <button @click="addCategory()" 
                                        class="px-4 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            
                            <div>
                                <h4 class="font-medium text-gray-900 mb-3">Kategori yang tersedia:</h4>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="category in categories" :key="category">
                                        <span class="inline-flex items-center gap-2 px-3 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm">
                                            <span x-text="category"></span>
                                            <button @click="removeCategory(category)" 
                                                    class="text-red-500 hover:text-red-700 transition-colors">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </span>
                                    </template>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end pt-6">
                            <button @click="closeCategoryModal()"
                                    class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Notifications -->
        <div x-show="showToast" x-cloak 
             class="fixed top-4 right-4 z-50 bg-white rounded-xl shadow-lg border border-gray-200 p-4 max-w-sm slide-in" 
             style="display: none;">
            <div class="flex items-center gap-3">
                <div :class="toastType === 'success' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600'" 
                     class="w-8 h-8 rounded-full flex items-center justify-center">
                    <i :class="toastType === 'success' ? 'fas fa-check' : 'fas fa-exclamation-triangle'"></i>
                </div>
                <div class="flex-1">
                    <p class="font-medium text-gray-900" x-text="toastMessage"></p>
                </div>
                <button @click="hideToast()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        function programManager() {
            return {
                programs: @json($programs ?? []),
                categories: @json($categories ?? []),
                showModal: false,
                showCategoryModal: false,
                editingProgram: null,
                searchQuery: '',
                statusFilter: '',
                categoryFilter: '',
                newCategory: '',
                showToast: false,
                toastMessage: '',
                toastType: 'success',
                loading: false,
                form: {
                    name: '',
                    description: '',
                    category: '',
                    status: 'active',
                    image: null
                },

                get filteredPrograms() {
                    return this.programs.filter(program => {
                        const matchesSearch = program.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                                            (program.description && program.description.toLowerCase().includes(this.searchQuery.toLowerCase()));
                        const matchesStatus = !this.statusFilter || program.status === this.statusFilter;
                        const matchesCategory = !this.categoryFilter || program.category === this.categoryFilter;
                        
                        return matchesSearch && matchesStatus && matchesCategory;
                    });
                },

                get activeProgramsCount() {
                    return this.programs.filter(p => p.status === 'active').length;
                },

                openModal(type) {
                    if (type === 'create') {
                        this.editingProgram = null;
                        this.resetForm();
                        this.showModal = true;
                    } else if (type === 'category') {
                        this.showCategoryModal = true;
                    }
                },

                closeModal() {
                    this.showModal = false;
                    this.editingProgram = null;
                    this.resetForm();
                },

                closeCategoryModal() {
                    this.showCategoryModal = false;
                    this.newCategory = '';
                },

                resetForm() {
                    this.form = {
                        name: '',
                        description: '',
                        category: '',
                        status: 'active',
                        image: null
                    };
                },

                editProgram(program) {
                    this.editingProgram = program;
                    this.form = {
                        name: program.name,
                        description: program.description || '',
                        category: program.category,
                        status: program.status,
                        image: null
                    };
                    this.showModal = true;
                },

                async saveProgram() {
                    try {
                        this.loading = true;
                        const formData = new FormData();
                        formData.append('name', this.form.name);
                        formData.append('description', this.form.description);
                        formData.append('category', this.form.category);
                        formData.append('status', this.form.status);
                        if (this.form.image) {
                            formData.append('image', this.form.image);
                        }

                        const url = this.editingProgram 
                            ? `/admin/programs/${this.editingProgram.id}`
                            : '/admin/programs';
                        
                        const method = this.editingProgram ? 'PUT' : 'POST';
                        
                        const response = await fetch(url, {
                            method: method,
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                            }
                        });

                        const result = await response.json();

                        if (result.success) {
                            this.showToastMessage(result.message, 'success');
                            this.closeModal();
                            await this.loadPrograms();
                        } else {
                            this.showToastMessage(result.message, 'error');
                        }
                    } catch (error) {
                        this.showToastMessage('Terjadi kesalahan saat menyimpan program', 'error');
                    } finally {
                        this.loading = false;
                    }
                },

                async deleteProgram(program) {
                    if (!confirm('Apakah Anda yakin ingin menghapus program ini?')) return;

                    try {
                        this.loading = true;
                        const response = await fetch(`/admin/programs/${program.id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                            }
                        });

                        const result = await response.json();

                        if (result.success) {
                            this.showToastMessage(result.message, 'success');
                            await this.loadPrograms();
                        } else {
                            this.showToastMessage(result.message, 'error');
                        }
                    } catch (error) {
                        this.showToastMessage('Terjadi kesalahan saat menghapus program', 'error');
                    } finally {
                        this.loading = false;
                    }
                },

                async toggleStatus(program) {
                    try {
                        this.loading = true;
                        const response = await fetch(`/admin/programs/${program.id}/toggle-status`, {
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                            }
                        });

                        const result = await response.json();

                        if (result.success) {
                            this.showToastMessage(result.message, 'success');
                            await this.loadPrograms();
                        } else {
                            this.showToastMessage(result.message, 'error');
                        }
                    } catch (error) {
                        this.showToastMessage('Terjadi kesalahan saat mengubah status', 'error');
                    } finally {
                        this.loading = false;
                    }
                },

                async addCategory() {
                    if (!this.newCategory.trim()) return;

                    if (!this.categories.includes(this.newCategory)) {
                        this.categories.push(this.newCategory);
                        this.newCategory = '';
                        this.showToastMessage('Kategori berhasil ditambahkan', 'success');
                    } else {
                        this.showToastMessage('Kategori sudah ada', 'error');
                    }
                },

                removeCategory(category) {
                    if (this.programs.some(p => p.category === category)) {
                        this.showToastMessage('Kategori tidak dapat dihapus karena masih digunakan', 'error');
                        return;
                    }

                    this.categories = this.categories.filter(c => c !== category);
                    this.showToastMessage('Kategori berhasil dihapus', 'success');
                },

                handleImageUpload(event) {
                    this.form.image = event.target.files[0];
                },

                async loadPrograms() {
                    try {
                        this.loading = true;
                        const response = await fetch('/admin/programs');
                        const result = await response.json();
                        if (result.success) {
                            this.programs = result.data;
                        }
                    } catch (error) {
                        console.error('Error loading programs:', error);
                        this.showToastMessage('Gagal memuat data program', 'error');
                    } finally {
                        this.loading = false;
                    }
                },

                showToastMessage(message, type = 'success') {
                    this.toastMessage = message;
                    this.toastType = type;
                    this.showToast = true;
                    setTimeout(() => this.hideToast(), 5000);
                },

                hideToast() {
                    this.showToast = false;
                },

                formatDate(dateString) {
                    if (!dateString) return '-';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('id-ID', {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric'
                    });
                },

                exportToCSV() {
                    const data = this.programs.map(program => ({
                        name: program.name,
                        category: program.category,
                        status: program.status === 'active' ? 'Aktif' : 'Nonaktif',
                        description: program.description || '',
                        created_at: this.formatDate(program.created_at)
                    }));
                    
                    const headers = ['Nama Program', 'Kategori', 'Status', 'Deskripsi', 'Tanggal Dibuat'];
                    const csvContent = [
                        headers.join(','),
                        ...data.map(item => [
                            `"${item.name}"`,
                            `"${item.category}"`,
                            `"${item.status}"`,
                            `"${item.description}"`,
                            `"${item.created_at}"`
                        ].join(','))
                    ].join('\n');
                    
                    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                    const link = document.createElement('a');
                    const url = URL.createObjectURL(blob);
                    link.setAttribute('href', url);
                    link.setAttribute('download', `programs-${new Date().toISOString().split('T')[0]}.csv`);
                    link.style.visibility = 'hidden';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    
                    this.showToastMessage('Data berhasil diexport ke CSV', 'success');
                },

                printPrograms() {
                    const printWindow = window.open('', '_blank');
                    const programs = this.programs;
                    
                    const printContent = `
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <title>Daftar Program - Yayasan Al-Khoir</title>
                            <style>
                                body { font-family: Arial, sans-serif; margin: 20px; }
                                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                                th { background-color: #f2f2f2; }
                                .header { text-align: center; margin-bottom: 30px; }
                                .header h1 { color: #2563eb; margin-bottom: 10px; }
                                .header p { color: #6b7280; }
                                @media print {
                                    .no-print { display: none; }
                                }
                            </style>
                        </head>
                        <body>
                            <div class="header">
                                <h1>Daftar Program Yayasan Al-Khoir</h1>
                                <p>Dicetak pada: ${this.formatDate(new Date())}</p>
                            </div>
                            
                            <table>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Program</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal Dibuat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${programs.map((program, index) => `
                                        <tr>
                                            <td>${index + 1}</td>
                                            <td>${program.name}</td>
                                            <td>${program.category}</td>
                                            <td>${program.status === 'active' ? 'Aktif' : 'Nonaktif'}</td>
                                            <td>${program.description || '-'}</td>
                                            <td>${this.formatDate(program.created_at)}</td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                            
                            <div class="no-print" style="margin-top: 30px; text-align: center;">
                                <button onclick="window.print()">Cetak</button>
                                <button onclick="window.close()">Tutup</button>
                            </div>
                        </body>
                        </html>
                    `;
                    
                    printWindow.document.write(printContent);
                    printWindow.document.close();
                }
            }
        }
    </script>
</body>
</html>

