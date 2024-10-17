<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunAjaranSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tahunAjaran = [
            [
                'tahun_ajaran' => '2023',
                'semester' => 'GANJIL',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tahun_ajaran' => '2023',
                'semester' => 'GENAP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tahun_ajaran' => '2024',
                'semester' => 'GANJIL',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tahun_ajaran' => '2024',
                'semester' => 'GENAP',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        \App\Models\TahunAjaran::insert($tahunAjaran);
    }
}
