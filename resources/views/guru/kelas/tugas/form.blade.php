<form class="modal-part" id="form-tambah-tugas" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Tugas</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-book"></i>
                </div>
            </div>
            <input type="text" class="form-control" placeholder="Masukkan nama tugas" name="nama" required>
        </div>
    </div>

    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" style="height: 120px; resize: none;" placeholder="Tuliskan deskripsi materi"
            name="deskripsi" rows="3" required></textarea>
    </div>

    <div class="form-group">
        <label>Batas Waktu</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            <input type="datetime-local" class="form-control" name="batas" required>
        </div>
        <small class="form-text text-muted">
            Tentukan tanggal dan waktu akhir pengumpulan tugas.
        </small>
    </div>

    <div class="form-group">
        <label>File Tugas</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-file-upload"></i>
                </div>
            </div>
            <input type="file" class="form-control" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip,.rar"
                required>
        </div>
        <small class="form-text text-muted">
            Format yang didukung: PDF, DOC, PPT, ZIP, RAR.
        </small>
    </div>
</form>
