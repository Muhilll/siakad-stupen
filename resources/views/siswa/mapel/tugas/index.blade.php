@extends('layouts.app')

@section('title', 'Siswa - Tugas Mata Pelajaran')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tugas Mata Pelajaran Bahasa Indonesia Kelas 7A</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="#">Mata Pelajaran</a></div>
                    <div class="breadcrumb-item active"><a href="#">Detail</a></div>
                    <div class="breadcrumb-item">Tugas</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card author-box card-primary">
                    <div class="card-header">
                        <h4>Tugas 1</h4>
                        <div class="card-header-action">
                            <a href="{{ route('siswa.mapel.detail.tugas.detail') }}" class="btn btn-primary">
                                Lihat
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Batas: <b>July 18, 2018</b></p>
                    </div>
                </div>
                <div class="card author-box card-primary">
                    <div class="card-header">
                        <h4>Tugas 2</h4>
                        <div class="card-header-action">
                            <a href="{{ route('siswa.mapel.detail.tugas.detail', $kelas_mapel_id) }}" class="btn btn-primary">
                                Lihat
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Batas: <b>July 18, 2018</b></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
