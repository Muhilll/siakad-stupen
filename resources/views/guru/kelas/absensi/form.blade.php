<div class="form-group">
    <label>Nama Absensi</label>
    <input type="text" class="form-control" name="nama" placeholder="Nama Absensi" required>
</div>

<div class="form-group">
    <label>Batas Waktu</label>
    <input type="datetime-local" class="form-control" name="batas" required>
</div>

<input type="hidden" name="kelas_mapel_id" value="{{ $kelasMapel->id }}">
