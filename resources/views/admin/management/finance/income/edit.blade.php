@extends('admin.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-50">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Pemasukan</h1>
                    <p class="mt-2 text-gray-600">Edit data pemasukan</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.management.finance.pemasukan') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-all duration-200 hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Form Edit Pemasukan</h3>
            </div>
            
            <form action="{{ route('admin.management.finance.income.update.simple', $income) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="student_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Santri *</label>
                        <input type="text" id="student_name" name="student_name" value="{{ old('student_name', $income->student_name) }}" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 @error('student_name') border-red-500 @enderror">
                        @error('student_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="class" class="block text-sm font-medium text-gray-700 mb-2">Kelas *</label>
                        <select id="class" name="class" required
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 @error('class') border-red-500 @enderror">
                            <option value="">Pilih Kelas</option>
                            <option value="SD 1" {{ old('class', default: $income->class) == 'SD 1' ? 'selected' : '' }}>SD 1</option>
                            <option value="SD 2" {{ old('class', $income->class) == 'SD 2' ? 'selected' : '' }}>SD 2</option>
                            <option value="SD 3" {{ old('class', $income->class) == 'SD 3' ? 'selected' : '' }}>SD 3</option>
                            <option value="SD 4" {{ old('class', $income->class) == 'SD 4' ? 'selected' : '' }}>SD 4</option>
                            <option value="SD 5" {{ old('class', $income->class) == 'SD 5' ? 'selected' : '' }}>SD 5</option>
                            <option value="SD 6" {{ old('class', $income->class) == 'SD 6' ? 'selected' : '' }}>SD 6</option>
                            <option value="SMP 1" {{ old('class', $income->class) == 'SMP 1' ? 'selected' : '' }}>SMP 1</option>
                            <option value="SMP 2" {{ old('class', $income->class) == 'SMP 2' ? 'selected' : '' }}>SMP 2</option>
                            <option value="SMP 3" {{ old('class', $income->class) == 'SMP 3' ? 'selected' : '' }}>SMP 3</option>
                            <option value="SMA 1" {{ old('class', $income->class) == 'SMA 1' ? 'selected' : '' }}>SMA 1</option>
                            <option value="SMA 2" {{ old('class', $income->class) == 'SMA 2' ? 'selected' : '' }}>SMA 2</option>
                            <option value="SMA 3" {{ old('class', $income->class) == 'SMA 3' ? 'selected' : '' }}>SMA 3</option>
                        </select>
                        @error('class')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Jumlah (Rp) *</label>
                        <input type="number" id="amount" name="amount" step="0.01" min="0" value="{{ old('amount', $income->amount) }}" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 @error('amount') border-red-500 @enderror">
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran *</label>
                        <select id="payment_method" name="payment_method" required
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 @error('payment_method') border-red-500 @enderror">
                            <option value="">Pilih Metode</option>
                            <option value="Tunai" {{ old('payment_method', $income->payment_method) == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                            <option value="Transfer Bank" {{ old('payment_method', $income->payment_method) == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                            <option value="E-Wallet" {{ old('payment_method', $income->payment_method) == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                            <option value="QRIS" {{ old('payment_method', $income->payment_method) == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                        </select>
                        @error('payment_method')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="receipt_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Kwitansi *</label>
                        <input type="text" id="receipt_number" name="receipt_number" value="{{ old('receipt_number', $income->receipt_number) }}" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 @error('receipt_number') border-red-500 @enderror">
                        @error('receipt_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pembayaran *</label>
                        <input type="date" id="payment_date" name="payment_date" value="{{ old('payment_date', $income->payment_date->format('Y-m-d')) }}" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 @error('payment_date') border-red-500 @enderror">
                        @error('payment_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select id="status" name="status" required
                            class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 @error('status') border-red-500 @enderror">
                        <option value="pending" {{ old('status', $income->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ old('status', $income->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ old('status', $income->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                    <textarea id="notes" name="notes" rows="3"
                              class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 @error('notes') border-red-500 @enderror">{{ old('notes', $income->notes) }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end space-x-3 pt-6">
                    <a href="{{ route('admin.management.finance.pemasukan') }}" 
                       class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-all duration-200 hover:shadow-lg">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
