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
        Schema::table('tb_nilai', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_tb_nilai_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('siswa_id', 'fk_tb_nilai_tb_siswa')->references('id')->on('tb_siswa')->onDelete('cascade');
            $table->foreign('mapel_id', 'fk_tb_nilai_tb_mapel')->references('id')->on('tb_mapel')->onDelete('cascade');
            $table->foreign('tahun_ajaran_id', 'fk_tb_nilai_tb_tahun_ajaran')->references('id')->on('tb_tahun_ajaran')->onDelete('cascade');
            $table->foreign('wali_kelas_id', 'fk_tb_nilai_tb_wali_kelas')->references('id')->on('tb_wali_kelas')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_nilai', function (Blueprint $table) {
            $table->dropForeign('fk_tb_nilai_users');
            $table->dropForeign('fk_tb_nilai_tb_siswa');
            $table->dropForeign('fk_tb_nilai_tb_mapel');
            $table->dropForeign('fk_tb_nilai_tb_tahun_ajaran');
            $table->dropForeign('fk_tb_nilai_tb_wali_kelas');
        });
    }
};
