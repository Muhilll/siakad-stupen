@extends('layouts.app')

@section('title', 'Admin - Pengajar Mata Pelajaran')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pengajar Mata Pelajaran Bahasa Indonesia</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="#">Mata Pelajaran</a></div>
                    <div class="breadcrumb-item">Pengajar</div>
                </div>
            </div>

            <div class="section-body">
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
                            </form>
                        </div>
                        <button class="btn btn-primary mx-2" id="modal-tambah-mapel-guru">
                            <i class="fa fa-plus"></i>
                            Tambah
                        </button>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border">
                            <li class="media align-items-center">
                                <img class="rounded-circle mr-3" width="50" src="{{ asset('img/avatar/avatar-4.png') }}"
                                    alt="avatar">

                                <div class="media-body">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div>
                                            <h6 class="media-title mb-0">
                                                <a href="#">Redesign header</a>
                                            </h6>
                                            <div class="text-small text-muted">
                                                Alfa Zulkarnain <div class="bullet"></div>
                                                <span class="text-primary">Now</span>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                    title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                    data-confirm-yes="alert('Deleted')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="media align-items-center">
                                <img class="rounded-circle mr-3" width="50" src="{{ asset('img/avatar/avatar-4.png') }}"
                                    alt="avatar">

                                <div class="media-body">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div>
                                            <h6 class="media-title mb-0">
                                                <a href="#">Redesign header</a>
                                            </h6>
                                            <div class="text-small text-muted">
                                                Alfa Zulkarnain <div class="bullet"></div>
                                                <span class="text-primary">Now</span>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                    title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                    data-confirm-yes="alert('Deleted')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="media align-items-center">
                                <img class="rounded-circle mr-3" width="50" src="{{ asset('img/avatar/avatar-4.png') }}"
                                    alt="avatar">

                                <div class="media-body">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div>
                                            <h6 class="media-title mb-0">
                                                <a href="#">Redesign header</a>
                                            </h6>
                                            <div class="text-small text-muted">
                                                Alfa Zulkarnain <div class="bullet"></div>
                                                <span class="text-primary">Now</span>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                    title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                    data-confirm-yes="alert('Deleted')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="media align-items-center">
                                <img class="rounded-circle mr-3" width="50" src="{{ asset('img/avatar/avatar-4.png') }}"
                                    alt="avatar">

                                <div class="media-body">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div>
                                            <h6 class="media-title mb-0">
                                                <a href="#">Redesign header</a>
                                            </h6>
                                            <div class="text-small text-muted">
                                                Alfa Zulkarnain <div class="bullet"></div>
                                                <span class="text-primary">Now</span>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                    title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                    data-confirm-yes="alert('Deleted')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('admin.mapel.guru.form')
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-table.js') }}"></script>
    <script src="{{ asset('js/admin/mapel/modal.js') }}"></script>
@endpush
