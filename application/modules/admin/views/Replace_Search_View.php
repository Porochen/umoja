<?php 

if (empty($replace)) { ?>

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
foreach ($replace as $value) { ?>

  <div class="container-fluid">
    <div class="main-body">
      <div class="card">
        <div class="col-md-12">
          <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                  <b class="text-success"><?=$page++?>. </b>
                  <?=$value['nom_membre'].' '.$value['prenom_membre']?>
                </div>
                <div class="col-sm-4  text-secondary">
                  <?=$value['email_membre']?>
                </div>
                <div class="col-sm-2">
                 <?=$value['tele_membre']?>
                </div>
                <div class="col-sm-2">
                 <a href="#" data-toggle="modal" data-target="#replace<?=$value['id_membre']?>" class="f-n-hover btn btn-info btn-raised px-2 py-10 w-20 text-300"><i class="fa fa-edit" aria-hidden="true"></i> </a>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>







  <!-- MESSAGE MODAL -->

    <div class="modal fade" id="replace<?=$value['id_membre']?>" tabindex="-1" role="dialog"  aria-hidden="true">

     <div class="modal-dialog modal-lg" role="document">

      <form method="post" action="" onsubmit="return false" id="form_member<?=$value['id_membre']?>" class="modal-content" enctype="multipart/form-data">

       <div class="modal-header">

        <h5 class="modal-title" id="example-Modal3">

        Voulez-vous remplacer <b class="text-success"> <?=$value['nom_membre'].' '.$value['prenom_membre']?> </b>?

        </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

         <span aria-hidden="true">&times;</span>

        </button>

       </div>
       <div id="message_rps<?=$value['id_membre']?>"></div>
       <div class="modal-body">
        <div class="row">
        <div class="form-group col-md-6">
        <input type="hidden" name="id_membre<?=$value['id_membre']?>" value="<?=$value['id_membre']?>" autocomplete="off" class="form-control">
         <label for="recipient-name" class="form-control-label">Nom:</label>

         <input type="text" name="nom_membre<?=$value['id_membre']?>" autocomplete="off" class="form-control">

        </div>

        <div class="form-group col-md-6">

         <label for="recipient-name" class="form-control-label">Prenom:</label>

         <input type="text" name="prenom_membre<?=$value['id_membre']?>" autocomplete="off" class="form-control">

        </div>

        <div class="form-group col-md-6">

         <label for="recipient-name" class="form-control-label">Email:</label>

         <input type="email" name="email_membre<?=$value['id_membre']?>" onchange="send_mail(<?=$value['id_membre']?>)" autocomplete="off" class="form-control">

         <div id="loadCODE"></div>

        </div>
        <div class="form-group col-md-6" >

         <label for="recipient-name" class="form-control-label">Tél:</label>

         <input type="text" name="tele_membre<?=$value['id_membre']?>" autocomplete="off" class="form-control">

        </div>

        <div class="col-md-12" id="message_code<?=$value['id_membre']?>"></div>

        <div class="form-group col-md-6" >

         <label for="recipient-name" class="form-control-label">Motif de ce remplacement:</label>

         <textarea name="motif<?=$value['id_membre']?>" autocomplete="off" class="form-control"></textarea>

        </div>
        <div class="form-group col-md-6" >

         <label for="recipient-name" class="form-control-label">Preuve de ce remplacement:</label>

         <input type="file" id="PHOTO<?=$value['id_membre']?>" name="PHOTO<?=$value['id_membre']?>" autocomplete="off" class="form-control">

        </div>

        <div class="form-group col-md-6">

         <label for="recipient-name" class="form-control-label">Code de Verification:</label>

         <input type="text" name="code<?=$value['id_membre']?>" autocomplete="off" class="form-control">

        </div>

       </div>
       </div>
       <div class="modal-footer">

        <button type="submit" onclick="new_fire(<?=$value['id_membre']?>)" class="btn btn-primary">

         Enregistrer

        </button>

       </div>

      </form>

     </div>

    </div>


<?php } } ?>

<div class="container mt-3 mb-3">
  <div class="row float-right">
  <div class="col-md-12" id="pagination"><?=$pagination?></div>
  </div>
</div>