@extends('layouts.app')

@section('title', 'Siswa - Detail Tugas Mata Pelajaran')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
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
                                        <h4>{{ $tugas->nama }}</h4>
                                    </div>
                                    <div class="ticket-info">
                                        <div class="font-weight-600">Guru: {{ $tugas->kelasMapel->mapelGuru->guru->nama_lengkap }}
                                        </div>
                                        <p>{{ $tugas->des }}</p>
                                        <div class="text-primary font-weight-600">Batas: <b>{{ $tugas->batas }}</b></div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="ticket-description">
                                <div class="ticket-form">
                                    <p>Penjelasan Tugas:</p>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $tugas->file }}" readonly>
                                        <div class="input-group-append">
                                            <a href="/storage/tugas/{{ $tugas->file }}"
                                                class="btn btn-info d-flex align-items-center justify-content-center"
                                                title="Lihat Materi" style="width: 42px; height: 42px; margin-left: 4px;">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="ticket-form">
                                    <p>Tugas Saya:</p>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $pengumpulan->file ?? 'Belum ada file' }}" readonly>
                                        <div class="input-group-append">
                                            <button id="modal-upload-tugas"
                                                class="btn btn-success d-flex align-items-center justify-content-center"
                                                title="Upload Tugas" style="width: 42px; height: 42px;">
                                                <i class="fas fa-upload"></i>
                                            </button>
                                            <a href="/storage/submission/{{ $pengumpulan->file }}"
                                                class="btn btn-info d-flex align-items-center justify-content-center"
                                                title="Lihat Materi" style="width: 42px; height: 42px; margin-left: 4px;">
                                                <i class="fas fa-eye"></i>
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

    
    <!-- Modal Tambah/Edit Tugas -->
    <div class="modal fade" id="modalTugas" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="formTugas" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTugasLabel">Tambah Tugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('siswa.mapel.tugas.form')
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="tugas_id" id="tugas_id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

    <script src="{{ asset('js/page/components-table.js') }}"></script>
    <script src="{{ asset('js/siswa/mapel/tugas/modal.js') }}"></script>
    <!-- Page Specific JS File -->
@endpush
