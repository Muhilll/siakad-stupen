@extends('layouts.app')

@section('title', 'Guru - Tugas Kelas')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tugas Kelas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Kelas</a></div>
                <div class="breadcrumb-item active"><a href="#">Detail</a></div>
                <div class="breadcrumb-item">Tugas</div>
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
                                    <input type="hidden" id="kelas_mapel_id" value="{{ $kelas_mapel_id }}">
                                </form>
                            </div>
                            <button class="btn btn-primary mx-2" id="modal-tambah-tugas">
                                <i class="fa fa-plus"></i>
                                Tambah
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabel-tugas" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Deskripsi</th>
                                            <th>File</th>
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
                    @include('guru.kelas.tugas.form')
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
<script src="{{ asset('js/guru/kelas/tugas/modal.js') }}"></script>
@endpush
