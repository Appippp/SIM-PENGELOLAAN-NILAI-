<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    use HasFactory;

    protected $table = 'tb_wali_kelas';

    protected $fillable = [
        'kelas_id',
        'pegawai_id',
        'tahun_ajaran_id',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }


    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }


    public function tahun_ajaran()
    {   
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'id');
    }

    public function mapel()
    {
        return $this->hasMany(Mapel::class, 'wali_kelas_id', 'id');
    }


}
