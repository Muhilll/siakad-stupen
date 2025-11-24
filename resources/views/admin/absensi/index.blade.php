@extends('layouts.app')

@section('title', 'Admin - Rekap Absensi')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Rekap Absensi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Rekap Absensi</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="{{ route('admin.absensi.cetak') }}" method="POST">
                                @csrf
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <div class="d-flex gap-2">
                                        <select name="kelas_id" id="filter-kelas" class="form-control selectric" style="width: 250px">
                                            <option value="">Pilih Kelas</option>
                                            @foreach ($dataKelas as $kelas)
                                                <option value="{{ $kelas->id }}">{{ $kelas->kode }}</option>
                                            @endforeach
                                        </select>

                                        <select name="tanggal" id="filter-tanggal" class="form-control selectric mx-3"
                                            style="width: 250px">
                                            <option value="">Pilih Tanggal</option>
                                        </select>

                                        <button type="button" class="btn btn-primary ml-auto" id="lihat-absensi">
                                            Lihat
                                        </button>

                                    </div>

                                    <button class="btn btn-primary ml-auto" id="cetak-absensi" type="submit">
                                        Cetak
                                    </button>
                                </div>
                            </form>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">#</th>
                                                <th rowspan="2">Nama Siswa</th>
                                                <th rowspan="2">NIS</th>
                                                <th rowspan="2">Jenis Kelamin</th>
                                                <th colspan="{{ count($absensiList) }}" class="text-center">Mata Pelajaran
                                                </th>
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
                                                    <td>{{ $siswa['siswa']->nama }}</td>
                                                    <td>{{ $siswa['siswa']->nis }}</td>
                                                    <td>{{ $siswa['siswa']->jkl == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>

                                                    @foreach ($absensiList as $absensi)
                                                        <td>
                                                            {{ $siswa['kehadiran'][$absensi->id] ?? '-' }}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-table.js') }}"></script>
    <script src="{{ asset('js/admin/absensi/script.js') }}"></script>
@endpush
