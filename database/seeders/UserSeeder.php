<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Raphyy',
            'email' => 'adeajah@gmail.com',
            'is_admin' => true,
            'password' => bcrypt('rahasia123'),
        ]);

        User::create([
            'name' => 'bambang',
            'email' => 'bambang@gmail.com',
            'is_admin' => false,
            'password' => bcrypt('bambang123'),
        ]);
    }
}
