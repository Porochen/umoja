<?php 

if (empty($waters)) { ?>

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
foreach ($waters as $value) { ?>

  <div class="container-fluid">
    <div class="table-responsive">
    <div class="main-body">
      <div class="card">
        <div class="col-md-12">
          <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                 <b><?=$page++?>.</b>&nbsp;&nbsp; <?=$value['nom_membre'].' '.$value['prenom_membre']?>
                </div>
                <div class="col-sm-4  text-secondary">
                  <?=$value['email_membre']?>
                </div>
                <div class="col-sm-2">
                 <?=$value['tele_membre']?>
                </div>
                <div class="col-sm-2">
                 <a href="<?=base_url('admin/Waters/index2/').$value['id_membre']?>" class="f-n-hover btn btn-info btn-raised px-2 py-10 w-20 text-300" title="Voir ses fires"><i class="fa fa-eye" aria-hidden="true"></i> </a>
                </div>
              </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>

<?php } } ?>


<div class="container mt-3 mb-3">
  <div class="row float-right">
  <div class="col-md-12 " id="pagination"><?=$pagination?></div>
  </div>
</div>