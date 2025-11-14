"use strict";

// CSRF token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

let kelas_id = $("input[name=kelas_id]").val();
let currentSearch = "";

// Load List Kelas Mapel
function loadKelasMapel(page = 1) {
    $.ajax({
        url: `/admin/kelas/detail/${kelas_id}/mapel/data`,
        method: "GET",
        data: { page: page, search: currentSearch },
        success: function(res) {
            let list = $("#list-kelas-mapel");
            list.empty();

            if(res.data.length === 0){
                list.append('<li class="text-center text-muted">Data tidak ditemukan</li>');
                $(".pagination").html('');
                return;
            }

            res.data.forEach((item, index) => {
                list.append(`
                    <li class="media align-items-center">
                        <img class="rounded-circle mr-3" width="50" src="/img/avatar/book.png">
                        <div class="media-body">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div>
                                    <h6 class="media-title mb-0">${item.mapel_guru.mapel.nama}</h6>
                                    <div class="text-small text-muted">
                                        ${item.mapel_guru.guru.nama_lengkap}
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-danger btn-delete" data-id="${item.id}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                `);
            });
            $(".pagination").html(res.pagination);
        }
    });
}

// Search
$(document).on("submit", ".card-header-form form", function(e){
    e.preventDefault();
    currentSearch = $(this).find("input[name='search']").val();
    loadKelasMapel();
});

// Pagination
$(document).on("click", ".pagination a", function(e){
    e.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    loadKelasMapel(page);
});

// Modal Tambah
$("#modal-tambah-kelas-mapel").click(function() {
    $("#form-tambah-kelas-mapel")[0].reset();
    $("#mapel_guru_id").attr("disabled", true);
    $("#modalTambahKelasMapel").modal("show");
});

// Ambil Guru saat Mapel dipilih
$("#mapel_id").change(function() {
    let mapelId = $(this).val();
    if (!mapelId) return;

    $.get(`/admin/kelas/detail/mapel/${mapelId}/guru`, function(res) {
        let select = $("#mapel_guru_id");
        select.empty().append('<option value="">-- Pilih Guru --</option>');
        res.forEach(item => {
            select.append(`<option value="${item.id}">${item.guru.nama_lengkap}</option>`);
        });
        select.attr("disabled", false);
    });
});

// Submit Tambah
$("#form-tambah-kelas-mapel").submit(function(e) {
    e.preventDefault();
    let formData = $(this).serialize();

    $.ajax({
        url: `/admin/kelas/detail/${kelas_id}/mapel`,
        type: 'POST',
        data: formData,
        success: function(res) {
            iziToast.success({ title: "Berhasil", message: res.message, position: "topRight" });
            $("#modalTambahKelasMapel").modal("hide");
            loadKelasMapel();
        },
        error: function(err) {
            if(err.status === 422){
                let errors = err.responseJSON.errors;
                $.each(errors, function(key, messages) {
                    let input = $(`#form-tambah-kelas-mapel [name="${key}"]`);
                    input.addClass("is-invalid");
                    input.closest(".form-group").find(".invalid-feedback").text(messages[0]);
                });
                return;
            }
            iziToast.error({ title: "Gagal", message: "Terjadi kesalahan.", position: "topRight" });
        }
    });
});

// Delete
$(document).on("click", ".btn-delete", function() {
    let id = $(this).data("id");
    swal({
        title: "Apakah anda yakin?",
        text: "Data mata pelajaran akan dihapus!",
        icon: "warning",
        buttons: true,
        dangerMode: true
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: `/admin/kelas/detail/mapel/${id}`,
                type: 'DELETE',
                success: function(res) {
                    iziToast.success({ title: "Berhasil", message: res.message, position: "topRight" });
                    loadKelasMapel();
                }
            });
        }
    });
});

// Inisialisasi
$(document).ready(function() {
    loadKelasMapel();
});
