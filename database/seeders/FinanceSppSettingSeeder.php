<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FinanceSppSetting;

class FinanceSppSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sppSettings = [
            [
                'class_level' => 'SD Kelas 1-2',
                'monthly_amount' => 150000,
                'description' => 'SPP untuk siswa SD kelas 1 dan 2',
                'is_active' => true
            ],
            [
                'class_level' => 'SD Kelas 3-4',
                'monthly_amount' => 200000,
                'description' => 'SPP untuk siswa SD kelas 3 dan 4',
                'is_active' => true
            ],
            [
                'class_level' => 'SD Kelas 5-6',
                'monthly_amount' => 250000,
                'description' => 'SPP untuk siswa SD kelas 5 dan 6',
                'is_active' => true
            ],
            [
                'class_level' => 'SMP Kelas 7-8',
                'monthly_amount' => 300000,
                'description' => 'SPP untuk siswa SMP kelas 7 dan 8',
                'is_active' => true
            ],
            [
                'class_level' => 'SMP Kelas 9',
                'monthly_amount' => 350000,
                'description' => 'SPP untuk siswa SMP kelas 9',
                'is_active' => true
            ],
            [
                'class_level' => 'SMA Kelas 10-11',
                'monthly_amount' => 400000,
                'description' => 'SPP untuk siswa SMA kelas 10 dan 11',
                'is_active' => true
            ],
            [
                'class_level' => 'SMA Kelas 12',
                'monthly_amount' => 450000,
                'description' => 'SPP untuk siswa SMA kelas 12',
                'is_active' => true
            ]
        ];

        foreach ($sppSettings as $setting) {
            FinanceSppSetting::create([
                'class_level' => $setting['class_level'],
                'monthly_amount' => $setting['monthly_amount'],
                'description' => $setting['description'],
                'is_active' => $setting['is_active'],
                'created_by' => 'Admin System',
            ]);
        }
    }
}
