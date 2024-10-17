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
        Schema::create('tb_nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index('fk_tb_nilai_users');
            $table->foreignId('tahun_ajaran_id')->nullable()->index('fk_tb_nilai_tb_tahun_ajaran');
            $table->foreignId('wali_kelas_id')->nullable()->index('fk_tb_nilai_tb_wali_kelas');
            $table->foreignId('siswa_id')->nullable()->index('fk_tb_nilai_tb_siswa');
            $table->foreignId('mapel_id')->nullable()->index('fk_tb_nilai_tb_mapel');
            $table->integer('tugas')->default(0);
            $table->integer('uts')->default(0);
            $table->integer('uas')->default(0);
            $table->integer('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_nilai');
    }
};
