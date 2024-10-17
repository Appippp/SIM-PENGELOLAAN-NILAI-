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
        Schema::table('tb_pegawai', function (Blueprint $table) {
            $table->foreign('jabatan_id', 'fk_tb_pegawai_tb_jabatan')->references('id')->on('tb_jabatan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'fk_tb_pegawai_tb_users')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_guru', function (Blueprint $table) {
            $table->dropForeign('fk_tb_pegawai_tb_jabatan');
            $table->dropForeign('fk_tb_pegawai_tb_users');
        });
    }
};
