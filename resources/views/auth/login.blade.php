@extends('layouts.auth')

@section('title', 'Login')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
<div class="card card-primary">
    <div class="card-header justify-content-center">
        <h4>Login</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('login.process') }}" class="needs-validation" novalidate="">
            @csrf

            {{-- LEVEL --}}
            <div class="form-group">
                <label for="level">Masuk sebagai</label>
                <select class="form-control" name="level" id="level" required>
                    <option value="">-- Pilih Level --</option>
                    <option value="siswa">Siswa</option>
                    <option value="guru">Guru</option>
                </select>
                <div class="invalid-feedback">
                    Silakan pilih level user
                </div>
            </div>

            {{-- MAPEL (Hanya muncul jika guru) --}}
            <div class="form-group d-none" id="mapel-wrapper">
                <label for="mapel">Mengampu Mapel</label>
                <select class="form-control" name="mapel_id" id="mapel">
                    <option value="">-- Pilih Mapel --</option>
                    @foreach ($mapels as $mapel)
                        <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                    @endforeach
                </select>
            </div>

            {{-- NIS --}}
            <div class="form-group">
                <label for="email">NIS/NIP</label>
                <input class="form-control" name="nis" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                    Please fill in your NIS/NIP
                </div>
            </div>

            {{-- PASSWORD --}}
            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">Password</label>
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                <div class="invalid-feedback">
                    please fill in your password
                </div>
            </div>

            {{-- REMEMBER --}}
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                </div>
            </div>

            {{-- SUBMIT --}}
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Tampilkan dropdown mapel jika memilih guru
    document.getElementById('level').addEventListener('change', function () {
        let mapelDiv = document.getElementById('mapel-wrapper');
        if (this.value === 'guru') {
            mapelDiv.classList.remove('d-none');
        } else {
            mapelDiv.classList.add('d-none');
        }
    });
</script>
@endpush
