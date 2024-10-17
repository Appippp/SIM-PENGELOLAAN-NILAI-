<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'tb_siswa';

    protected $fillable = [
        'user_id',
        'nis',
        'nama_lengkap',
        'jk',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'alamat',
        'no_tlp',
        'no_tlp_ortu',
        'status',
        'foto',
        'wali_kelas_id',
        'tahun_ajaran_id',
    ];


    public function wali_kelas()
    {
        return $this->belongsTo(WaliKelas::class, 'wali_kelas_id', 'id');
    }


    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'id');
    }


    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'siswa_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
