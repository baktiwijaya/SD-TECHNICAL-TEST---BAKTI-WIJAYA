<div class="container">

    <!-- Outer Row -->
    <br><br><br><br><br>
    <div class="row justify-content-center">

        <div class="col-lg-7">


            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-white font-weight-bold mb-4">Football</h1>
                        </div>

                        <?= $this->session->flashdata('message'); ?>

                        <form class="user" method="post" action="<?= base_url('auth'); ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            <div class="input-group mb-3">
                              <input type="text" class="form-control form-control-user" placeholder="Enter Username" aria-label="Username" aria-describedby="basic-addon2" value="<?= set_value('email'); ?>"  id="email" name="email">
                            </div>

                            
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Login
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small text-white" href="<?= base_url('auth/forgotpassword'); ?>">Lupa Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small text-white" href="<?= base_url('auth/registration'); ?>">Daftar Akun !</a>
                        </div>
                    </div>
                </div>
            </div>
  

        </div>

    </div>

</div> 