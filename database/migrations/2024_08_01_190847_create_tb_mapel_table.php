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
        Schema::create('tb_mapel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->nullable()->index('fk_tb_mapel_tb_pegawai');
            $table->foreignId('tahun_ajaran_id')->nullable()->index('fk_tb_mapel_tb_tahun_ajaran');
            $table->foreignId('wali_kelas_id')->nullable()->index('fk_tb_mapel_tb_wali_kelas');
            $table->string('nama_mapel');
            $table->string('kkm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_mapel');
    }
};
