<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = [
            [
                'judul' => 'Kegiatan Santri Bulan Muharram 2025',
                'slug' => 'kegiatan-santri-bulan-muharram-2025',
                'konten' => 'Bulan Muharram merupakan bulan yang penuh berkah dan amal ibadah. Para santri Yayasan Al-Khoir telah melaksanakan berbagai kegiatan keagamaan yang bertujuan untuk meningkatkan ketaqwaan dan keimanan.

Kegiatan yang dilaksanakan meliputi:
- Tadarus Al-Quran bersama
- Kajian keislaman
- Puasa sunnah
- Doa bersama untuk kebaikan umat

Semua kegiatan berjalan dengan lancar dan penuh semangat dari para santri.',
                'ringkasan' => 'Para santri Yayasan Al-Khoir melaksanakan berbagai kegiatan keagamaan di bulan Muharram untuk meningkatkan ketaqwaan dan keimanan.',
                'gambar' => null,
                'penulis' => 'Admin',
                'status' => 'published',
                'tanggal_terbit' => '2025-01-15',
                'kategori' => 'Kegiatan',
                'tags' => ['Muharram', 'Santri', 'Keagamaan', 'Al-Quran']
            ],
            [
                'judul' => 'Penerimaan Santri Baru Tahun Ajaran 2025/2026',
                'slug' => 'penerimaan-santri-baru-tahun-ajaran-2025-2026',
                'konten' => 'Yayasan Al-Khoir membuka pendaftaran santri baru untuk tahun ajaran 2025/2026. Program yang tersedia meliputi:

1. Program Tahfidz Al-Quran
2. Program Sekolah Dasar Terpadu
3. Program Madrasah Tsanawiyah
4. Program Raudhatul Qur\'an

Persyaratan pendaftaran:
- Usia minimal 6 tahun
- Surat keterangan sehat
- Fotokopi akta kelahiran
- Pas foto 3x4 (2 lembar)

Pendaftaran dibuka mulai Januari 2025 dengan kuota terbatas.',
                'ringkasan' => 'Yayasan Al-Khoir membuka pendaftaran santri baru untuk berbagai program pendidikan dengan kuota terbatas.',
                'gambar' => null,
                'penulis' => 'Admin',
                'status' => 'published',
                'tanggal_terbit' => '2025-01-10',
                'kategori' => 'Pengumuman',
                'tags' => ['Pendaftaran', 'Santri Baru', 'Pendidikan', 'Tahfidz']
            ],
            [
                'judul' => 'Prestasi Santri dalam Lomba Tahfidz Tingkat Kota',
                'slug' => 'prestasi-santri-dalam-lomba-tahfidz-tingkat-kota',
                'konten' => 'Kami bangga mengumumkan prestasi membanggakan dari santri Yayasan Al-Khoir dalam Lomba Tahfidz Al-Quran Tingkat Kota yang diselenggarakan oleh Dinas Pendidikan.

Prestasi yang diraih:
- Juara 1: Ahmad Fadillah (Kelas 6 SD)
- Juara 2: Siti Nurhaliza (Kelas 5 SD)
- Juara 3: Muhammad Rizki (Kelas 4 SD)

Prestasi ini merupakan hasil dari kerja keras para santri dan bimbingan dari para guru tahfidz yang telah memberikan pengajaran dengan penuh dedikasi.

Selamat kepada para juara! Semoga prestasi ini menjadi motivasi untuk santri lainnya dalam meningkatkan kemampuan tahfidz.',
                'ringkasan' => 'Santri Yayasan Al-Khoir berhasil meraih juara 1, 2, dan 3 dalam Lomba Tahfidz Al-Quran Tingkat Kota.',
                'gambar' => null,
                'penulis' => 'Admin',
                'status' => 'published',
                'tanggal_terbit' => '2025-01-05',
                'kategori' => 'Prestasi',
                'tags' => ['Tahfidz', 'Prestasi', 'Lomba', 'Al-Quran']
            ],
            [
                'judul' => 'Kunjungan Edukatif ke Museum Islam',
                'slug' => 'kunjungan-edukatif-ke-museum-islam',
                'konten' => 'Para santri Yayasan Al-Khoir mengikuti kunjungan edukatif ke Museum Islam untuk menambah wawasan tentang sejarah dan kebudayaan Islam.

Kegiatan ini diikuti oleh santri kelas 4-6 SD dan seluruh santri MTs. Kunjungan dipandu oleh pemandu museum yang menjelaskan berbagai koleksi artefak Islam, manuskrip kuno, dan peninggalan bersejarah.

Tujuan kunjungan:
- Memperluas wawasan sejarah Islam
- Meningkatkan apresiasi terhadap kebudayaan Islam
- Menambah pengetahuan tentang peradaban Islam
- Memotivasi santri untuk belajar lebih giat

Santri sangat antusias mengikuti kegiatan ini dan banyak yang bertanya tentang berbagai hal yang menarik perhatian mereka.',
                'ringkasan' => 'Santri Yayasan Al-Khoir mengikuti kunjungan edukatif ke Museum Islam untuk menambah wawasan tentang sejarah dan kebudayaan Islam.',
                'gambar' => null,
                'penulis' => 'Admin',
                'status' => 'draft',
                'tanggal_terbit' => '2025-01-20',
                'kategori' => 'Kegiatan',
                'tags' => ['Kunjungan', 'Museum', 'Edukatif', 'Sejarah Islam']
            ]
        ];

        foreach ($news as $item) {
            News::create($item);
        }
    }
}
