<?php

namespace App\Imports;

use App\Models\AgtKelas;
use App\Models\Siswa;
use App\Models\User;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements OnEachRow, WithHeadingRow
{
    protected $kelas_id;

    public function __construct($kelas_id)
    {
        $this->kelas_id = $kelas_id;
    }

    public function onRow(Row $row)
    {
        $r = $row->toArray();

        $siswa = Siswa::create([
            'nis'  => $r['no_induk'],
            'nisn' => $r['nisn'],
            'nama' => $r['nama'],
            'jkl'  => $r['jkl'],
        ]);

        AgtKelas::create([
            'siswa_id' => $siswa->id,
            'kelas_id' => $this->kelas_id,
        ]);

        User::create([
            'username' => $r['no_induk'],
            'password' => bcrypt(trim($r['no_induk'])),
            'role'     => 'siswa',
        ]);
    }
}
