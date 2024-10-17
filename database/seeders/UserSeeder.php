<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =[
            [
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'role' => 1
            ],

        ];

        User::insert($user);
    }
}
