@extends('layouts.app')

@section('title', 'Guru - Detail Kelas')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Kelas {{$kelas->tingkat}} - {{$kelas->kode}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="#">Kelas</a></div>
                    <div class="breadcrumb-item">Detail</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fa fa-users fa-4x"></i>
                            </div>
                            <div class="card-body">
                                <h4>Siswa</h4>
                                <p>Daftar siswa pada kelas <b>{{$kelas->tingkat}} - {{$kelas->kode}}</b></p>
                                <a href="{{route('guru.kelas.detail.siswa', ['kelas_mapel_id' => $kelas_mapel_id])}}"
                                    class="card-cta">Lihat<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fa-solid fa-book fa-4x"></i>
                            </div>
                            <div class="card-body">
                                <h4>Materi</h4>
                                <p>Daftar materi pada kelas <b>{{$kelas->tingkat}} - {{$kelas->kode}}</b></p>
                                <a href="{{route('guru.kelas.detail.materi', ['kelas_mapel_id' => $kelas_mapel_id])}}"
                                    class="card-cta">Lihat<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fa-solid fa-list-check fa-4x"></i>
                            </div>
                            <div class="card-body">
                                <h4>Tugas</h4>
                                <p>Daftar tugas pada kelas <b>{{$kelas->tingkat}} - {{$kelas->kode}}</b></p>
                                <a href="{{route('guru.kelas.detail.tugas', ['kelas_mapel_id' => $kelas_mapel_id])}}"
                                    class="card-cta">Lihat<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fa-solid fa-list-check fa-4x"></i>
                            </div>
                            <div class="card-body">
                                <h4>Absensi</h4>
                                <p>Daftar absensi pada kelas <b>{{$kelas->tingkat}} - {{$kelas->kode}}</b></p>
                                <a href="{{route('guru.kelas.detail.absensi', ['kelas_mapel_id' => $kelas_mapel_id])}}"
                                    class="card-cta">Lihat<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
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
