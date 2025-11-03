<form class="modal-part" id="form-tambah-admin" enctype="multipart/form-data">
    {{-- Username --}}
    <div class="form-group">
        <label>Username</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <input type="text" class="form-control" name="username" placeholder="Masukkan username" required>
        </div>
    </div>

    {{-- Email --}}
    <div class="form-group">
        <label>Email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
            <input type="email" class="form-control" name="email" placeholder="Masukkan email" required>
        </div>
    </div>

    {{-- Password --}}
    <div class="form-group">
        <label>Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
            <input type="password" class="form-control" name="password" placeholder="Masukkan password" required>
        </div>
    </div>

    {{-- Role --}}
    <div class="form-group">
        <label>Role</label>
        <select class="form-control" name="role" required>
            <option value="" disabled selected>Pilih role</option>
            <option value="admin">Admin</option>
            <option value="guru">Guru</option>
            <option value="siswa">Siswa</option>
        </select>
    </div>
</form>
