<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('program_units', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // mahasantri, majelis_talim, rtq, sd_tahfidz
            $table->longText('sejarah')->nullable();
            $table->longText('visi')->nullable();
            $table->longText('misi_tujuan')->nullable();
            $table->longText('profil_ketua_program')->nullable();
            $table->longText('fasilitas')->nullable();
            $table->timestamps();
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_units');
    }
};


