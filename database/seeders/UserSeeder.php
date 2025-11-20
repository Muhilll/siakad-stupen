<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => '5716833895',
            'role' => 'siswa',
            'password' => bcrypt('siswa'),
        ]);
        User::create([
            'username' => '1918168104397954',
            'role' => 'guru',
            'password' => bcrypt('guru'),
        ]);
        User::create([
            'username' => '123456789',
            'role' => 'admin',
            'password' => bcrypt('admin'),
        ]);
    }
}
