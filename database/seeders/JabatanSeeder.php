<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatan = [
            [
                'nama_jabatan' => 'KEPALA SEKOLAH',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'nama_jabatan' => 'WAKA KURIKULUM',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_jabatan' => 'WAKA KESISWAAN',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_jabatan' => 'BENDAHARA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_jabatan' => 'TENAGA ADMINISTRASI',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_jabatan' => 'GURU',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        Jabatan::insert($jabatan);
    }
}
