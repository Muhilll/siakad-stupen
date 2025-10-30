@extends('layouts.app')

@section('title', 'Siswa - Detail Tugas Mata Pelajaran')

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
                    <div class="breadcrumb-item active"><a href="#">Tugas</a></div>
                    <div class="breadcrumb-item">Detail</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card author-box card-primary">
                    <div class="card-body">
                        <div class="ticket-content">
                            <div class="ticket-header">
                                <div class="ticket-detail">
                                    <div class="ticket-title">
                                        <h4>Tugas 1</h4>
                                    </div>
                                    <div class="ticket-info">
                                        <div class="font-weight-600">Farhan A. Mujib</div>
                                        <div class="bullet"></div>
                                        <div class="text-primary font-weight-600">Batas: <b>July 18, 2018</b></div>
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
                                        <input type="text" class="form-control" value="materi_bahasa_indonesia.pdf"
                                            readonly>
                                        <div class="input-group-append">
                                            <button {{--  Upload --}}
                                                id="modal-upload-tugas"
                                                class="btn btn-success d-flex align-items-center justify-content-center"
                                                title="Upload Tugas" style="width: 42px; height: 42px;">
                                                <i class="fas fa-upload"></i>
                                            </button>
                                            <a href="" {{-- target="_blank" --}}
                                                class="btn btn-info d-flex align-items-center justify-content-center"
                                                title="Lihat Materi" style="width: 42px; height: 42px; margin-left: 4px;">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="" {{-- download --}}
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
        </section>
    </div>

    @include('siswa.mapel.tugas.form')
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('js/siswa/tugas/tugas.js') }}"></script>
    <!-- Page Specific JS File -->
@endpush
