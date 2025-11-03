<form class="modal-part" id="form-tambah-kelas">
    {{-- Tingkat Kelas --}}
    <div class="form-group">
        <label>Tingkat Kelas</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-layer-group"></i>
                </div>
            </div>
            <input type="text" name="tingkat" class="form-control" placeholder="Contoh: X, XI, XII" required>
        </div>
    </div>

    {{-- Kode Kelas --}}
    <div class="form-group">
        <label>Kode Kelas</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-code"></i>
                </div>
            </div>
            <input type="text" name="kode" class="form-control" placeholder="Contoh: X-A, XI-B, XII-RPL" required>
        </div>
    </div>
</form>
