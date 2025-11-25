@extends('layouts.app')

@section('title', 'Admin - Kelas - Mata Pelajaran')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Mata Pelajaran Kelas {{ $kelas->kode }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('admin.kelas.index') }}">Kelas</a></div>
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.kelas.detail.index', encrypt($kelas->id)) }}">Detail</a></div>
                    <div class="breadcrumb-item">Mata Pelajaran</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Advanced Table</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <button class="btn btn-primary mx-2" id="modal-tambah-kelas-mapel">
                            <i class="fa fa-plus"></i>
                            Tambah
                        </button>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border" id="list-kelas-mapel">
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modalTambahKelasMapel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-tambah-kelas-mapel">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Mata Pelajaran</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        @include('admin.kelas.mapel.form')
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
    <script src="{{ asset('js/admin/kelas/mapel/modal.js') }}"></script>
@endpush
