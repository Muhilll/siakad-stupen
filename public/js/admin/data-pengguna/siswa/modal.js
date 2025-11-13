"use strict";

// Load tabel
function loadTabelSiswa() {
    $.ajax({
        url: "/admin/siswa/data",
        method: "GET",
        success: function (data) {
            let tbody = $("#tabel-siswa tbody");
            tbody.empty();
            data.forEach((siswa, index) => {
                let badge =
                    siswa.status === "Aktif" ? "badge-success" : "badge-danger";
                tbody.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${siswa.nama}</td>
                        <td>${siswa.nis}</td>
                        <td>${siswa.nisn}</td>
                        <td><div class="badge ${badge}">${
                    siswa.status
                }</div></td>
                        <td>
                            <button class="btn btn-warning btn-edit" data-id="${
                                siswa.id
                            }"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-delete" data-id="${
                                siswa.id
                            }"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                `);
            });
        },
        error: function (err) {
            console.error("Gagal memuat tabel siswa:", err);
        },
    });
}

$(document).ready(function () {
    loadTabelSiswa();

    // Buka modal tambah
    $("#modal-tambah-siswa").click(function () {
        $("#formSiswa")[0].reset();
        $("#siswa_id").val("");
        $("#modalSiswaLabel").text("Tambah Siswa");
        $("#modalSiswa").modal("show");
    });

    // Buka modal edit
    $(document).on("click", ".btn-edit", function () {
        let id = $(this).data("id");

        $.ajax({
            url: `/admin/siswa/${id}`,
            method: "GET",
            success: function (res) {
                let siswa = res.siswa;

                $("#formSiswa")[0].reset();
                $("#siswa_id").val(siswa.id);
                $("#formSiswa [name=nis]").val(siswa.nis);
                $("#formSiswa [name=nisn]").val(siswa.nisn);
                $("#formSiswa [name=nama]").val(siswa.nama);
                $("#formSiswa [name=jkl]").val(siswa.jkl);
                $("#formSiswa [name=tmp_lahir]").val(siswa.tmp_lahir);
                $("#formSiswa [name=tgl_lahir]").val(siswa.tgl_lahir);
                $("#formSiswa [name=agama]").val(siswa.agama);
                $("#formSiswa [name=alamat]").val(siswa.alamat);
                $("#formSiswa [name=no_hp]").val(siswa.no_hp);
                $("#formSiswa [name=tahun_masuk]").val(siswa.tahun_masuk);
                $("#formSiswa [name=status]").val(siswa.status);
                $("#formSiswa [name=nama_ayah]").val(siswa.nama_ayah);
                $("#formSiswa [name=pekerjaan_ayah]").val(siswa.pekerjaan_ayah);
                $("#formSiswa [name=nama_ibu]").val(siswa.nama_ibu);
                $("#formSiswa [name=pekerjaan_ibu]").val(siswa.pekerjaan_ibu);
                $("#formSiswa [name=nohp_ortu]").val(siswa.nohp_ortu);

                $("#modalSiswaLabel").text("Edit Siswa");
                $("#modalSiswa").modal("show");
            },
            error: function (err) {
                iziToast.error({
                    title: "Gagal!",
                    message: "Data siswa tidak ditemukan",
                    position: "topRight",
                });
            },
        });
    });

    // Submit tambah/edit
    $("#formSiswa").submit(function (e) {
        e.preventDefault();
        let id = $("#siswa_id").val();
        let formData = new FormData(this);

        let url = id ? `/admin/siswa/${id}` : "/admin/siswa";
        let method = id ? "POST" : "POST"; // Laravel bisa gunakan POST + hidden _method untuk update

        if (id) formData.append("_method", "PUT");

        $.ajax({
            url: url,
            method: method,
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                if (res.success) {
                    iziToast.success({
                        title: "Berhasil!",
                        message: res.message,
                        position: "topRight",
                    });
                    $("#modalSiswa").modal("hide");
                    loadTabelSiswa();
                }
            },
            error: function (err) {
                iziToast.error({
                    title: "Gagal!",
                    message: "Terjadi kesalahan saat menyimpan data.",
                    position: "topRight",
                });
            },
        });
    });

    // Hapus siswa
    $(document).on("click", ".btn-delete", function () {
        let id = $(this).data("id");

        swal({
            title: "Apakah anda yakin?",
            text: "Data siswa akan dihapus dan tidak bisa dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: `/admin/siswa/${id}`,
                    method: "POST",
                    data: { _method: "DELETE" },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (res) {
                        iziToast.success({
                            title: "Berhasil!",
                            message: res.message,
                            position: "topRight",
                        });
                        loadTabelSiswa();
                    },
                    error: function (err) {
                        iziToast.error({
                            title: "Gagal!",
                            message: "Data siswa gagal dihapus",
                            position: "topRight",
                        });
                    },
                });
            }
        });
    });
});
