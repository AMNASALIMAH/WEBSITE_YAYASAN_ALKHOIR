<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StrukturOrganisasi;

class StrukturOrganisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StrukturOrganisasi::create([
            'nama' => 'H. Ahmad Rizki',
            'jabatan' => 'Ketua Yayasan',
            'foto' => null,
        ]);

        StrukturOrganisasi::create([
            'nama' => 'Siti Nurhaliza',
            'jabatan' => 'Sekretaris',
            'foto' => null,
        ]);

        StrukturOrganisasi::create([
            'nama' => 'Muhammad Fadli',
            'jabatan' => 'Bendahara',
            'foto' => null,
        ]);

        StrukturOrganisasi::create([
            'nama' => 'Aisyah Putri',
            'jabatan' => 'Penanggung Jawab Pendidikan',
            'foto' => null,
        ]);

        StrukturOrganisasi::create([
            'nama' => 'Abdul Rahman',
            'jabatan' => 'Penanggung Jawab Keagamaan',
            'foto' => null,
        ]);

        StrukturOrganisasi::create([
            'nama' => 'Fatimah Azzahra',
            'jabatan' => 'Penanggung Jawab Kesehatan',
            'foto' => null,
        ]);
    }
}
