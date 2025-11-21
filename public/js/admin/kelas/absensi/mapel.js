"use strict";

// CSRF
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

let kelas_id = $("input[name=kelas_id]").val();
let currentSearch = "";

// === LOAD MAPEL LIST ===
function loadAbsensiMapel(page = 1) {
    $.ajax({
        url: `/admin/kelas/detail/absensi/${kelas_id}/data`,
        method: "GET",
        data: { page: page, search: currentSearch },
        success: function(res) {

            let list = $("#list-mapel-absensi");
            list.empty();

            if (res.data.length === 0) {
                list.append(`<tr><td colspan="5" class="text-center text-muted">Data tidak ditemukan</td></tr>`);
                $(".pagination").html('');
                return;
            }

            res.data.forEach((item, index) => {
                list.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.mapel_guru.mapel.nama}</td>
                        <td>${item.mapel_guru.guru.nama_lengkap}</td>
                        <td>${item.created_at}</td>
                        <td>
                            <a href="/admin/kelas/detail/absensi/mapel/${item.encrypted_id}" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i> Lihat
                            </a>
                        </td>
                    </tr>
                `);
            });

            $(".pagination").html(res.pagination);
        }
    });
}

// === SEARCH ===
$(document).on("submit", ".card-header-form form", function(e){
    e.preventDefault();
    currentSearch = $(this).find("input").val();
    loadAbsensiMapel();
});

// === PAGINATION CLICK ===
$(document).on("click", ".pagination a", function(e){
    e.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    loadAbsensiMapel(page);
});

// INIT
$(document).ready(function () {
    loadAbsensiMapel();
});
