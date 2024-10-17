<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'tb_kelas';

    protected $fillable = [
        'nama_kelas',
    ];

    



    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }


    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'kelas_id');
    }


    public function mapel()
    {
        return $this->hasMany(Mapel::class, 'kelas_id');
    }

    public function wali_kelas()
    {
        return $this->hasMany(WaliKelas::class, 'kelas_id');
    }



    
}
