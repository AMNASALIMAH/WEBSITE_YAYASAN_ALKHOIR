<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE `finance_expense` MODIFY `category` ENUM('operasional','gaji','utilitas','maintenance','pendidikan','lainnya') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE `finance_expense` MODIFY `category` ENUM('operasional','gaji','utilitas','maintenance','lainnya') NOT NULL");
    }
};


