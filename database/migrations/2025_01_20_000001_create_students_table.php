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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique()->comment('Nomor Induk Siswa');
            $table->string('nama_lengkap');
            $table->string('nama_panggilan')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama');
            $table->text('alamat');
            $table->string('nama_ortu');
            $table->string('telepon_ortu');
            $table->string('email_ortu')->nullable();
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade');
            $table->string('kelas');
            $table->enum('status', ['aktif', 'nonaktif', 'lulus', 'pindah'])->default('aktif');
            $table->date('tanggal_masuk');
            $table->string('foto')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
