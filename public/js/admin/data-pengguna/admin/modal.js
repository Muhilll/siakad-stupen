"use strict";

let currentSearchAdmin = "";

// Load table
function loadTabelAdmin(page = 1) {
    $.ajax({
        url: "/admin/admins/data",
        method: "GET",
        data: {
            page: page,
            search: currentSearchAdmin,
        },
        success: function (res) {
            let tbody = $("#tabel-admin tbody");
            tbody.empty();

            if (res.data.length === 0) {
                tbody.append(`
                    <tr class="text-center text-muted">
                        <td colspan="4">Data tidak ditemukan</td>
                    </tr>
                `);
                $(".pagination").html("");
                return;
            }

            res.data.forEach((admin, index) => {
                tbody.append(`
                    <tr>
                        <td>${index + 1 + (page - 1) * 10}</td>
                        <td>${admin.username}</td>
                        <td>${admin.created_at}</td>
                        <td>
                            <button class="btn btn-warning btn-edit" data-id="${admin.id}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-delete" data-id="${admin.id}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `);
            });

            $(".pagination").html(res.pagination);
        },
        error: function (err) {
            console.error("Gagal memuat tabel:", err);
        },
    });
}

// Submit search
$(document).on("submit", ".card-header-form form", function (e) {
    e.preventDefault();
    currentSearchAdmin = $(this).find("input[name=search]").val();
    loadTabelAdmin();
});

// Pagination click
$(document).on("click", ".pagination a", function (e) {
    e.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    loadTabelAdmin(page);
});

// Ready
$(document).ready(function () {
    loadTabelAdmin();

    // buka modal tambah
    $("#modal-tambah-admin").click(function () {
        $("#formAdmin")[0].reset();
        $("#formAdmin .form-control").removeClass("is-invalid");
        $("#formAdmin .invalid-feedback").text("");

        $("#admin_id").val("");
        $("#modalAdminLabel").text("Tambah Admin");
        $("#modalAdmin").modal("show");
    });

    // edit admin
    $(document).on("click", ".btn-edit", function () {
        let id = $(this).data("id");

        $.ajax({
            url: `/admin/admins/${id}`,
            method: "GET",
            success: function (res) {
                let admin = res.admin;

                $("#formAdmin")[0].reset();
                $("#formAdmin .form-control").removeClass("is-invalid");
                $("#formAdmin .invalid-feedback").text("");

                $("#admin_id").val(admin.id);
                $("#formAdmin [name=username]").val(admin.username);
                $("#formAdmin [name=password]").val("");

                $("#modalAdminLabel").text("Edit Admin");
                $("#modalAdmin").modal("show");
            },
            error: function () {
                iziToast.error({
                    title: "Gagal!",
                    message: "Data admin tidak ditemukan",
                    position: "topRight",
                });
            },
        });
    });

    // submit tambah/edit
    $("#formAdmin").submit(function (e) {
        e.preventDefault();
        let id = $("#admin_id").val();
        let formData = new FormData(this);

        let url = id ? `/admin/admins/${id}` : "/admin/admins";
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
                iziToast.success({
                    title: "Berhasil!",
                    message: res.message,
                    position: "topRight",
                });

                $("#modalAdmin").modal("hide");
                loadTabelAdmin();
            },
            error: function (err) {
                if (err.status === 422) {
                    let errors = err.responseJSON.errors;

                    $("#formAdmin .form-control").removeClass("is-invalid");
                    $("#formAdmin .invalid-feedback").text("");

                    $.each(errors, function (key, messages) {
                        let input = $(`#formAdmin [name="${key}"]`);
                        input.addClass("is-invalid");
                        input.closest(".form-group")
                             .find(".invalid-feedback")
                             .text(messages[0]);
                    });

                    iziToast.error({
                        title: "Gagal!",
                        message: Object.values(errors)[0][0],
                        position: "topRight",
                    });

                    return;
                }

                iziToast.error({
                    title: "Error!",
                    message: "Terjadi kesalahan server.",
                    position: "topRight",
                });
            },
        });
    });

    // delete admin
    $(document).on("click", ".btn-delete", function () {
        let id = $(this).data("id");

        swal({
            title: "Apakah anda yakin?",
            text: "Data admin akan dihapus dan tidak bisa dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((hapus) => {
            if (hapus) {
                $.ajax({
                    url: `/admin/admins/${id}`,
                    method: "POST",
                    data: { _method: "DELETE" },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function (res) {
                        iziToast.success({
                            title: "Berhasil!",
                            message: res.message,
                            position: "topRight",
                        });

                        loadTabelAdmin();
                    },
                    error: function (err) {
                        iziToast.error({
                            title: "Gagal!",
                            message: "Tidak dapat menghapus data",
                            position: "topRight",
                        });
                    },
                });
            }
        });
    });
});