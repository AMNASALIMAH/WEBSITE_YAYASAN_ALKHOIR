<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\visi_misi;

class VisiMisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        visi_misi::create([
            'visi' => 'Menjadi yayasan pendidikan Islam terdepan yang menghasilkan generasi muslim yang berkualitas, berakhlak mulia, dan siap menghadapi tantangan global dengan landasan Al-Quran dan As-Sunnah.',
            'misi' => '1. Menyelenggarakan pendidikan Islam yang berkualitas dan terpadu dari tingkat dasar hingga menengah atas.
2. Mengembangkan sistem pembelajaran yang mengintegrasikan ilmu pengetahuan modern dengan nilai-nilai Islam.
3. Membentuk karakter siswa yang berakhlak mulia, mandiri, dan memiliki kepedulian sosial yang tinggi.
4. Menyediakan fasilitas pendidikan yang memadai dan lingkungan belajar yang kondusif.
5. Menjalin kerjasama dengan berbagai pihak untuk meningkatkan kualitas pendidikan.
6. Mengembangkan program-program unggulan yang sesuai dengan kebutuhan masyarakat.
7. Mencetak generasi muda yang siap berkontribusi positif bagi bangsa dan agama.',
            'tujuan' => '1. Menghasilkan lulusan yang memiliki pemahaman Islam yang benar dan komprehensif.
2. Mencetak siswa yang berprestasi akademik tinggi dengan tetap mempertahankan nilai-nilai keislaman.
3. Membentuk karakter siswa yang memiliki akhlak mulia dan kepribadian yang kuat.
4. Menyiapkan siswa untuk melanjutkan pendidikan ke jenjang yang lebih tinggi.
5. Mengembangkan potensi siswa dalam berbagai bidang sesuai dengan minat dan bakatnya.
6. Menciptakan lingkungan belajar yang nyaman, aman, dan mendukung perkembangan siswa.
7. Menjadi mitra terpercaya bagi orang tua dalam mendidik anak-anak mereka.
8. Berkontribusi dalam pembangunan masyarakat yang beradab dan berakhlak mulia.',
        ]);
    }
}
