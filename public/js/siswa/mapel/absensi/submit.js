"use strict";

// Klik tombol submit
$(document).on("click", ".btn-submit-absensi", function () {
    let id = $(this).data("id");
    $("#absensi_id_hidden").val(id);

    $("#modalAbsensiLabel").text("Submit Absensi");
    $("#modalAbsensi").modal("show");
});

// Submit form
$("#formAbsensi").submit(function (e) {
    e.preventDefault();

    $.ajax({
        url: "/siswa/mapel/detail/absensi/submit",
        method: "POST",
        data: $(this).serialize(),
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function (res) {
            iziToast.success({
                title: "Berhasil!",
                message: res.message,
                position: "topRight"
            });

            $("#modalAbsensi").modal("hide");
            location.reload();
        },
        error: function (err) {
            iziToast.error({
                title: "Gagal!",
                message: err.responseJSON.message,
                position: "topRight"
            });
        }
    });
});
