<form class="modal-part" id="form-tambah-anggota-kelas">
    {{-- Hidden ID Kelas --}}
    {{-- <input type="hidden" name="kelas_id" id="kelas_id" value="{{ $kelas->id }}"> --}}

    {{-- Pilih Siswa --}}
    <div class="form-group">
        <label>Pilih Siswa</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user-graduate"></i></div>
            </div>
            <select name="siswa_id" id="siswa_id" class="form-control" required>
                <option value="">-- Pilih Siswa --</option>
                {{-- @foreach ($siswa as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->nis }})</option>
                @endforeach --}}
            </select>
        </div>
    </div>

    {{-- Detail Siswa --}}
    <div id="detail-siswa" style="display: none;">
        <hr>
        <h6 class="text-primary">Detail Siswa</h6>

        <div class="form-group">
            <label>NIS</label>
            <input type="text" id="nis" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label>NISN</label>
            <input type="text" id="nisn" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" id="nama" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <input type="text" id="jkl" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label>Tempat, Tanggal Lahir</label>
            <input type="text" id="ttl" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label>Agama</label>
            <input type="text" id="agama" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea id="alamat" class="form-control" rows="2" readonly></textarea>
        </div>

        <div class="form-group">
            <label>No. HP</label>
            <input type="text" id="nohp" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label>Tahun Masuk</label>
            <input type="text" id="tahun_masuk" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label>Status</label>
            <input type="text" id="status" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label>Nama Ayah</label>
            <input type="text" id="nama_ayah" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label>Pekerjaan Ayah</label>
            <input type="text" id="pekerjaan_ayah" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label>Nama Ibu</label>
            <input type="text" id="nama_ibu" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label>Pekerjaan Ibu</label>
            <input type="text" id="pekerjaan_ibu" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label>No. HP Orang Tua</label>
            <input type="text" id="nohp_ortu" class="form-control" readonly>
        </div>
    </div>
</form>
