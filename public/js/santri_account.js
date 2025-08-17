// Student Management System
class StudentManager {
    constructor() {
        // Prevent multiple instances
        if (window.studentManager) {
            console.log('StudentManager already exists, returning existing instance');
            return window.studentManager;
        }
        
        this.currentPage = 1;
        this.perPage = 10;
        this.selectedStudents = new Set();
        this.currentStudent = null;
        this.isEditing = false;
        this.isLoading = false;
        this.initialized = false;
        
        this.init();
        
        // Store instance globally
        window.studentManager = this;
    }

    init() {
        this.bindEvents();
        // Only load students if the table is empty
        if (document.getElementById('studentsTableBody').children.length === 0) {
            this.loadStudents();
        } else {
            // Bind checkboxes for initial data
            this.bindCheckboxEvents();
        }
        this.setupTooltips();
    }

    bindEvents() {
        // Add Student Button
        document.getElementById('addStudentBtn').addEventListener('click', () => {
            this.openModal();
        });

        // Close Modal
        const closeModalBtn = document.getElementById('closeModal');
        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                console.log('Close button clicked');
                this.closeModal();
                
                // Fallback: force close if modal doesn't close after 1 second
                setTimeout(() => {
                    const modal = document.getElementById('studentModal');
                    if (modal && !modal.classList.contains('hidden')) {
                        console.log('Modal still visible, force closing...');
                        this.forceCloseModal();
                    }
                }, 1000);
            });
        }

        // Cancel Button
        const cancelBtn = document.getElementById('cancelBtn');
        if (cancelBtn) {
            cancelBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                console.log('Cancel button clicked');
                this.closeModal();
                
                // Fallback: force close if modal doesn't close after 1 second
                setTimeout(() => {
                    const modal = document.getElementById('studentModal');
                    if (modal && !modal.classList.contains('hidden')) {
                        console.log('Modal still visible, force closing...');
                        this.forceCloseModal();
                    }
                }, 1000);
            });
        }

            // Form Submit
    document.getElementById('studentForm').addEventListener('submit', (e) => {
        e.preventDefault();
        this.handleFormSubmit();
    });

        // Search and Filters
        document.getElementById('searchInput').addEventListener('input', this.debounce(() => {
            this.currentPage = 1;
            this.loadStudents();
        }, 300));

        document.getElementById('statusFilter').addEventListener('change', () => {
            this.currentPage = 1;
            this.loadStudents();
        });

        document.getElementById('programFilter').addEventListener('change', () => {
            this.currentPage = 1;
            this.loadStudents();
        });

        document.getElementById('resetFiltersBtn').addEventListener('click', () => {
            this.resetFilters();
        });

        // Select All Checkbox
        document.getElementById('selectAll').addEventListener('change', (e) => {
            this.toggleSelectAll(e.target.checked);
        });

        // Bulk Delete
        document.getElementById('bulkDeleteBtn').addEventListener('click', () => {
            this.bulkDelete();
        });

        // Delete Modal
        const cancelDeleteBtn = document.getElementById('cancelDelete');
        if (cancelDeleteBtn) {
            cancelDeleteBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                console.log('Cancel delete button clicked');
                this.closeDeleteModal();
                
                // Fallback: force close if modal doesn't close after 1 second
                setTimeout(() => {
                    const deleteModal = document.getElementById('deleteModal');
                    if (deleteModal && !deleteModal.classList.contains('hidden')) {
                        console.log('Delete modal still visible, force closing...');
                        this.forceCloseDeleteModal();
                    }
                }, 1000);
            });
        }

        const confirmDeleteBtn = document.getElementById('confirmDelete');
        if (confirmDeleteBtn) {
            confirmDeleteBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                console.log('Confirm delete button clicked');
                this.confirmDelete();
            });
        }

        // Toast Close
        document.getElementById('closeToast').addEventListener('click', () => {
            this.hideToast();
        });

        // Modal Backdrop Click
        const studentModal = document.getElementById('studentModal');
        if (studentModal) {
            studentModal.addEventListener('click', (e) => {
                if (e.target === e.currentTarget) {
                    console.log('Modal backdrop clicked');
                    this.closeModal();
                }
            });
        }

        // Keyboard event for Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const studentModal = document.getElementById('studentModal');
                const deleteModal = document.getElementById('deleteModal');
                
                if (studentModal && !studentModal.classList.contains('hidden')) {
                    console.log('Escape key pressed, closing student modal');
                    this.closeModal();
                } else if (deleteModal && !deleteModal.classList.contains('hidden')) {
                    console.log('Escape key pressed, closing delete modal');
                    this.closeDeleteModal();
                }
            }
        });

        const deleteModal = document.getElementById('deleteModal');
        if (deleteModal) {
            deleteModal.addEventListener('click', (e) => {
                if (e.target === e.currentTarget) {
                    console.log('Delete modal backdrop clicked');
                    this.closeDeleteModal();
                }
            });
        }

        // File Input Change
        document.getElementById('foto').addEventListener('change', (e) => {
            this.handleFileChange(e);
        });
    }

    // Load Students with pagination and filters
    async loadStudents() {
        try {
            // Prevent multiple simultaneous requests
            if (this.isLoading) {
                console.log('Already loading students, skipping...');
                return;
            }
            
            this.isLoading = true;
            this.showLoading();
            
            const search = document.getElementById('searchInput').value;
            const status = document.getElementById('statusFilter').value;
            const programId = document.getElementById('programFilter').value;
            
            const params = new URLSearchParams({
                page: this.currentPage,
                search: search,
                status: status,
                program_id: programId
            });

            console.log('Loading students with params:', params.toString());
            
            const response = await fetch(`/admin/students?${params}`);
            const data = await response.json();

            if (data.success !== false) {
                this.renderStudents(data.data);
                this.renderPagination(data);
                this.updateBulkActions();
            } else {
                this.showError('Gagal memuat data santri');
            }
        } catch (error) {
            console.error('Error loading students:', error);
            this.showError('Terjadi kesalahan saat memuat data');
        } finally {
            this.isLoading = false;
            this.hideLoading();
        }
    }

    // Render Students Table
    renderStudents(students) {
        const tbody = document.getElementById('studentsTableBody');
        const emptyState = document.getElementById('emptyState');
        
        if (!students || students.length === 0) {
            tbody.innerHTML = '';
            emptyState.classList.remove('hidden');
            return;
        }

        emptyState.classList.add('hidden');
        
        tbody.innerHTML = students.map(student => `
            <tr class="hover:bg-gray-50 transition-colors duration-150" data-student-id="${student.id}">
                <td class="px-6 py-4 whitespace-nowrap">
                    <input type="checkbox" class="student-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" value="${student.id}">
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex-shrink-0 h-10 w-10">
                        <img class="h-10 w-10 rounded-full object-cover" 
                             src="${student.foto ? `/storage/${student.foto}` : '/assets/images/default-avatar.png'}" 
                             alt="${student.nama_lengkap}"
                             onerror="this.onerror=null; this.src='/assets/images/default-avatar.png';">
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${student.nis}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${student.nama_lengkap}</div>
                    <div class="text-sm text-gray-500">${student.nama_panggilan || ''}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${student.program?.name || '-'}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${student.kelas}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${this.getStatusBadgeClass(student.status)}">
                        ${this.getStatusDisplay(student.status)}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex space-x-2">
                        <button onclick="studentManager.editStudent(${student.id})" 
                                class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200"
                                title="Edit Santri">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button onclick="studentManager.deleteStudent(${student.id})" 
                                class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                title="Hapus Santri">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');

        // Bind checkbox events
        this.bindCheckboxEvents();
    }

    // Render Pagination
    renderPagination(data) {
        const pagination = document.getElementById('pagination');
        const pageNumbers = document.getElementById('pageNumbers');
        const showingFrom = document.getElementById('showingFrom');
        const showingTo = document.getElementById('showingTo');
        const totalItems = document.getElementById('totalItems');
        const prevPage = document.getElementById('prevPage');
        const nextPage = document.getElementById('nextPage');
        const prevPageMobile = document.getElementById('prevPageMobile');
        const nextPageMobile = document.getElementById('nextPageMobile');

        if (data.total <= data.per_page) {
            pagination.classList.add('hidden');
            return;
        }

        pagination.classList.remove('hidden');
        
        const currentPage = data.current_page;
        const lastPage = data.last_page;
        const from = data.from;
        const to = data.to;
        const total = data.total;

        showingFrom.textContent = from;
        showingTo.textContent = to;
        totalItems.textContent = total;

        // Previous/Next buttons
        prevPage.disabled = currentPage === 1;
        nextPage.disabled = currentPage === lastPage;
        prevPageMobile.disabled = currentPage === 1;
        nextPageMobile.disabled = currentPage === lastPage;

        prevPage.classList.toggle('opacity-50', currentPage === 1);
        nextPage.classList.toggle('opacity-50', currentPage === lastPage);

        // Page numbers
        pageNumbers.innerHTML = this.generatePageNumbers(currentPage, lastPage);

        // Bind pagination events
        prevPage.onclick = () => this.goToPage(currentPage - 1);
        nextPage.onclick = () => this.goToPage(currentPage + 1);
        prevPageMobile.onclick = () => this.goToPage(currentPage - 1);
        nextPageMobile.onclick = () => this.goToPage(currentPage + 1);
    }

    // Generate Page Numbers
    generatePageNumbers(currentPage, lastPage) {
        let pages = [];
        const maxVisible = 5;
        
        if (lastPage <= maxVisible) {
            for (let i = 1; i <= lastPage; i++) {
                pages.push(i);
            }
        } else {
            if (currentPage <= 3) {
                for (let i = 1; i <= 4; i++) {
                    pages.push(i);
                }
                pages.push('...');
                pages.push(lastPage);
            } else if (currentPage >= lastPage - 2) {
                pages.push(1);
                pages.push('...');
                for (let i = lastPage - 3; i <= lastPage; i++) {
                    pages.push(i);
                }
            } else {
                pages.push(1);
                pages.push('...');
                for (let i = currentPage - 1; i <= currentPage + 1; i++) {
                    pages.push(i);
                }
                pages.push('...');
                pages.push(lastPage);
            }
        }

        return pages.map(page => {
            if (page === '...') {
                return '<span class="px-3 py-2 text-gray-500">...</span>';
            }
            
            const isActive = page === currentPage;
            return `
                <button onclick="studentManager.goToPage(${page})" 
                        class="relative inline-flex items-center px-3 py-2 text-sm font-medium ${isActive ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'} border transition-colors duration-200">
                    ${page}
                </button>
            `;
        }).join('');
    }

    // Go to specific page
    goToPage(page) {
        this.currentPage = page;
        this.loadStudents();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Open Modal for Add/Edit
    openModal(student = null) {
        this.currentStudent = student;
        this.isEditing = !!student;
        
        const modal = document.getElementById('studentModal');
        const modalTitle = document.getElementById('modalTitle');
        const submitBtnText = document.getElementById('submitBtnText');
        
        if (this.isEditing) {
            modalTitle.textContent = 'Edit Data Santri';
            submitBtnText.textContent = 'Update';
            this.populateForm(student);
        } else {
            modalTitle.textContent = 'Tambah Santri Baru';
            submitBtnText.textContent = 'Simpan';
            this.resetForm();
        }
        
        modal.classList.remove('hidden');
        modal.classList.add('animate-fade-in');
        
        // Focus first input
        setTimeout(() => {
            document.getElementById('nis').focus();
        }, 100);
    }

    // Close Modal
    closeModal() {
        console.log('Closing modal...');
        const modal = document.getElementById('studentModal');
        if (!modal) {
            console.error('Modal element not found');
            return;
        }
        
        console.log('Modal found, adding fade-out animation');
        modal.classList.add('animate-fade-out');
        
        setTimeout(() => {
            console.log('Removing modal classes and resetting form');
            modal.classList.add('hidden');
            modal.classList.remove('animate-fade-out');
            this.resetForm();
            this.currentStudent = null;
            this.isEditing = false;
            console.log('Modal closed successfully');
            this.checkModalState();
        }, 200);
    }

    // Force Close Modal (emergency method)
    forceCloseModal() {
        console.log('Force closing modal...');
        const modal = document.getElementById('studentModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('animate-fade-in', 'animate-fade-out');
            this.resetForm();
            this.currentStudent = null;
            this.isEditing = false;
            console.log('Modal force closed');
        }
    }

    // Check Modal State
    checkModalState() {
        const modal = document.getElementById('studentModal');
        if (modal) {
            console.log('Modal classes:', modal.className);
            console.log('Modal hidden:', modal.classList.contains('hidden'));
            console.log('Modal visible:', !modal.classList.contains('hidden'));
        } else {
            console.log('Modal element not found');
        }
    }

    // Force Close Delete Modal (emergency method)
    forceCloseDeleteModal() {
        console.log('Force closing delete modal...');
        const modal = document.getElementById('deleteModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('animate-fade-in', 'animate-fade-out');
            this.currentStudent = null;
            console.log('Delete modal force closed');
        }
    }

    // Check Delete Modal State
    checkDeleteModalState() {
        const modal = document.getElementById('deleteModal');
        if (modal) {
            console.log('Delete modal classes:', modal.className);
            console.log('Delete modal hidden:', modal.classList.contains('hidden'));
            console.log('Delete modal visible:', !modal.classList.contains('hidden'));
        } else {
            console.log('Delete modal element not found');
        }
    }

    // Populate Form with Student Data
    populateForm(student) {
        document.getElementById('studentId').value = student.id;
        document.getElementById('nis').value = student.nis;
        document.getElementById('nama_lengkap').value = student.nama_lengkap;
        document.getElementById('nama_panggilan').value = student.nama_panggilan || '';
        document.getElementById('tempat_lahir').value = student.tempat_lahir;
        document.getElementById('tanggal_lahir').value = student.tanggal_lahir;
        document.getElementById('jenis_kelamin').value = student.jenis_kelamin;
        document.getElementById('agama').value = student.agama;
        document.getElementById('alamat').value = student.alamat;
        document.getElementById('program_id').value = student.program_id;
        document.getElementById('kelas').value = student.kelas;
        document.getElementById('status').value = student.status;
        document.getElementById('tanggal_masuk').value = student.tanggal_masuk;
        document.getElementById('nama_ortu').value = student.nama_ortu;
        document.getElementById('telepon_ortu').value = student.telepon_ortu;
        document.getElementById('email_ortu').value = student.email_ortu || '';
        document.getElementById('catatan').value = student.catatan || '';

        // Show current photo if exists
        if (student.foto) {
            document.getElementById('currentFoto').classList.remove('hidden');
            document.getElementById('fotoPreview').src = `/storage/${student.foto}`;
        } else {
            document.getElementById('currentFoto').classList.add('hidden');
        }
    }

    // Reset Form
    resetForm() {
        const form = document.getElementById('studentForm');
        if (form) {
            form.reset();
        }
        
        const studentIdInput = document.getElementById('studentId');
        if (studentIdInput) {
            studentIdInput.value = '';
        }
        
        const currentFoto = document.getElementById('currentFoto');
        if (currentFoto) {
            currentFoto.classList.add('hidden');
        }
        
        this.clearErrors();
    }

    // Handle Form Submit
    async handleFormSubmit() {
        try {
            this.setSubmitLoading(true);
            this.clearErrors();
            
            const formData = new FormData(document.getElementById('studentForm'));
            
            // Get CSRF token from multiple sources
            let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            if (!csrfToken) {
                // Try to get from hidden input
                csrfToken = document.querySelector('input[name="_token"]')?.value;
            }
            
            if (!csrfToken) {
                // Try to get from cookie
                csrfToken = this.getCookie('XSRF-TOKEN');
            }
            
            if (!csrfToken) {
                this.showToast('error', 'CSRF token tidak ditemukan. Silakan refresh halaman.');
                return;
            }

            // Ensure CSRF token is in form data
            formData.append('_token', csrfToken);
            
            const url = this.isEditing 
                ? `/admin/students/${this.currentStudent.id}`
                : '/admin/students';

            const method = this.isEditing ? 'PUT' : 'POST';
            
            // Add _method for PUT requests (Laravel requirement)
            if (this.isEditing) {
                formData.append('_method', 'PUT');
            }

            // Debug: Log the request details
            console.log('Submitting form to:', url);
            console.log('CSRF Token:', csrfToken);
            console.log('Form data entries:');
            for (let [key, value] of formData.entries()) {
                console.log(key + ': ' + value);
            }

            const response = await fetch(url, {
                method: 'POST', // Always use POST for Laravel
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',
                body: formData
            });

            // Debug: Log the response details
            console.log('Response status:', response.status);
            console.log('Response headers:', response.headers);
            console.log('Response redirected:', response.redirected);

            // Check if response is a redirect (302) - session expired
            if (response.redirected) {
                this.showToast('error', 'Sesi Anda telah berakhir. Silakan login ulang.');
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
                return;
            }

            // Handle HTTP error status codes
            if (!response.ok) {
                if (response.status === 401) {
                    this.showToast('error', 'Anda tidak memiliki izin atau sesi Anda telah berakhir. Silakan login ulang.');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                    return;
                }
                if (response.status === 422) {
                    const errorData = await response.json();
                    this.showValidationErrors(errorData.errors || {});
                    this.showToast('error', 'Mohon periksa kembali data yang dimasukkan.');
                    return;
                }
                this.showToast('error', `Error ${response.status}: ${response.statusText}`);
                return;
            }

            const result = await response.json();

            if (result.success) {
                this.showToast('success', result.message || 'Data berhasil disimpan');
                this.closeModal();
                this.loadStudents();
            } else {
                this.showToast('error', result.message || 'Gagal menyimpan data');
            }
        } catch (error) {
            console.error('Error submitting form:', error);
            this.showToast('error', 'Terjadi kesalahan saat menyimpan data');
        } finally {
            this.setSubmitLoading(false);
        }
    }


    // Set Submit Loading State
    setSubmitLoading(loading) {
        const submitBtn = document.getElementById('submitBtn');
        const submitBtnText = document.getElementById('submitBtnText');
        const submitBtnLoading = document.getElementById('submitBtnLoading');
        
        if (loading) {
            submitBtn.disabled = true;
            submitBtnText.classList.add('hidden');
            submitBtnLoading.classList.remove('hidden');
        } else {
            submitBtn.disabled = false;
            submitBtnText.classList.remove('hidden');
            submitBtnLoading.classList.add('hidden');
        }
    }

    // Show Validation Errors
    showValidationErrors(errors) {
        Object.keys(errors).forEach(field => {
            const errorElement = document.getElementById(`${field}Error`);
            if (errorElement) {
                errorElement.textContent = errors[field][0];
                errorElement.classList.remove('hidden');
            }
        });
    }

    // Clear All Errors
    clearErrors() {
        const errorElements = document.querySelectorAll('[id$="Error"]');
        if (errorElements && errorElements.length > 0) {
            errorElements.forEach(element => {
                if (element) {
                    element.classList.add('hidden');
                    element.textContent = '';
                }
            });
        }
    }

    // Edit Student
    async editStudent(studentId) {
        try {
            const response = await fetch(`/admin/students/${studentId}`);
            const data = await response.json();
            
            if (data.success) {
                this.openModal(data.data);
            } else {
                this.showError('Gagal memuat data santri');
            }
        } catch (error) {
            console.error('Error loading student:', error);
            this.showError('Terjadi kesalahan saat memuat data');
        }
    }

    // Delete Student
    deleteStudent(studentId) {
        this.currentStudent = { id: studentId };
        this.openDeleteModal();
    }

    // Open Delete Modal
    openDeleteModal() {
        console.log('Opening delete modal...');
        const modal = document.getElementById('deleteModal');
        if (!modal) {
            console.error('Delete modal element not found');
            return;
        }
        
        console.log('Delete modal found, removing hidden class and adding fade-in animation');
        modal.classList.remove('hidden');
        modal.classList.add('animate-fade-in');
        console.log('Delete modal opened successfully');
    }

    // Close Delete Modal
    closeDeleteModal() {
        console.log('Closing delete modal...');
        const modal = document.getElementById('deleteModal');
        if (!modal) {
            console.error('Delete modal element not found');
            return;
        }
        
        console.log('Delete modal found, adding fade-out animation');
        modal.classList.add('animate-fade-out');
        
        setTimeout(() => {
            console.log('Removing delete modal classes');
            modal.classList.add('hidden');
            modal.classList.remove('animate-fade-out');
            this.currentStudent = null;
            console.log('Delete modal closed successfully');
            this.checkDeleteModalState();
        }, 200);
    }

    // Confirm Delete
    async confirmDelete() {
        try {
            console.log('Confirming delete for student:', this.currentStudent?.id);
            
            const response = await fetch(`/admin/students/${this.currentStudent.id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                                   document.querySelector('input[name="_token"]')?.value
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.showSuccess(data.message);
                console.log('Delete successful, closing modal and reloading students');
                this.closeDeleteModal();
                this.loadStudents();
            } else {
                this.showError(data.message || 'Gagal menghapus santri');
            }
        } catch (error) {
            console.error('Error deleting student:', error);
            this.showError('Terjadi kesalahan saat menghapus data');
        }
    }

    // Bulk Delete
    async bulkDelete() {
        if (this.selectedStudents.size === 0) {
            this.showError('Pilih santri yang akan dihapus');
            return;
        }

        if (!confirm(`Apakah Anda yakin ingin menghapus ${this.selectedStudents.size} santri yang dipilih?`)) {
            return;
        }

        try {
            const response = await fetch('/admin/students/bulk', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                                   document.querySelector('input[name="_token"]')?.value
                },
                body: JSON.stringify({
                    ids: Array.from(this.selectedStudents)
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.showSuccess(data.message);
                this.selectedStudents.clear();
                this.loadStudents();
            } else {
                this.showError(data.message || 'Gagal menghapus santri');
            }
        } catch (error) {
            console.error('Error bulk deleting:', error);
            this.showError('Terjadi kesalahan saat menghapus data');
        }
    }

    // Toggle Select All
    toggleSelectAll(checked) {
        const checkboxes = document.querySelectorAll('.student-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = checked;
            if (checked) {
                this.selectedStudents.add(checkbox.value);
            } else {
                this.selectedStudents.delete(checkbox.value);
            }
        });
        this.updateBulkActions();
    }

    // Bind Checkbox Events
    bindCheckboxEvents() {
        const checkboxes = document.querySelectorAll('.student-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', (e) => {
                if (e.target.checked) {
                    this.selectedStudents.add(e.target.value);
                } else {
                    this.selectedStudents.delete(e.target.value);
                }
                this.updateBulkActions();
            });
        });
    }

    // Update Bulk Actions
    updateBulkActions() {
        const bulkActions = document.getElementById('bulkActions');
        const selectedCount = document.getElementById('selectedCount');
        const selectAll = document.getElementById('selectAll');
        
        if (this.selectedStudents.size > 0) {
            bulkActions.classList.remove('hidden');
            selectedCount.textContent = `${this.selectedStudents.size} santri dipilih`;
            
            // Update select all checkbox
            const checkboxes = document.querySelectorAll('.student-checkbox');
            const allChecked = checkboxes.length > 0 && Array.from(checkboxes).every(cb => cb.checked);
            selectAll.checked = allChecked;
            selectAll.indeterminate = this.selectedStudents.size > 0 && this.selectedStudents.size < checkboxes.length;
        } else {
            bulkActions.classList.add('hidden');
            selectAll.checked = false;
            selectAll.indeterminate = false;
        }
    }

    // Reset Filters
    resetFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('statusFilter').value = '';
        document.getElementById('programFilter').value = '';
        this.currentPage = 1;
        this.loadStudents();
    }

    // Handle File Change
    handleFileChange(event) {
        const file = event.target.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) { // 2MB limit
                this.showError('Ukuran file terlalu besar. Maksimal 2MB.');
                event.target.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('fotoPreview');
                if (preview) {
                    preview.src = e.target.result;
                    document.getElementById('currentFoto').classList.remove('hidden');
                }
            };
            reader.readAsDataURL(file);
        }
    }

    // Show Loading State
    showLoading() {
        document.getElementById('loadingState').classList.remove('hidden');
        document.getElementById('studentsTableBody').innerHTML = '';
    }

    // Hide Loading State
    hideLoading() {
        document.getElementById('loadingState').classList.add('hidden');
    }

    // Show Success Toast
    showSuccess(message) {
        this.showToast('success', message);
    }

    // Show Error Toast
    showError(message) {
        this.showToast('error', message);
    }

    // Show Toast
    showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toastMessage');
        const toastIcon = document.getElementById('toastIcon');
        
        toastMessage.textContent = message;
        
        if (type === 'success') {
            toastIcon.innerHTML = `
                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            `;
        } else {
            toastIcon.innerHTML = `
                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
            `;
        }
        
        toast.classList.remove('hidden');
        toast.classList.add('animate-slide-in');
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            this.hideToast();
        }, 5000);
    }

    // Hide Toast
    hideToast() {
        const toast = document.getElementById('toast');
        toast.classList.add('animate-slide-out');
        
        setTimeout(() => {
            toast.classList.remove('hidden', 'animate-slide-out');
        }, 200);
    }

    // Setup Tooltips
    setupTooltips() {
        // Add tooltip functionality if needed
        const tooltipElements = document.querySelectorAll('[title]');
        tooltipElements.forEach(element => {
            element.addEventListener('mouseenter', (e) => {
                // Tooltip implementation can be added here
            });
        });
    }

    // Utility: Debounce function
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Get cookie value by name
    getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) {
            return parts.pop().split(';').shift();
        }
        return null;
    }

    // Get Status Badge Class
    getStatusBadgeClass(status) {
        const classes = {
            'aktif': 'bg-green-100 text-green-800',
            'nonaktif': 'bg-red-100 text-red-800',
            'lulus': 'bg-blue-100 text-blue-800',
            'pindah': 'bg-yellow-100 text-yellow-800'
        };
        return classes[status] || 'bg-gray-100 text-gray-800';
    }

    // Get Status Display
    getStatusDisplay(status) {
        const displays = {
            'aktif': 'Aktif',
            'nonaktif': 'Nonaktif',
            'lulus': 'Lulus',
            'pindah': 'Pindah'
        };
        return displays[status] || status;
    }

    // Cleanup method to prevent memory leaks
    cleanup() {
        // Remove event listeners
        if (this.searchInput) {
            this.searchInput.removeEventListener('input', this.debouncedSearch);
        }
        if (this.statusFilter) {
            this.statusFilter.removeEventListener('change', this.handleFilterChange);
        }
        if (this.programFilter) {
            this.programFilter.removeEventListener('change', this.handleFilterChange);
        }
        
        // Clear intervals and timeouts
        if (this.searchTimeout) {
            clearTimeout(this.searchTimeout);
        }
        
        // Reset state
        this.selectedStudents.clear();
        this.currentPage = 1;
        this.currentStudent = null;
        this.isEditing = false;
    }
}

// Initialize Student Manager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Check if we're on the students page
    if (document.querySelector('[data-content="mgmt-students"]')) {
        // Only initialize if not already initialized
        if (!window.studentManager) {
            console.log('Initializing StudentManager on DOMContentLoaded...');
            window.studentManager = new StudentManager();
        } else {
            console.log('StudentManager already exists, skipping initialization...');
        }
    }
});

// Also initialize when content is loaded via AJAX
if (typeof window.initializeMainContentUI === 'function') {
    const originalInitializeMainContentUI = window.initializeMainContentUI;
    window.initializeMainContentUI = function() {
        // Call original function
        originalInitializeMainContentUI();
        
        // Check if we need to initialize student manager
        if (document.querySelector('[data-content="mgmt-students"]')) {
            // Clean up existing instance if it exists
            if (window.studentManager) {
                console.log('Cleaning up existing StudentManager...');
                window.studentManager.cleanup();
                window.studentManager = null;
            }
            // Create new instance
            console.log('Initializing new StudentManager after AJAX load...');
            window.studentManager = new StudentManager();
        }
    };
}

// Cleanup when navigating away
window.addEventListener('beforeunload', function() {
    if (window.studentManager) {
        console.log('Cleaning up StudentManager on page unload...');
        window.studentManager.cleanup();
    }
});

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.2s ease-out;
    }
    
    .animate-fade-out {
        animation: fadeOut 0.2s ease-out;
    }
    
    .animate-slide-in {
        animation: slideIn 0.3s ease-out;
    }
    
    .animate-slide-out {
        animation: slideOut 0.3s ease-out;
    }
    
    .transition-all {
        transition: all 0.2s ease-in-out;
    }
    
    .hover\\:scale-105:hover {
        transform: scale(1.05);
    }
    
    .hover\\:scale-105 {
        transition: transform 0.2s ease-in-out;
    }
`;
document.head.appendChild(style);
