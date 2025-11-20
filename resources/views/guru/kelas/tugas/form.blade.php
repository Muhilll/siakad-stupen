<input type="hidden" name="kelas_mapel_id" id="form_kelas_mapel_id" value="{{ $kelas_mapel_id }}">

<div class="form-group">
    <label>Nama Tugas</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-book"></i></div>
        </div>
        <input type="text" class="form-control" placeholder="Masukkan nama tugas" name="nama" required>
    </div>
    <div class="invalid-feedback"></div>
</div>

<div class="form-group">
    <label>Deskripsi</label>
    <textarea class="form-control" style="height: 120px; resize: none;" placeholder="Tuliskan deskripsi tugas"
        name="des" rows="3" required></textarea>
    <div class="invalid-feedback"></div>
</div>

<div class="form-group">
    <label>Batas Waktu</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
        </div>
        <input type="datetime-local" class="form-control" name="batas" required>
    </div>
    <div class="invalid-feedback"></div>
    <small class="form-text text-muted">Tentukan tanggal dan waktu akhir pengumpulan tugas.</small>
</div>

<div class="form-group">
    <label>File Tugas</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-file-upload"></i></div>
        </div>
        <input type="file" class="form-control" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip,.rar">
    </div>
    <small class="form-text text-muted">Format yang didukung: PDF, DOC, PPT, ZIP, RAR. (Wajib saat tambah, tidak wajib saat edit.)</small>
    <div class="invalid-feedback"></div>
</div>
