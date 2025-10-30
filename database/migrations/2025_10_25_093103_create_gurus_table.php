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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nuptk')->unique();
            $table->string('nama_lengkap')->nullable();
            $table->enum('jkl', ['L', 'P'])->nullable();;
            $table->string('tmp_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable()->unique();
            $table->enum('status_pegawai', ['PNS', 'Honorer', 'Kontrak', 'Tetap Yayasan'])->default('Honorer');
            $table->string('jabatan')->nullable();
            $table->enum('sertifikasi', ['Ya', 'Tidak'])->default('Tidak');
            $table->enum('status_mengajar', ['Aktif', 'Nonaktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
