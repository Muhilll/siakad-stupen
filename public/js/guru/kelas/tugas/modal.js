"use strict";

let currentSearchTugas = "";
let kelas_mapel_id = $("#kelas_mapel_id").val();

// Load tabel tugas
function loadTabelTugas(page = 1) {
    $.ajax({
        url: `/guru/kelas/detail/${kelas_mapel_id}/tugas/data`,
        method: "GET",
        data: { page: page, search: currentSearchTugas },
        success: function (res) {
            let tbody = $("#tabel-tugas tbody");
            tbody.empty();
            if (res.data.length === 0) {
                tbody.append(
                    '<tr class="text-center text-muted"><td colspan="6">Data tidak ditemukan</td></tr>'
                );
                $(".pagination").html("");
                return;
            }
            res.data.forEach((item, index) => {
                let fileHtml = item.file
                    ? `<a href="/storage/tugas/${item.file}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>`
                    : "-";
                let batas = item.batas ? formatTanggal(item.batas) : "-";
                tbody.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.nama}</td>
                        <td>${
                            item.des
                                ? item.des.length > 80
                                    ? item.des.substring(0, 80) + "..."
                                    : item.des
                                : "-"
                        }</td>
                        <td>${fileHtml}</td>
                        <td>${batas}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-info btn-edit" data-id="${
                                    item.id
                                }"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-delete" data-id="${
                                    item.id
                                }"><i class="fa fa-trash"></i></button>
                                <button class="btn btn-primary btn-submission" data-id="${
                                    item.id
                                }"><i class="fa fa-eye"></i></button>
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
    currentSearchTugas = $(this).find("input[type='text']").val();
    loadTabelTugas();
});

// Pagination click
$(document).on("click", ".pagination a", function (e) {
    e.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    loadTabelTugas(page);
});

$(document).ready(function () {
    loadTabelTugas();

    // Modal Tambah
    $("#modal-tambah-tugas").click(function () {
        $("#formTugas")[0].reset();
        $("#formTugas .form-control").removeClass("is-invalid");
        $("#tugas_id").val("");
        $("#modalTugasLabel").text("Tambah Tugas");
        $("#modalTugas").modal("show");
    });

    // Submit Tambah / Update
    $("#formTugas").submit(function (e) {
        e.preventDefault();
        let tugasId = $("#tugas_id").val();
        let formData = new FormData(this);

        let url = `/guru/kelas/detail/tugas/store`;
        if (tugasId) {
            url = `/guru/kelas/detail/tugas/update/${tugasId}`;
        }

        $.ajax({
            url: url,
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
                    $("#modalTugas").modal("hide");
                    loadTabelTugas();
                }
            },
            error: function (err) {
                if (err.status === 422) {
                    let errors = err.responseJSON.errors;
                    $("#formTugas .form-control").removeClass("is-invalid");
                    $.each(errors, function (key, messages) {
                        let input = $(`#formTugas [name="${key}"]`);
                        input.addClass("is-invalid");
                        input
                            .closest(".form-group")
                            .find(".invalid-feedback")
                            .remove();
                        input
                            .closest(".form-group")
                            .append(
                                `<div class="invalid-feedback">${messages[0]}</div>`
                            );
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

    // Edit
    $(document).on("click", ".btn-edit", function () {
        let id = $(this).data("id");
        $.get(`/guru/kelas/detail/tugas/show/${id}`, function (res) {
            let t = res.tugas;
            if (t) {
                $("#tugas_id").val(t.id);
                let form = $("#formTugas");
                form.find('[name="nama"]').val(t.nama);
                form.find('[name="des"]').val(t.des);
                // convert batas to datetime-local input value (YYYY-MM-DDTHH:MM)
                if (t.batas) {
                    let dt = new Date(t.batas);
                    let iso = dt.toISOString().slice(0, 16);
                    form.find('[name="batas"]').val(iso);
                } else {
                    form.find('[name="batas"]').val("");
                }
                form.find('[name="kelas_mapel_id"]').val(t.kelas_mapel_id);
                $("#modalTugasLabel").text("Edit Tugas");
                $("#modalTugas").modal("show");
            }
        });
    });

    // Delete
    $(document).on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        swal({
            title: "Apakah anda yakin?",
            text: "Data tugas akan dihapus!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: `/guru/kelas/detail/tugas/delete/${id}`,
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
                        loadTabelTugas();
                    },
                });
            }
        });
    });

    $(document).on("click", ".btn-submission", function () {
        const tugasId = $(this).data("id");
        $.post('/encrypt-id', { id: tugasId, _token: $('meta[name="csrf-token"]').attr('content') }, function(res) {
            if (res.encrypted) {
                window.location.href = `/guru/tugas/submission/${res.encrypted}`;
            }
        });
    });
});
