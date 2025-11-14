<div class="modal fade" id="modalDetailGuru" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Guru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form-detail-guru">
                    {{-- Jenis PTK --}}
                    <div class="form-group">
                        <label>Jenis PTK</label>
                        <select class="form-control" name="jenis_ptk" disabled>
                            <option value="" disabled selected>Pilih jenis PTK</option>
                            <option value="Pendidik (Guru)">Pendidik (Guru)</option>
                            <option value="Kepala Sekolah">Kepala Sekolah</option>
                            <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
                        </select>
                    </div>

                    {{-- NAMA LENGKAP --}}
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" readonly>
                    </div>

                    {{-- NIP --}}
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" name="nip" readonly>
                    </div>

                    {{-- PANGKAT --}}
                    <div class="form-group">
                        <label>Pangkat</label>
                        <input type="text" class="form-control" name="pangkat" readonly>
                    </div>

                    {{-- GOLONGAN --}}
                    <div class="form-group">
                        <label>Golongan</label>
                        <input type="text" class="form-control" name="golongan" readonly>
                    </div>

                    {{-- TMT --}}
                    <div class="form-group">
                        <label>TMT</label>
                        <input type="date" class="form-control" name="tmt" readonly>
                    </div>

                    {{-- MKG CPNS --}}
                    <div class="form-group">
                        <label>MKG CPNS</label>
                        <div class="row">
                            <div class="col">
                                <input type="number" class="form-control" name="mkg_cpns_tahun" placeholder="Tahun"
                                    readonly>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" name="mkg_cpns_bulan" placeholder="Bulan"
                                    readonly>
                            </div>
                        </div>
                    </div>

                    {{-- MKG TOTAL --}}
                    <div class="form-group">
                        <label>MKG TOTAL</label>
                        <div class="row">
                            <div class="col">
                                <input type="number" class="form-control" name="mkg_total_tahun" placeholder="Tahun"
                                    readonly>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" name="mkg_total_bulan" placeholder="Bulan"
                                    readonly>
                            </div>
                        </div>
                    </div>

                    {{-- NUPTK --}}
                    <div class="form-group">
                        <label>NUPTK</label>
                        <input type="text" class="form-control" name="nuptk" readonly>
                    </div>

                    {{-- NIK --}}
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" name="nik" readonly>
                    </div>

                    {{-- JENIS KELAMIN --}}
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" disabled>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    {{-- TEMPAT LAHIR --}}
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" readonly>
                    </div>

                    {{-- TANGGAL LAHIR --}}
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" readonly>
                    </div>

                    {{-- AGAMA --}}
                    <div class="form-group">
                        <label>Agama</label>
                        <select class="form-control" name="agama" disabled>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>

                    {{-- No HP --}}
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" class="form-control" name="no_hp" readonly>
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" readonly>
                    </div>

                    {{-- Jabatan --}}
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" readonly>
                    </div>

                    {{-- SERTIFIKASI BIDANG STUDI --}}
                    <div class="form-group">
                        <label>Sertifikasi Bidang Studi</label>
                        <input type="text" class="form-control" name="sertifikasi_bidang_studi" readonly>
                    </div>

                    {{-- SERTIFIKASI TAHUN --}}
                    <div class="form-group">
                        <label>Tahun Sertifikasi</label>
                        <input type="text" class="form-control" name="sertifikasi_tahun" readonly>
                    </div>

                    {{-- PENDIDIKAN TERAKHIR --}}
                    <h6 class="mt-3">Pendidikan Terakhir</h6>

                    <div class="form-group">
                        <label>Jenjang</label>
                        <select class="form-control" name="pendidikan_jenjang" disabled>
                            <option value="SMA">SMA</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Gelar</label>
                        <input type="text" class="form-control" name="pendidikan_gelar" readonly>
                    </div>

                    <div class="form-group">
                        <label>Bidang Studi</label>
                        <input type="text" class="form-control" name="pendidikan_bidang_studi" readonly>
                    </div>

                    <div class="form-group">
                        <label>Tahun Lulus</label>
                        <input type="text" class="form-control" name="pendidikan_tahun" readonly>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
