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
                                        <div class="ticket-item active">
                                            <div class="ticket-title">
                                                <h4>Pertemuan 1</h4>
                                            </div>
                                            <div class="ticket-desc">
                                                <div>Farhan A. Mujib</div>
                                                <div class="bullet"></div>
                                                <div>July 18, 2018</div>
                                            </div>
                                        </div>
                                        <div class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>Pertemuan 2</h4>
                                            </div>
                                            <div class="ticket-desc">
                                                <div>Amanda Aprilia Azmi</div>
                                                <div class="bullet"></div>
                                                <div>July 18, 2018</div>
                                            </div>
                                        </div>
                                        <div class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>Pertemuan 3</h4>
                                            </div>
                                            <div class="ticket-desc">
                                                <div>Irwansyah Saputra</div>
                                                <div class="bullet"></div>
                                                <div>July 18, 2018</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ticket-content">
                                        <div class="ticket-header">
                                            <div class="ticket-sender-picture img-shadow">
                                                <img src="{{ asset('img/avatar/avatar-5.png') }}" alt="image">
                                            </div>
                                            <div class="ticket-detail">
                                                <div class="ticket-title">
                                                    <h4>Pertemuan 1</h4>
                                                </div>
                                                <div class="ticket-info">
                                                    <div class="font-weight-600">Farhan A. Mujib</div>
                                                    <div class="bullet"></div>
                                                    <div class="text-primary font-weight-600">July 18, 2018</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ticket-description">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                                non
                                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                                non
                                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                                            <div class="ticket-form">
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        value="materi_bahasa_indonesia.pdf" readonly>
                                                    <div class="input-group-append">
                                                        <a href="" 
                                                        {{-- target="_blank" --}}
                                                            class="btn btn-info d-flex align-items-center justify-content-center"
                                                            title="Lihat Materi" style="width: 42px; height: 42px;">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="" 
                                                        {{-- download --}}
                                                            class="btn btn-primary d-flex align-items-center justify-content-center"
                                                            title="Download Materi"
                                                            style="width: 42px; height: 42px; margin-left: 4px;">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
@endpush
