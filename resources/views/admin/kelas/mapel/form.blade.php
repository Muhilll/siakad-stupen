<input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
<!-- MAPEL -->
<div class="form-group">
    <label>Pilih Mata Pelajaran</label>
    <input type="text" id="search-mapel" class="form-control mb-2" placeholder="Cari mapel...">
    <select name="mapel_id" id="mapel_id" class="form-control" required>
        <option value="">-- Pilih Mata Pelajaran --</option>
    </select>
    <div class="invalid-feedback"></div>
</div>

<!-- GURU -->
<div class="form-group">
    <label>Pilih Guru</label>
    <input type="text" id="search-guru" class="form-control mb-2" placeholder="Cari guru..." disabled>
    <select name="mapel_guru_id" id="mapel_guru_id" class="form-control" required disabled>
        <option value="">-- Pilih Guru --</option>
    </select>
    <div class="invalid-feedback"></div>
</div>  
