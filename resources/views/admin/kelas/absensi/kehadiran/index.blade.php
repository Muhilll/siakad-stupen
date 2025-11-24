@extends('layouts.app')

@section('title', 'Admin - Kehadiran Absensi Mata Pelajaran')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>
                    Daftar Hadir {{ $absensi->nama }} <br>
                    Mata Pelajaran {{ $absensi->kelasMapel->mapelGuru->mapel->nama }} <br>
                    Kelas {{ $absensi->kelasMapel->kelas->kode }}
                </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('admin.kelas.index') }}">Kelas</a></div>
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.kelas.detail.index', encrypt($absensi->kelasMapel->kelas_id)) }}">Detail</a>
                    </div>
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.kelas.detail.mapelForAbsensi', encrypt($absensi->kelasMapel->kelas_id)) }}">Absensi
                            Kelas</a></div>
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.kelas.detail.absensi', encrypt($absensi->kelasMapel->id)) }}">Absensi Mata
                            Pelajaran</a></div>
                    <div class="breadcrumb-item">Kehadiran</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Kehadiran</h4>
                        <div class="card-header-form">
                            <form id="formSearchKehadiran">
                                <div class="input-group">
                                    <input type="text" id="search" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary">Search</button>
                                    </div>
                                    <input type="hidden" id="absensi_id" value="{{ $absensi->id }}">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabel-kehadiran" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Siswa</th>
                                        <th>NIS</th>
                                        <th>Status</th>
                                        <th>Tanggal Absensi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav>
                            <ul class="pagination mb-0"></ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('admin.kelas.absensi.kehadiran.form')
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/kelas/absensi/kehadiran.js') }}"></script>
@endpush
