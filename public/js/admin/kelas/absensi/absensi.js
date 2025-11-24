"use strict";

let currentSearchAbsensi = "";
let kelas_mapel_id = $("#kelas_mapel_id").val();

// Load tabel absensi
function loadTabelAbsensi(page = 1) {
    $.ajax({
        url: `/admin/kelas/detail/absensi/mapel/${kelas_mapel_id}/data`,
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
                        <td>${formatTanggal(item.created_at)}</td>
                        <td>${formatTanggal(item.batas)}</td>
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
    
    $(document).on("click", ".btn-kehadiran", function () {
        const tugasId = $(this).data("id");
        $.post('/encrypt-id', { id: tugasId, _token: $('meta[name="csrf-token"]').attr('content') }, function(res) {
            if (res.encrypted) {
                window.location.href = `/admin/kelas/detail/absensi/mapel/kehadiran/${res.encrypted}`;
            }
        });
    });
});
