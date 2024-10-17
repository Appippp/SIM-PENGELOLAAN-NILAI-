<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'tb_nilai';

    protected $fillable = [
        'user_id',
        'siswa_id',
        'mapel_id',
        'wali_kelas_id',
        'tahun_ajaran_id',
        'tugas',
        'uts',
        'uas',
        'nilai',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }


    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id', 'id');
    }

    public function wali_kelas()
    {
        return $this->belongsTo(WaliKelas::class, 'wali_kelas_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function tahun_ajaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'id');
    }
}
