<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $jenisPtkOptions = [
            'Pendidik (Guru)',
            'Kepala Sekolah',
            'Tenaga Kependidikan'
        ];

        for ($i = 1; $i <= 20; $i++) {
            $guru = Guru::create([
                'jenis_ptk' => $faker->randomElement($jenisPtkOptions),
                'nama_lengkap' => $faker->name(),
                
                // Unique 16 digit number
                'nip' => $faker->unique()->numerify('################'),
                
                'pangkat' => $faker->randomElement(['Penata Muda', 'Penata', 'Pembina']),
                'golongan' => $faker->randomElement(['III/a', 'III/b', 'III/c', 'IV/a']),
                'tmt' => $faker->date(),
                
                'mkg_cpns_tahun' => $faker->numberBetween(0, 10),
                'mkg_cpns_bulan' => $faker->numberBetween(0, 11),
                'mkg_total_tahun' => $faker->numberBetween(5, 30),
                'mkg_total_bulan' => $faker->numberBetween(0, 11),

                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'tempat_lahir' => $faker->city(),
                'tanggal_lahir' => $faker->date(),

                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),

                // Unique 16 digit NIK
                'nik' => $faker->unique()->numerify('################'),

                // Unique NUPTK 16 digit
                'nuptk' => $faker->unique()->numerify('################'),

                'no_hp' => $faker->phoneNumber(),
                'email' => $faker->unique()->safeEmail(),

                'jabatan' => $faker->randomElement(['Guru Mata Pelajaran', 'Guru Kelas', 'Kepala Sekolah', 'Staf TU']),
                'sertifikasi_bidang_studi' => $faker->randomElement(['Matematika', 'IPA', 'IPS', 'Bahasa Indonesia', 'Bahasa Inggris', 'PPKn']),
                'sertifikasi_tahun' => $faker->numberBetween(2005, 2023),

                'pendidikan_jenjang' => $faker->randomElement(['SMA', 'D3', 'S1', 'S2']),
                'pendidikan_gelar' => $faker->randomElement(['S.Pd', 'M.Pd', 'A.Md']),
                'pendidikan_bidang_studi' => $faker->randomElement(['Matematika', 'Bahasa Inggris', 'PGSD', 'IPA']),
                'pendidikan_tahun' => $faker->numberBetween(2000, 2022),

                'created_at' => now(),
                'updated_at' => now(),
            ]);

            User::create([
                'username' => $guru->nip,
                'role' => 'guru',
                'password' => $guru->nip
            ]);
        }
    }
}
