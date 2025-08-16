<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FinanceExpense;
use Carbon\Carbon;

class FinanceExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenses = [
            [
                'title' => 'Gaji Guru dan Staff',
                'description' => 'Pembayaran gaji bulanan untuk guru dan staff yayasan',
                'amount' => 5000000,
                'category' => 'gaji',
                'status' => 'approved',
                'approved_by' => 'Ketua Yayasan'
            ],
            [
                'title' => 'Biaya Listrik dan Air',
                'description' => 'Pembayaran tagihan listrik dan air bulanan',
                'amount' => 1200000,
                'category' => 'utilitas',
                'status' => 'approved',
                'approved_by' => 'Ketua Yayasan'
            ],
            [
                'title' => 'Maintenance Gedung',
                'description' => 'Perbaikan dan pemeliharaan gedung sekolah',
                'amount' => 2500000,
                'category' => 'maintenance',
                'status' => 'approved',
                'approved_by' => 'Ketua Yayasan'
            ],
            [
                'title' => 'Pembelian Buku Pelajaran',
                'description' => 'Pembelian buku pelajaran untuk siswa baru',
                'amount' => 1800000,
                'category' => 'operasional',
                'status' => 'pending'
            ],
            [
                'title' => 'Biaya Internet',
                'description' => 'Pembayaran paket internet untuk lab komputer',
                'amount' => 500000,
                'category' => 'utilitas',
                'status' => 'approved',
                'approved_by' => 'Ketua Yayasan'
            ],
            [
                'title' => 'Konsumsi Rapat',
                'description' => 'Biaya konsumsi untuk rapat koordinasi bulanan',
                'amount' => 300000,
                'category' => 'operasional',
                'status' => 'pending'
            ],
            [
                'title' => 'Biaya Kebersihan',
                'description' => 'Jasa kebersihan gedung dan lingkungan sekolah',
                'amount' => 800000,
                'category' => 'operasional',
                'status' => 'approved',
                'approved_by' => 'Ketua Yayasan'
            ],
            [
                'title' => 'Pembelian ATK',
                'description' => 'Pembelian alat tulis kantor untuk kebutuhan administrasi',
                'amount' => 400000,
                'category' => 'operasional',
                'status' => 'pending'
            ]
        ];

        foreach ($expenses as $expense) {
            FinanceExpense::create([
                'expense_title' => $expense['title'],
                'description' => $expense['description'],
                'amount' => $expense['amount'],
                'category' => $expense['category'],
                'expense_date' => Carbon::now()->subDays(rand(0, 30)),
                'receipt_number' => 'EXP-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                'status' => $expense['status'],
                'approved_by' => $expense['approved_by'] ?? null,
                'notes' => rand(0, 1) ? 'Pengeluaran rutin bulanan' : null,
                'created_by' => 'Admin System',
            ]);
        }
    }
}
