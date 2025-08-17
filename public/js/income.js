let currentIncomeId = null;

function openIncomeModal(incomeId = null) {
    currentIncomeId = incomeId;
    const modal = document.getElementById('incomeModal');
    const modalTitle = document.getElementById('modalTitle');
    const submitButtonText = document.getElementById('submitButtonText');
    const form = document.getElementById('incomeForm');
    const methodInput = document.getElementById('_method');
    const incomeIdInput = document.getElementById('incomeId');
    
    // Reset form
    form.reset();
    
    if (incomeId) {
        // Edit mode
        modalTitle.textContent = 'Edit Pemasukan';
        submitButtonText.textContent = 'Update';
        methodInput.value = 'PUT';
        incomeIdInput.value = incomeId;
        
        // Load income data
        loadIncomeData(incomeId);
    } else {
        // Create mode
        modalTitle.textContent = 'Tambah Pemasukan';
        submitButtonText.textContent = 'Simpan';
        methodInput.value = 'POST';
        incomeIdInput.value = '';
        
        // Set default date to today
        document.getElementById('payment_date').value = new Date().toISOString().split('T')[0];
    }
    
    modal.classList.remove('hidden');
}

function closeIncomeModal() {
    const modal = document.getElementById('incomeModal');
    modal.classList.add('hidden');
    currentIncomeId = null;
}

function loadIncomeData(incomeId) {
    // Fetch income data via AJAX
    fetch(`/admin/management/finance/income-simple/${incomeId}/edit`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const income = data.income;
                document.getElementById('student_name').value = income.student_name;
                document.getElementById('class').value = income.class;
                document.getElementById('amount').value = income.amount;
                document.getElementById('payment_method').value = income.payment_method;
                document.getElementById('receipt_number').value = income.receipt_number;
                document.getElementById('payment_date').value = income.payment_date;
                document.getElementById('status').value = income.status;
                document.getElementById('notes').value = income.notes || '';
            }
        })
        .catch(error => {
            console.error('Error loading income data:', error);
            showToast('Error loading income data', 'error');
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
        toastDiv.className = 'bg-white border-l-4 border-green-500 shadow-lg rounded-lg p-4 max-w-sm';
        toastDiv.querySelector('svg').className = 'h-5 w-5 text-green-400';
    }
    
    toast.classList.remove('hidden');
    
    setTimeout(() => {
        toast.classList.add('hidden');
    }, 3000);
}

// Form submission
document.getElementById('incomeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const url = currentIncomeId 
        ? `/admin/management/finance/income-simple/${currentIncomeId}`
        : '/admin/management/finance/income-simple';
    
    fetch(url, {
        method: currentIncomeId ? 'PUT' : 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message);
            closeIncomeModal();
            // Optionally reload the page or update the table
            if (typeof window.location !== 'undefined') {
                window.location.reload();
            }
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
document.getElementById('incomeModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeIncomeModal();
    }
});
