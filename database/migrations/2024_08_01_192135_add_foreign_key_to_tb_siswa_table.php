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
        Schema::table('tb_siswa', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_tb_siswa_users')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('wali_kelas_id', 'fk_tb_siswa_tb_wali_kelas')->references('id')->on('tb_wali_kelas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tahun_ajaran_id', 'fk_tb_siswa_tb_tahun_ajaran')->references('id')->on('tb_tahun_ajaran')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_siswa', function (Blueprint $table) {
            $table->dropForeign('fk_tb_siswa_users');
            $table->dropForeign('fk_tb_siswa_tb_wali_kelas');
            $table->dropForeign('fk_tb_siswa_tb_tahun_ajaran');
        });
    }
};
