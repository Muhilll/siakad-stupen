"use strict";

let currentSearch = "";
let kelas_id = $("#kelas_id").val();

// Load tabel siswa
function loadTabelSiswa(page = 1) {
    $.ajax({
        url: `/admin/kelas/detail/${kelas_id}/siswa/data`,
        method: "GET",
        data: { page: page, search: currentSearch },
        success: function (res) {
            let tbody = $("#tabel-siswa tbody");
            tbody.empty();
            if (res.data.length === 0) {
                tbody.append(
                    '<tr class="text-center text-muted"><td colspan="6">Data tidak ditemukan</td></tr>'
                );
                $(".pagination").html("");
                return;
            }
            res.data.forEach((item, index) => {
                tbody.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.siswa.nama}</td>
                            <td>${item.siswa.nis}</td>
                            <td>${item.siswa.nisn}</td>
                            <td>${item.siswa.status}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-info btn-detail" data-id="${
                                        item.id
                                    }"><i class="fa fa-eye"></i></button>
                                    <button class="btn btn-danger btn-delete" data-id="${
                                        item.id
                                    }"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    `);
            });
            $(".pagination").html(res.pagination);
        },
    });
}

// Search
$(document).on("submit", ".card-header-form form", function (e) {
    e.preventDefault();
    currentSearch = $(this).find("input").val();
    loadTabelSiswa();
});

// Pagination
$(document).on("click", ".pagination a", function (e) {
    e.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    loadTabelSiswa(page);
});

$(document).ready(function () {
    loadTabelSiswa();

    // Modal Tambah
    $("#modal-tambah-anggota-kelas").click(function () {
        $("#form-tambah-anggota-kelas")[0].reset();
        $("#form-tambah-anggota-kelas .form-control").removeClass("is-invalid");
        $("#modalTambahSiswa").modal("show");
    });

    $("#cariSiswa").on("keyup", function () {
        let keyword = $(this).val();

        $.ajax({
            url: "/admin/data/siswa/search",
            method: "GET",
            data: { keyword: keyword },
            success: function (res) {
                let select = $("#siswaSelect");
                select.empty();

                res.forEach((siswa) => {
                    select.append(`
                        <option value="${siswa.id}">
                            ${siswa.nama} (${siswa.nis})
                        </option>
                    `);
                });
            },
        });
    });

    // Submit Tambah
    $("#form-tambah-anggota-kelas").submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: `/admin/kelas/detail/${kelas_id}/siswa`,
            method: "POST",
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
                    $("#modalTambahSiswa").modal("hide");
                    loadTabelSiswa();
                }
            },
            error: function (err) {
                if (err.status === 422) {
                    let errors = err.responseJSON.errors;
                    $.each(errors, function (key, messages) {
                        let input = $(
                            `#form-tambah-anggota-kelas [name="${key}"]`
                        );
                        input.addClass("is-invalid");
                        input
                            .closest(".form-group")
                            .find(".invalid-feedback")
                            .text(messages[0]);
                    });

                    return;
                }
                iziToast.error({
                    title: "Gagal!",
                    message: "Terjadi kesalahan.",
                    position: "topRight",
                });
            },
        });
    });

    // Detail Siswa
    $(document).on("click", ".btn-detail", function () {
        let id = $(this).data("id");
        $.get(`/admin/kelas/detail/siswa/show/${id}`, function (res) {
            let siswa = res.siswa;
            if (siswa) {
                let form = $("#form-detail-siswa");
                Object.keys(siswa).forEach((key) =>
                    form.find(`[name="${key}"]`).val(siswa[key])
                );
                $("#modalDetailSiswa").modal("show");
            }
        });
    });

    // Delete Siswa
    $(document).on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        swal({
            title: "Apakah anda yakin?",
            text: "Data siswa akan dihapus!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: `/admin/kelas/detail/siswa/${id}`,
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
                });
            }
        });
    });
});
