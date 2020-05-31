<?php 
  $hidden_form = array('id'=> !empty($id) ? $id : '');
  echo form_open_multipart('detail_pertandingan/save', array('id' => 'myform', 'class' => 'form-horizontal frm'), $hidden_form);
?>
<h6>*) Klik tombol untuk mencatat waktu</h6>
<button type="button" class="btn btn-primary" id="time-elapsed">00:00</button>

<input type="hidden" name="" id="waktu" value="<?php echo $detail->TANGGAL_PERTANDINGAN." ".$detail->JAM_PERTANDINGAN;?>">
<input type="text" readonly id="catatan" name="WAKTU" required>
<br>
<br>
<div class="row">
	<div class="col-md-3">
		<select class="form-control" id="TIPE" name="TIPE" required>
			<option value="" disabled selected>Pilih Jenis</option>
			<option value="1">Gol</option>
			<option value="2">Offside</option>
			<option value="3">Pelanggaran</option>
		</select>
	</div>
	<div class="col-md-3">
		<select class="form-control" onchange="get_pemain(this.value);" name="ID_TIM" required>
			<option value="" disabled selected>Pilih Tim</option>
			<option value="<?php echo $detail->TUAN_RUMAH; ?>">Tuan Rumah (&nbsp;<?php echo $this->Global_m->getvalue('NAMA_TIM','T_TIM','ID',$detail->TUAN_RUMAH)?>&nbsp;) </option>
			<option value="<?php echo $detail->TAMU; ?>">Tamu (&nbsp;<?php echo $this->Global_m->getvalue('NAMA_TIM','T_TIM','ID',$detail->TAMU)?>&nbsp;)</option>
		</select>
	</div>
	<div class="col-md-3">
		<select class="form-control" id="PEMAIN" name="ID_ANGGOTA" required>
			<option value="" disabled selected>Pilih Pemain</option>
		</select>
	</div>

	<div class="col-md-3">
		<button type="button" class="btn btn-primary" id="simpan">Simpan</button>
	</div>
</div>
<br>
<div class="col-md-12">
	<div class="card">
		<div class="card-header" style="background-color: white;">
			<div class="col-md-9">
	            <h3 class="card-title">Highlight Pertandingan</h3>
	        </div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-4">
					<h2>Gol</h2>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama Pemain</th>
								<th>Waktu</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;foreach($gol as $data) : ?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $this->Global_m->getvalue('NAMA_ANGGOTA','T_ANGGOTA','ID',$data['ID_ANGGOTA']) ?></td>
									<td><?php echo $data['WAKTU'] ?></td>
								</tr>
							<?php $no++;endforeach; ?>
						</tbody>
					</table>
				</div>
				<div class="col-md-4">
					<h2>Offside</h2>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama Pemain</th>
								<th>Waktu</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;foreach($offside as $data) : ?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $this->Global_m->getvalue('NAMA_ANGGOTA','T_ANGGOTA','ID',$data['ID_ANGGOTA']) ?></td>
									<td><?php echo $data['WAKTU'] ?></td>
								</tr>
							<?php $no++;endforeach; ?>
						</tbody>
					</table>
				</div>
				<div class="col-md-4">
					<h2>Pelanggaran</h2>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama Pemain</th>
								<th>Waktu</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;foreach($pelanggaran as $data) : ?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $this->Global_m->getvalue('NAMA_ANGGOTA','T_ANGGOTA','ID',$data['ID_ANGGOTA']) ?></td>
									<td><?php echo $data['WAKTU'] ?></td>
								</tr>
							<?php $no++;endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">

	var datetime = $('#waktu').val();
	var startDateTime = new Date(datetime); 
	var startStamp = startDateTime.getTime();
	var newDate = new Date();
	var newStamp = newDate.getTime();

	var timer; 

	function updateClock() {
	    newDate = new Date();
	    newStamp = newDate.getTime();
	    var b;
	    var a = Math.round((newStamp-startStamp)/1000);
	    var c = Math.floor(a / 60);
	    var diff = Math.round((newStamp-startStamp)/1000);
	    var d = Math.floor(diff/(24*60*60));
	    diff = diff-(d*24*60*60);
	    var h = Math.floor(diff/(60*60));
	    diff = diff-(h*60*60);
	    var m = Math.floor(diff/ 60);
	    if(a > 60) {
	    	b = c;
	    } else {
	    	b = m;
	    }
	    diff = diff - (m*60);
	    var s = diff;
	    
	    document.getElementById("time-elapsed").innerHTML = b+":"+s;
	}

	timer = setInterval(updateClock, 1000);

	$('#time-elapsed').click(function(){
		var catat = $(this).text();
		var b = catat.substr(0, catat.indexOf(':')); 

		$("#catatan").val(b);
	})

	function get_pemain(id) {
    	$('select[id="PEMAIN"]').empty();
    	var datana = {
            "id" : id
        };
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()?>detail_pertandingan/get_pemain',
            data: datana,
            dataType: "json",
            error: function (data) {
                alert('Proses data gagal', 'info')
            },
            success: function (data) {

                $('select[id="PEMAIN"]').val(0);
                $.each(data,function(x,y) {
                    $('#PEMAIN').append('<option value="'+y.ID+'">'+y.NAMA_ANGGOTA+'</option>');
                })
                
            }
        })
    }

    $("#simpan").click(function(){
    	$('#myform').submit();
    });

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
	                    detail('<?php echo $id?>');
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