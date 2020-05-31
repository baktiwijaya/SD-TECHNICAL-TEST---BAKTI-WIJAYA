        <!-- Sidebar -->
        <?php $url = $this->uri->segment('1'); ?>
        <?php $toggle = ($url == 'dashboard' || $url == 'dashboard_new') ? 'toggled' : ''; ?>
        <ul class="navbar-nav sidebar sidebar-dark accordion <?php echo $toggle ?>" id="accordionSidebar" style="background: #263238;background: #263238;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
               <!--  <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-code"></i>
                </div> -->
                <div class="sidebar-brand-text mx-3">TEST</div>
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
        <!-- End  of Sidebar --> 