<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\User;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeachersImport implements OnEachRow, WithHeadingRow
{
    /**
     * @param Collection $collection
     */

    private function indoToDate($text)
    {
        if (!$text || trim($text) === '') return null;

        $months = [
            'Januari' => '01',
            'Februari' => '02',
            'Maret' => '03',
            'April' => '04',
            'Mei' => '05',
            'Juni' => '06',
            'Juli' => '07',
            'Agustus' => '08',
            'September' => '09',
            'Oktober' => '10',
            'November' => '11',
            'Desember' => '12',
        ];

        $parts = explode(' ', $text);

        if (count($parts) !== 3) return null;

        [$day, $monthName, $year] = $parts;

        $month = $months[$monthName] ?? null;

        if (!$month) return null;

        return "$year-$month-$day";
    }

    private function jklToCode($jkl)
    {
        $jkl = strtolower(trim($jkl));
        if ($jkl === 'laki-laki' || $jkl === 'l') {
            return 'L';
        } elseif ($jkl === 'perempuan' || $jkl === 'p') {
            return 'P';
        } else {
            return null;
        }
    }

    public function onRow(Row $row)
    {
        $r = $row->toArray();

        Guru::create([
            'jenis_ptk' => $r['jenis_ptk'],
            'nama_lengkap' => $r['nama_lengkap'],
            'nip' => $r['nip'],
            'pangkat' => $r['pangkat'],
            'golongan' => $r['golongan'],
            'tmt' => $this->indoToDate($r['tmt']),
            'mkg_cpns_tahun' => $r['mkg_cpns_tahun'],
            'mkg_cpns_bulan' => $r['mkg_cpns_bulan'],
            'mkg_total_tahun' => $r['mkg_total_tahun'],
            'mkg_total_bulan' => $r['mkg_total_bulan'],
            'jenis_kelamin' => $this->jklToCode($r['jenis_kelamin']),
            'tanggal_lahir' => $this->indoToDate($r['tanggal_lahir']),
            'agama' => $r['agama'],
            'nik' => $r['nik'],
            'nuptk' => $r['nuptk'],
            'no_hp' => $r['no_hp'],
            'email' => $r['email'],
            'jabatan' => $r['jabatan'],
            'sertifikasi_bidang_studi' => $r['sertifikasi_bidang_studi'],
            'sertifikasi_tahun' => $r['sertifikasi_tahun'],
            'pendidikan_jenjang' => $r['pendidikan_jenjang'],
            'pendidikan_gelar' => $r['pendidikan_gelar'],
            'pendidikan_bidang_studi' => $r['pendidikan_bidang_studi'],
            'pendidikan_tahun' => $r['pendidikan_tahun'],
        ]);

        User::create([
            'username' => $r['nip'],
            'password' => bcrypt(trim($r['nip'])),
            'role'     => 'guru',
        ]);
    }
}
