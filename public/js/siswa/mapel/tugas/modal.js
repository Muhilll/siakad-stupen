"use strict";

$(document).ready(function(){

    const tugasId = $("#tugas_id").val();

    // Open modal upload
    $("#modal-upload-tugas").click(function(){
        $("#formTugas")[0].reset();
        $("#formTugas .form-control").removeClass("is-invalid");
        $("#modalTugasLabel").text("Upload Tugas");
        $("#modalTugas").modal("show");

        // load existing submission (jika sudah pernah submit)
        $.get(`/siswa/tugas/submission/${tugasId}`, function(res){
            if(res && res.file){
                $("#formTugas [name='des']").val(res.des);
                // bisa tampilkan file lama di modal jika perlu
            }
        });
    });

    // Submit upload
    $("#formTugas").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('tugas_id', tugasId);

        $.ajax({
            url: '/siswa/tugas/submit',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res){
                if(res.success){
                    iziToast.success({
                        title: 'Berhasil!',
                        message: res.message,
                        position: 'topRight'
                    });
                    $("#modalTugas").modal("hide");

                    // update file di input view
                    let fileInput = $(".ticket-form input[type='text']").eq(1);
                    let lihatBtn = $(".ticket-form a.btn-info").eq(1);
                    fileInput.val(res.submission.file);
                    lihatBtn.attr('href', '/storage/submission/' + res.submission.file);
                }
            },
            error: function(err){
                if(err.status === 422){
                    let errors = err.responseJSON.errors;
                    $("#formTugas .form-control").removeClass("is-invalid");
                    $.each(errors, function(key, messages){
                        let input = $(`#formTugas [name="${key}"]`);
                        input.addClass("is-invalid");
                        input.closest(".form-group").find(".invalid-feedback").remove();
                        input.closest(".form-group").append(`<div class="invalid-feedback">${messages[0]}</div>`);
                    });
                    return;
                }
                iziToast.error({
                    title: 'Gagal!',
                    message: 'Terjadi kesalahan.',
                    position: 'topRight'
                });
            }
        });
    });

});
