<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SD TECHNICAL TEST</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
        google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700","Asap+Condensed:500"]},
        active: function() {
            // sessionStorage.fonts = true;
        }
      });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/css/inputmask.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js">
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/validation/validate.min.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
      <?php $url = $this->uri->segment('1'); ?>
      <?php $toggle = ($url == 'dashboard') ? 'toggled' : ''; ?>
      <ul class="navbar-nav sidebar sidebar-dark accordion <?php echo $toggle ?>" id="accordionSidebar" style="background: #263238;background: #263238;">

          <!-- Sidebar - Brand -->
          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
             <!--  <div class="sidebar-brand-icon rotate-n-15">
                  <i class="fas fa-code"></i>
              </div> -->
              <div class="sidebar-brand-text mx-3">FOOTBALL</div>
          </a>

          <!-- Divider -->
          <hr class="sidebar-divider">


          <!-- QUERY MENU -->
          <?php 
          $role_id = $this->session->userdata('role_id');
          $queryMenu = "SELECT a.id, menu
                          FROM USER_MENU a JOIN `USER_ACCESS_MENU` b
                            ON a.id = b.menu_id
                         WHERE b.role_id = $role_id
                      ORDER BY b.menu_id ASC
                      ";
          $menu = $this->db->query($queryMenu)->result_array();
          ?>

          
          <!-- LOOPING MENU -->
          <?php $no = 1;$sec = 1;;foreach ($menu as $m) : ?>
          
          <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse<?= $m['id']?>" aria-expanded="true" aria-controls="collapse<?= $m['id']?>">
                <i class="fas fa-fw fa-cog"></i>
                <span><?= $m['menu'] ?></span>
              </a>

              <div id="collapse<?= $m['id']?>" class="collapse " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <?php 
                      $menuId = $m['id'];
                      $querySubMenu = "SELECT *
                                         FROM USER_SUB_MENU JOIN USER_MENU 
                                           ON USER_SUB_MENU.menu_id = USER_MENU.id
                                        WHERE USER_SUB_MENU.menu_id = $menuId
                                          AND USER_SUB_MENU.is_active = 1
                                  ";
                      $subMenu = $this->db->query($querySubMenu)->result_array();
                  ?>
                  <?php foreach ($subMenu as $sm) : ?>
                      <?php if ($title == $sm['title']) : ?>
                          <?php $active = 'active' ?>
                      <?php else : ?>
                          <?php $active = ''; ?>
                      <?php endif;?>
                      <a class="collapse-item <?php echo $active ?>" href="<?= base_url($sm['url']); ?>"><?= $sm['title'] ?></a>
                  <?php endforeach; ?>
                </div>
              </div>
          </li>
      
          <hr class="sidebar-divider">

          <?php endforeach; ?>

          <li class="nav-item">
              <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                  <i class="fas fa-fw fa-sign-out-alt"></i>
                  <span>Logout</span></a>
          </li>


          <!-- Divider -->
          <hr class="sidebar-divider d-none d-md-block">

          <!-- Sidebar Toggler (Sidebar) -->
          <div class="text-center d-none d-md-inline">
              <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>

      </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown no-arrow">
                  <a class="nav-link" style="color: black;" href="#" id="" role="button">
                      <?php echo $this->Global_m->get_days().", ".$this->Global_m->get_today(); ?>&nbsp;,&nbsp;
                      <span id="clock"></span>
                  </a>
                  
              </li>
              
              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                      <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                  </a>
                  <!-- Dropdown - User Information -->
                  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                      <a class="dropdown-item" href="<?php echo base_url() ?>user">
                          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                          My Profile
                      </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#" onclick="logout();">
                          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                          Logout
                      </a>
                  </div>
              </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
          <?php $this->load->view($content); ?>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
            <span><b>Copyright &copy; Bakti Wijaya <?php echo date('Y')?> </b>.<br>Dimuat dalam waktu <b>{elapsed_time} </b>Detik !</span>
            </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="<?= base_url('assets/'); ?>js/jquery.inputmask.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <script src="<?php echo base_url() ?>assets/js/loaders/blockui.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/loaders/pace.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
        setInterval('tampilkanwaktu()', 1000);
        function tampilkanwaktu(){
            var waktu = new Date();
          
            var sh = waktu.getHours() + ""; 
            var sm = waktu.getMinutes() + "";
            var ss = waktu.getSeconds() + "";
            document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
        }

        $('.form-check-input').on('click', function() {
            const menuId = $(this).data('menu');
            const roleId = $(this).data('role');

            $.ajax({
                url: "<?= base_url('admin/changeaccess'); ?>",
                type: 'post',
                data: {
                    menuId: menuId,
                    roleId: roleId
                },
                success: function() {
                    document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
                }
            });

        });

        function logout() {
            Swal.fire({
                title: 'Konfirmasi ?',
                text: "Apakah anda yakin ingin logout ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya !',
                cancelButtonText: 'Tidak !',
            }).then((result) => {
                if (result.value) {
                    document.location.href = "<?= base_url('auth/logout'); ?>";         
                }
            })

        }
    </script>

</body>

</html>
