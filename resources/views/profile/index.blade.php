@extends('layouts.app')

@section('title', 'Profile')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Hi,
                    @if (auth()->user()->role == 'guru')
                        {{ $profile->nama_lengkap }}
                    @elseif (auth()->user()->role == 'siswa')
                        {{ $profile->nama }}
                    @else
                        Admin
                    @endif
                </h2>

                @if (session('success') === 'password')
                    <div class="alert alert-success mt-2">
                        <p>{{ session('message') }}</p>
                    </div>
                @endif

                <form action="{{ route('profile.update.password') }}" method="POST">
                    @csrf
                    <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Profile</h4>
                        </div>
                        <div class="card-body">
                            @if (auth()->user()->role == 'guru')
                                @include('profile.guru-form')
                            @elseif (auth()->user()->role == 'siswa')
                                @include('profile.siswa-form')
                            @else
                                @include('profile.admin-form')
                            @endif
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush
