<form class="modal-part" id="form-tambah-guru" enctype="multipart/form-data">
    {{-- NIP --}}
    <div class="form-group">
        <label>NIP</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-id-card"></i></div>
            </div>
            <input type="text" class="form-control" name="nip" placeholder="Masukkan NIP" required>
        </div>
    </div>

    {{-- NUPTK --}}
    <div class="form-group">
        <label>NUPTK</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-id-badge"></i></div>
            </div>
            <input type="text" class="form-control" name="nuptk" placeholder="Masukkan NUPTK" required>
        </div>
    </div>

    {{-- Nama Lengkap --}}
    <div class="form-group">
        <label>Nama Lengkap</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
            </div>
            <input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan nama lengkap" required>
        </div>
    </div>

    {{-- Jenis Kelamin --}}
    <div class="form-group">
        <label>Jenis Kelamin</label>
        <select class="form-control" name="jenis_kelamin" required>
            <option value="" disabled selected>Pilih jenis kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
    </div>

    {{-- Tempat & Tanggal Lahir --}}
    <div class="form-group">
        <label>Tempat Lahir</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>
            </div>
            <input type="text" class="form-control" name="tmp_lahir" placeholder="Masukkan tempat lahir" required>
        </div>
    </div>

    <div class="form-group">
        <label>Tanggal Lahir</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
            </div>
            <input type="date" class="form-control" name="tgl_lahir" required>
        </div>
    </div>

    {{-- Agama --}}
    <div class="form-group">
        <label>Agama</label>
        <select class="form-control" name="agama" required>
            <option value="" disabled selected>Pilih agama</option>
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Katolik">Katolik</option>
            <option value="Hindu">Hindu</option>
            <option value="Buddha">Buddha</option>
            <option value="Konghucu">Konghucu</option>
        </select>
    </div>

    {{-- Alamat --}}
    <div class="form-group">
        <label>Alamat</label>
        <textarea class="form-control" name="alamat" placeholder="Masukkan alamat lengkap" style="height: 100px; resize: none;" required></textarea>
    </div>

    {{-- Nomor HP --}}
    <div class="form-group">
        <label>No. HP</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-phone"></i></div>
            </div>
            <input type="text" class="form-control" name="no_hp" placeholder="Masukkan nomor HP" required>
        </div>
    </div>

    {{-- Email --}}
    <div class="form-group">
        <label>Email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-envelope"></i></div>
            </div>
            <input type="email" class="form-control" name="email" placeholder="Masukkan alamat email" required>
        </div>
    </div>

    {{-- Status Pegawai --}}
    <div class="form-group">
        <label>Status Pegawai</label>
        <select class="form-control" name="status_pegawai" required>
            <option value="" disabled selected>Pilih status pegawai</option>
            <option value="PNS">PNS</option>
            <option value="Non-PNS">Non-PNS</option>
            <option value="Honorer">Honorer</option>
        </select>
    </div>

    {{-- Jabatan --}}
    <div class="form-group">
        <label>Jabatan</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-briefcase"></i></div>
            </div>
            <input type="text" class="form-control" name="jabatan" placeholder="Masukkan jabatan (misal: Wali Kelas, Guru Mapel)" required>
        </div>
    </div>

    {{-- Sertifikasi --}}
    <div class="form-group">
        <label>Sertifikasi</label>
        <select class="form-control" name="sertifikasi" required>
            <option value="" disabled selected>Pilih status sertifikasi</option>
            <option value="Sudah">Sudah</option>
            <option value="Belum">Belum</option>
        </select>
    </div>

    {{-- Status Mengajar --}}
    <div class="form-group">
        <label>Status Mengajar</label>
        <select class="form-control" name="status_mengajar" required>
            <option value="" disabled selected>Pilih status mengajar</option>
            <option value="Aktif">Aktif</option>
            <option value="Tidak Aktif">Tidak Aktif</option>
        </select>
    </div>
</form>
