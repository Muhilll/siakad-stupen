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
            $table->string('jenis_ptk')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('nip')->unique();
            $table->string('pangkat')->nullable();
            $table->string('golongan')->nullable();
            $table->date('tmt')->nullable();
            $table->integer('mkg_cpns_tahun')->nullable()->default(0);
            $table->integer('mkg_cpns_bulan')->nullable()->default(0);
            $table->integer('mkg_total_tahun')->nullable()->default(0);
            $table->integer('mkg_total_bulan')->nullable()->default(0);
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->string('nik')->nullable();
            $table->string('nuptk')->nullable()->unique();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('sertifikasi_bidang_studi')->nullable();
            $table->string('sertifikasi_tahun')->nullable();
            $table->string('pendidikan_jenjang')->nullable();
            $table->string('pendidikan_gelar')->nullable();
            $table->string('pendidikan_bidang_studi')->nullable();
            $table->string('pendidikan_tahun')->nullable();
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
