<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    // use HasFactory;

    protected $table = 'tb_pegawai';

    protected $fillable = [
        'user_id',
        'jabatan_id',
        'nip',
        'nama_lengkap',
        'jk',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'alamat',
        'no_tlp',
        'status',
        'foto',
    ];



    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function wali_kelas()
    {
        return $this->hashMany(WaliKelas::class, 'pegawai_id');
    }



    public function mapel()
    {
        return $this->hasMany(Mapel::class, 'pegawai_id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'pegawai_id');
    }
}
