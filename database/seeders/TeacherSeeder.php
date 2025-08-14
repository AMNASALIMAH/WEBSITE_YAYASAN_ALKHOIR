<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'nama' => 'Ust. Hadi Santoso',
                'mapel' => 'Tahfidz',
                'telepon' => '0812-1111-2222',
                'email' => 'hadi.santoso@alkhoir.com',
                'alamat' => 'Jl. Pesantren No. 123, Jakarta Selatan',
                'status' => 'aktif',
                'tanggal_bergabung' => '2023-01-15',
                'kualifikasi' => 'S1 Pendidikan Agama Islam, Universitas Al-Azhar',
                'pengalaman' => '5 tahun mengajar tahfidz di berbagai pesantren',
            ],
            [
                'nama' => 'Ustadzah Rina Safitri',
                'mapel' => 'Fiqih',
                'telepon' => '0812-3333-4444',
                'email' => 'rina.safitri@alkhoir.com',
                'alamat' => 'Jl. Madrasah No. 45, Jakarta Timur',
                'status' => 'aktif',
                'tanggal_bergabung' => '2023-03-20',
                'kualifikasi' => 'S1 Syariah, IAIN Jakarta',
                'pengalaman' => '3 tahun mengajar fiqih untuk tingkat SD dan SMP',
            ],
            [
                'nama' => 'Ust. Ahmad Fauzi',
                'mapel' => 'Aqidah',
                'telepon' => '0812-5555-6666',
                'email' => 'ahmad.fauzi@alkhoir.com',
                'alamat' => 'Jl. Islamic Center No. 78, Jakarta Pusat',
                'status' => 'aktif',
                'tanggal_bergabung' => '2023-02-10',
                'kualifikasi' => 'S2 Aqidah dan Filsafat, UIN Jakarta',
                'pengalaman' => '7 tahun mengajar aqidah di pesantren modern',
            ],
            [
                'nama' => 'Ustadzah Siti Aminah',
                'mapel' => 'Bahasa Arab',
                'telepon' => '0812-7777-8888',
                'email' => 'siti.aminah@alkhoir.com',
                'alamat' => 'Jl. Al-Hikmah No. 90, Jakarta Barat',
                'status' => 'aktif',
                'tanggal_bergabung' => '2023-04-05',
                'kualifikasi' => 'S1 Pendidikan Bahasa Arab, UIN Syarif Hidayatullah',
                'pengalaman' => '4 tahun mengajar bahasa Arab untuk pemula',
            ],
            [
                'nama' => 'Ust. Muhammad Rizki',
                'mapel' => 'Tajwid',
                'telepon' => '0812-9999-0000',
                'email' => 'muhammad.rizki@alkhoir.com',
                'alamat' => 'Jl. Qur\'an No. 12, Jakarta Utara',
                'status' => 'nonaktif',
                'tanggal_bergabung' => '2022-08-15',
                'kualifikasi' => 'S1 Qira\'at, Universitas Al-Qur\'an',
                'pengalaman' => '6 tahun mengajar tajwid dan qira\'at',
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}
