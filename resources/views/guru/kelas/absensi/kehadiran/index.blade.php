@extends('layouts.app')

@section('title', 'Guru - Kehadiran Absensi')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kehadiran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="#">Kelas</a></div>
                    <div class="breadcrumb-item active"><a href="#">Detail</a></div>
                    <div class="breadcrumb-item active"><a href="#">Absensi</a></div>
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
                                    <input type="hidden" id="absensi_id" value="{{ $absensi_id }}">
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

    @include('guru.kelas.absensi.kehadiran.form')
@endsection

@push('scripts')
    <script src="{{ asset('js/guru/kelas/absensi/kehadiran.js') }}"></script>
@endpush
