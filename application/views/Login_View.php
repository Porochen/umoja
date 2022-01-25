<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    $name_apk=$this->Model->getValueSettings('name_apk') ;
    $theme_apk=$this->Model->getValueSettings('theme_apk');
    $home_word=$this->Model->getValueSettings('home_word');

    $logo=$this->Model->getValueSettings('logo') ;
    ?>
    <title><?=$name_apk?></title>

    <link rel="stylesheet" href="<?= base_url('assets/login/css/unplug-ui-kit.css')?>">

    <link rel="stylesheet" href="<?= base_url('assets/login/css/unplug-ui-kit-demo.css')?>">

    <link rel="stylesheet" href="<?= base_url('assets/login/css/materialdesignicons.min.css')?>">

    <link rel="icon" href="<?=base_url('assets/photo/settings_images/').$logo?>" type="image/x-icon"/>

    

</head>

<body>

    <main class="auth">

        <div class="container-fluid">

            <div class="row vh-100">

                <div class="col-md-6 text-center py-5 d-flex flex-column justify-content-center auth-bg-section text-white">

                <figure>

                  <img src="<?= base_url('assets/login/images/map.jpg')?>" style="height: 300px;width: 100%;margin-top: -50px;" alt="" class="img-fluid">

                </figure>

                    <h2 style="color:white;"><?=$name_apk?></h2>

                    <p style="color:white;"> <?=$home_word?> 

                    </p>

                    <center></center>

                    <div class="footer" >

                    <div class="copy">© <?= date('Y')?> - <?=$name_apk?></div></div>

                </div>

                <div class="col-md-6 text-center d-flex flex-column py-2 justify-content-center">

                    <center><div class="col-md-9 " >

                        <div class="logo"><img src="<?=base_url('assets/photo/settings_images/').$logo?>"  width="350" height="150"></div>

                        <div class="mb-4">

                      <h3>Connectez-vous à  <strong>Umoja</strong></h3>

                      <p><p><?=$theme_apk?></p></p>

                    </div>

                        <form action="<?=base_url('Login/do_login')?>" method="post" class="auth-form">

                          <?php if(!empty($this->session->flashdata('message')))
                                 echo $this->session->flashdata('message');
                          ?>

                            <div class="form-group">

                                <label for="username" class="sr-only">Email</label>

                                <input type="text" name="username" style="font-size: 15px;" class="form-control" placeholder="Email" required="">

                            </div>

                            <div class="form-group">

                            <label for="userPassword" class="sr-only">Mot de passe</label>

                            <input type="password" style="font-size: 15px;" name="password" class="form-control" placeholder="Mot de passe" required="">

                            </div>

                            <button type="submit" class="btn btn-success btn-block mb-3">Connexion</button>

                            <div class="d-md-flex justify-content-between">

                                <div class="form-check">

                                </div>

                                <a href="<?=base_url('Login/recover_password')?>" class="text-info">Forgot Password?</a>

                            </div>



                        </form>

                        

                    </div>

                    </center>

                </div>

            </div>

        </div>

    </main>





<!-- Modal terms -->

  <div class="modal fade" id="reglema" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

      <div class="modal-content">

        <div class="modal-header">

          <h4 class="modal-title" id="termsLabel">Règlements</h4>

          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        </div>

        <div class="modal-body">

          <p>Umoja Network est une communauté privée dont l'objectif est de responsabiliser et de positionner ses membres avec le bon type d'opportunité d'exceller financièrement et économiquement. Nous sommes fiers du fait que nous défendons l'intégrité et la loyauté envers notre cause.</p>



          <p>Les membres de cette communauté croient qu'il faut s'élever les uns les autres. C'est pourquoi nous nous engageons également dans des dons caritatifs pour aider les moins privilégiés de la communauté.</p>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-info" data-dismiss="modal">Fermer</button>

        </div>

      </div>

      <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

  </div>

  <!-- /.modal -->

    

</body>

</html>





  <!--   Core JS Files   -->

    <script src="<?= base_url()?>assets/js/core/jquery.3.2.1.min.js"></script>

    <script src="<?= base_url()?>assets/js/core/popper.min.js"></script>

    <script src="<?= base_url()?>assets/js/core/bootstrap.min.js"></script>