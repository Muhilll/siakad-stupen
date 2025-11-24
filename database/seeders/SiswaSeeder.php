<?php

namespace Database\Seeders;

use App\Imports\StudentsImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $j = 1;
        for($i = 1; $i <= 10; $i++) {
            Excel::import(new StudentsImport($i), public_path('excel/siswa/x-' . $j . '.xlsx'));
            $j++;
        }
        
        $j = 1;
        for($i = 11; $i <= 19; $i++) {
            Excel::import(new StudentsImport($i), public_path('excel/siswa/xi-' . $j . '.xlsx'));
            $j++;
        }

        $j = 1;
        for($i = 20; $i <= 28; $i++) {
            Excel::import(new StudentsImport($i), public_path('excel/siswa/xii-' . $j . '.xlsx'));
            $j++;
        }
    }
}
