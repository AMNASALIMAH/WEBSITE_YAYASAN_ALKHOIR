let currentExpenseId = null;

function openExpenseModal(expenseId = null) {
    currentExpenseId = expenseId;
    const modal = document.getElementById('expenseModal');
    const modalTitle = document.getElementById('modalTitle');
    const submitButtonText = document.getElementById('submitButtonText');
    const form = document.getElementById('expenseForm');
    const methodInput = document.getElementById('_method');
    const expenseIdInput = document.getElementById('expenseId');
    
    // Reset form
    form.reset();
    
    if (expenseId) {
        // Edit mode
        modalTitle.textContent = 'Edit Pengeluaran';
        submitButtonText.textContent = 'Update';
        methodInput.value = 'PUT';
        expenseIdInput.value = expenseId;
        
        // Load expense data
        loadExpenseData(expenseId);
    } else {
        // Create mode
        modalTitle.textContent = 'Tambah Pengeluaran';
        submitButtonText.textContent = 'Simpan';
        methodInput.value = 'POST';
        expenseIdInput.value = '';
        
        // Set default date to today
        document.getElementById('expense_date').value = new Date().toISOString().split('T')[0];
    }
    
    modal.classList.remove('hidden');
}

function closeExpenseModal() {
    const modal = document.getElementById('expenseModal');
    modal.classList.add('hidden');
    currentExpenseId = null;
}

function loadExpenseData(expenseId) {
    // Fetch expense data via AJAX
    fetch(`/admin/management/finance/expense-simple/${expenseId}/edit`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const expense = data.expense;
                document.getElementById('expense_title').value = expense.expense_title;
                document.getElementById('category').value = expense.category;
                document.getElementById('amount').value = expense.amount;
                document.getElementById('expense_date').value = expense.expense_date;
                document.getElementById('receipt_number').value = expense.receipt_number;
                document.getElementById('status').value = expense.status;
                document.getElementById('description').value = expense.description;
                document.getElementById('notes').value = expense.notes || '';
            }
        })
        .catch(error => {
            console.error('Error loading expense data:', error);
            showToast('Error loading expense data', 'error');
        });
}

function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toastMessage');
    
    toastMessage.textContent = message;
    
    // Update toast styling based on type
    const toastDiv = toast.querySelector('div');
    if (type === 'error') {
        toastDiv.className = 'bg-white border-l-4 border-red-500 shadow-lg rounded-lg p-4 max-w-sm';
        toastDiv.querySelector('svg').className = 'h-5 w-5 text-red-400';
    } else {
        toastDiv.className = 'bg-white border-l-4 border-red-500 shadow-lg rounded-lg p-4 max-w-sm';
        toastDiv.querySelector('svg').className = 'h-5 w-5 text-red-400';
    }
    
    toast.classList.remove('hidden');
    
    setTimeout(() => {
        toast.classList.add('hidden');
    }, 3000);
}

// Form submission
document.getElementById('expenseForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const url = currentExpenseId 
        ? `/admin/management/finance/expense-simple/${currentExpenseId}`
        : '/admin/management/finance/expense-simple';
    
    fetch(url, {
        method: currentExpenseId ? 'PUT' : 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message);
            closeExpenseModal();
            // Reload the page to show updated data
            window.location.reload();
        } else {
            showToast(data.message || 'An error occurred', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while saving', 'error');
    });
});

// Close modal when clicking outside
document.getElementById('expenseModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeExpenseModal();
    }
});