    <input type="hidden" name="kelas_mapel_id" id="form_kelas_mapel_id" value="{{ $kelasMapel->id }}">

    <div class="form-group">
        <label>Nama Materi</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-book"></i>
                </div>
            </div>
            <input type="text" class="form-control" placeholder="Masukkan nama materi" name="nama" required>
        </div>
    </div>

    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" style="height: 120px; resize: none;" placeholder="Tuliskan deskripsi materi"
            name="des" rows="3" required></textarea>
    </div>

    <div class="form-group">
        <label>File Materi</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-file-upload"></i>
                </div>
            </div>
            <input type="file" class="form-control" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip,.rar">
        </div>
        <small class="form-text text-muted">
            Format yang didukung: PDF, DOC, PPT, ZIP, RAR. (File wajib saat tambah; tidak wajib saat edit.)
        </small>
    </div>
