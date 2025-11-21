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
        Schema::create('kehadirans', function (Blueprint $table) {
            $table->id();
            $table->enum('ket', ['Hadir', 'Izin', 'Alpa'])->default('Alpa');
            $table->enum('status', ['Terkirim', 'Terlambat'])->default('Terkirim');
            $table->foreignId('agt_kelas_id')->constrained('agt_kelas')->onDelete('cascade');
            $table->foreignId('absensi_id')->constrained('absensis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadirans');
    }
};
