<?php 

if (empty($user)) { ?>

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
foreach ($user as $value) { ?>

  <div class="container-fluid">
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
              <a href="#" data-toggle="modal" data-target="#modif<?=$value['id_membre']?>" class="f-n-hover btn btn-info btn-raised px-2 py-10 w-20 text-300"><i class="fa fa-edit" aria-hidden="true"></i> </a>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- MESSAGE MODAL -->

    <div class="modal fade" id="modif<?=$value['id_membre']?>" tabindex="-1" role="dialog"  aria-hidden="true">

     <div class="modal-dialog" role="document">

      <form method="post" action="<?=base_url('admin/Users/updateData/').$value['id_membre']?>"  class="modal-content" enctype="multipart/form-data">

       <div class="modal-header">

        <h5 class="modal-title" id="example-Modal3">

       <b> Modification  </b>

        </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

         <span aria-hidden="true">&times;</span>

        </button>

       </div>

       <div class="modal-body">

        <div class="form-group">
        <input type="hidden" name="id_membre<?=$value['id_membre']?>" value="<?=$value['id_membre']?>" autocomplete="off" class="form-control">
         <label for="recipient-name" class="form-control-label">Nom:</label>

         <input type="text"  required="required" name="nom_membre"  autocomplete="off" class="form-control" value="<?=$value['nom_membre']?>" >

        </div>

        <div class="form-group">

         <label for="recipient-name" class="form-control-label">Prenom:</label>

         <input type="text"  required="required" name="prenom_membre" autocomplete="off" class="form-control" value="<?=$value['prenom_membre']?>">

        </div>





        <div class="form-group">

         <label for="recipient-name" class="form-control-label">Email:</label>

         <input type="email" required="required" name="email_membre"  autocomplete="off" class="form-control"  value="<?=$value['email_membre']?>">

  

        </div>

      

        <div class="form-group">

         <label for="recipient-name" class="form-control-label">Tél:</label>

         <input type="tel" required="required" name="tele_membre" autocomplete="off" class="form-control" value="<?=$value['tele_membre']?>">

        </div>

     

       </div>

       <div class="modal-footer">

        <button type="submit" class="btn btn-primary">

         Modifier

        </button>

       </div>

      </form>

     </div>

    </div>

<?php } } ?>

<div class="container mt-3 mb-3">
  <div class="row float-right">
  <div class="col-md-12 " id="pagination"><?=$pagination?></div>
  </div>
</div>