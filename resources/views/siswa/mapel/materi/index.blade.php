@extends('layouts.app')

@section('title', 'Siswa - Materi')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/chocolat/dist/css/chocolat.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Materi Bahasa Indonesia</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="#">Mata Pelajaran</a></div>
                    <div class="breadcrumb-item active"><a href="#">Detail</a></div>
                    <div class="breadcrumb-item">Materi</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Materi Mata Pelajaran Bahasa Indonesia</h4>
                            </div>
                            <div class="card-body">
                                <a href="#" class="btn btn-primary btn-icon icon-left btn-lg btn-block d-md-none mb-4"
                                    data-toggle-slide="#ticket-items">
                                    <i class="fas fa-list"></i> All Tickets
                                </a>
                                <div class="tickets">
                                    <div class="ticket-items" id="ticket-items">
                                        @foreach ($dataMateri as $materi)
                                            <div class="ticket-item" data-id="{{ encrypt($materi->id) }}">
                                                <div class="ticket-title">
                                                    <h4>{{ $materi->nama }}</h4>
                                                </div>
                                                <div class="ticket-desc">
                                                    <div>{{ $materi->kelasMapel->mapelGuru->guru->nama_lengkap }}</div>
                                                    <div class="bullet"></div>
                                                    <div>{{ $materi->created_at }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="ticket-content">
                                    </div>
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
    <!-- JS Libraies -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/siswa/mapel/materi/detail.js') }}"></script>
@endpush
