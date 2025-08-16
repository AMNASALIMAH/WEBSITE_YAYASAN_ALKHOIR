// Program Management JavaScript
class ProgramManager {
    constructor() {
        this.csrfToken = this.getCsrfToken();
        this.initializeEventListeners();
    }

    getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
               document.querySelector('input[name="_token"]')?.value ||
               this.getCookie('XSRF-TOKEN');
    }

    getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    initializeEventListeners() {
        // Add any additional event listeners here
        document.addEventListener('DOMContentLoaded', () => {
            this.setupTooltips();
            this.setupKeyboardShortcuts();
        });
    }

    setupTooltips() {
        // Initialize tooltips for better UX
        const tooltipElements = document.querySelectorAll('[title]');
        tooltipElements.forEach(element => {
            element.addEventListener('mouseenter', (e) => {
                this.showTooltip(e.target, e.target.title);
            });
            
            element.addEventListener('mouseleave', () => {
                this.hideTooltip();
            });
        });
    }

    showTooltip(element, text) {
        const tooltip = document.createElement('div');
        tooltip.className = 'fixed z-50 px-2 py-1 text-sm text-white bg-gray-900 rounded shadow-lg pointer-events-none';
        tooltip.textContent = text;
        tooltip.id = 'custom-tooltip';
        
        document.body.appendChild(tooltip);
        
        const rect = element.getBoundingClientRect();
        tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
        tooltip.style.top = rect.top - tooltip.offsetHeight - 8 + 'px';
        
        // Add animation
        tooltip.style.opacity = '0';
        tooltip.style.transform = 'translateY(10px)';
        tooltip.style.transition = 'all 0.2s ease-out';
        
        setTimeout(() => {
            tooltip.style.opacity = '1';
            tooltip.style.transform = 'translateY(0)';
        }, 10);
    }

    hideTooltip() {
        const tooltip = document.getElementById('custom-tooltip');
        if (tooltip) {
            tooltip.style.opacity = '0';
            tooltip.style.transform = 'translateY(10px)';
            setTimeout(() => {
                if (tooltip.parentNode) {
                    tooltip.parentNode.removeChild(tooltip);
                }
            }, 200);
        }
    }

    setupKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            // Ctrl/Cmd + N for new program
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                const newButton = document.querySelector('[data-action="new-program"]');
                if (newButton) newButton.click();
            }
            
            // Escape to close modals
            if (e.key === 'Escape') {
                this.closeAllModals();
            }
        });
    }

    closeAllModals() {
        // Close any open modals
        const modals = document.querySelectorAll('[x-show]');
        modals.forEach(modal => {
            if (modal.style.display !== 'none') {
                modal.style.display = 'none';
            }
        });
    }

    // Utility function to show loading state
    showLoading(element) {
        const originalText = element.textContent;
        element.textContent = 'Memuat...';
        element.disabled = true;
        element.classList.add('opacity-50');
        
        return () => {
            element.textContent = originalText;
            element.disabled = false;
            element.classList.remove('opacity-50');
        };
    }

    // Utility function to format currency
    formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(amount);
    }

    // Utility function to format date
    formatDate(dateString) {
        if (!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    // Utility function to validate form
    validateForm(formData) {
        const errors = [];
        
        if (!formData.get('name')?.trim()) {
            errors.push('Nama program wajib diisi');
        }
        
        if (!formData.get('category')?.trim()) {
            errors.push('Kategori wajib dipilih');
        }
        
        if (!formData.get('status')) {
            errors.push('Status wajib dipilih');
        }
        
        return errors;
    }

    // Utility function to show error messages
    showErrors(errors) {
        if (errors.length === 0) return;
        
        const errorHtml = errors.map(error => `<li>${error}</li>`).join('');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4';
        errorDiv.innerHTML = `
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            ${errorHtml}
                        </ul>
                    </div>
                </div>
            </div>
        `;
        
        // Insert error message at the top of the form
        const form = document.querySelector('form');
        if (form) {
            form.insertBefore(errorDiv, form.firstChild);
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
                if (errorDiv.parentNode) {
                    errorDiv.parentNode.removeChild(errorDiv);
                }
            }, 5000);
        }
    }

    // Utility function to debounce search
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

    // Export data functionality
    exportToCSV(data, filename = 'programs.csv') {
        const headers = ['Nama Program', 'Kategori', 'Status', 'Deskripsi', 'Tanggal Dibuat'];
        const csvContent = [
            headers.join(','),
            ...data.map(item => [
                `"${item.name}"`,
                `"${item.category}"`,
                `"${item.status === 'active' ? 'Aktif' : 'Nonaktif'}"`,
                `"${item.description || ''}"`,
                `"${this.formatDate(item.created_at)}"`
            ].join(','))
        ].join('\n');
        
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', filename);
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // Print functionality
    printPrograms() {
        const printWindow = window.open('', '_blank');
        const programs = this.getProgramsData();
        
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

    getProgramsData() {
        // This should be implemented based on your data structure
        // For now, returning empty array
        return [];
    }
}

// Initialize the program manager when the page loads
document.addEventListener('DOMContentLoaded', () => {
    window.programManager = new ProgramManager();
});

// Export for use in other modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ProgramManager;
}
