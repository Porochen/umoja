<?php include VIEWPATH.'template/includes/header.php';?>

<!-- Sidebar -->

<?php include VIEWPATH.'template/includes/sidebar_menu.php';?>

<!-- End Sidebar -->

<?php
$image_profil='';
if (!empty($source['photo_membre'])) {
 $image_profil=base_url('assets/photo/profile/').$source['photo_membre'];
}else{
 $image_profil=base_url('assets/photo/profile/profile.jpg');
}

?>

<div class="main-panel">

 <div class="container">


  <div class="panel-header bg-primary-gradient">

   <div class="page-inner py-3">

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">

     <div>

      <h2 class="text-white pb-2 fw-bold">

      <?=lang('membres')?>

      </h2>

     </div>

     <div class="ml-md-auto py-2 py-md-0">

      <!-- PAGE-HEADER -->

      <div class="page-header">

       <ol class="breadcrumb">

        <li class="breadcrumb-item">

         <a href="#"><?=lang('acceuil')?></a>

        </li>

        <li class="breadcrumb-item">

         <a href="#"><?=lang('membres')?></a>

        </li>

        <li class="breadcrumb-item active" aria-current="page">

          <?=lang('reseau_actif')?>

        </li>

       </ol>

      </div>

      <!-- PAGE-HEADER END -->

     </div>

    </div>

   </div>

  </div>











  <div class="page-inner mt--5">

   <div class="row mt--2 ">









    <div class="col-lg-4 col-xl-3">

     <div class="card bg-primary ">

      <div class="panel-heading p-4 text-center">

       <h3 class="text-center mb-2">
       Mon compte
        

       </h3>

       <p class="text-dark mb-0">        
        <?php 
          $niv = $this->Model->readOne('niveau', ['id_niveau'=> $this->session->userdata('id_niveau')]);
        ?>
        <?=$niv['niveau_desc']?>

       </p>

      </div>

      <div class=" userlist">

       <div class="card-body text-center">

        <div class="userprofile mt-0">

         <div class="userpic"> 

          <center>

           <img class="media-object rounded-circle thumb-sm" alt="<?= $source['nom_membre']?>" src="<?= $image_profil?>" style="width: 65px; height: 65px">

          </center> 

         </div>

         <h3 class="username text-white">

          <?= $source['prenom_membre']?><br>

          <?= $source['nom_membre']?>

         </h3>

        </div>

        <p class="mb-0 text-white">

         <a href="javascript:void(0);" class="text-white">

          <?= $source['email_membre']?>

         </a>

        </p>

        <p class="mb-0 text-white">

         <a href="javascript:void(0);" class="text-white">

          <?= $source['tele_membre']?>

         </a>

        </p>

       </div>

      </div>

      <div class="panel-footer br-br-0 br-bl-0">

       <div class="text-center ">

        <div class="flex-c-m ">

         <a href="" target="_blank" class="login100-social-item bg1">

          <i class="fab fa-facebook"></i>

         </a>

         <a href="" target="_blank" class="login100-social-item bg2">

          <i class="fab fa-telegram"></i>

         </a>

        </div>

       </div>

      </div>

     </div>                  </div>



     <div class="col-lg-8 col-xl-9">

      <div class="row">

       <div class="col-12">





        <div class="card ">

         <div class="card-header ">

          <CENTER>

           <h3 class="card-title ">

          <?=lang('mon_parrain')?>

           </h3>

          </CENTER>

         </div>

        </div>



        <div class="row">

         <div class="col-4"></div>

         <div class="col-4">

          <div class="card ">

           <div class="card-header ">

            <h3 class="card-title ">
            <?php
            $niveau="";
              if (empty($parrain)) {
                $niveau="Système";
              }else{
                $level = $this->Model->readOne('niveau', ['id_niveau'=> $parrain['id_niveau']]);
                $niveau=$level['niveau_desc'];
              }
               ?>
          <?=$niveau;?>

            </h3>
            <?php
              $image_parrain='';
              if (!empty($parrain['photo_membre'])) {
               $image_profil=base_url('assets/photo/profile/').$parrain['photo_membre'];
              }else{
               $image_parrain=base_url('assets/photo/profile/profile.jpg');
              }

              ?>
           </div>

           <div class="card-body text-center">

            <div class="notif-img"> 

             <center>

              <img class="media-object rounded-circle thumb-sm" alt="image" src="<?= $image_parrain?>" style="width: 65px; height: 65px">

             </center>

            </div>

            <h4 class="h4 mb-0 mt-3">

             <?= $parrain !=''? $parrain['prenom_membre'].' '.$parrain['nom_membre'] : 'Umoja System'?>

            </h4>

            <span style="font-size: 12px">

             <b><?= $source['code_membre']?></b>

            </span>



            <br><br>

            <p class="card-text">

             <?= $parrain!=''? $parrain['email_membre'] :''?><br>

             <?= $parrain!=''? $parrain['tele_membre']:''?>

            </p>

           </div>

           <div class="card-footer text-center">

            <div class="row user-social-detail">

             <div class="col-lg-4 col-sm-4 col-4">

             </div>

             <div class="col-lg-4 col-sm-4 col-4"></div>

             <div class="col-lg-4 col-sm-4 col-4">

              <a href="https://api.whatsapp.com/send?phone=<?= $parrain!=''? $parrain['tele_membre']:''?>" target="_blank" class="btn btn-circle btn-success ">

               <i class="fab fa-whatsapp"></i>

              </a>

             </div>

            </div>

           </div>

          </div>

         </div>

         <div class="col-4"></div>

        </div>

        <div class="card ">

         <div class="card-header ">

          <CENTER>

           <h3 class="card-title "> 
 
            <?= empty($first_tier)? lang('aucun_niveau1'):lang('equipe1') ?>

           </h3>

          </CENTER>

         </div>

        </div>



        <div class="row">

         <!-- <div class="col-2"></div> -->

         

         <?php 



         if (!empty($first_tier)) {

           $color='';
           $col='';
           $niveau_membre='';
           $niveau_m="";
          foreach ($first_tier as $value) {  
             if ($value['id_niveau']!=$niveau_actuel) {

                if ($value['id_niveau']==1) {
                      $col='#C0C0C0';
                    }elseif($value['id_niveau']==2){
                      $col='#614e1a';
                    }elseif($value['id_niveau']==3){
                      $col='#ffd700';
                    }elseif($value['id_niveau']==4){
                      $col='#6977a1';
                    }elseif($value['id_niveau']==5){
                      $col='#cee4e6';
                    }


               $color='style="background-color:'.$col.';"';
                  $niveau_membre='<span class="badge float-right" style="background-color:#fff;">'.$value['id_niveau'].'</span>';

                  $level1 = $this->Model->readOne('niveau', ['id_niveau'=> $value['id_niveau']]);
                $niveau_m=$level1['niveau_desc'];
               }else{

                $color='';
                $niveau_membre='<span class="badge float-right" style="background-color:#fff;">'.$niveau_actuel.'</span>';

                $level1 = $this->Model->readOne('niveau', ['id_niveau'=> $niveau_actuel]);
                $niveau_m=$level1['niveau_desc'];
               } ?>

           <?php
           $image_value='';
           if (!empty($value['photo_membre'])) {
            $image_value=base_url('assets/photo/profile/').$value['photo_membre'];
           }else{
            $image_value=base_url('assets/photo/profile/profile.jpg');
           }

           ?>

           <div class="col-6">

            <div class="card ">

             <div class="card-header " <?=$color?>>

              <h3 class="card-title ">

               
               <?=$niveau_m?>
               <?=$niveau_membre?>
              </h3>
             </div>

             <div class="card-body text-center">

              <div class="notif-img"> 

               <center>

                <img class="media-object rounded-circle thumb-sm" alt="Image" src="<?= $image_value?>" style="width: 65px; height: 65px">

               </center>

              </div>

              <h4 class="h4 mb-0 mt-3">

               <?= $value['prenom_membre'] .' '.$value['nom_membre']?>

              </h4>

              <span style="font-size: 12px">

               <b><?= $value['code_membre']?></b>

              </span>



              <br><br>

              <p class="card-text">

               <?= $value['email_membre']?>

               <br>

               <?= $value['tele_membre']?>

              </p>

              <!-- <button type="button"  class="btn btn-success">DONNÉ</button> -->
              <hr>

              <p><b>Parrain</b><br>

               <?= $source['prenom_membre'].' '.$source['nom_membre']?>

              </p>

             </div>

             <div class="card-footer text-center">

              <div class="row user-social-detail">

               <div class="col-lg-4 col-sm-4 col-4"></div>

               <div class="col-lg-4 col-sm-4 col-4"></div>

               <div class="col-lg-4 col-sm-4 col-4">

                <a href="https://api.whatsapp.com/send?phone=<?= $value['tele_membre']?>" target="_blank" class="btn btn-success">

                 <i class="fab fa-whatsapp"></i>

                </a>

               </div>

              </div>

             </div>

            </div>

           </div>

          <?php   }

         }?>

         <div class="col-2"></div>

        </div>



       </div>



       <div class="col-12">

        <div class="card ">

         <div class="card-header ">

          <CENTER>

           <h3 class="card-title ">

            <?= empty($second_tier)? lang('aucun_niveau2'):lang('equipe2')?> 
                 
           </h3>

          </CENTER>

         </div>

        </div>

        <div class="row">



         <?php



         if (!empty($second_tier)) {

            $color='';
            $col='';
            $niveau_membre='';
            $niveau_m2='';
          foreach ($second_tier as $value) {

          if ($value['id_niveau']!=$niveau_actuel) {

                 if ($value['id_niveau']==1) {
                      $col='#C0C0C0';
                    }elseif($value['id_niveau']==2){
                      $col='#614e1a';
                    }elseif($value['id_niveau']==3){
                      $col='#ffd700';
                    }elseif($value['id_niveau']==4){
                      $col='#6977a1';
                    }elseif($value['id_niveau']==5){
                      $col='#cee4e6';
                    }


               $color='style="background-color:'.$col.';"';
               $niveau_membre='<span class="badge float-right" style="background-color:#fff;">'.$value['id_niveau'].'</span>';
               $level2 = $this->Model->readOne('niveau', ['id_niveau'=> $value['id_niveau']]);
                $niveau_m2=$level2['niveau_desc'];
             }else{
              $color='';
              $niveau_membre='<span class="badge float-right" style="background-color:#fff;">'.$niveau_actuel.'</span>';
              $level2 = $this->Model->readOne('niveau', ['id_niveau'=> $niveau_actuel]);
                $niveau_m2=$level2['niveau_desc'];
             }
              

           $second_source=$this->Model->readRequeteOne("SELECT t.*,m.prenom_membre,m.nom_membre AS nom_water FROM tier1 t JOIN membre m ON m.id_membre=t.id_water_source where t.id_membre_tier1=".$value['id_membre_tier2']."");

           ?>

           <?php
           $image_value='';
           if (!empty($value['photo_membre'])) {
            $image_value=base_url('assets/photo/profile/').$value['photo_membre'];
           }else{
            $image_value=base_url('assets/photo/profile/profile.jpg');
           }

           ?>

           <div class="col-6">

            <div class="card ">

             <div class="card-header " <?=$color?>>

              <h3 class="card-title ">
                <?=$niveau_m2?>
                <?=$niveau_membre?>
              </h3>

             </div>

             <div class="card-body text-center">

              <div class="notif-img"> 

               <center>

                <img class="media-object rounded-circle thumb-sm" alt="<?= $value['prenom_membre']?>" src="<?= $image_value?>" style="width: 65px; height: 65px">

               </center>

              </div>

              <h4 class="h4 mb-0 mt-3">

               <?= $value['prenom_membre'].' '.$value['nom_membre']?>

              </h4>

              <span style="font-size: 12px">

               <b><?= $value['code_membre']?></b>

              </span>



              <br><br>

              <p class="card-text">

               <?= $value['email_membre']?><br>

               <?= $value['tele_membre']?>

              </p>



              <hr>



              <p><b>Parrain</b><br>

               <?= $second_source['prenom_membre'].' '.$second_source['nom_water']?> 

              </p>

             </div>

             <div class="card-footer text-center">

              <div class="row user-social-detail">

               <div class="col-lg-4 col-sm-4 col-4"> </div>

               <div class="col-lg-4 col-sm-4 col-4"></div>

               

               <div class="col-lg-4 col-sm-4 col-4">

                <a href="https://api.whatsapp.com/send?phone=<?= $value['tele_membre']?>" target="_blank" class="btn btn-success">

                 <i class="fab fa-whatsapp"></i>

                </a>

               </div>

              </div>

             </div>

            </div>

           </div>

          <?php  } 



         }?>



        </div>



       </div>



       <div class="col-12">

        <div class="card ">

         <div class="card-header ">

          <CENTER>

           <h3 class="card-title ">

            <?= empty($third_tier)? lang('aucun_niveau3'):lang('equipe3')?>

           </h3>

          </CENTER>

         </div>

        </div>

        <div class="row">



         <?php



         if (!empty($third_tier)) {

           $color='';
           $col='';
           $niveau_membre='';
           $niveau_m3='';
          foreach ($third_tier as $value) {  

          if ($value['id_niveau']!=$niveau_actuel) {

                  if ($value['id_niveau']==1) {
                      $col='#C0C0C0';
                    }elseif($value['id_niveau']==2){
                      $col='#614e1a';
                    }elseif($value['id_niveau']==3){
                      $col='#ffd700';
                    }elseif($value['id_niveau']==4){
                      $col='#6977a1';
                    }elseif($value['id_niveau']==5){
                      $col='#cee4e6';
                    }


               $color='style="background-color:'.$col.';"';
               $niveau_membre='<span class="badge float-right" style="background-color:#fff;">'.$value['id_niveau'].'</span>';
               $level3 = $this->Model->readOne('niveau', ['id_niveau'=> $value['id_niveau']]);
                $niveau_m3=$level3['niveau_desc'];
            }else{
              $color='';
              $niveau_membre='<span class="badge float-right" style="background-color:#fff;">'.$niveau_actuel.'</span>';
              $level3 = $this->Model->readOne('niveau', ['id_niveau'=> $niveau_actuel]);
                $niveau_m3=$level3['niveau_desc'];
            }

           $third_source=$this->Model->readRequeteOne("SELECT t.*,m.prenom_membre,m.nom_membre FROM tier1 t JOIN membre m ON m.id_membre=t.id_water_source where t.id_membre_tier1=".$value['id_membre_tier3']."");

           ?>


           <?php
           $image_value='';
           if (!empty($value['photo_membre'])) {
            $image_value=base_url('assets/photo/profile/').$value['photo_membre'];
           }else{
            $image_value=base_url('assets/photo/profile/profile.jpg');
           }

           ?>



           <div class="col-6">

            <div class="card ">

             <div class="card-header " <?=$color?>>

              <h3 class="card-title ">
              <?=$niveau_m3?>
              <?=$niveau_membre?>
              </h3>

             </div>

             <div class="card-body text-center">

              <div class="notif-img"> 

               <center>

                <img class="media-object rounded-circle thumb-sm" alt="<?= $value['prenom_membre']?>" src="<?= $image_value?>" style="width: 65px; height: 65px">

               </center>

              </div>

              <h4 class="h4 mb-0 mt-3">

               <?= $value['prenom_membre'].' '.$value['nom_membre']?>                                               </h4>

               <span style="font-size: 12px">

                <b><?= $value['code_membre']?></b>

               </span>



               <br><br>

               <p class="card-text">

                <?= $value['email_membre']?><br>

                <?= $value['tele_membre']?>

               </p>



               <hr>



               <p><b>Parrain</b><br>

                <?= $third_source['prenom_membre'].' '.$third_source['nom_membre']?>

               </p>

              </div>

              <div class="card-footer text-center">

               <div class="row user-social-detail">

                <div class="col-lg-4 col-sm-4 col-4"></div>

                <div class="col-lg-4 col-sm-4 col-4"></div>

                <div class="col-lg-4 col-sm-4 col-4">

                 <a href="https://api.whatsapp.com/send?phone=<?= $value['tele_membre']?>" target="_blank" class="btn btn-success">

                  <i class="fab fa-whatsapp" aria-hidden="true"></i>

                 </a>

                </div>

               </div>

              </div>

             </div>

            </div>

           <?php  } 

          }?>





         </div>



        </div>

       </div>

      </div><!-- COL-END -->

      <!-- </div> -->











     </div>

     <!-- ROW-1 CLOSED -->

    </div>













    <!-- Footer --> 

    <?php include VIEWPATH.'template/includes/footer.php';?>

    <!-- End Footer --> 