{{-- Jenis PTK --}}
<div class="form-group">
    <label>Jenis PTK</label>
    <select class="form-control" name="jenis_ptk">
        <option value="" disabled selected>Pilih jenis PTK</option>
        <option value="Pendidik (Guru)">Pendidik (Guru)</option>
        <option value="Kepala Sekolah">Kepala Sekolah</option>
        <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
    </select>
    <div class="invalid-feedback"></div>
</div>

{{-- NAMA LENGKAP --}}
<div class="form-group">
    <label>Nama Lengkap</label>
    <input type="text" class="form-control" name="nama_lengkap">
    <div class="invalid-feedback"></div>
</div>

{{-- NIP --}}
<div class="form-group">
    <label>NIP</label>
    <input type="text" class="form-control" name="nip" placeholder="Masukkan NIP" required>
    <div class="invalid-feedback"></div>
</div>

{{-- PANGKAT --}}
<div class="form-group">
    <label>Pangkat</label>
    <input type="text" class="form-control" name="pangkat" placeholder="Misal: Penata Muda / IIIa">
    <div class="invalid-feedback"></div>
</div>

{{-- GOLONGAN --}}
<div class="form-group">
    <label>Golongan</label>
    <input type="text" class="form-control" name="golongan" placeholder="Misal: III/a">
    <div class="invalid-feedback"></div>
</div>

{{-- TMT --}}
<div class="form-group">
    <label>TMT</label>
    <input type="date" class="form-control" name="tmt">
    <div class="invalid-feedback"></div>
</div>

{{-- MKG CPNS --}}
<div class="form-group">
    <label>MKG CPNS</label>
    <div class="row">
        <div class="col">
            <input type="number" class="form-control" name="mkg_cpns_tahun" placeholder="Tahun">
        </div>
        <div class="col">
            <input type="number" class="form-control" name="mkg_cpns_bulan" placeholder="Bulan">
        </div>
    </div>
    <div class="invalid-feedback"></div>
</div>

{{-- MKG TOTAL --}}
<div class="form-group">
    <label>MKG TOTAL</label>
    <div class="row">
        <div class="col">
            <input type="number" class="form-control" name="mkg_total_tahun" placeholder="Tahun">
        </div>
        <div class="col">
            <input type="number" class="form-control" name="mkg_total_bulan" placeholder="Bulan">
        </div>
    </div>
    <div class="invalid-feedback"></div>
</div>

{{-- NUPTK --}}
<div class="form-group">
    <label>NUPTK</label>
    <input type="text" class="form-control" name="nuptk" placeholder="Masukkan NUPTK" required>
    <div class="invalid-feedback"></div>
</div>

{{-- NIK --}}
<div class="form-group">
    <label>NIK</label>
    <input type="text" class="form-control" name="nik" placeholder="Masukkan NIK">
    <div class="invalid-feedback"></div>
</div>

{{-- JENIS KELAMIN --}}
<div class="form-group">
    <label>Jenis Kelamin</label>
    <select class="form-control" name="jenis_kelamin">
        <option value="" disabled selected>Pilih jenis kelamin</option>
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
    </select>
    <div class="invalid-feedback"></div>
</div>

{{-- TANGGAL LAHIR --}}
<div class="form-group">
    <label>Tanggal Lahir</label>
    <input type="date" class="form-control" name="tanggal_lahir">
    <div class="invalid-feedback"></div>
</div>

{{-- AGAMA --}}
<div class="form-group">
    <label>Agama</label>
    <select class="form-control" name="agama">
        <option value="" disabled selected>Pilih agama</option>
        <option value="Islam">Islam</option>
        <option value="Kristen">Kristen</option>
        <option value="Katolik">Katolik</option>
        <option value="Hindu">Hindu</option>
        <option value="Buddha">Buddha</option>
        <option value="Konghucu">Konghucu</option>
    </select>
    <div class="invalid-feedback"></div>
</div>

{{-- No HP --}}
<div class="form-group">
    <label>No HP</label>
    <input type="text" class="form-control" name="no_hp">
    <div class="invalid-feedback"></div>
</div>

{{-- Email --}}
<div class="form-group">
    <label>Email</label>
    <input type="email" class="form-control" name="email">
    <div class="invalid-feedback"></div>
</div>

{{-- Jabatan --}}
<div class="form-group">
    <label>Jabatan</label>
    <input type="text" class="form-control" name="jabatan" placeholder="Misal: Guru Kelas / Guru Mapel">
    <div class="invalid-feedback"></div>
</div>

{{-- SERTIFIKASI BIDANG STUDI --}}
<div class="form-group">
    <label>Sertifikasi Bidang Studi</label>
    <input type="text" class="form-control" name="sertifikasi_bidang_studi"
        placeholder="Bidang studi sertifikasi">
    <div class="invalid-feedback"></div>
</div>

{{-- SERTIFIKASI TAHUN --}}
<div class="form-group">
    <label>Tahun Sertifikasi</label>
    <input type="text" class="form-control" name="sertifikasi_tahun" placeholder="Misal: 2018">
    <div class="invalid-feedback"></div>
</div>

{{-- PENDIDIKAN TERAKHIR --}}
<h6 class="mt-3">Pendidikan Terakhir</h6>

<div class="form-group">
    <label>Jenjang</label>
    <select class="form-control" name="pendidikan_jenjang">
        <option value="" disabled selected>Pilih jenjang</option>
        <option value="SMA">SMA</option>
        <option value="D3">D3</option>
        <option value="S1">S1</option>
        <option value="S2">S2</option>
        <option value="S3">S3</option>
    </select>
    <div class="invalid-feedback"></div>
</div>

{{-- GELAR --}}
<div class="form-group">
    <label>Gelar</label>
    <input type="text" class="form-control" name="pendidikan_gelar" placeholder="Misal: S.Pd / M.Pd">
    <div class="invalid-feedback"></div>
</div>

{{-- BIDANG STUDI --}}
<div class="form-group">
    <label>Bidang Studi</label>
    <input type="text" class="form-control" name="pendidikan_bidang_studi">
    <div class="invalid-feedback"></div>
</div>

{{-- TAHUN LULUS --}}
<div class="form-group">
    <label>Tahun Lulus</label>
    <input type="text" class="form-control" name="pendidikan_tahun" placeholder="Misal: 2020">
    <div class="invalid-feedback"></div>
</div>