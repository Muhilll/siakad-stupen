"use strict";

let currentSearch = "";
let kelas_id = $("#kelas_id").val();

// Load tabel siswa
function loadTabelSiswa(page = 1) {
    $.ajax({
        url: `/guru/kelas/detail/${kelas_id}/siswa/data`,
        method: "GET",
        data: { page: page, search: currentSearch },
        success: function (res) {
            let tbody = $("#tabel-siswa tbody");
            tbody.empty();

            if (res.data.length === 0) {
                tbody.append(
                    '<tr class="text-center text-muted"><td colspan="6">Data tidak ditemukan</td></tr>'
                );
                $(".pagination").html("");
                return;
            }

            res.data.forEach((item, index) => {
                tbody.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.siswa.nama}</td>
                        <td>${item.siswa.nis}</td>
                        <td>${item.siswa.nisn}</td>
                        <td>${item.siswa.status}</td>
                        <td>
                            <button class="btn btn-info btn-detail" data-id="${item.id}">
                                <i class="fa fa-eye"></i>
                            </button>
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
    currentSearch = $(this).find("input").val();
    loadTabelSiswa();
});

// Pagination
$(document).on("click", ".pagination a", function (e) {
    e.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    loadTabelSiswa(page);
});

// Ready
$(document).ready(function () {
    loadTabelSiswa();

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
