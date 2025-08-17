<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YayasanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profileyayasans')->insert([
            'visi' => 'Menjadi yayasan terdepan dalam pendidikan, sosial, dan dakwah Islam di Indonesia.',
            'misi' => "1. Menyelenggarakan pendidikan Islam yang berkualitas dan terjangkau.\n2. Mengembangkan program sosial untuk membantu masyarakat kurang mampu.\n3. Meningkatkan dakwah dan syiar Islam melalui berbagai kegiatan keagamaan.\n4. Membangun jaringan kerjasama dengan berbagai pihak untuk kemajuan umat.",
            'sejarah' => "Yayasan Al-Khoir didirikan pada tahun 2010 oleh sekelompok pendidik dan tokoh masyarakat yang peduli terhadap pendidikan dan kesejahteraan umat. Sejak berdiri, yayasan telah mengelola berbagai program pendidikan, sosial, dan dakwah yang memberikan manfaat luas bagi masyarakat.",
            'telepon' => '021-12345678',
            'email' => 'info@alkhoir.or.id',
            'alamat' => 'Jl. Pesantren No. 123, Jakarta Selatan',
            'facebook' => 'alkhoirfoundation',
            'twitter' => 'alkhoir_id',
            'instagram' => 'alkhoirfoundation',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
