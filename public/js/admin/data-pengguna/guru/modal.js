"use strict";

let currentSearchGuru = "";

function loadTabelGuru(page = 1) {
    $.ajax({
        url: "/admin/guru/data",
        method: "GET",
        data: {
            page: page,
            search: currentSearchGuru,
        },
        success: function (res) {
            let tbody = $("#tabel-guru tbody");
            tbody.empty();

            res.data.forEach((guru, index) => {
                tbody.append(`
                    <tr>
                        <td>${index + 1 + (page - 1) * 10}</td>
                        <td>${guru.nama_lengkap ?? ""}</td>
                        <td>${guru.nip ?? ""}</td>
                        <td>${guru.nik ?? ""}</td>
                        <td>${guru.jenis_ptk ?? ""}</td>
                        <td>
                            <button class="btn btn-warning btn-edit" data-id="${
                                guru.id
                            }"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-delete" data-id="${
                                guru.id
                            }"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                `);
            });

            $(".card-footer .pagination").html(res.pagination);
        },
        error: function (err) {
            console.error("Gagal memuat tabel guru:", err);
        },
    });
}

// Submit search
$(document).on("submit", ".card-header-form form", function (e) {
    e.preventDefault();
    currentSearchGuru = $(this).find("input[name=search]").val();
    loadTabelGuru(); // muat ulang tabel dengan search
});

// Klik pagination
$(document).on("click", ".pagination a", function (e) {
    e.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    loadTabelGuru(page);
});

$(document).ready(function () {
    loadTabelGuru();

    // Buka modal tambah
    $("#modal-tambah-guru").click(function () {
        $("#formGuru")[0].reset();
        $("#formGuru .form-control").removeClass("is-invalid");
        $("#formGuru .invalid-feedback").text("");
        $("#guru_id").val("");
        $("#modalGuruLabel").text("Tambah Guru");
        $("#modalGuru").modal("show");
    });

    // Buka modal edit
    $(document).on("click", ".btn-edit", function () {
        let id = $(this).data("id");

        $.ajax({
            url: `/admin/guru/${id}`,
            method: "GET",
            success: function (res) {
                let guru = res.guru;

                $("#formGuru")[0].reset();
                $("#formGuru .form-control").removeClass("is-invalid");
                $("#formGuru .invalid-feedback").text("");

                $("#guru_id").val(guru.id);
                $("#formGuru [name=jenis_ptk]").val(guru.jenis_ptk);
                $("#formGuru [name=nama_lengkap]").val(guru.nama_lengkap);
                $("#formGuru [name=nip]").val(guru.nip);
                $("#formGuru [name=pangkat]").val(guru.pangkat);
                $("#formGuru [name=golongan]").val(guru.golongan);
                $("#formGuru [name=tmt]").val(guru.tmt);
                $("#formGuru [name=mkg_cpns_tahun]").val(guru.mkg_cpns_tahun);
                $("#formGuru [name=mkg_cpns_bulan]").val(guru.mkg_cpns_bulan);
                $("#formGuru [name=mkg_total_tahun]").val(guru.mkg_total_tahun);
                $("#formGuru [name=mkg_total_bulan]").val(guru.mkg_total_bulan);
                $("#formGuru [name=nuptk]").val(guru.nuptk);
                $("#formGuru [name=nik]").val(guru.nik);
                $("#formGuru [name=jenis_kelamin]").val(guru.jenis_kelamin);
                $("#formGuru [name=tempat_lahir]").val(guru.tempat_lahir);
                $("#formGuru [name=tanggal_lahir]").val(guru.tanggal_lahir);
                $("#formGuru [name=agama]").val(guru.agama);
                $("#formGuru [name=no_hp]").val(guru.no_hp);
                $("#formGuru [name=email]").val(guru.email);
                $("#formGuru [name=jabatan]").val(guru.jabatan);
                $("#formGuru [name=sertifikasi_bidang_studi]").val(
                    guru.sertifikasi_bidang_studi
                );
                $("#formGuru [name=sertifikasi_tahun]").val(
                    guru.sertifikasi_tahun
                );
                $("#formGuru [name=pendidikan_jenjang]").val(
                    guru.pendidikan_jenjang
                );
                $("#formGuru [name=pendidikan_gelar]").val(
                    guru.pendidikan_gelar
                );
                $("#formGuru [name=pendidikan_bidang_studi]").val(
                    guru.pendidikan_bidang_studi
                );
                $("#formGuru [name=pendidikan_tahun]").val(
                    guru.pendidikan_tahun
                );

                $("#modalGuruLabel").text("Edit Guru");
                $("#modalGuru").modal("show");
            },
            error: function (err) {
                iziToast.error({
                    title: "Gagal!",
                    message: "Data guru tidak ditemukan",
                    position: "topRight",
                });
            },
        });
    });

    // Submit tambah/edit
    $("#formGuru").submit(function (e) {
        e.preventDefault();
        let id = $("#guru_id").val();
        let formData = new FormData(this);

        let url = id ? `/admin/guru/${id}` : "/admin/guru";
        let method = "POST";

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
                    $("#modalGuru").modal("hide");
                    loadTabelGuru();
                }
            },
            error: function (err) {
                if (err.status === 422) {
                    let errors = err.responseJSON.errors;
                    $("#formGuru .form-control").removeClass("is-invalid");
                    $("#formGuru .invalid-feedback").text("");

                    // tampilkan form error
                    $.each(errors, function (key, messages) {
                        let input = $(`#formGuru [name="${key}"]`);
                        input.addClass("is-invalid");
                        input
                            .closest(".form-group")
                            .find(".invalid-feedback")
                            .text(messages[0]);
                    });

                    // tampilkan toast dengan error pertama
                    let firstError = Object.values(errors)[0][0];

                    iziToast.error({
                        title: "Gagal!",
                        message: firstError,
                        position: "topRight",
                    });

                    return;
                }

                iziToast.error({
                    title: "Gagal!",
                    message: "Terjadi kesalahan saat menyimpan data.",
                    position: "topRight",
                });
            },
        });
    });

    // Hapus guru
    $(document).on("click", ".btn-delete", function () {
        let id = $(this).data("id");

        swal({
            title: "Apakah anda yakin?",
            text: "Data guru akan dihapus dan tidak bisa dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: `/admin/guru/${id}`,
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
                        loadTabelGuru();
                    },
                    error: function (err) {
                      let errors = err.responseJSON.errors;
                      let firstError = Object.values(errors)[0][0];
                        iziToast.error({
                            title: "Gagal!",
                            message: firstError,
                            position: "topRight",
                        });
                    },
                });
            }
        });
    });
});
