<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas = [
            [
                'nama_kelas' => 'VII',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'nama_kelas' => 'VIII',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'nama_kelas' => 'IX',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ];

        Kelas::insert($kelas);
        
    }
}
