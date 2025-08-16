<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FinanceIncome;
use Carbon\Carbon;

class FinanceIncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            ['name' => 'Ahmad Rizki', 'class' => '5A'],
            ['name' => 'Siti Nurhaliza', 'class' => '5A'],
            ['name' => 'Muhammad Fadli', 'class' => '5B'],
            ['name' => 'Dewi Lestari', 'class' => '6A'],
            ['name' => 'Rizki Ramadhan', 'class' => '6B'],
            ['name' => 'Nurul Hidayah', 'class' => '4A'],
            ['name' => 'Abdul Rahman', 'class' => '4B'],
            ['name' => 'Fatimah Azzahra', 'class' => '3A'],
            ['name' => 'Ali bin Abi Thalib', 'class' => '3B'],
            ['name' => 'Aisyah binti Abu Bakar', 'class' => '2A'],
        ];

        $paymentMethods = ['tunai', 'transfer', 'qris'];
        $statuses = ['completed', 'pending', 'completed'];

        foreach ($students as $index => $student) {
            // Create multiple payments for each student
            for ($i = 0; $i < rand(1, 3); $i++) {
                $paymentDate = Carbon::now()->subDays(rand(0, 30));
                
                FinanceIncome::create([
                    'student_name' => $student['name'],
                    'class' => $student['class'],
                    'amount' => rand(200000, 300000),
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'receipt_number' => 'INV-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT) . '-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                    'notes' => rand(0, 1) ? 'Pembayaran SPP bulan ' . $paymentDate->format('F Y') : null,
                    'payment_date' => $paymentDate,
                    'status' => $statuses[array_rand($statuses)],
                    'created_by' => 'Admin System',
                ]);
            }
        }
    }
}
