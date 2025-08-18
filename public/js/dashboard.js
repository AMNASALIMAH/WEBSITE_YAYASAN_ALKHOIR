// Modal functions
function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.getElementById(modalId).classList.add('animate-in');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

function openMessageModal(messageId) {
    // Here you would typically fetch message details via AJAX
    document.getElementById('messageModal').classList.remove('hidden');
    document.getElementById('messageModal').classList.add('animate-in');
    
    // For demo purposes, show sample content
    document.getElementById('messageContent').innerHTML = `
        <div class="border-b pb-4">
            <p class="text-sm text-gray-600">Dari: <span class="font-medium">John Doe</span></p>
            <p class="text-sm text-gray-600">Email: <span class="font-medium">john@example.com</span></p>
            <p class="text-sm text-gray-600">Waktu: <span class="font-medium">2 jam yang lalu</span></p>
        </div>
        <div class="py-4">
            <p class="text-gray-700">Ini adalah contoh isi pesan yang dikirim oleh pengunjung website. Pesan ini berisi pertanyaan atau informasi yang perlu ditanggapi oleh admin.</p>
        </div>
        <div class="flex space-x-3 pt-4">
            <button onclick="closeMessageModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Tutup
            </button>
            <button onclick="markAsRead('${messageId}')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                Tandai Sudah Dibaca
            </button>
        </div>
    `;
}

function closeMessageModal() {
    document.getElementById('messageModal').classList.add('hidden');
}

function markAsRead(messageId) {
    // Here you would typically make an AJAX call to mark message as read
    showToast('Pesan berhasil ditandai sudah dibaca', 'success');
    closeMessageModal();
}

// Toast notification function
function showToast(message, type = 'info') {
    // Check if we're in a context where the main_app.js showToast should be used
    if (typeof window.showToastFromMainApp === 'function') {
        window.showToastFromMainApp(message, type);
        return;
    }
    
    const toastContainer = document.getElementById('toastContainer');
    if (!toastContainer) {
        console.warn('Toast container not found, falling back to alert');
        // alert(message);
        return;
    }
    
    const toast = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
    
    toast.className = `${bgColor} text-white px-6 py-3 rounded-lg shadow-lg toast-enter`;
    toast.textContent = message;
    
    if (toastContainer.parentNode) {
        toastContainer.appendChild(toast);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            toast.classList.add('toast-exit');
            setTimeout(() => {
                if (toast.parentNode) {
                    toastContainer.removeChild(toast);
                }
            }, 300);
        }, 3000);
    }
}

// Close modals when clicking outside
document.addEventListener('click', function(event) {
    const modals = ['addStudent', 'addNews', 'addExpense', 'messageModal'];
    modals.forEach(modalId => {
        const modal = document.getElementById(modalId);
        if (modal && event.target === modal) {
            closeModal(modalId);
        }
    });
});

// Initialize tooltips and other interactive elements
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth scrolling
    document.documentElement.style.scrollBehavior = 'smooth';
    
    // Add loading states to buttons (excluding logout, form submission buttons, and modal forms)
    const buttons = document.querySelectorAll('button[type="submit"]');
    buttons.forEach(button => {
        // Skip logout button to prevent loading state
        if (button.closest('form') && button.closest('form').action.includes('logout')) {
            return;
        }
        
        // Skip form submission buttons that should work normally
        if (button.closest('form') && (
            button.closest('form').action.includes('income') ||
            button.closest('form').action.includes('expense') ||
            button.closest('form').action.includes('store') ||
            button.closest('form').action.includes('update') ||
            button.closest('form').action.includes('sejarah') ||
            button.closest('form').action.includes('admin')
        )) {
            return;
        }
        
        // Skip buttons in modal forms (addStudent, addNews, addExpense)
        if (button.closest('#addStudent') || button.closest('#addNews') || button.closest('#addExpense')) {
            return;
        }
        
        button.addEventListener('click', function() {
            this.disabled = true;
        });
    });
});