"use strict";

let currentSearchMateri = "";
let kelas_mapel_id = $("#kelas_mapel_id").val(); // dari index.blade

// Load tabel materi
function loadTabelMateri(page = 1) {
    $.ajax({
        url: `/guru/kelas/detail/${kelas_mapel_id}/materi/data`,
        method: "GET",
        data: { page: page, search: currentSearchMateri },
        success: function (res) {
            let tbody = $("#tabel-materi tbody");
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
                    ? `<a href="/storage/materi/${item.file}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>`
                    : "-";
                tbody.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.nama}</td>
                            <td>${item.des ? (item.des.length > 60 ? item.des.substring(0,60) + '...' : item.des) : '-'}</td>
                            <td>${fileHtml}</td>
                            <td>${item.created_at ? item.created_at : '-'}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-info btn-edit" data-id="${item.id}"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-delete" data-id="${item.id}"><i class="fa fa-trash"></i></button>
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
    currentSearchMateri = $(this).find("input[type='text']").val();
    loadTabelMateri();
});

// Pagination
$(document).on("click", ".pagination a", function (e) {
    e.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    loadTabelMateri(page);
});

$(document).ready(function () {
    loadTabelMateri();

    // Modal Tambah
    $("#modal-tambah-materi").click(function () {
        $("#formMateri")[0].reset();
        $("#formMateri .form-control").removeClass("is-invalid");
        $("#materi_id").val('');
        $("#modalMateriLabel").text('Tambah Materi');
        $("#modalMateri").modal("show");
    });

    // Submit Tambah / Update
    $("#formMateri").submit(function (e) {
        e.preventDefault();
        let materiId = $("#materi_id").val();
        let formData = new FormData(this);

        let url = `/guru/kelas/detail/materi/store`;
        if (materiId) {
            url = `/guru/kelas/detail/materi/update/${materiId}`;
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
                    $("#modalMateri").modal("hide");
                    loadTabelMateri();
                }
            },
            error: function (err) {
                if (err.status === 422) {
                    let errors = err.responseJSON.errors;
                    $("#formMateri .form-control").removeClass("is-invalid");
                    $.each(errors, function (key, messages) {
                        let input = $(`#formMateri [name="${key}"]`);
                        input.addClass("is-invalid");
                        input.closest(".form-group").find(".invalid-feedback").remove();
                        input.closest(".form-group").append(`<div class="invalid-feedback">${messages[0]}</div>`);
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

    // Edit Materi
    $(document).on("click", ".btn-edit", function () {
        let id = $(this).data("id");
        $.get(`/guru/kelas/detail/materi/show/${id}`, function (res) {
            let m = res.materi;
            if (m) {
                $("#materi_id").val(m.id);
                let form = $("#formMateri");
                form.find('[name="nama"]').val(m.nama);
                form.find('[name="des"]').val(m.des);
                form.find('[name="kelas_mapel_id"]').val(m.kelas_mapel_id);
                // note: file input left empty (user may upload new file to replace)
                $("#modalMateriLabel").text('Edit Materi');
                $("#modalMateri").modal("show");
            }
        });
    });

    // Delete Materi
    $(document).on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        swal({
            title: "Apakah anda yakin?",
            text: "Data materi akan dihapus!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: `/guru/kelas/detail/materi/delete/${id}`,
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
                        loadTabelMateri();
                    },
                });
            }
        });
    });
});
