"use strict";

$("#modal-tambah-mapel").fireModal({
  title: 'Tambah Mata Pelajaran',
  body: $("#form-tambah-mapel"),
  footerClass: 'bg-whitesmoke',
  autoFocus: false,

  onFormSubmit: function(modal, e, form) {
    // Form Data
    let form_data = $(e.target).serialize();
    console.log(form_data)

    // DO AJAX HERE
    let fake_ajax = setTimeout(function() {
      form.stopProgress();
      modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')

      clearInterval(fake_ajax);
    }, 1500);

    e.preventDefault();
  },
  shown: function(modal, form) {
    console.log(form)
  },
  buttons: [
    {
      text: 'Simpan',
      submit: true,
      class: 'btn btn-primary btn-shadow',
      handler: function(modal) {
      }
    }
  ]
});

$("#modal-tambah-mapel-guru").fireModal({
  title: 'Tambah Pengajar Mata Pelajaran',
  body: $("#form-tambah-mapel-guru"),
  footerClass: 'bg-whitesmoke',
  autoFocus: false,

  onFormSubmit: function(modal, e, form) {
    // Form Data
    let form_data = $(e.target).serialize();
    console.log(form_data)

    // DO AJAX HERE
    let fake_ajax = setTimeout(function() {
      form.stopProgress();
      modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')

      clearInterval(fake_ajax);
    }, 1500);

    e.preventDefault();
  },
  shown: function(modal, form) {
    console.log(form)
  },
  buttons: [
    {
      text: 'Simpan',
      submit: true,
      class: 'btn btn-primary btn-shadow',
      handler: function(modal) {
      }
    }
  ]
});
