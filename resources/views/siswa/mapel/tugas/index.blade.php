@extends('layouts.app')

@section('title', 'Siswa - Tugas Mata Pelajaran')

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
                    <div class="breadcrumb-item">Tugas</div>
                </div>
            </div>

            <div class="section-body">
                @foreach ($dataTugas as $tugas)    
                    <div class="card author-box card-primary">
                        <div class="card-header">
                            <h4>{{$tugas->nama}}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('siswa.mapel.detail.tugas.detail', encrypt($tugas->id)) }}" class="btn btn-primary">
                                    Lihat
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Tanggal: <b>{{$tugas->created_at}}</b>
                            <br>Batas Pengumpulan: <b>{{$tugas->batas}}</b></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
