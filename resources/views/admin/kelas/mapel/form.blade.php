<form class="modal-part" id="form-tambah-kelas-mapel">
    {{-- Input tersembunyi untuk ID kelas --}}
    <input type="hidden" name="kelas_id" value="{{ $kelas->id ?? '' }}">

    {{-- Dropdown Mapel --}}
    <div class="form-group">
        <label for="mapel">Pilih Mata Pelajaran</label>
        <select name="mapel_id" id="mapel" class="form-control" required>
            <option value="">-- Pilih Mata Pelajaran --</option>
            {{-- @foreach ($mapel as $m)
                <option value="{{ $m->id }}">{{ $m->nama }}</option>
            @endforeach --}}
        </select>
    </div>

    {{-- Dropdown Guru yang muncul setelah Mapel dipilih --}}
    <div class="form-group">
        <label for="mapel_guru">Pilih Guru</label>
        <select name="mapel_guru_id" id="mapel_guru" class="form-control" required disabled>
            <option value="">-- Pilih Guru --</option>
        </select>
    </div>
</form>