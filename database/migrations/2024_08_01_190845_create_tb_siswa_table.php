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
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('nis')->unique();
            $table->string('nama_lengkap');
            $table->string('jk');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('agama');
            $table->string('alamat');
            $table->string('no_tlp');
            $table->string('no_tlp_ortu');
            $table->foreignId('wali_kelas_id')->nullable()->constrained('tb_wali_kelas')->onDelete('set null');
            $table->foreignId('tahun_ajaran_id')->nullable()->constrained('tb_tahun_ajaran')->onDelete('set null');
            $table->boolean('status')->default(0);
            $table->longText('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_siswa');
    }
};
