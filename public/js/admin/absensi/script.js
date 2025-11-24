$(document).ready(function () {
    // Ketika pilihan kelas berubah
    $("#filter-kelas").change(function () {
        let kelasId = $(this).val();

        // Kosongkan dropdown tanggal
        $("#filter-tanggal").html('<option value="">Pilih Tanggal</option>');

        if (!kelasId) return;

        $.ajax({
            url: "/admin/absensi/tanggal",
            method: "GET",
            data: { kelas_id: kelasId },
            success: function (res) {
                if (res.length === 0) {
                    $("#filter-tanggal").append(
                        '<option value="">Tidak ada absensi</option>'
                    );
                    return;
                }

                res.forEach((t) => {
                    $("#filter-tanggal").append(`
                        <option value="${t.tanggal}">${t.tanggal}</option>
                    `);
                });
            },
        });
    });

    // Klik tombol LIHAT
    $("#lihat-absensi").click(function () {
        loadAbsensi();
    });

    function loadAbsensi() {
        let kelasId = $("#filter-kelas").val();
        let tanggal = $("#filter-tanggal").val();

        if (!kelasId || !tanggal) {
            iziToast.warning({
                title: "Perhatian",
                message: "Silakan pilih kelas dan tanggal terlebih dahulu",
                position: "topRight",
            });
            return;
        }

        $.ajax({
            url: "/admin/absensi/data",
            method: "GET",
            data: {
                kelas_id: kelasId,
                tanggal: tanggal,
            },
            success: function (res) {
                updateTable(res.absensiList, res.result);
            },
        });
    }

    function updateTable(absensiList, result) {
        // =============== HEADER DINAMIS ===============

        let colspan = absensiList.length;

        let header1 = `
            <tr>
                <th rowspan="2">#</th>
                <th rowspan="2">Nama Siswa</th>
                <th rowspan="2">NIS</th>
                <th rowspan="2">Jenis Kelamin</th>
                <th colspan="${colspan}" class="text-center">Mata Pelajaran</th>
            </tr>
        `;

        let header2 = "<tr>";

        absensiList.forEach((abs) => {
            header2 += `<th>${abs.kelas_mapel.mapel_guru.mapel.nama}</th>`;
        });

        header2 += "</tr>";

        // Tempelkan header ke thead
        $("table thead").html(header1 + header2);

        // =============== BODY TABEL ===============

        let tbody = "";
        let no = 1;

        Object.keys(result).forEach((siswaId) => {
            const siswaData = result[siswaId];
            const siswa = siswaData.siswa;

            let row = `
                <tr>
                    <td>${no++}</td>
                    <td>${siswa.nama}</td>
                    <td>${siswa.nis}</td>
                    <td>${siswa.jkl == "L" ? "Laki-laki" : "Perempuan"}</td>
            `;

            absensiList.forEach((abs) => {
                let hadirObj = siswaData.kehadiran[abs.id];
                let ket = hadirObj && hadirObj.ket ? hadirObj.ket : "-";
                if(ket === 'Hadir'){
                    ket = `<div class="badge badge-success">${ket}</div>`;
                }else if(ket === 'Izin'){
                    ket = `<div class="badge badge-danger">${ket}</div>`;
                }else{
                    ket = `<div class="badge badge-danger">-</div>`;
                }
                row += `<td>${ket}</td>`;
            });

            row += `</tr>`;
            tbody += row;
        });

        $("table tbody").html(tbody);
    }
});
