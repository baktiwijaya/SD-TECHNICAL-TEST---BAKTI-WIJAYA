<div class="container-fluid">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header" style="background-color: white;">
        <div class="row">
          <div class="col-md-9">
            <h3 class="card-title"><?php echo $title ?></h3>
          </div>
          <div class="col-md-3" align="right">
            <a href="#" class="btn btn-success btn-sm" title="Tambah" onclick="add()">Tambah</a>
            <a href="#" class="btn btn-primary btn-sm" title="Reload" onclick="tampil()">Muat ulang</a>
          </div>
        </div>
      </div>
      <?= $this->session->flashdata('message'); ?>
      <div class="card-body">
          <div id="content_data"></div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    tampil();
  })
  function tampil() {
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url() ?>anggota/load_table',
      beforeSend: function(data) {
        $.blockUI({
          message: 'Mohon tunggu !',
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
      error: function (data) {
        $.unblockUI();
        alert('Opps, gagal memuat data!', 'info')
      },
      success: function (data) {
        $.unblockUI();
        $('#content_data').html(data);
      }
    })
  }

  function add() {
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url() ?>anggota/add',
      beforeSend: function(data) {
        $.blockUI({
          message: 'Mohon tunggu !',
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
      error: function (data) {
        $.unblockUI();
        alert('Opps, gagal memuat data!', 'info')
      },
      success: function (data) {
        $.unblockUI();
        $('#content_data').html(data);
      }
    })
  }
</script>
