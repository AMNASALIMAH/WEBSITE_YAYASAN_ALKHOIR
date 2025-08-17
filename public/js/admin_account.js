// Admin Accounts Management JavaScript
class AdminAccountsManager {
    constructor() {
        // Prevent multiple instances
        if (window.adminAccountsManager) {
            console.log('AdminAccountsManager already exists, returning existing instance');
            return window.adminAccountsManager;
        }
        
        this.currentPage = 1;
        this.itemsPerPage = 10;
        this.totalItems = 0;
        this.filteredData = [];
        this.selectedItems = new Set();
        this.currentUserId = null;
        this.isEditMode = false;

        // Define all API routes in one place for easy management
        this.routes = {
            list: '/api/admin/accounts',
            detail: (id) => `/api/admin/accounts/${id}`,
            create: '/api/admin/accounts',
            update: (id) => `/api/admin/accounts/${id}`,
            delete: (id) => `/api/admin/accounts/${id}`,
            bulkDelete: '/api/admin/accounts/bulk'
        };

        this.init();
        
        // Store instance globally
        window.adminAccountsManager = this;
    }

    init() {
        this.checkAuthentication();
        this.bindEvents();
        this.loadData();
    }

    checkAuthentication() {
        // Check if user is authenticated by looking for auth elements
        const authElement = document.querySelector('[data-content="mgmt-admin-accounts"]');
        if (!authElement) {
            console.error('Admin accounts management element not found');
            return;
        }

        // Check if CSRF token exists
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error('CSRF token not found');
            this.showToast('error', 'Token keamanan tidak ditemukan. Silakan refresh halaman.');
            return;
        }
    }

    bindEvents() {
        // Form submission
        document.getElementById('adminForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleFormSubmit();
        });

        // Select all checkbox
        document.getElementById('selectAll').addEventListener('change', (e) => {
            this.toggleSelectAll(e.target.checked);
        });

        // Search input
        document.getElementById('searchInput').addEventListener('input', (e) => {
            this.debounce(() => this.filterData(), 300);
        });

        // Role and status filters
        document.getElementById('roleFilter').addEventListener('change', () => {
            this.filterData();
        });

        document.getElementById('statusFilter').addEventListener('change', () => {
            this.filterData();
        });

        // Delegate checkbox events for dynamically added rows
        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('user-checkbox')) {
                this.updateBulkActions();
            }
        });
    }

    setupSearchAndFilter() {
        // Debounce function for search
        this.debounce = (func, wait) => {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        };
    }

    async loadData() {
        try {
            this.showLoading(true);

            const response = await fetch(this.routes.list, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            });

            // Check if response is a redirect (302)
            if (response.redirected) {
                this.handleSessionExpiration();
                return;
            }

            // Handle HTTP error status codes
            if (this.handleHttpError(response)) {
                return;
            }

            // Check if response is not JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                this.showToast('error', 'Terjadi kesalahan pada server. Silakan coba lagi.');
                return;
            }

            const result = await response.json();

            if (result.success) {
                this.filteredData = result.data;
                this.totalItems = result.data.length;
                this.renderTable();
                this.updatePagination();
            } else {
                this.showToast('error', result.message || 'Gagal memuat data');
            }
        } catch (error) {
            console.error('Error loading admin accounts:', error);
            this.showToast('error', 'Terjadi kesalahan saat memuat data');
        } finally {
            this.showLoading(false);
        }
    }

    filterData() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const roleFilter = document.getElementById('roleFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;

        // Get original data from the table
        const originalData = Array.from(document.querySelectorAll('#adminAccountsTable tr')).map(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length === 0) return null;

            return {
                id: row.dataset.userId,
                name: cells[1]?.textContent?.trim() || '',
                email: cells[2]?.textContent?.trim() || '',
                role: cells[3]?.textContent?.trim() || '',
                status: cells[4]?.textContent?.trim() || '',
                created_at: cells[5]?.textContent?.trim() || ''
            };
        }).filter(Boolean);

        // Apply filters
        this.filteredData = originalData.filter(item => {
            const matchesSearch = !searchTerm ||
                item.name.toLowerCase().includes(searchTerm) ||
                item.email.toLowerCase().includes(searchTerm);

            const matchesRole = !roleFilter || item.role === roleFilter;
            const matchesStatus = !statusFilter || item.status === statusFilter;

            return matchesSearch && matchesRole && matchesStatus;
        });

        this.totalItems = this.filteredData.length;
        this.currentPage = 1;
        this.renderTable();
        this.updatePagination();
    }

    renderTable() {
        const tbody = document.getElementById('adminAccountsTable');
        const startIndex = (this.currentPage - 1) * this.itemsPerPage;
        const endIndex = startIndex + this.itemsPerPage;
        const pageData = this.filteredData.slice(startIndex, endIndex);

        if (pageData.length === 0) {
            this.showEmptyState();
            return;
        }

        tbody.innerHTML = pageData.map(user => this.renderTableRow(user)).join('');
        this.updateBulkActions();
    }

    renderTableRow(user) {
        const roleBadge = this.getRoleBadge(user.role);
        const statusBadge = this.getStatusBadge(user.status);
        const isSelected = this.selectedItems.has(user.id);

        return `
            <tr data-user-id="${user.id}" class="hover:bg-gray-50 transition-colors duration-150">
                <td class="px-6 py-4 whitespace-nowrap">
                    <input type="checkbox" 
                           class="user-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                           value="${user.id}" 
                           ${isSelected ? 'checked' : ''}>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${user.name}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${user.email}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    ${roleBadge}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    ${statusBadge}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${this.formatDate(user.created_at)}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex items-center space-x-2">
                        <button onclick="adminAccountsManager.editUser('${user.id}')" 
                                class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button onclick="adminAccountsManager.deleteUser('${user.id}')" 
                                class="text-red-600 hover:text-red-900 transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    }

    getRoleBadge(role) {
        const badges = {
            'super_admin': '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Super Admin</span>',
            'admin': '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Admin</span>',
            'editor': '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Editor</span>',
            'viewer': '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Viewer</span>'
        };
        return badges[role] || role;
    }

    getStatusBadge(status) {
        const badges = {
            'active': '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>',
            'pending': '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pending</span>',
            'inactive': '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Nonaktif</span>'
        };
        return badges[status] || status;
    }

    formatDate(dateString) {
        if (!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
    }

    updatePagination() {
        const totalPages = Math.ceil(this.totalItems / this.itemsPerPage);
        const showingInfo = document.getElementById('showingInfo');
        const paginationButtons = document.getElementById('paginationButtons');

        const startItem = (this.currentPage - 1) * this.itemsPerPage + 1;
        const endItem = Math.min(this.currentPage * this.itemsPerPage, this.totalItems);

        showingInfo.textContent = `Menampilkan ${startItem} sampai ${endItem} dari ${this.totalItems} hasil`;

        if (totalPages <= 1) {
            paginationButtons.innerHTML = '';
            return;
        }

        let buttons = '';

        // Previous button
        if (this.currentPage > 1) {
            buttons += `
                <button onclick="adminAccountsManager.goToPage(${this.currentPage - 1})" 
                        class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50 transition-colors duration-200">
                    Sebelumnya
                </button>
            `;
        }

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            if (i === this.currentPage) {
                buttons += `
                    <button class="px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600">
                        ${i}
                    </button>
                `;
            } else {
                buttons += `
                    <button onclick="adminAccountsManager.goToPage(${i})" 
                            class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                        ${i}
                    </button>
                `;
            }
        }

        // Next button
        if (this.currentPage < totalPages) {
            buttons += `
                <button onclick="adminAccountsManager.goToPage(${this.currentPage + 1})" 
                        class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50 transition-colors duration-200">
                    Selanjutnya
                </button>
            `;
        }

        paginationButtons.innerHTML = buttons;
    }

    goToPage(page) {
        this.currentPage = page;
        this.renderTable();
        this.updatePagination();
    }

    showLoading(show) {
        const loadingState = document.getElementById('loadingState');
        const table = document.querySelector('table');

        if (show) {
            loadingState.classList.remove('hidden');
            table.classList.add('hidden');
        } else {
            loadingState.classList.add('hidden');
            table.classList.remove('hidden');
        }
    }

    showEmptyState() {
        const tbody = document.getElementById('adminAccountsTable');
        const emptyState = document.getElementById('emptyState');

        tbody.innerHTML = '';
        emptyState.classList.remove('hidden');
    }

    // Modal Management
    openCreateModal() {
        this.isEditMode = false;
        this.currentUserId = null;
        this.resetForm();
        document.getElementById('modalTitle').textContent = 'Tambah Akun Admin';
        document.getElementById('passwordRequired').classList.remove('hidden');
        document.getElementById('password').required = true;
        document.getElementById('adminModal').classList.remove('hidden');

        // Add animation
        setTimeout(() => {
            document.querySelector('#adminModal .relative').classList.add('animate-in', 'slide-in-from-top-2');
        }, 10);
    }

    async editUser(userId) {
        try {
            const response = await fetch(this.routes.detail(userId), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            });

            // Check if response is a redirect (302)
            if (response.redirected) {
                this.handleSessionExpiration();
                return;
            }

            // Handle HTTP error status codes
            if (this.handleHttpError(response)) {
                return;
            }

            // Check if response is not JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                this.showToast('error', 'Terjadi kesalahan pada server. Silakan coba lagi.');
                return;
            }

            const result = await response.json();

            if (result.success) {
                this.isEditMode = true;
                this.currentUserId = userId;
                this.populateForm(result.data);
                document.getElementById('modalTitle').textContent = 'Edit Akun Admin';
                document.getElementById('passwordRequired').classList.add('hidden');
                document.getElementById('password').required = false;
                document.getElementById('adminModal').classList.remove('hidden');

                // Add animation
                setTimeout(() => {
                    document.querySelector('#adminModal .relative').classList.add('animate-in', 'slide-in-from-top-2');
                }, 10);
            } else {
                this.showToast('error', result.message || 'Gagal memuat data akun');
            }
        } catch (error) {
            console.error('Error loading user data:', error);
            this.showToast('error', 'Terjadi kesalahan saat memuat data akun');
        }
    }

    populateForm(user) {
        document.getElementById('userId').value = user.id;
        document.getElementById('name').value = user.name;
        document.getElementById('email').value = user.email;
        document.getElementById('role').value = user.role;
        document.getElementById('status').value = user.status;
        document.getElementById('password').value = '';
    }

    resetForm() {
        document.getElementById('adminForm').reset();
        document.getElementById('userId').value = '';
    }

    closeModal() {
        document.getElementById('adminModal').classList.add('hidden');
        document.querySelector('#adminModal .relative').classList.remove('animate-in', 'slide-in-from-top-2');
        this.resetForm();
    }

    async handleFormSubmit() {
        try {
            const formData = new FormData(document.getElementById('adminForm'));
            const data = Object.fromEntries(formData.entries());

            // Remove empty password in edit mode
            if (this.isEditMode && !data.password) {
                delete data.password;
            }

            const url = this.isEditMode
                ? this.routes.update(this.currentUserId)
                : this.routes.create;

            const method = this.isEditMode ? 'PUT' : 'POST';

            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify(data)
            });

            // Check if response is a redirect (302)
            if (response.redirected) {
                this.handleSessionExpiration();
                return;
            }

            // Handle HTTP error status codes
            if (this.handleHttpError(response)) {
                return;
            }

            // Check if response is not JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                this.showToast('error', 'Terjadi kesalahan pada server. Silakan coba lagi.');
                return;
            }

            const result = await response.json();

            if (result.success) {
                this.showToast('success', result.message);
                this.closeModal();
                this.loadData();
            } else {
                this.showToast('error', result.message || 'Gagal menyimpan data');
            }
        } catch (error) {
            console.error('Error submitting form:', error);
            this.showToast('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    // Delete Management
    deleteUser(userId) {
        this.currentUserId = userId;
        document.getElementById('deleteModal').classList.remove('hidden');

        // Add animation
        setTimeout(() => {
            document.querySelector('#deleteModal .relative').classList.add('animate-in', 'slide-in-from-top-2');
        }, 10);
    }

    closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.querySelector('#deleteModal .relative').classList.remove('animate-in', 'slide-in-from-top-2');
        this.currentUserId = null;
    }

    closeDeleteModalTambah() {
        document.getElementById('adminModal').classList.add('hidden');
        document.querySelector('#adminModal .relative').classList.remove('animate-in', 'slide-in-from-top-2');
        this.currentUserId = null;
    }

    async confirmDelete() {
        try {
            const response = await fetch(this.routes.delete(this.currentUserId), {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            });

            // Check if response is a redirect (302)
            if (response.redirected) {
                this.handleSessionExpiration();
                return;
            }

            // Handle HTTP error status codes
            if (this.handleHttpError(response)) {
                return;
            }

            // Check if response is not JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                this.showToast('error', 'Terjadi kesalahan pada server. Silakan coba lagi.');
                return;
            }

            const result = await response.json();

            if (result.success) {
                this.showToast('success', result.message);
                this.closeDeleteModal();
                this.loadData();
            } else {
                this.showToast('error', result.message || 'Gagal menghapus akun');
            }
        } catch (error) {
            console.error('Error deleting user:', error);
            this.showToast('error', 'Terjadi kesalahan saat menghapus akun');
        }
    }

    // Bulk Actions
    toggleSelectAll(checked) {
        const checkboxes = document.querySelectorAll('.user-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = checked;
            if (checked) {
                this.selectedItems.add(checkbox.value);
            } else {
                this.selectedItems.delete(checkbox.value);
            }
        });
        this.updateBulkActions();
    }

    updateBulkActions() {
        const checkboxes = document.querySelectorAll('.user-checkbox:checked');
        this.selectedItems = new Set(Array.from(checkboxes).map(cb => cb.value));

        const bulkActions = document.getElementById('bulkActions');
        const selectedCount = document.getElementById('selectedCount');

        if (this.selectedItems.size > 0) {
            bulkActions.classList.remove('hidden');
            selectedCount.textContent = this.selectedItems.size;
        } else {
            bulkActions.classList.add('hidden');
        }
    }

    clearSelection() {
        this.selectedItems.clear();
        document.querySelectorAll('.user-checkbox').forEach(cb => cb.checked = false);
        document.getElementById('selectAll').checked = false;
        this.updateBulkActions();
    }

    async bulkDelete() {
        if (this.selectedItems.size === 0) return;

        if (!confirm(`Apakah Anda yakin ingin menghapus ${this.selectedItems.size} akun yang dipilih?`)) {
            return;
        }

        try {
            const response = await fetch(this.routes.bulkDelete, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    ids: Array.from(this.selectedItems)
                })
            });

            // Check if response is a redirect (302)
            if (response.redirected) {
                this.handleSessionExpiration();
                return;
            }

            // Handle HTTP error status codes
            if (this.handleHttpError(response)) {
                return;
            }

            // Check if response is not JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                this.showToast('error', 'Terjadi kesalahan pada server. Silakan coba lagi.');
                return;
            }

            const result = await response.json();

            if (result.success) {
                this.showToast('success', result.message);
                this.clearSelection();
                this.loadData();
            } else {
                this.showToast('error', result.message || 'Gagal menghapus akun');
            }
        } catch (error) {
            console.error('Error bulk deleting users:', error);
            this.showToast('error', 'Terjadi kesalahan saat menghapus akun');
        }
    }

    handleSessionExpiration() {
        this.showToast('error', 'Sesi Anda telah berakhir. Silakan login kembali.');
        // Redirect to login page after a short delay
        setTimeout(() => {
            window.location.href = '/login';
        }, 2000);
    }

    handleHttpError(response) {
        if (response.status === 401) {
            this.handleSessionExpiration();
            return true;
        } else if (response.status === 403) {
            this.showToast('error', 'Anda tidak memiliki izin untuk melakukan aksi ini');
            return true;
        } else if (response.status === 404) {
            this.showToast('error', 'Data tidak ditemukan');
            return true;
        } else if (response.status >= 500) {
            this.showToast('error', 'Terjadi kesalahan pada server. Silakan coba lagi nanti');
            return true;
        }
        return false;
    }

    // Toast Management
    showToast(type, message) {
        const toast = document.getElementById('toast');
        const toastIcon = document.getElementById('toastIcon');
        const toastMessage = document.getElementById('toastMessage');

        // Set icon and message
        if (type === 'success') {
            toastIcon.innerHTML = `
                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            `;
        } else {
            toastIcon.innerHTML = `
                <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
            `;
        }

        toastMessage.textContent = message;
        toast.classList.remove('hidden');

        // Auto hide after 5 seconds
        setTimeout(() => {
            this.hideToast();
        }, 5000);
    }

    hideToast() {
        document.getElementById('toast').classList.add('hidden');
    }

    // Cleanup method to prevent memory leaks
    cleanup() {
        // Remove event listeners
        if (this.searchInput) {
            this.searchInput.removeEventListener('input', this.debouncedSearch);
        }
        if (this.roleFilter) {
            this.roleFilter.removeEventListener('change', this.handleFilterChange);
        }
        if (this.statusFilter) {
            this.statusFilter.removeEventListener('change', this.handleFilterChange);
        }
        
        // Clear intervals and timeouts
        if (this.searchTimeout) {
            clearTimeout(this.searchTimeout);
        }
        
        // Reset state
        this.selectedItems.clear();
        this.currentPage = 1;
        this.filteredData = [];
        this.currentUserId = null;
        this.isEditMode = false;
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Check if we're on the admin accounts page
    if (document.querySelector('[data-content="mgmt-admin-accounts"]')) {
        // Only initialize if not already initialized
        if (!window.adminAccountsManager) {
            console.log('Initializing AdminAccountsManager on DOMContentLoaded...');
            window.adminAccountsManager = new AdminAccountsManager();
        } else {
            console.log('AdminAccountsManager already exists, skipping initialization...');
        }
    }
});

// Also initialize when content is loaded via AJAX
if (typeof window.initializeMainContentUI === 'function') {
    const originalInitializeMainContentUI = window.initializeMainContentUI;
    window.initializeMainContentUI = function() {
        // Call original function
        originalInitializeMainContentUI();
        
        // Check if we need to initialize admin accounts manager
        if (document.querySelector('[data-content="mgmt-admin-accounts"]')) {
            // Clean up existing instance if it exists
            if (window.adminAccountsManager) {
                console.log('Cleaning up existing AdminAccountsManager...');
                window.adminAccountsManager.cleanup();
                window.adminAccountsManager = null;
            }
            // Create new instance
            console.log('Initializing new AdminAccountsManager after AJAX load...');
            window.adminAccountsManager = new AdminAccountsManager();
        }
    };
}

// Cleanup when navigating away
window.addEventListener('beforeunload', function() {
    if (window.adminAccountsManager) {
        console.log('Cleaning up AdminAccountsManager on page unload...');
        window.adminAccountsManager.cleanup();
    }
});

// Global functions for onclick handlers
function openCreateModal() {
    if (window.adminAccountsManager) {
        window.adminAccountsManager.openCreateModal();
    }
}

function closeModal() {
    if (window.adminAccountsManager) {
        window.adminAccountsManager.closeModal();
    }
}

function editUser(userId) {
    if (window.adminAccountsManager) {
        window.adminAccountsManager.editUser(userId);
    }
}

function deleteUser(userId) {
    if (window.adminAccountsManager) {
        window.adminAccountsManager.deleteUser(userId);
    }
}

function confirmDelete() {
    if (window.adminAccountsManager) {
        window.adminAccountsManager.confirmDelete();
    }
}

function closeDeleteModal() {
    if (window.adminAccountsManager) {
        window.adminAccountsManager.closeDeleteModal();
    }
}

function closeDeleteModalTambah() {
    if (window.adminAccountsManager) {
        window.adminAccountsManager.closeDeleteModalTambah();
    }
}

function bulkDelete() {
    if (window.adminAccountsManager) {
        window.adminAccountsManager.bulkDelete();
    }
}

function clearSelection() {
    if (window.adminAccountsManager) {
        window.adminAccountsManager.clearSelection();
    }
}

function hideToast() {
    if (window.adminAccountsManager) {
        window.adminAccountsManager.hideToast();
    }
}
