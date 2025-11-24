<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Kelas::create([
                'tingkat' => 'X',
                'kode'    => 'X-' . $i,
            ]);
        }
        for ($i = 1; $i <= 9; $i++) {
            Kelas::create([
                'tingkat' => 'XI',
                'kode'    => 'XI-' . $i,
            ]);
        }
        for ($i = 1; $i <= 9; $i++) {
            Kelas::create([
                'tingkat' => 'XII',
                'kode'    => 'XII-' . $i,
            ]);
        }
    }
}
