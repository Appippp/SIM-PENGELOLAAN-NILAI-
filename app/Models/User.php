<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'user_id', 'id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id');
    }

    public function isSiswa()
    {
        return $this->role === 0;
    }

    public function isAdmin()
    {
        return $this->role === 1;
    }

    public function isGuru()
    {
        return $this->role === 2;
    }
}
