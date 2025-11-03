<form class="modal-part" id="form-tambah-mapel" enctype="multipart/form-data">
    {{-- Nama Mata Pelajaran --}}
    <div class="form-group">
        <label>Nama Mata Pelajaran</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-book"></i>
                </div>
            </div>
            <input type="text" class="form-control" name="nama" placeholder="Masukkan nama mata pelajaran" required>
        </div>
    </div>

    {{-- Deskripsi --}}
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" name="des" style="height: 120px; resize: none;"
            placeholder="Tuliskan deskripsi singkat mata pelajaran" rows="3"></textarea>
    </div>
</form>
