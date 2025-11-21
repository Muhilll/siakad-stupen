@extends('layouts.app')

@section('title', 'Siswa - Absensi Kelas')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Absensi Kelas</h1>
            </div>

            <div class="section-body">
                @foreach ($dataAbsensi as $absensi)
                    <div class="card author-box card-primary">
                        <div class="card-header">
                            <h4>{{ $absensi->nama }}</h4>

                            <div class="card-header-action">
                                @if ($absensi->kehadiran->count() > 0)
                                    <button class="btn btn-success" disabled>Sudah Submit</button>
                                @else
                                    <button class="btn btn-primary btn-submit-absensi" data-id="{{ $absensi->id }}"
                                        data-nama="{{ $absensi->nama }}">
                                        Submit Absensi
                                    </button>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <p>Tanggal Dibuat: {{ $absensi->created_at }}
                                <br>Batas Submit: {{ $absensi->batas }}
                            </p>

                            <p>
                                Status:
                                @if ($absensi->kehadiran->count() > 0)
                                    <br>
                                    <span class="badge badge-success">{{ $absensi->kehadiran[0]->ket }}</span>
                                    <span class="badge badge-info">{{ $absensi->kehadiran[0]->status }}</span>
                                @else
                                    <span class="badge badge-danger">Belum Submit</span>
                                @endif
                            </p>

                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="modalAbsensi" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formAbsensi">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAbsensiLabel">Submit Absensi</h5>
                    </div>

                    <div class="modal-body">
                        @include('siswa.mapel.absensi.form')
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="absensi_id" id="absensi_id_hidden">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="btnSimpan">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/siswa/mapel/absensi/submit.js') }}"></script>
@endpush
