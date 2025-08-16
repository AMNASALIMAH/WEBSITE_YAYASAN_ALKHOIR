@extends('admin.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-50">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Manajemen Pemasukan</h1>
                    <p class="mt-2 text-gray-600">Kelola semua data pemasukan dan pembayaran SPP</p>
                </div>
                <div class="flex space-x-3">
                    <button onclick="openAddIncomeModal()" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-all duration-200 hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Pemasukan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="search" placeholder="Cari nama santri, kelas, atau nomor kwitansi..." 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200">
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="statusFilter" class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200">
                        <option value="">Semua Status</option>
                        <option value="completed">Selesai</option>
                        <option value="pending">Pending</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </div>

                <!-- Date Filter -->
                <div>
                    <label for="dateFilter" class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                    <input type="month" id="dateFilter" 
                           class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200">
                </div>
            </div>
        </div>

        <!-- Income List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Pemasukan</h3>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-500">Total: <span class="font-semibold">{{ $income->total() }}</span> data</span>
                    </div>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Santri</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode Pembayaran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="incomeTableBody">
                        @forelse($income as $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-150" data-id="{{ $item->id }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $item->student_name }}</div>
                                <div class="text-sm text-gray-500">No. Kwitansi: {{ $item->receipt_number }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->class }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">Rp {{ number_format($item->amount, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->payment_method }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item->status === 'completed')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3"/>
                                        </svg>
                                        Selesai
                                    </span>
                                @elseif($item->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3"/>
                                        </svg>
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3"/>
                                        </svg>
                                        Dibatalkan
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->payment_date->format('d/m/Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <button onclick="viewIncome({{ $item->id }})" class="text-blue-600 hover:text-blue-900 transition-colors duration-200" title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="editIncome({{ $item->id }})" class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="deleteIncome({{ $item->id }})" class="text-red-600 hover:text-red-900 transition-colors duration-200" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-lg font-medium text-gray-900 mb-2">Belum ada data pemasukan</p>
                                    <p class="text-gray-500">Mulai dengan menambahkan data pemasukan pertama</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($income->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $income->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Add/Edit Income Modal -->
<div id="incomeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">Tambah Pemasukan</h3>
                <button onclick="closeIncomeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <form id="incomeForm" class="space-y-4">
                @csrf
                <input type="hidden" id="incomeId" name="income_id">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="student_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Santri *</label>
                        <input type="text" id="student_name" name="student_name" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200">
                    </div>
                    
                    <div>
                        <label for="class" class="block text-sm font-medium text-gray-700 mb-2">Kelas *</label>
                        <select id="class" name="class" required
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200">
                            <option value="">Pilih Kelas</option>
                            <option value="SD 1">SD 1</option>
                            <option value="SD 2">SD 2</option>
                            <option value="SD 3">SD 3</option>
                            <option value="SD 4">SD 4</option>
                            <option value="SD 5">SD 5</option>
                            <option value="SD 6">SD 6</option>
                            <option value="SMP 1">SMP 1</option>
                            <option value="SMP 2">SMP 2</option>
                            <option value="SMP 3">SMP 3</option>
                            <option value="SMA 1">SMA 1</option>
                            <option value="SMA 2">SMA 2</option>
                            <option value="SMA 3">SMA 3</option>
                        </select>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Jumlah (Rp) *</label>
                        <input type="number" id="amount" name="amount" step="0.01" min="0" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200">
                    </div>
                    
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran *</label>
                        <select id="payment_method" name="payment_method" required
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200">
                            <option value="">Pilih Metode</option>
                            <option value="Tunai">Tunai</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="E-Wallet">E-Wallet</option>
                            <option value="QRIS">QRIS</option>
                        </select>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="receipt_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Kwitansi *</label>
                        <input type="text" id="receipt_number" name="receipt_number" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200">
                    </div>
                    
                    <div>
                        <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pembayaran *</label>
                        <input type="date" id="payment_date" name="payment_date" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200">
                    </div>
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select id="status" name="status" required
                            class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200">
                        <option value="pending">Pending</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </div>
                
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                    <textarea id="notes" name="notes" rows="3"
                              class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200"></textarea>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeIncomeModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-all duration-200 hover:shadow-lg">
                        <span id="submitButtonText">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Income Modal -->
<div id="viewIncomeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Detail Pemasukan</h3>
                <button onclick="closeViewIncomeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div id="viewIncomeContent" class="space-y-4">
                <!-- Income details will be loaded here -->
            </div>
            
            <div class="flex justify-end space-x-3 mt-6">
                <button onclick="closeViewIncomeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Konfirmasi Hapus</h3>
            <p class="text-sm text-gray-500 mb-6">Apakah Anda yakin ingin menghapus data pemasukan ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex justify-center space-x-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                    Batal
                </button>
                <button onclick="confirmDelete()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-all duration-200">
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div id="toast" class="fixed top-4 right-4 z-50 hidden">
    <div class="bg-white border-l-4 border-green-500 shadow-lg rounded-lg p-4 max-w-sm">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-900" id="toastMessage"></p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.tailwindcss.com"></script>
<script>
let currentIncomeId = null;
let deleteIncomeId = null;

// Toast notification function
function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toastMessage');
    
    // Change border color based on type
    const borderClass = type === 'success' ? 'border-green-500' : 'border-red-500';
    const iconClass = type === 'success' ? 'text-green-400' : 'text-red-400';
    
    toast.querySelector('.border-l-4').className = `border-l-4 ${borderClass}`;
    toast.querySelector('svg').className = `h-5 w-5 ${iconClass}`;
    
    toastMessage.textContent = message;
    toast.classList.remove('hidden');
    
    setTimeout(() => {
        toast.classList.add('hidden');
    }, 3000);
}

// Modal functions
function openAddIncomeModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Pemasukan';
    document.getElementById('submitButtonText').textContent = 'Simpan';
    document.getElementById('incomeForm').reset();
    document.getElementById('incomeId').value = '';
    currentIncomeId = null;
    document.getElementById('incomeModal').classList.remove('hidden');
}

function closeIncomeModal() {
    document.getElementById('incomeModal').classList.add('hidden');
}

function openViewIncomeModal() {
    document.getElementById('viewIncomeModal').classList.remove('hidden');
}

function closeViewIncomeModal() {
    document.getElementById('viewIncomeModal').classList.add('hidden');
}

function openDeleteModal() {
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// CRUD operations
function viewIncome(id) {
    // Fetch income data and display in modal
    fetch(`/admin/management/finance/income/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayIncomeDetails(data.data);
                openViewIncomeModal();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Gagal memuat data pemasukan', 'error');
        });
}

function displayIncomeDetails(income) {
    const content = document.getElementById('viewIncomeContent');
    content.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Santri</label>
                <p class="mt-1 text-sm text-gray-900">${income.student_name}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Kelas</label>
                <p class="mt-1 text-sm text-gray-900">${income.class}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                <p class="mt-1 text-sm font-semibold text-gray-900">Rp ${parseInt(income.amount).toLocaleString('id-ID')}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                <p class="mt-1 text-sm text-gray-900">${income.payment_method}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nomor Kwitansi</label>
                <p class="mt-1 text-sm text-gray-900">${income.receipt_number}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <p class="mt-1">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                        income.status === 'completed' ? 'bg-green-100 text-green-800' :
                        income.status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                        'bg-red-100 text-red-800'
                    }">
                        ${income.status === 'completed' ? 'Selesai' : 
                          income.status === 'pending' ? 'Pending' : 'Dibatalkan'}
                    </span>
                </p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Pembayaran</label>
                <p class="mt-1 text-sm text-gray-900">${new Date(income.payment_date).toLocaleDateString('id-ID')}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Dibuat Oleh</label>
                <p class="mt-1 text-sm text-gray-900">${income.created_by || '-'}</p>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Catatan</label>
            <p class="mt-1 text-sm text-gray-900">${income.notes || 'Tidak ada catatan'}</p>
        </div>
    `;
}

function editIncome(id) {
    currentIncomeId = id;
    
    // Fetch income data and populate form
    fetch(`/admin/management/finance/income/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                populateIncomeForm(data.data);
                document.getElementById('modalTitle').textContent = 'Edit Pemasukan';
                document.getElementById('submitButtonText').textContent = 'Update';
                document.getElementById('incomeModal').classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Gagal memuat data pemasukan', 'error');
        });
}

function populateIncomeForm(income) {
    document.getElementById('incomeId').value = income.id;
    document.getElementById('student_name').value = income.student_name;
    document.getElementById('class').value = income.class;
    document.getElementById('amount').value = income.amount;
    document.getElementById('payment_method').value = income.payment_method;
    document.getElementById('receipt_number').value = income.receipt_number;
    document.getElementById('payment_date').value = income.payment_date;
    document.getElementById('status').value = income.status;
    document.getElementById('notes').value = income.notes || '';
}

function deleteIncome(id) {
    deleteIncomeId = id;
    openDeleteModal();
}

function confirmDelete() {
    if (!deleteIncomeId) return;
    
    fetch(`/admin/management/finance/income/${deleteIncomeId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message);
            closeDeleteModal();
            // Remove row from table
            const row = document.querySelector(`tr[data-id="${deleteIncomeId}"]`);
            if (row) row.remove();
            deleteIncomeId = null;
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Gagal menghapus data pemasukan', 'error');
    });
}

// Form submission
document.getElementById('incomeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const url = currentIncomeId ? 
        `/admin/management/finance/income/${currentIncomeId}` : 
        '/admin/management/finance/income';
    const method = currentIncomeId ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message);
            closeIncomeModal();
            // Reload page to show updated data
            location.reload();
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Gagal menyimpan data pemasukan', 'error');
    });
});

// Search and filter functionality
document.getElementById('search').addEventListener('input', function() {
    filterIncome();
});

document.getElementById('statusFilter').addEventListener('change', function() {
    filterIncome();
});

document.getElementById('dateFilter').addEventListener('change', function() {
    filterIncome();
});

function filterIncome() {
    const search = document.getElementById('search').value.toLowerCase();
    const status = document.getElementById('statusFilter').value;
    const date = document.getElementById('dateFilter').value;
    
    const rows = document.querySelectorAll('#incomeTableBody tr');
    
    rows.forEach(row => {
        const studentName = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
        const receiptNumber = row.querySelector('td:nth-child(1) div:nth-child(2)').textContent.toLowerCase();
        const statusText = row.querySelector('td:nth-child(5) span').textContent.toLowerCase();
        
        let show = true;
        
        // Search filter
        if (search && !studentName.includes(search) && !receiptNumber.includes(search)) {
            show = false;
        }
        
        // Status filter
        if (status && statusText !== status) {
            show = false;
        }
        
        // Date filter (you can implement this based on your needs)
        
        row.style.display = show ? '' : 'none';
    });
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    // Set current month as default date filter
    const today = new Date();
    const currentMonth = today.getFullYear() + '-' + String(today.getMonth() + 1).padStart(2, '0');
    document.getElementById('dateFilter').value = currentMonth;
});
</script>
@endpush
