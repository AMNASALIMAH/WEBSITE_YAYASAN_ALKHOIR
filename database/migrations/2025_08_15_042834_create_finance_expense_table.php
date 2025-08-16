<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('finance_expense', function (Blueprint $table) {
            $table->id();
            $table->string('expense_title');
            $table->text('description');
            $table->decimal('amount', 12, 2);
            $table->enum('category', ['operasional', 'gaji', 'utilitas', 'maintenance', 'lainnya']);
            $table->date('expense_date');
            $table->string('receipt_number')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('approved_by')->nullable();
            $table->text('notes')->nullable();
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_expense');
    }
};
