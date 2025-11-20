$(document).ready(function(){

    $('.ticket-item').click(function(){
        // highlight item
        $('.ticket-item').removeClass('active');
        $(this).addClass('active');

        let materi_id = $(this).data('id');

        $.get(`/siswa/mapel/detail/materi/${materi_id}/detail`, function(res){
            if(res.materi){
                let materi = res.materi;
                let html = `
                    <div class="ticket-header">
                        <div class="ticket-sender-picture img-shadow">
                            <i class="fa-solid fa-book fa-3x"></i>
                        </div>
                        <div class="ticket-detail">
                            <div class="ticket-title">
                                <h4>${materi.nama}</h4>
                            </div>
                            <div class="ticket-info">
                                <div class="font-weight-600">${res.guru}</div>
                                <div class="bullet"></div>
                                <div class="text-primary font-weight-600">${materi.created_at}</div>
                            </div>
                        </div>
                    </div>
                    <div class="ticket-description">
                        <p>${materi.des ?? ''}</p>
                        <div class="ticket-form">
                            <div class="input-group">
                                <input type="text" class="form-control" value="${materi.file}" readonly>
                                <div class="input-group-append">
                                    <a href="/storage/materi/${materi.file}" target="_blank" 
                                        class="btn btn-info d-flex align-items-center justify-content-center" 
                                        title="Lihat Materi" style="width: 42px; height: 42px;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/storage/materi/${materi.file}" download
                                        class="btn btn-primary d-flex align-items-center justify-content-center" 
                                        title="Download Materi" style="width: 42px; height: 42px; margin-left:4px;">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                $('.ticket-content').html(html);
            }
        });
    });

});
