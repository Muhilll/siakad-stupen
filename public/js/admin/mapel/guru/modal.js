"use strict";

let currentSearch = "";
let mapel_id = $("#mapel_id").val();

function loadTabelPengajar(page = 1) {
    $.ajax({
        url: `/admin/mapel/${mapel_id}/pengajar/data`,
        method: "GET",
        data: { page: page, search: currentSearch },
        success: function (res) {
            let container = $(".list-unstyled");
            container.empty();
            if (res.data.length === 0) {
                container.append(
                    '<li class="text-center text-muted">Data tidak ditemukan</li>'
                );
                $(".pagination").html("");
                return;
            }
            res.data.forEach((item) => {
                container.append(`
                    <li class="media align-items-center">
                        <img class="rounded-circle mr-3" width="50" src="/img/avatar/avatar-4.png">
                        <div class="media-body">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div>
                                    <h6 class="media-title mb-0">${item.guru.nama_lengkap}</h6>
                                    <div class="text-small text-muted">${item.guru.nip}</div>
                                </div>
                                <div class="text-right">
                                    <div class="btn-group">
                                        <button class="btn btn-info btn-detail" data-id="${item.id}"><i class="fa fa-eye"></i></button>
                                        <button class="btn btn-danger btn-delete" data-id="${item.id}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
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
    loadTabelPengajar();
});

// Pagination
$(document).on("click", ".pagination a", function (e) {
    e.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    loadTabelPengajar(page);
});

$(document).ready(function () {
    loadTabelPengajar();

    // Tambah Pengajar
    $("#modal-tambah-mapel-guru").click(function () {
        $("#form-tambah-mapel-guru")[0].reset();
        $("#form-tambah-mapel-guru .form-control").removeClass("is-invalid");
        $("#modalMapelGuruLabel").text("Tambah Pengajar");
        $("#modalMapelGuru").modal("show");
    });

    // Submit Tambah Pengajar
    $("#form-tambah-mapel-guru").submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: `/admin/mapel/${mapel_id}/pengajar`,
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
                    $("#modalMapelGuru").modal("hide");
                    loadTabelPengajar();
                }
            },
            error: function (err) {
                if (err.status === 422) {
                    let errors = err.responseJSON.errors;
                    $.each(errors, function (key, messages) {
                        let input = $(`#form-tambah-mapel-guru [name="${key}"]`);
                        input.addClass("is-invalid");
                        input.closest(".form-group").find(".invalid-feedback").text(messages[0]);
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

    // Detail Guru
    $(document).on("click", ".btn-detail", function () {
        let id = $(this).data("id");
        $.get(`/admin/mapel/pengajar/${id}`, function (res) {
            let guru = res.pengajar.guru;
            if (guru) {
                let form = $("#form-detail-guru");
                Object.keys(guru).forEach((key) => {
                    form.find(`[name="${key}"]`).val(guru[key]);
                });
                $("#modalDetailGuru").modal("show");
            }
        });
    });

    // Delete Pengajar
    $(document).on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        swal({
            title: "Apakah anda yakin?",
            text: "Data pengajar akan dihapus!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: `/admin/mapel/pengajar/${id}`,
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
                        loadTabelPengajar();
                    },
                });
            }
        });
    });
});
