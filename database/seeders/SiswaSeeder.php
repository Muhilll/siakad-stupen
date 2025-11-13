<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for ($i = 1; $i <= 20; $i++) {
            Siswa::create([
                'nis' => 'NIS' . $faker->unique()->numberBetween(1000, 9999),
                'nisn' => 'NISN' . $faker->unique()->numberBetween(10000, 99999),
                'nama' => $faker->unique()->name,
                'jkl' => $faker->randomElement(['L', 'P']),
                'tmp_lahir' => $faker->city,
                'tgl_lahir' => $faker->date('Y-m-d', '2010-12-31'),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'alamat' => $faker->address,
                'no_hp' => $faker->phoneNumber,
                'tahun_masuk' => $faker->numberBetween(2015, 2023),
                'status' => $faker->randomElement(['Aktif', 'Nonaktif']),
                'nama_ayah' => $faker->name('male'),
                'pekerjaan_ayah' => $faker->jobTitle,
                'nama_ibu' => $faker->name('female'),
                'pekerjaan_ibu' => $faker->jobTitle,
                'nohp_ortu' => $faker->phoneNumber,
            ]);
        }
    }
}
