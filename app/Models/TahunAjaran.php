<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'tb_tahun_ajaran';

    protected $fillable = [
        'tahun_ajaran',
        'semester',
        
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'tahun_ajaran_id');
    }

    public function mapel()
    {
        return $this->hasMany(Mapel::class, 'tahun_ajaran_id');
    }

    public function wali_kelas()
    {
        return $this->hasMany(WaliKelas::class, 'tahun_ajaran_id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'tahun_ajaran_id');
    }

   
}
