@extends('layouts.app')

@section('title', 'Siswa - Guru Mata Pelajaran')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Guru Mata Pelajaran Bahasa Indonesia Kelas 7A</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="#">Mata Pelajaran</a></div>
                    <div class="breadcrumb-item active"><a href="#">Detail</a></div>
                    <div class="breadcrumb-item">Guru</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card author-box card-primary">
                    <div class="card-body">
                        <div class="author-box-left">
                            <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}"
                                class="rounded-circle author-box-picture">
                            <div class="clearfix"></div>
                            <a href="#" class="btn btn-primary follow-btn mt-3"
                                data-follow-action="alert('follow clicked');"
                                data-unfollow-action="alert('unfollow clicked');">Follow</a>
                        </div>
                        <div class="author-box-details">
                            <div class="author-box-name">
                                <a href="#">Hasan Basri</a>
                            </div>
                            <div class="author-box-job">Web Developer</div>
                            <div class="author-box-description">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</p>
                            </div>
                            <div class="mb-2 mt-3">
                                <div class="text-small font-weight-bold">Lorem ipsum</div>
                            </div>
                            <a href="#" class="btn btn-social-icon btn-facebook mr-1">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-social-icon btn-twitter mr-1">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-social-icon btn-github mr-1">
                                <i class="fab fa-github"></i>
                            </a>
                            <a href="#" class="btn btn-social-icon btn-instagram mr-1">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <div class="w-100 d-sm-none"></div>
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
