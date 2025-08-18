<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create a test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create admin users for testing
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@alkhoir.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin2@alkhoir.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Editor User',
            'email' => 'editor@alkhoir.com',
            'password' => Hash::make('password'),
            'role' => 'editor',
            'status' => 'active',
        ]);

        $this->call([
            NewsSeeder::class,
            TeacherSeeder::class,
            FinanceIncomeSeeder::class,
            FinanceExpenseSeeder::class,
            FinanceSppSettingSeeder::class,
            ProgramSeeder::class,
            YayasanTableSeeder::class,
            VisiMisiSeeder::class,
            StrukturOrganisasiSeeder::class,
        ]);
        
        // Create sample messages for testing
        \App\Models\KirimPesan::create([
            'nama_depan' => 'Ahmad',
            'nama_belakang' => 'Rizki',
            'no_hp' => '081234567890',
            'email' => 'ahmad@example.com',
            'pesan' => 'Saya ingin bertanya tentang program MT Al-Khoir. Apakah masih ada kuota untuk tahun ajaran baru?',
            'is_read' => false,
        ]);
        
        \App\Models\KirimPesan::create([
            'nama_depan' => 'Siti',
            'nama_belakang' => 'Nurhaliza',
            'no_hp' => '081234567891',
            'email' => 'siti@example.com',
            'pesan' => 'Bagaimana cara mendaftar untuk program SDT Al-Khoir? Mohon informasi lengkapnya.',
            'is_read' => false,
        ]);
        
        \App\Models\KirimPesan::create([
            'nama_depan' => 'Muhammad',
            'nama_belakang' => 'Fadli',
            'no_hp' => '081234567892',
            'email' => 'fadli@example.com',
            'pesan' => 'Saya sudah membaca informasi tentang yayasan. Sangat menarik dan ingin bergabung.',
            'is_read' => true,
        ]);
    }
}
