<?php include VIEWPATH.'template/includes/header.php';?>
<!-- Sidebar -->
<?php include VIEWPATH.'template/includes/sidebar_menu.php';?>
<!-- End Sidebar -->

<div class="main-panel">
 <div class="container">

  <div class="panel-header bg-primary-gradient">
   <div class="page-inner py-3">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
     <div>
      <h2 class="text-white pb-2 fw-bold">
       <?=lang('semence')?>
      </h2>
     </div>
     <div class="ml-md-auto py-2 py-md-0">
      <!-- PAGE-HEADER -->
      <div class="page-header">
       <ol class="breadcrumb">
        <li class="breadcrumb-item">
         <a href="#"> <?=lang('acceuil')?></a>
        </li>
        <li class="breadcrumb-item">
         <a href="#"><?=lang('semence')?></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
         <?=lang('list')?>
        </li>
       </ol>
      </div>
      <!-- PAGE-HEADER END -->
     </div>
    </div>
   </div>
  </div>



      <div>
          <?php if(!empty($this->session->flashdata('sms'))){   
            echo $this->session->flashdata('sms'); } 
         ?>
      </div>

  <div class="page-inner mt--5">


   <div class="row row-cards">
    <div class="col-lg-12 col-xl-12">
     <div class="row">
      <?php 
        if (!empty($water_beneficiaire)) {

            if ($this->session->userdata('id_member')<=2048) {
               $i=2;
            }else{
                $i=1;
            }
            
           foreach($water_beneficiaire as $value) {

            $prooof=$this->Model->readRequeteOne("SELECT p.id_proof_paiement, p.statut,p.image_proof,p.id_membre_donateur FROM  proof_paiement p WHERE p.id_membre_donateur=".$value['id_membre_donateur']." AND  p.niveau_membre_donateur=".$i);
  
            $montant=$this->Model->readOne('niveau',['id_niveau'=>$i]);
            if (empty($prooof)) {
               $statu=lang('echeance'); 
               $buton=lang('telecharger_preuve');
               $idmodal="#DQX4567HN_1A";
               $id_id=$value['id_beneficiaire'];
            }else{

            if ($prooof['statut']==NULL) 

            {
               $statu=lang('echeance'); 
               $buton=lang('telecharger_preuve');
               $idmodal="#DQX4567HN_1A";
               $id_id=$value['id_beneficiaire'];

            }else{

               if($prooof['statut']==1)

               {
                 $statu=lang('recu');
                 $buton=lang('preuve');
                 $idmodal="#DQX4567HN_2";
                 $id_id=$prooof['id_proof_paiement'];

               }elseif($prooof['statut']==0)

               {
                    $statu="PAYABLE";
                    $buton=lang('preuve');
                    $idmodal="#DQX4567HN_2";
                    $id_id=$prooof['id_proof_paiement'];

                     

               }

            }

            }

      ?>

      <div class="col-lg-4 col-sm-12 p-l-0 p-r-0 col-md-12">

       <div class="card">

        <div class="card-header text-center success">

         <h4 class="card-title" >

          $ <?= $montant['cout_gift']?>.00 - <?=$statu?>

         </b>

        </div>

        <div class="card-body">

         <?php
        $img = '';

        if (!empty($value['photo_membre'])) { 

         $img=base_url('assets/photo/Profile/').$value['photo_membre'];
         $nom=$value['nom_membre'];
        }else{ 
         $img=base_url('assets/photo/profile/profile.jpg');
         $nom='No Image';
        }  

        ?>
         <center>
          <img class="media-object rounded-circle thumb-sm" alt="<?=$nom?>" src="<?= $img ?>" style="width: 65px; height: 65px">
        </center>

         <div class="text-center mt-3">

          <h5>
            <?php 

            $nom_prenom='';
            $email='';
            $phone='';
            if ($value['id_membre']==NULL && $value['nom_membre']==NULL && $value['prenom_membre']==NULL && $value['id_membre_beneficiaire']==0) {
                
                $nom_prenom=lang('compte_bancaire');
                $email=lang('numero_compte');
                $phone=$compte_bancaire;

            }else{

                $nom_prenom=$value['nom_membre'].' '.$value['prenom_membre'];
                $email=$value['email_membre'];
                $phone=$value['tele_membre'];
            }
            ?>
           <?= $nom_prenom ?>

          </h5>

          <p class="mb-4">

           <?= $email?><br>

           <?= $phone?>

          </p>

        <div class="card-footer">
         <div class="col p-1 mt-2">
          <center><div>
           <button type="button" class="btn btn-primary btn-sm d-block" data-toggle="modal" data-target="<?=$idmodal.$id_id?>"><?=$buton?></button>
          </div></center>
         </div>
        </div>

         </div>

        </div>

       </div>

      </div>






 <div id="DQX4567HN_2" class="modal fade">
 <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content ">
   <div class="modal-header pd-x-20">
    <h6 class="modal-title"><?=lang('preuve_payement')?></h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
   </div>
   <div class="modal-body pd-20" >
    <center>
     <embed  src="<?= base_url('assets/photo/proof_paiement/').$prooof['image_proof']?>" alt="Preuve" width="100%" height="400px"/>
     
    </center>
   </div>
  </div>
 </div>
</div>




<div id="DQX4567HN_1A<?= $value['id_beneficiaire']?>" class="modal fade">
 <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content ">
   <div class="modal-header pd-x-20">
    <h6 class="modal-title"><?=lang('preuve_payement')?></h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
   </div>
   <div class="modal-body pd-20">
    <form method="post" action="<?= base_url('cadeau/Graine/upload_proof')?>" enctype="multipart/form-data">
        <input type="hidden" name="niveau_chargement" value="<?=$i?>">
     <div class="form-group">
      <label class="form-label"><?=lang('paiement_cadeau')?></label>
      <select name="preferred" class="form-control" required>
       <option value="" selected><?=lang('choisir_option')?></option>
       <?php  foreach ($mode_paiement as $key) { ?>
        <option value="<?=$key['id_mode_paiement']?>" ><?=$key['description_mode']?></option>

      <?php  } ?>
      </select>
     </div>
     <div class="form-group">
      <label class="form-label"><?=lang('detail_cadeau')?></label>
      <textarea class="form-control" name="details" required rows="3"></textarea>
     </div>
     <div class="form-group">
      <label class="form-label"><?=lang('preuve_payement')?></label>
      <input type="file" class="form-control" required name="proof">
     </div>

     <div class="form-footer">
      <button type="submit" class="btn btn-primary btn-block"><?=lang('enregistrer')?></button>
     </div>
    </form>
   </div>
  </div>
 </div>
</div>


 <?php   $i++;   

    }    
    
    }else{  ?>

<div class="container-fluid mt-4">
    <div class="main-body">
      <div class="card">
        <div class="col-md-12">
          <div class="card-body">
            <div class="row">
                 <div class="alert alert- col-md-12"><h6 class="text-center">Aucune donnée disponible dans la table ! </h6></div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>


 <?php  } ?>





     </div>
    </div>
   </div>
  </div>
 </div>

</div>



<!-- Footer -->	
<?php include VIEWPATH.'template/includes/footer.php';?>
<!-- End Footer -->	






