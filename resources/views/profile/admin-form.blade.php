<div class="form-group">
    <label>Username</label>
    <input type="text" class="form-control" value="{{auth()->user()->username}}" name="username" placeholder="Masukkan username" readonly>
    <div class="invalid-feedback"></div>
</div>
<div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="password" placeholder="Masukkan password" required>
    <div class="invalid-feedback"></div>
</div>

