
<div class="container-fluid">
    <div class="row">
        
    </div>
    
</div>



<script>
    $(document).ready(function(){
   
})


function load() {
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url() ?>upload/select_dashboard',
        error: function (data) {
            alert('Opps, gagal memuat data!', 'info')
        },
        success: function (data) {
            var obj = JSON.parse(data);
          

        }
    })
}
</script>