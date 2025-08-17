@extends('admin.app')

@section('content')
<div x-data="{ addStudent: false, addNews: false, addExpense: false, messageModal: false }" class="min-h-screen bg-gray-50 p-6">
    <!-- Header Section -->
    <div class="mb-8 animate-in">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard</h1>
        <p class="text-gray-600">Selamat datang kembali! Berikut adalah ringkasan aktivitas Yayasan Al-Khoir</p>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Students Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all duration-300 transform hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Santri</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $student->count() }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-600 text-sm font-medium">
                    <i class="fas fa-arrow-up mr-1"></i>+12%
                </span>
                <span class="text-gray-500 text-sm ml-2">dari bulan lalu</span>
            </div>
        </div>

        <!-- Total Teachers Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all duration-300 transform hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Guru</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $teacher->count() }}</p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <i class="fas fa-chalkboard-teacher text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-600 text-sm font-medium">
                    <i class="fas fa-arrow-up mr-1"></i>+5%
                </span>
                <span class="text-gray-500 text-sm ml-2">dari bulan lalu</span>
            </div>
        </div>

        <!-- Total Income Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all duration-300 transform hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Pemasukan</p>
                    <p class="text-2xl font-bold text-green-600">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-600 text-sm font-medium">
                    <i class="fas fa-arrow-up mr-1"></i>+8%
                </span>
                <span class="text-gray-500 text-sm ml-2">dari bulan lalu</span>
            </div>
        </div>

        <!-- Unread Messages Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all duration-300 transform hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pesan Baru</p>
                    <p class="text-2xl font-bold text-orange-600">{{ $unreadMessages }}</p>
                </div>
                <div class="p-3 bg-orange-100 rounded-full">
                    <i class="fas fa-envelope text-orange-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-orange-600 text-sm font-medium">
                    <i class="fas fa-exclamation-circle mr-1"></i>Perlu dibaca
                </span>
            </div>
        </div>
    </div>

    <!-- Charts and Analytics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Financial Overview Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Overview Keuangan</h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200 transition-colors">Bulan Ini</button>
                    <button class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors">Tahun Ini</button>
                </div>
            </div>
            
            <!-- Simple Bar Chart -->
            <div class="h-64 flex items-end justify-between space-x-2">
                @foreach($monthlyIncome as $month => $amount)
                <div class="flex flex-col items-center space-y-2">
                    <div class="w-8 bg-blue-500 rounded-t" style="height: {{ $amount > 0 ? ($amount / max(array_values($monthlyIncome))) * 200 : 0 }}px"></div>
                    <span class="text-xs text-gray-500">{{ $month }}</span>
                </div>
                @endforeach
            </div>
            
            <div class="mt-4 flex items-center justify-between text-sm">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-gray-600">Pemasukan</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                        <span class="text-gray-600">Pengeluaran</span>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-gray-600">Net Income</p>
                    <p class="text-lg font-semibold {{ $netIncome >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        Rp {{ number_format($netIncome, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Aktivitas Terbaru</h3>
            <div class="space-y-4">
                @foreach($recentNews->take(3) as $news)
                <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">{{ Str::limit($news->title, 50) }}</p>
                        <p class="text-xs text-gray-500">{{ $news->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach
                
                @foreach($recentExpenses->take(2) as $expense)
                <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-2 h-2 bg-red-500 rounded-full mt-2"></div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Pengeluaran: {{ Str::limit($expense->expense_title ?? 'Pengeluaran', 40) }}</p>
                        <p class="text-xs text-gray-500">Rp {{ number_format($expense->amount, 0, ',', '.') }} • {{ $expense->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach
                
                @foreach($recentIncome->take(2) as $income)
                <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Pemasukan: {{ Str::limit($income->student_name ?? 'Pemasukan', 40) }}</p>
                        <p class="text-xs text-gray-500">Rp {{ number_format($income->amount, 0, ',', '.') }} • {{ $income->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Quick Actions and Recent Data -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Aksi Cepat</h3>
            <div class="space-y-3">
                <button onclick="openModal('addStudent')" class="w-full flex items-center space-x-3 p-3 text-left rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-all duration-200">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <i class="fas fa-user-plus text-blue-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Tambah Santri</p>
                        <p class="text-sm text-gray-500">Daftarkan santri baru</p>
                    </div>
                </button>
                
                <button onclick="openModal('addNews')" class="w-full flex items-center space-x-3 p-3 text-left rounded-lg border border-gray-200 hover:border-green-300 hover:bg-green-50 transition-all duration-200">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <i class="fas fa-newspaper text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Tambah Berita</p>
                        <p class="text-sm text-gray-500">Publikasikan berita baru</p>
                    </div>
                </button>
                
                <button onclick="openModal('addExpense')" class="w-full flex items-center space-x-3 p-3 text-left rounded-lg border border-gray-200 hover:border-red-300 hover:bg-red-50 transition-all duration-200">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <i class="fas fa-minus-circle text-red-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Catat Pengeluaran</p>
                        <p class="text-sm text-gray-500">Tambah pengeluaran baru</p>
                    </div>
                </button>
            </div>
        </div>

        <!-- Recent Messages -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Pesan Terbaru</h3>
            <div class="space-y-3 max-h-72 overflow-y-auto">
                @foreach($pesan->sortByDesc('created_at') as $message)
                <div class="p-3 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer" onclick="openMessageModal('{{ $message->id }}')">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">{{ Str::limit($message->nama_depan . ' ' . $message->nama_belakang, 20) }}</p>
                            <p class="text-xs text-gray-500">{{ Str::limit($message->pesan ?? 'No message', 40) }}</p>
                        </div>
                        {{-- @if(!($message->is_read ?? false))
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        @endif --}}
                    </div>
                    <p class="text-xs text-gray-400 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- System Status -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Status Sistem</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Database</span>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span class="text-sm text-green-600">Online</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Server</span>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span class="text-sm text-green-600">Healthy</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Storage</span>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                        <span class="text-sm text-yellow-600">75%</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Memory</span>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span class="text-sm text-green-600">45%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<!-- Add Student Modal -->
<div id="addStudent" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4 transform transition-all">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Tambah Santri Baru</h3>
            <button onclick="closeModal('addStudent')" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Program</label>
                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option>SDT Al-Khoir</option>
                    <option>MT Al-Khoir</option>
                    <option>MHS Al-Khoir</option>
                    <option>RTQ Al-Khoir</option>
                </select>
            </div>
            <div class="flex space-x-3 pt-4">
                <button type="button" onclick="closeModal('addStudent')" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Add News Modal -->
<div id="addNews" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4 transform transition-all">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Tambah Berita Baru</h3>
            <button onclick="closeModal('addNews')" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Berita</label>
                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konten</label>
                <textarea rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
            </div>
            <div class="flex space-x-3 pt-4">
                <button type="button" onclick="closeModal('addNews')" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    Publikasikan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Add Expense Modal -->
<div id="addExpense" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4 transform transition-all">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Catat Pengeluaran</h3>
            <button onclick="closeModal('addExpense')" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option>Operasional</option>
                    <option>Pendidikan</option>
                    <option>Fasilitas</option>
                    <option>Lainnya</option>
                </select>
            </div>
            <div class="flex space-x-3 pt-4">
                <button type="button" onclick="closeModal('addExpense')" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Message Detail Modal -->
<div id="messageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl p-6 w-full max-w-lg mx-4 transform transition-all">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Detail Pesan</h3>
            <button onclick="closeMessageModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="messageContent" class="space-y-4">
            <!-- Message content will be loaded here -->
        </div>
    </div>
</div>

<!-- Toast Notifications -->
<div id="toastContainer" class="fixed top-4 right-4 z-50 space-y-2"></div>

<script>

</script>
@endsection