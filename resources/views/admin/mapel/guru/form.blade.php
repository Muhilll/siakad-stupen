<form class="modal-part" id="form-tambah-mapel-guru">
    {{-- Pilih Mata Pelajaran --}}
    <div class="form-group">
        <label>Mata Pelajaran</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-book"></i>
                </div>
            </div>
            <select class="form-control" name="mapel_id" required>
                <option value="">-- Pilih Mata Pelajaran --</option>
                {{-- @foreach ($mapel as $m)
                    <option value="{{ $m->id }}">{{ $m->nama }}</option>
                @endforeach --}}
            </select>
        </div>
    </div>

    {{-- Pilih Guru --}}
    <div class="form-group">
        <label>Guru Pengampu</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
            <select class="form-control" name="guru_id" required>
                <option value="">-- Pilih Guru --</option>
                {{-- @foreach ($guru as $g)
                    <option value="{{ $g->id }}">{{ $g->nama_lengkap }}</option>
                @endforeach --}}
            </select>
        </div>
    </div>
</form>
