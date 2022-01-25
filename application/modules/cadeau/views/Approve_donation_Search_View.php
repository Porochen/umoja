<?php 

if (empty($appr)) { ?>
<div class="alert alert-info col-md-12"><h6 class="text-center">Aucune donnée disponible dans la table ! </h6></div>

<?php }else{

$page=($page*5)-5+1;
foreach ($appr as $value) { ?>

  <div class="container-fluid">
    <div class="table-responsive">
    <div class="main-body">
      <div class="card">
        <div class="col-md-12">
          <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                  <b class="text-success"><?=$page++?>. </b><?=$value['nom_membre'].' '.$value['prenom_membre']?>
                </div>
                <div class="col-sm-4">
                  <?=$value['email_membre']?>
                </div>
                <div class="col-sm-2">
                  <?=$value['tele_membre']?>
                </div> 
                
                <div class="col-sm-2">
                  <a href="#" data-toggle="modal"  data-target="#preuve<?=$value['id_donation']?>" class="btn btn-info btn-sm" title="Preuve"><i class="fa fa-eye" style="font-size:20px"></i></a>
                   <a href="#" data-toggle="modal"  data-target="#desact<?=$value['id_donation']?>" class="btn btn-primary btn-sm" title="Approuver"><i class="fa fa-check"></i></a>
                </div>             
              </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>


<div id="desact<?=$value['id_donation']?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Valider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="signup-form">
          <form id="admin"  method="post" action="<?= base_url('cadeau/Donation/approuver/')?>" autocomplete="off">
               <h5>Voulez-vous approuver les frais payé par :<b class="text-success"> <?=$value['nom_membre'].' '.$value['prenom_membre']?></b></h5>
               <hr>  
               <input type="hidden" name="id_membre" value="<?=$value['id_membre']?>">
               <input type="hidden" name="id_donation" value="<?=$value['id_donation']?>"> 
            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-primary mt-4 mt-sm-0 btn-icon-text float-right" >
                  Approuver </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



<div id="preuve<?=$value['id_donation']?>" class="modal fade">
 <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content ">
   <div class="modal-header pd-x-20">
    <h6 class="modal-title">PREUVE DE PAIEMENT</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
   </div>
   <div class="modal-body pd-20" >
    <center>
     <embed  src="<?= base_url('assets/photo/proof_donation/').$value['proof_donation']?>" alt="Preuve" width="100%" height="400px"/>
     
    </center>
   </div>
  </div>
 </div>
</div>
<?php } }  ?>

<div class="container mt-3 mb-3">
  <div class="row float-right">
  <div class="col-md-12" id="pagination"><?=$pagination?></div>
  </div>
</div>


