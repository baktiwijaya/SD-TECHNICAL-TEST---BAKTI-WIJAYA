<?php 
  $hidden_form = array('id'=> !empty($id) ? $id : '');
  echo form_open_multipart('anggota/save', array('id' => 'myform', 'class' => 'form-horizontal frm'), $hidden_form);
?>

<div class="col-md-6">
  
  <div class="form-group">
    <label>Nama Anggota</label>
    <?php echo form_input('NAMA_ANGGOTA', !empty($detail->NAMA_ANGGOTA) ? $detail->NAMA_ANGGOTA : '', 'class="form-control" required'); ?>
  </div>

  <div class="form-group">
    <label>Nama Tim</label>
    <?php
      echo form_dropdown('ID_TIM', $options_tim, !empty($detail->ID_TIM) ? $detail->ID_TIM : '', 'class="form-control select2"required');
    ?>
  </div>

  <div class="form-group">
    <label>Posisi</label>
    <?php
      echo form_dropdown('POSISI', $options_posisi, !empty($detail->POSISI) ? $detail->POSISI : '', 'class="form-control select2"required');
    ?>
  </div>

  <div class="form-group">
    <label>Nomor Punggung</label>
    <?php echo form_input('NOMOR_PUNGGUNG', !empty($detail->NOMOR_PUNGGUNG) ? $detail->NOMOR_PUNGGUNG : '', 'class="form-control" required'); ?>
  </div>

  <div class="form-group">
    <label>Tinggi Badan</label>
    <?php echo form_input('TINGGI_BADAN', !empty($detail->TINGGI_BADAN) ? $detail->TINGGI_BADAN : '', 'class="form-control" required'); ?>
  </div>

  <div class="form-group">
    <label>Berat Badan</label>
    <?php echo form_input('BERAT_BADAN', !empty($detail->BERAT_BADAN) ? $detail->BERAT_BADAN : '', 'class="form-control" required'); ?>
  </div>



  <div class="form-group">
    <?php $tipe = ($id != "") ? 'Ubah' : 'Simpan'; ?>
    <button type="submit" class="btn btn-info"><?php echo $tipe ?></button>
    <button type="button" class="btn btn-danger" onclick="tampil()">Kembali</button>
  </div>
</div>

<?php echo form_close(); ?>


<script type="text/javascript">
  $('.frm').validate({
    ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
    errorClass: 'validation-invalid-label',
    successClass: 'validation-valid-label',
    validClass: 'validation-valid-label',
    highlight: function(element, errorClass) {
      $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
      $(element).removeClass(errorClass);
    },
    errorPlacement: function(error, element) {
      if (element.parents().hasClass('form-check')) {
        error.appendTo(element.parents('.form-check').parent());
      } else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
        error.appendTo(element.parent());
      } else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
        error.appendTo(element.parent().parent());
      }
      // Other elements
      else {
        error.insertAfter(element);
      }
    },
    submitHandler: function(form) {
      var tipe = ('<?php echo $id != "" ?>') ? 'mengubah' : 'menambah';
      Swal.fire({
        title: 'Konfirmasi ?',
        text: "Apakah anda yakin ingin " + tipe + " data ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya !',
        cancelButtonText: 'Tidak !',
      }).then((result) => {
        if (result.value) {
          var data = new FormData(form);
          $.ajax({
            type: 'POST',
            url: $("#myform").attr('action'),
            data: data,
            contentType: false,
            processData: false,
            beforeSend: function(data) {
              $.blockUI({
                message: '<i class="icon-spinner4 spinner"></i>',
                overlayCSS: {
                  backgroundColor: '#1b2024',
                  opacity: 0.8,
                  zIndex: 1200,
                  cursor: 'wait'
                },
                css: {
                  border: 0,
                  color: '#fff',
                  zIndex: 1201,
                  padding: 0,
                  backgroundColor: 'transparent'
                }
              });
            },
            error: function(data) {
              $.unblockUI();
              alert('Proses data gagal', 'info')
            },
            success: function(data) {
              $.unblockUI();
              var obj = JSON.parse(data);
              if (obj[0]) {
                Swal.fire({
                  title: obj[1],
                  text: obj[2],
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Ok'
                }).then((result) => {
                  if (result.value) {
                    tampil();
                  }
                })
              } else {
                Swal.fire({
                  icon: 'error',
                  title: obj[1],
                  text: obj[2],
                })
              }
            }
          })
        }
      })
    }
  });
</script>