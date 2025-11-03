@extends('layouts.app')

@section('title', 'Admin - Detail Kelas')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Kelas</h1>
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
                                <p>General settings such as, site title, site description, address and so on.</p>
                                <a href="{{route('admin.kelas.detail.siswa')}}"
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
                                <h4>Mata Pelajaran</h4>
                                <p>Search engine optimization settings, such as meta tags and social media.</p>
                                <a href="{{route('admin.kelas.detail.mapel')}}"
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
