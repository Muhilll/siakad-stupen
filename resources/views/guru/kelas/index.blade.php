@extends('layouts.app')

@section('title', 'Guru - Kelas')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kelas Mata Pelajaran {{$mapel->nama}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('guru.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Kelas</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    @foreach ($dataMapelGuru as $mapelGuru)
                        @foreach ($mapelGuru->kelasMapel as $km)
                            <div class="col-lg-6">
                                <div class="card card-large-icons">
                                    <div class="card-icon bg-primary text-white">
                                        <i class="fa-solid fa-people-roof fa-4x"></i>
                                    </div>
                                    <div class="card-body">
                                        <h4>Kelas {{ $km->kelas->kode }}</h4>
                                        <a href="{{ route('guru.kelas.detail', encrypt($km->id)) }}" class="card-cta">Lihat<i
                                                class="fas fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush