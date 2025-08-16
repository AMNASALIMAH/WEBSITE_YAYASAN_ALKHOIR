<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'name' => 'SD Tahfidz Al-Khoir',
                'description' => 'Program pendidikan dasar dengan fokus tahfidz Al-Quran untuk tingkat SD.',
                'category' => 'Pendidikan',
                'status' => 'active',
            ],
            [
                'name' => 'RTQ Al-Khoir',
                'description' => 'Program Rumah Tahfidz Al-Quran untuk semua kalangan.',
                'category' => 'Tahfidz',
                'status' => 'active',
            ],
            [
                'name' => 'MT Al-Khoir',
                'description' => 'Program Madrasah Tsanawiyah dengan kurikulum terpadu.',
                'category' => 'Pendidikan',
                'status' => 'active',
            ],
            [
                'name' => 'MHS Al-Khoir',
                'description' => 'Program Madrasah Aliyah dengan spesialisasi keagamaan.',
                'category' => 'Pendidikan',
                'status' => 'active',
            ],
            [
                'name' => 'Bantuan Sosial',
                'description' => 'Program bantuan sosial untuk masyarakat kurang mampu.',
                'category' => 'Sosial',
                'status' => 'active',
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}
