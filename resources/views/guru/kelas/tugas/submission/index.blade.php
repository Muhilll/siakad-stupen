@extends('layouts.app')

@section('title', 'Guru - Submission Tugas')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Submission Tugas Mata Pelajaran {{ $kelasMapel->mapelGuru->mapel->nama }} Kelas {{ $kelasMapel->kelas->kode }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('guru.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('guru.kelas') }}">Kelas</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('guru.kelas.detail', encrypt($kelasMapel->id)) }}">Detail</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('guru.kelas.detail.tugas', encrypt($kelasMapel->id)) }}">Tugas</a></div>
                <div class="breadcrumb-item">Submission</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Submission</h4>
                    <div class="card-header-form">
                        <form id="formSearchSubmission">
                            <div class="input-group">
                                <input type="text" id="search" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary">Search</button>
                                </div>
                                <input type="hidden" id="tugas_id" value="{{ $tugas_id }}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabel-submission" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Siswa</th>
                                    <th>Deskripsi</th>
                                    <th>File</th>
                                    <th>Status</th>
                                    <th>Tanggal Kirim</th>
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
@endsection

@push('scripts')
<script src="{{ asset('js/guru/kelas/tugas/submission.js') }}"></script>
@endpush
