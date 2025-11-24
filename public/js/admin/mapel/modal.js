"use strict";

let currentSearch = "";

function loadTabelMapel(page = 1) {
    $.ajax({
        url: "/admin/mapel/data",
        method: "GET",
        data: { page: page, search: currentSearch },
        success: function (res) {
            let tbody = $("#tabel-mapel tbody");
            tbody.empty();
            if (res.data.length === 0) {
                tbody.append(
                    '<tr class="text-center text-muted"><td colspan="6">Data tidak ditemukan</td></tr>'
                );
                $(".pagination").html("");
                return;
            }
            res.data.forEach((mapel, index) => {
                tbody.append(`
                    <tr>
                        <td>${index + 1 + (page - 1) * 10}</td>
                        <td>${mapel.nama}</td>
                        <td>${mapel.des}</td>
                        <td>${formatTanggal(mapel.updated_at)}</td>
                        <td>
                            <button class="btn btn-warning btn-edit" data-id="${
                                mapel.id
                            }"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-delete" data-id="${
                                mapel.id
                            }"><i class="fa fa-trash"></i></button>
                            <form class="form-pengajar d-inline" method="POST">
                                <input type="hidden" name="id" value="${
                                    mapel.id
                                }">
                                <button type="submit" class="btn btn-secondary">Pengajar</button>
                            </form>
                        </td>
                    </tr>
                `);
            });

            $(".card-footer .pagination").html(res.pagination);
        },
        error: function (err) {
            console.error("Gagal memuat tabel mapel:", err);
        },
    });
}

// Search
$(document).on("submit", ".card-header-form form", function (e) {
    e.preventDefault();
    currentSearch = $(this).find("input").val();
    loadTabelMapel();
});

// Pagination
$(document).on("click", ".pagination a", function (e) {
    e.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    loadTabelMapel(page);
});

$(document).ready(function () {
    loadTabelMapel();

    // Modal Tambah
    $("#modal-tambah-mapel").click(function () {
        $("#formMapel")[0].reset();
        $("#mapel_id").val("");
        $("#modalMapelLabel").text("Tambah Mata Pelajaran");
        $("#modalMapel").modal("show");
    });

    // Modal Edit
    $(document).on("click", ".btn-edit", function () {
        let id = $(this).data("id");

        $.ajax({
            url: `/admin/mapel/${id}`,
            method: "GET",
            success: function (res) {
                let mapel = res.mapel;
                $("#formMapel")[0].reset();
                $("#mapel_id").val(mapel.id);
                $("#formMapel [name=nama]").val(mapel.nama);
                $("#formMapel [name=des]").val(mapel.des);
                $("#modalMapelLabel").text("Edit Mata Pelajaran");
                $("#modalMapel").modal("show");
            },
            error: function (err) {
                iziToast.error({
                    title: "Gagal!",
                    message: "Data mapel tidak ditemukan",
                    position: "topRight",
                });
            },
        });
    });

    // Submit Tambah/Edit
    $("#formMapel").submit(function (e) {
        e.preventDefault();
        let id = $("#mapel_id").val();
        let formData = new FormData(this);
        let url = id ? `/admin/mapel/${id}` : "/admin/mapel";
        let method = id ? "POST" : "POST";
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
                    $("#modalMapel").modal("hide");
                    loadTabelMapel();
                }
            },
            error: function (err) {
                if (err.status === 422) {
                    let errors = err.responseJSON.errors;
                    $.each(errors, function (key, messages) {
                        let input = $(`#formMapel [name="${key}"]`);
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
                    message: "Terjadi kesalahan saat menyimpan data.",
                    position: "topRight",
                });
            },
        });
    });

    // Hapus Mapel
    $(document).on("click", ".btn-delete", function () {
        let id = $(this).data("id");

        swal({
            title: "Apakah anda yakin?",
            text: "Data mapel akan dihapus dan tidak bisa dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: `/admin/mapel/${id}`,
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
                        loadTabelMapel();
                    },
                    error: function (err) {
                        iziToast.error({
                            title: "Gagal!",
                            message: "Terjadi kesalahan saat menghapus data.",
                            position: "topRight",
                        });
                    },
                });
            }
        });
    });

    $(document).on("submit", ".form-pengajar", function (e) {
        e.preventDefault();

        const form = $(this);
        const id = form.find("input[name=id]").val();

        // Buat form POST sebenarnya agar pindah halaman
        const realForm = $("<form>", {
            method: "POST",
            action: "/admin/mapel/pengajar",
        });

        realForm.append(`
        <input type="hidden" name="_token" value="${$(
            'meta[name="csrf-token"]'
        ).attr("content")}">
        <input type="hidden" name="id" value="${id}">
    `);

        $("body").append(realForm);
        realForm.submit();
    });
});
