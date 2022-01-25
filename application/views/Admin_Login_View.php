

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    $name_apk=$this->Model->getValueSettings('name_apk') ;
    $theme_apk=$this->Model->getValueSettings('theme_apk');
    
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

                

                <div class="col-md-12 text-center d-flex flex-column py-2 justify-content-center">

                    <center><div class="col-md-4 " >

                        <div class="logo"><img src="<?=base_url('assets/photo/settings_images/').$logo?>"  width="150" height="100"></div>

                        <div class="mb-4">

                      <h3>Connectez-vous à  <strong>Umoja</strong></h3>

                      <p><?=$theme_apk?></p>

                    </div>

                        <form action="<?=base_url('Login/admin_do_login')?>" method="post" class="auth-form">

                          <?= $sms?>

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

                            </div>



                        </form>

                        

                    </div>

                    </center>

                </div>

            </div>

        </div>

    </main>

    

</body>

</html>





  <!--   Core JS Files   -->

    <script src="<?= base_url()?>assets/js/core/jquery.3.2.1.min.js"></script>

    <script src="<?= base_url()?>assets/js/core/popper.min.js"></script>

    <script src="<?= base_url()?>assets/js/core/bootstrap.min.js"></script>