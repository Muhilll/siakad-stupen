
{{-- NAMA LENGKAP --}}
<div class="form-group">
    <label>Nama Lengkap</label>
    <input type="text" class="form-control" value="{{ $profile->nama_lengkap }}" name="nama_lengkap" readonly>
    <div class="invalid-feedback"></div>
</div>

{{-- NIP --}}
<div class="form-group">
    <label>NIP</label>
    <input type="text" class="form-control" value="{{ $profile->nip }}" name="nip" placeholder="Masukkan NIP" readonly>
    <div class="invalid-feedback"></div>
</div>

{{-- NUPTK --}}
<div class="form-group">
    <label>NUPTK</label>
    <input type="text" class="form-control" value="{{ $profile->nuptk }}" name="nuptk" placeholder="Masukkan NUPTK" required readonly>
    <div class="invalid-feedback"></div>
</div>

{{-- JENIS KELAMIN --}}
<div class="form-group">
    <label>Jenis Kelamin</label>
    <input type="text" class="form-control" value="{{ $profile->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}"
        name="jkl" placeholder="Masukkan jenis kelamin" readonly>
</div>

<div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="password" placeholder="Masukkan password" required>
    <div class="invalid-feedback"></div>
</div>

