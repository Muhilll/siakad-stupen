"use strict";

let currentSearchKehadiran = "";
const absensi_id = $("#absensi_id").val();

function loadKehadiran(page = 1) {
    $.get(`/guru/tugas/kehadiran/${absensi_id}/data`, { page: page, search: currentSearchKehadiran }, function(res){
        let tbody = $("#tabel-kehadiran tbody");
        tbody.empty();
        $(".pagination").html(res.pagination);

        if(res.data.length === 0){
            tbody.append('<tr class="text-center text-muted"><td colspan="5">Data tidak tersedia</td></tr>');
            return;
        }

        res.data.forEach((item, index) => {
            let statusBadge = item.status
                ? `<div class="badge badge-success">Hadir</div>`
                : `<div class="badge badge-danger">Tidak Hadir</div>`;

            tbody.append(`
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.anggota_kelas.siswa.nama}</td>
                    <td>${item.anggota_kelas.siswa.nis}</td>
                    <td>${statusBadge}</td>
                    <td>${item.created_at}</td>
                    <td>
                        <button class="btn btn-info btn-detail" data-id="${item.anggota_kelas.id}">
                            <i class="fa fa-eye"></i>
                        </button>
                    </td>
                </tr>
            `);
        });
    });
}

// Search
$(document).on("submit", "#formSearchKehadiran", function(e){
    e.preventDefault();
    currentSearchKehadiran = $("#search").val();
    loadKehadiran(1);
});

// Pagination click
$(document).on("click", ".pagination a", function(e){
    e.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    loadKehadiran(page);
});

$(document).ready(function(){
    loadKehadiran();
});

$(document).ready(function () {

    // Detail siswa (jika modal digunakan sama seperti admin)
    $(document).on("click", ".btn-detail", function () {
        
        let id = $(this).data("id");

        $.get(`/guru/kelas/detail/siswa/show/${id}`, function (res) {
            let siswa = res.siswa;

            let form = $("#form-detail-siswa");
            Object.keys(siswa).forEach((key) =>
                form.find(`[name="${key}"]`).val(siswa[key])
            );

            $("#modalDetailSiswa").modal("show");
        });
    });
});