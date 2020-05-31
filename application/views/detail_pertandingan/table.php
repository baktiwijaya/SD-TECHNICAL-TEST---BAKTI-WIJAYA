<div class="table-responsive">
  <table class="table table-hover" id="table">
    <thead>
      <tr>
        <th style="text-align: left;">No</th>
        <th style="text-align: left;">Tanggal Pertandingan</th>
        <th style="text-align: left;">Jam Pertandingan</th>
        <th style="text-align: left;">Tuan Rumah</th>
        <th style="text-align: left;">Tamu</th>
        <th style="text-align: left;">Skor Akhir</th>
        <th style="text-align: center;">Aksi</th>
      </tr>
    </thead>
    <tbody>

      <?php $no = 1; foreach ($list as $key) :?>
      <?php $skor_tuanrumah = $this->Crud_m->countWhereValue('T_DETAIL_PERTANDINGAN',"ID_PERTANDINGAN=".$key['ID'],"TIPE = 1","ID_TIM = ".$key['TUAN_RUMAH']);?>
      <?php $skor_tamu = $this->Crud_m->countWhereValue('T_DETAIL_PERTANDINGAN',"ID_PERTANDINGAN=".$key['ID'],"TIPE = 1","ID_TIM = ".$key['TAMU']);?>
      <tr>
        <th><?php echo $no++; ?></th>
        <td><?php echo $key['TANGGAL_PERTANDINGAN'] ?></td>
        <td><?php echo $key['JAM_PERTANDINGAN'] ?></td>
        <td><?php echo $this->Global_m->getvalue('NAMA_TIM','T_TIM','ID',$key['TUAN_RUMAH']) ?></td>
        <td><?php echo $this->Global_m->getvalue('NAMA_TIM','T_TIM','ID',$key['TAMU']) ?></td>
        <td><?php echo $skor_tuanrumah." - ".$skor_tamu; ?></td>
        <td style="text-align: center;">
          <a href="#" class="btn btn-success btn-circle" onclick="detail('<?php echo $key['ID'] ?>')">
            <i class="fas fa-eye"></i>
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
  function detail(id) {
    $.ajax({
      type: 'POST',
      data: {
        "id": id
      },
      url: '<?php echo base_url() ?>detail_pertandingan/load_detail/',
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
</script>
