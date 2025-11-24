<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi</title>

    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th,
        table td {
            border: 1px solid #444;
            padding: 6px 8px;
            text-align: center;
        }

        table th {
            background: #f0f0f0;
            font-weight: bold;
        }

        .header-section {
            text-align: center;
            margin-bottom: 20px;
        }

        .small-text {
            font-size: 10px;
            color: #666;
            margin-top: -5px;
        }

        .left {
            text-align: left !important;
        }
    </style>
</head>

<body>

    <div class="header-section">
        <h2>Laporan Absensi Siswa</h2>
        <div class="small-text">Dicetak pada: {{ now()->format('d M Y - H:i') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="2">#</th>
                <th rowspan="2" class="left">Nama Siswa</th>
                <th rowspan="2">NIS</th>
                <th rowspan="2">Jenis Kelamin</th>
                <th colspan="{{ count($absensiList) }}">Mata Pelajaran</th>
            </tr>
            <tr>
                @foreach ($absensiList as $absensi)
                    <th>{{ $absensi->kelasMapel->mapelGuru->mapel->nama }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($result as $siswa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="left">{{ $siswa['siswa']->nama }}</td>
                    <td>{{ $siswa['siswa']->nis }}</td>
                    <td>{{ $siswa['siswa']->jkl == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>

                    @foreach ($absensiList as $absensi)
                        <td>
                            @if ($siswa['kehadiran'][$absensi->id] == 'Hadir')
                                Hadir
                            @elseif($siswa['kehadiran'][$absensi->id] == 'Izin')
                                Izin
                            @else
                                -   
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>