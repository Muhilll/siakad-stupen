<div class="modal fade" id="modalDetailSiswa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Siswa</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form-detail-siswa">
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="text" class="form-control" name="nis" readonly>
                    </div>
                    <div class="form-group">
                        <label>NISN</label>
                        <input type="text" class="form-control" name="nisn" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" readonly>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="jkl" disabled>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" name="tmp_lahir" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tgl_lahir" readonly>
                    </div>
                    <div class="form-group">
                        <label>Agama</label>
                        <select class="form-control" name="agama" disabled>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" style="height:100px; resize:none;" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label>No. HP Siswa</label>
                        <input type="text" class="form-control" name="no_hp" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tahun Masuk</label>
                        <input type="number" class="form-control" name="tahun_masuk" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" disabled>
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>
                    <hr>
                    <h6 class="text-primary mb-3">Data Orang Tua</h6>
                    <div class="form-group">
                        <label>Nama Ayah</label>
                        <input type="text" class="form-control" name="nama_ayah" readonly>
                    </div>
                    <div class="form-group">
                        <label>Pekerjaan Ayah</label>
                        <input type="text" class="form-control" name="pekerjaan_ayah" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Ibu</label>
                        <input type="text" class="form-control" name="nama_ibu" readonly>
                    </div>
                    <div class="form-group">
                        <label>Pekerjaan Ibu</label>
                        <input type="text" class="form-control" name="pekerjaan_ibu" readonly>
                    </div>
                    <div class="form-group">
                        <label>No. HP Orang Tua</label>
                        <input type="text" class="form-control" name="nohp_ortu" readonly>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
