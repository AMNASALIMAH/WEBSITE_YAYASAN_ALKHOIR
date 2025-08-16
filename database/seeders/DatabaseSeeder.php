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
        ]);
    }
}
