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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique();
            $table->string('nisn')->unique();
            $table->string('nama')->nullable();
            $table->enum('jkl', ['L', 'P'])->nullable();
            $table->string('tmp_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('tahun_masuk')->nullable();
            $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('nohp_ortu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
