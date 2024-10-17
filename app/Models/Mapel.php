<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'tb_mapel';

    protected $fillable = [
        'pegawai_id',
        'tahun_ajaran_id',
        'wali_kelas_id',
        'nama_mapel',
        'kkm',
    ];


    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }


    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'id');
    }


    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }


    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'mapel_id');
    }


    public function wali_kelas()
    {
        return $this->belongsTo(WaliKelas::class, 'wali_kelas_id', 'id');
    }
}
