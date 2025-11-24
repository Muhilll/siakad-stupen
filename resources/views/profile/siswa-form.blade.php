<input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
<div class="form-group">
    <label>NIS</label>
    <input type="text" class="form-control" value="{{ $profile->nis }}" name="nis" placeholder="Masukkan NIS"
        readonly>
    <div class="invalid-feedback"></div>
</div>
<div class="form-group">
    <label>NISN</label>
    <input type="text" class="form-control" value="{{ $profile->nisn }}" name="nisn"
        placeholder="Masukkan NISN" readonly>
    <div class="invalid-feedback"></div>
</div>
<div class="form-group">
    <label>Nama Lengkap</label>
    <input type="text" class="form-control" value="{{ $profile->nama }}" name="nama"
        placeholder="Masukkan nama lengkap" readonly>
</div>
<div class="form-group">
    <label>Jenis Kelamin</label>
    <input type="text" class="form-control" value="{{ $profile->jkl == 'L' ? 'Laki-laki' : 'Perempuan' }}"
        name="jkl" placeholder="Masukkan jenis kelamin" readonly>
</div>
<div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="password" placeholder="Masukkan password" required>
    <div class="invalid-feedback"></div>
</div>