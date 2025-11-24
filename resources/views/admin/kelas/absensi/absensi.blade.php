@extends('layouts.app')

@section('title', 'Admin - Absensi Mata Pelajaran')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Absensi Mata Pelajaran {{ $kelasMapel->mapelGuru->mapel->nama }} Kelas {{ $kelasMapel->kelas->kode }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.kelas.index') }}">Kelas</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.kelas.detail.index', encrypt($kelasMapel->kelas_id)) }}">Detail</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.kelas.detail.mapelForAbsensi', encrypt($kelasMapel->kelas_id)) }}">Absensi Kelas</a></div>
                <div class="breadcrumb-item">Absensi Mata Pelajaran</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Advanced Table</h4>
                            <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                    <input type="hidden" id="kelas_mapel_id" value="{{ $kelasMapel->id }}">
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabel-absensi" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Batas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                <ul class="pagination mb-0"></ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('scripts')
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

<script src="{{ asset('js/page/components-table.js') }}"></script>
<script src="{{ asset('js/admin/kelas/absensi/absensi.js') }}"></script>
@endpush