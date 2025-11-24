@extends('layouts.app')

@section('title', 'Admin - Pengajar Mata Pelajaran')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pengajar Mata Pelajaran {{ $mapel->nama }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('admin.mapel.index') }}">Mata Pelajaran</a></div>
                    <div class="breadcrumb-item">Pengajar</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Pengajar</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <button class="btn btn-primary mx-2" id="modal-tambah-mapel-guru">
                            <i class="fa fa-plus"></i> Tambah
                        </button>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border"></ul>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0"></ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modalMapelGuru" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-tambah-mapel-guru">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalMapelGuruLabel">Tambah Pengajar</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="mapel_id" id="mapel_id" value="{{ $mapel->id }}">
                        <div class="form-group">
                            <label>Guru Pengampu</label>
                            <select class="form-control" name="guru_id" required>
                                <option value="">-- Pilih Guru --</option>
                                @foreach ($dataGuru as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->nama_lengkap }} ({{$guru->nip}})</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.mapel.guru.form')
@endsection

@push('scripts')
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

    <script src="{{ asset('js/page/components-table.js') }}"></script>
    <script src="{{ asset('js/admin/mapel/guru/modal.js') }}"></script>
@endpush
