<?php

namespace Database\Seeders;

use App\Imports\TeachersImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new TeachersImport(), public_path('excel/guru/guru.xlsx'));
    }
}
