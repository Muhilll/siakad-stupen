<input type="text" name="tugas_id" value="{{$tugas->id}}" hidden id="tugas_id">

<div class="form-group">
    <label>Deskripsi / Catatan</label>
    <textarea class="form-control" style="height: 120px; resize: none;" placeholder="Tuliskan catatan atau deskripsi tugas"
        name="des" rows="3"></textarea>
    <small class="form-text text-muted">
        (Opsional) Tambahkan catatan untuk guru mengenai tugas yang dikumpulkan.
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
        <input type="file" class="form-control" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip,.rar" required>
    </div>
    <small class="form-text text-muted">
        Wajib diisi. Format yang didukung: PDF, DOC, PPT, ZIP, RAR.
    </small>
</div>
