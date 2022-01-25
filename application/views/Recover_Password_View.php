

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
  $name_apk=$this->Model->getValueSettings('name_apk') ;
  $theme_apk=$this->Model->getValueSettings('theme_apk') ;
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

                    <div class="footer" style="">

                    <div class="copy">© <?= date('Y')?> - <?=$name_apk?></div></div>

                </div>

                <div class="col-md-6 text-center d-flex flex-column py-2 justify-content-center">

                    <center><div class="col-md-9 " >

                        <div class="logo"><img src="<?=base_url('assets/photo/settings_images/').$logo?>"  width="150" height="100"></div>

                        <div class="mb-4">

                      <h3>Récupération du  <strong>mot de passe</strong></h3>

                      <p><?=$theme_apk?></p>

                    </div>

                      <form method="post" action="#" id="recover" class="card" autocomplete="off">

								<div class="card-body p-6">

									<h3 class="text-center card-title">Mot de passe oublié</h3>

										<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">

											<input class="input100 form-control" type="email" name="email" id="email" placeholder="Email" >

											<span class="focus-input100"></span>

											<span class="symbol-input100">

												<i class="zmdi zmdi-email" aria-hidden="true"></i>

											</span>

										</div><br><span id="succ"></span>

										<div class="form-footer">

			

											<button type="button"  class="btn btn-success btn-block" onclick="return recover_pass();">Recuperer</button>

										</div>

										<div class="text-center text-muted mt-3 ">

										 <a href="<?=base_url('Login')?>">Se connecter ici</a>

									</div>

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



<script>

  function recover_pass()

    {

        var email=$('#email').val();

        if(email==''){

        $('#email').focus()

        $('#email').css('border-color','red')

      }else{

        $.ajax({

          type:'post',

          dataType: "json",

          url:'<?=base_url()?>Login/recover/',

          data:{email:email},

          success:function(data){

            if (data.response === 'success') 

            {

              document.getElementById("recover").reset();

              $('#succ').html("<div class='alert alert-info text-center col-md-12 pull-right'>"+data.message+"</div>");



            }else{

              document.getElementById("recover").reset();

              $('#succ').html("<div class='alert alert-danger text-center col-md-12 pull-right'>"+data.message+"</div>");

            }

          }

        });

      }

    }

</script>

    

</body>

</html>