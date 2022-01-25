<?php 

if (empty($parent)) { ?>

  <div class="container-fluid">
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

<?php }else{

$page=($page*15)-15+1;
foreach ($parent as $value) { ?>

  <div class="container-fluid">
    <div class="table-responsive">
    <div class="main-body">
      <div class="card">
        <div class="col-md-12">
          <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                  <b class="text-success"><?=$page++?>.&nbsp;&nbsp;MEMBRE REMPLACE :</b>
                  <div class="dropdown-divider"></div>
                  <b><?=$value['nom_membre'].' '.$value['prenom_membre']?></b><br>
                  <?=$value['email_membre']?><br>
                  <?=$value['tele_membre']?>
                </div>
                <?php
                
                $repl=$this->Model->readRequeteOne("SELECT m.nom_membre,m.prenom_membre,m.email_membre,m.tele_membre,m.date_insertion FROM membre m WHERE m.id_membre=".$value['id_mbr_rep']." ORDER BY m.date_insertion ASC") ;

                $admin=$this->Model->readRequeteOne("SELECT * FROM admin WHERE id_admin=".$value['id_admin']) ;
                 ?>
                <div class="col-sm-4">
                  <b class="text-success">LE REMPLACANT :</b>
                  <div class="dropdown-divider"></div>
                  <b><?=$repl['nom_membre'].' '.$repl['prenom_membre']?></b><br>
                  <?=$repl['email_membre']?><br>
                  <?=$repl['tele_membre']?>
                </div>
                 <div class="col-sm-2">
                  <b class="text-success">FAIT PAR :</b>
                  <div class="dropdown-divider"></div>
                  <b><?=$admin['nom_admin'].' '.$admin['prenom_admin']?></b><br>
                  <?=$value['date_insertion']?>
                </div>
               
              <div class="col-sm-2">
                  <b class="text-success">JUSTIFICATION :</b>
                  <div class="dropdown-divider"></div><br>
                 <a href="#" data-toggle="modal"  data-target="#view<?=$value['id_membre_remplace']?>" class="btn btn-success" ><i class="fa fa-eye" aria-hidden="true"></i> Preuve </a>
                </div>
              </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>




<div id="view<?=$value['id_membre_remplace']?>" class="modal fade">
 <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content ">
   <div class="modal-header pd-x-20">
    <h6 class="modal-title">Preuve de remplacement</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
   </div>
   <div class="modal-body pd-20" >
    <center>
     <embed  src="<?= base_url('assets/photo/proof_replace/').$value['preuve']?>" alt="Preuve" width="100%" height="400px"/>
     
    </center>
    <textarea class="form-control" readonly=""><?=$value['motif']?></textarea>
   </div>
  </div>
 </div>
</div>

<?php } }  ?>

<div class="container mt-3 mb-3">
  <div class="row float-right">
  <div class="col-md-12 " id="pagination"><?=$pagination?></div>
  </div>
</div>