"use strict";

let currentSearchAbsensi = "";
let kelas_mapel_id = $("#kelas_mapel_id").val();

// Load tabel absensi
function loadTabelAbsensi(page = 1) {
    $.ajax({
        url: `/guru/kelas/detail/${kelas_mapel_id}/absensi/data`,
        method: "GET",
        data: { page: page, search: currentSearchAbsensi },
        success: function (res) {
            let tbody = $("#tabel-absensi tbody");
            tbody.empty();
            if (res.data.length === 0) {
                tbody.append('<tr class="text-center text-muted"><td colspan="6">Data tidak ditemukan</td></tr>');
                $(".pagination").html("");
                return;
            }
            res.data.forEach((item, index) => {
                tbody.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.nama}</td>
                        <td>${item.created_at}</td>
                        <td>${item.batas}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-primary btn-kehadiran" data-id="${item.id}"><i class="fa fa-eye"></i></button>
                            </div>
                        </td>
                    </tr>
                `);
            });
            $(".pagination").html(res.pagination);
        }
    });
}

// Search
$(document).on("submit", ".card-header-form form", function (e) {
    e.preventDefault();
    currentSearchAbsensi = $(this).find("input[type='text']").val();
    loadTabelAbsensi();
});

// Pagination
$(document).on("click", ".pagination a", function (e) {
    e.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    loadTabelAbsensi(page);
});

// Document ready
$(document).ready(function () {
    loadTabelAbsensi();

    // Modal Tambah
    $("#modal-tambah-absensi").click(function () {
        $("#formAbsensi")[0].reset();
        $("#formAbsensi .form-control").removeClass("is-invalid");
        $("#absensi_id").val('');
        $("#modalAbsensiLabel").text('Tambah Absensi');
        $("#modalAbsensi").modal("show");
    });

    // Submit Tambah / Update
    $("#formAbsensi").submit(function (e) {
        e.preventDefault();
        let absensiId = $("#absensi_id").val();
        let formData = new FormData(this);

        let url = `/guru/kelas/detail/absensi/store`;
        if (absensiId) {
            url = `/guru/kelas/detail/absensi/update/${absensiId}`;
        }

        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function (res) {
                if (res.success) {
                    iziToast.success({ title: "Berhasil!", message: res.message, position: "topRight" });
                    $("#modalAbsensi").modal("hide");
                    loadTabelAbsensi();
                }
            },
            error: function (err) {
                if (err.status === 422) {
                    let errors = err.responseJSON.errors;
                    $("#formAbsensi .form-control").removeClass("is-invalid");
                    $.each(errors, function (key, messages) {
                        let input = $(`#formAbsensi [name="${key}"]`);
                        input.addClass("is-invalid");
                        input.closest(".form-group").find(".invalid-feedback").remove();
                        input.closest(".form-group").append(`<div class="invalid-feedback">${messages[0]}</div>`);
                    });
                    return;
                }
                iziToast.error({ title: "Gagal!", message: "Terjadi kesalahan.", position: "topRight" });
            }
        });
    });

    // Edit Absensi
    $(document).on("click", ".btn-edit", function () {
        let id = $(this).data("id");
        $.get(`/guru/kelas/detail/absensi/show/${id}`, function (res) {
            let a = res.absensi;
            if (a) {
                $("#absensi_id").val(a.id);
                let form = $("#formAbsensi");
                form.find('[name="nama"]').val(a.nama);
                form.find('[name="batas"]').val(a.batas);
                $("#modalAbsensiLabel").text('Edit Absensi');
                $("#modalAbsensi").modal("show");
            }
        });
    });

    // Delete Absensi
    $(document).on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        swal({
            title: "Apakah anda yakin?",
            text: "Data absensi akan dihapus!",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: `/guru/kelas/detail/absensi/delete/${id}`,
                    method: "POST",
                    data: { _method: "DELETE" },
                    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                    success: function (res) {
                        iziToast.success({ title: "Berhasil!", message: res.message, position: "topRight" });
                        loadTabelAbsensi();
                    }
                });
            }
        });
    });
    
    $(document).on("click", ".btn-kehadiran", function () {
        const tugasId = $(this).data("id");
        $.post('/encrypt-id', { id: tugasId, _token: $('meta[name="csrf-token"]').attr('content') }, function(res) {
            if (res.encrypted) {
                window.location.href = `/admin/kelas/detail/absensi/mapel/kehadiran/${res.encrypted}`;
            }
        });
    });
});
