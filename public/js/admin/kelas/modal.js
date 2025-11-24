"use strict";

let currentSearch = "";

function loadTabelKelas(page = 1) {
    $.ajax({
        url: "/admin/kelas/data",
        method: "GET",
        data: { page: page, search: currentSearch },
        success: function (res) {
            let tbody = $("#tabel-kelas tbody");
            tbody.empty();
            if (res.data.length === 0) {
                tbody.append(
                    '<tr class="text-center text-muted"><td colspan="6">Data tidak ditemukan</td></tr>'
                );
                $(".pagination").html("");
                return;
            }
            res.data.forEach((kelas, index) => {
                let encryptedId = kelas.encrypted_id;
                tbody.append(`
                    <tr>
                        <td>${index + 1 + (page - 1) * 10}</td>
                        <td>${kelas.tingkat}</td>
                        <td>${kelas.kode}</td>
                        <td>${formatTanggal(kelas.updated_at)}</td>
                        <td>
                            <button class="btn btn-warning btn-edit" data-id="${
                                kelas.id
                            }">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-delete" data-id="${
                                kelas.id
                            }">
                                <i class="fa fa-trash"></i>
                            </button>
                            <a href="/admin/kelas/detail/${encryptedId}" class="btn btn-secondary">Lihat</a>
                        </td>
                    </tr>
                `);
            });

            $(".pagination").html(res.pagination);
        },
        error: function (err) {
            console.error("Gagal memuat tabel kelas:", err);
        },
    });
}

// Search
$(document).on("submit", ".card-header-form form", function (e) {
    e.preventDefault();
    currentSearch = $(this).find("input").val();
    loadTabelKelas();
});

// Pagination
$(document).on("click", ".pagination a", function (e) {
    e.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    loadTabelKelas(page);
});

$(document).ready(function () {
    loadTabelKelas();

    // Modal Tambah
    $("#modal-tambah-kelas").click(function () {
        $("#formKelasModal")[0].reset();
        $("#kelas_id").val("");
        $("#modalKelasLabel").text("Tambah Kelas");
        $("#modalKelas").modal("show");
    });

    // Modal Edit
    $(document).on("click", ".btn-edit", function () {
        let id = $(this).data("id");
        $.ajax({
            url: `/admin/kelas/${id}`,
            method: "GET",
            success: function (res) {
                let kelas = res.kelas;
                $("#formKelasModal")[0].reset();
                $("#kelas_id").val(kelas.id);
                $("#formKelasModal [name=tingkat]").val(kelas.tingkat);
                $("#formKelasModal [name=kode]").val(kelas.kode);
                $("#modalKelasLabel").text("Edit Kelas");
                $("#modalKelas").modal("show");
            },
            error: function (err) {
                iziToast.error({
                    title: "Gagal!",
                    message: "Data kelas tidak ditemukan",
                    position: "topRight",
                });
            },
        });
    });

    // Submit Tambah/Edit
    $("#formKelasModal").submit(function (e) {
        e.preventDefault();
        let id = $("#kelas_id").val();
        let formData = new FormData(this);
        let url = id ? `/admin/kelas/${id}` : "/admin/kelas";
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
                    $("#modalKelas").modal("hide");
                    loadTabelKelas();
                }
            },
            error: function (err) {
                if (err.status === 422) {
                    let errors = err.responseJSON.errors;
                    $.each(errors, function (key, messages) {
                        let input = $(`#formKelasModal [name="${key}"]`);
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

    // Hapus
    $(document).on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        swal({
            title: "Apakah anda yakin?",
            text: "Data kelas akan dihapus dan tidak bisa dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: `/admin/kelas/${id}`,
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
                        loadTabelKelas();
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

    // Form Detail
    $(document).on("submit", ".form-detail", function (e) {
        e.preventDefault();
        const form = $(this);
        const id = form.find("input[name=id]").val();

        const realForm = $("<form>", {
            method: "POST",
            action: "/admin/kelas/detail",
        });
        realForm.append(
            `<input type="hidden" name="_token" value="${$(
                'meta[name="csrf-token"]'
            ).attr("content")}">`
        );
        realForm.append(`<input type="hidden" name="id" value="${id}">`);
        $("body").append(realForm);
        realForm.submit();
    });
});
