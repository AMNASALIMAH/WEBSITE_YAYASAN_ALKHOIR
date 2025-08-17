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