<div class="table-responsive">
  <table class="table table-hover" id="table">
    <thead>
      <tr>
        <th style="text-align: left;">No</th>
        <th style="text-align: left;">Tanggal Pertandingan</th>
        <th style="text-align: left;">Jam Pertandingan</th>
        <th style="text-align: left;">Tuan Rumah</th>
        <th style="text-align: left;">Tamu</th>
        <th style="text-align: center;">Aksi</th>
      </tr>
    </thead>
    <tbody>

      <?php $no = 1; foreach ($list as $key) :?>

      <tr>
        <th><?php echo $no++; ?></th>
        <td><?php echo $key['TANGGAL_PERTANDINGAN'] ?></td>
        <td><?php echo $key['JAM_PERTANDINGAN'] ?></td>
        <td><?php echo $this->Global_m->getvalue('NAMA_TIM','T_TIM','ID',$key['TUAN_RUMAH']) ?></td>
        <td><?php echo $this->Global_m->getvalue('NAMA_TIM','T_TIM','ID',$key['TAMU']) ?></td>
        <td style="text-align: center;">
          <a href="#" class="btn btn-success btn-circle" onclick="edit('<?php echo $key['ID'] ?>')">
            <i class="fas fa-edit"></i>
          </a>
          <a href="#" class="btn btn-danger btn-circle" onclick="hapus('<?php echo $key['ID'] ?>')">
            <i class="fas fa-trash"></i>
          </a>
        </td>
      </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
</div>
<script type="text/javascript">
   $(document).ready(function(){
    $('#table').DataTable();
  })
  function edit(id_level1) {
    $.ajax({
      type: 'POST',
      data: {
        id: id_level1
      },
      url: '<?php echo base_url() ?>pertandingan/edit/',
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
      error: function(data) {
        $.unblockUI();
        alert('Opps, gagal memuat data!', 'info')
      },
      success: function(data) {
        $.unblockUI();
        $('#content_data').html(data);
      }
    })
  }

  function hapus(id_level1) {
    Swal.fire({
      title: 'Konfirmasi ?',
      text: "Apakah anda yakin ingin menghapus data ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya !',
      cancelButtonText: 'Tidak !',
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "<?php echo base_url(); ?>pertandingan/delete",
          method: "POST",
          data: {
            id: id_level1
          },
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
          error: function(data) {
            $.unblockUI();
            alert('Opps, gagal memuat data!', 'info')
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
</script>
