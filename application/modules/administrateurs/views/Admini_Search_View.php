<?php 

if (empty($Admini)) { ?>
<div class="alert alert-info col-md-12"><h6 class="text-center">Aucune donnée disponible dans la table ! </h6></div>

<?php }else{

$page=($page*5)-5+1;
foreach ($Admini as $value) { ?>

  <div class="container-fluid">
    <div class="table-responsive">
    <div class="main-body">
      <div class="card">
        <div class="col-md-12">
          <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                  <b class="text-success"><?=$page++?>. </b><?=$value['nom_admin'].' '.$value['prenom_admin']?>
                </div>
                <div class="col-sm-3">
                  <?=$value['email_admin']?>
                </div>
                <div class="col-sm-2">
                  <?=$value['phone_admin']?>
                </div> 
                <div class="col-sm-1">
                  <?php if ($value['statut_user']==1) {
                    $titre="désactiver";
                    $bottom="Désactiver";
                    $class='<i class="fa fa-ban"></i>';
                    $color="btn btn-danger";
                    echo '<i class="fa fa-check text-success" style="font-size:24px" title="Activé"></i>';
                  }else{
                    $titre="activer";
                    $bottom="Activer";
                    $class='<i class="fa fa-check"></i>';
                    $color="btn btn-success";
                    echo '<i class="fa fa-times text-danger" style="font-size:24px" title="Désactivé"></i>';
                  }
                  ?>
                  
                </div>
                <div class="col-sm-2">
                   <a href="<?= base_url('administrateurs/Administrateurs/getOne/').$value['id_admin']?>" class="btn btn-primary btn-sm" title="Editer"><i class="fa fa-edit"></i></a>
                   <a href="#" data-toggle="modal"  data-target="#desact<?=$value['id_admin']?>" class="<?=$color?> btn-sm" title="<?=$bottom?>"><?=$class?></a>
                </div>             
              </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>


<div id="desact<?=$value['id_admin']?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?=$bottom?> un administrateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="signup-form">
          <form id="admin_del"  method="post" action="<?= base_url('administrateurs/Administrateurs/desactiver/').$value['id_admin']?>" autocomplete="off">
               <h5>Voulez-vous <?=$titre?> :<b class="text-success"> <?=$value['nom_admin'].' '.$value['prenom_admin']?></b></h5>
               <hr>   
            <div class="form-group col-md-12">
              <button type="submit" class="<?=$color?> mt-4 mt-sm-0 btn-icon-text float-right" >
                  <?=$bottom?> </button>
            </div>
          </form>
        </div>
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