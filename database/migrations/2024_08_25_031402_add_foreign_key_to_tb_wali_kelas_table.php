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
        Schema::table('tb_wali_kelas', function (Blueprint $table) {
            $table->foreign('pegawai_id', 'fk_tb_wali_kelas_tb_pegawai')->references('id')->on('tb_pegawai')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kelas_id', 'fk_tb_wali_kelas_tb_kelas_id')->references('id')->on('tb_kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tahun_ajaran_id', 'fk_tb_wali_kelas_tb_tahun_ajaran_id')->references('id')->on('tb_tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_wali_kelas', function (Blueprint $table) {
            $table->dropForeign('fk_tb_wali_kelas_tb_pegawai');
            $table->dropForeign('fk_tb_wali_kelas_tb_tahun_ajaran_id');
            $table->dropForeign('fk_tb_wali_kelas_tb_kelas_id');
        });
    }
};
