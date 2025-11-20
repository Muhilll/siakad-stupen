"use strict";

let currentSearchSubmission = "";
const tugas_id = $("#tugas_id").val();

function loadSubmission(page = 1) {
    $.get(`/guru/tugas/submission/${tugas_id}/data`, { page: page, search: currentSearchSubmission }, function(res){
        let tbody = $("#tabel-submission tbody");
        tbody.empty();
        $(".pagination").html(res.pagination);

        if(res.data.length === 0){
            tbody.append('<tr class="text-center text-muted"><td colspan="7">Data tidak tersedia</td></tr>');
            return;
        }

        res.data.forEach((item, index) => {
            let fileBtn = item.file 
                ? `<a href="/storage/submission/${item.file}" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>` 
                : '-';
            let statusBadge = item.status === 'Terkirim'
                ? '<div class="badge badge-success">Terkirim</div>'
                : '<div class="badge badge-warning">Terlambat</div>';

            tbody.append(`
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.anggota_kelas.siswa.nama}</td>
                    <td>${item.des ?? '-'}</td>
                    <td>${fileBtn}</td>
                    <td>${statusBadge}</td>
                    <td>${item.created_at}</td>
                </tr>
            `);
        });
    });
}

// Search
$(document).on("submit", "#formSearchSubmission", function(e){
    e.preventDefault();
    currentSearchSubmission = $("#search").val();
    loadSubmission(1);
});

// Pagination click
$(document).on("click", ".pagination a", function(e){
    e.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    loadSubmission(page);
});

$(document).ready(function(){
    loadSubmission();
});