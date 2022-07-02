<?php $this->load->view('crud_function'); ?>

<!DOCTYPE html>
<html>
    <head>
        <?php 
            if(!isset($_SESSION)) {
                 session_start();
            }

            $this->load->view('page_header'); 
        ?>
    </head>

    <body class="bg-accpunt-pages">
        <!-- HOME -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="wrapper-page">
                            <div class="account-pages">
                                <div class="account-box">
                                    <div class="account-logo-box">
                                        <h2 class="text-uppercase text-center">
                                            <a href="index.html" class="text-success">
                                                <span><img src="<?php echo base_url().'assets/images/logo_dark.png'?>" alt="" height="100"></span>
                                            </a>
                                        </h2>
                                        <h5 class="text-uppercase font-bold m-b-5 m-t-50">Sign In</h5>
                                    </div>
                                    <div class="account-content" style="padding-top: 0px;">
                                        <p style='text-align:left;color:red;font-weight:bold'><?php echo $alert ?></p>
                                        <form class="form-horizontal" id="form_login" action="<?php echo $path."/verifikasi"?>" method="post">
                                            <div class="form-group m-b-20 row">
                                                <div class="col-12">
                                                    <label for="emailaddress">Pengguna</label>
                                                    <input class="form-control" type="text" id="username" name="username" required placeholder="Username">
                                                </div>
                                            </div>

                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <label for="password">Kata sandi</label>
                                                    <input class="form-control" type="password" required id="password" name="password" placeholder="Password">
                                                </div>
                                            </div>

                                            <div class="form-group row text-center m-t-10">
                                                <div class="col-12">
                                                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Sign In</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-box-->
                        </div>
                        <!-- end wrapper -->
                    </div>
                </div>
            </div>
          </section>
          <!-- END HOME -->
        <?php $this->load->view('page_footer'); ?>
    </body>
</html>
