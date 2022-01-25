<?php 

if (empty($fires)) { ?>

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

  $i=1;

foreach ($fires as $value) { ?>

  <div class="container-fluid">
    <div class="table-responsive">
    <div class="main-body">
      <div class="card">
        <div class="col-md-12">
          <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                  <b class="text-success">FIRE N° <?=$i++?>:</b>
                  <div class="dropdown-divider"></div><br>
                  <b><?=$value['nom_membre'].' '.$value['prenom_membre']?></b><br>
                  <?=$value['email_membre']?><br>
                  <?=$value['tele_membre']?>
                </div>
                <?php
                $benef=$this->Model->readRequeteOne("SELECT m.nom_membre,m.prenom_membre,m.email_membre,m.tele_membre,b.id_membre_beneficiaire,b.id_beneficiaire,b.id_water_source FROM beneficiaire b LEFT JOIN membre m ON m.id_membre=b.id_membre_beneficiaire WHERE b.id_membre_donateur=".$value['id_membre']."");

                if (!empty($benef)) {
                 

                if ($benef['id_membre_beneficiaire']!=0) { ?>

                <div class="col-sm-5">
                  <b class="text-success">BENEFICIAIRE:</b>
                  <div class="dropdown-divider"></div><br>
                 <b><?=$benef['nom_membre']." ".$benef['prenom_membre']?></b><br>
                 <?=$benef['email_membre']?><br>
                 <?=$benef['tele_membre']?>
                </div>
                 
                <?php  }else{   ?>

                  <div class="col-sm-5">
                  <b class="text-success">BENEFICIAIRE:</b>
                  <div class="dropdown-divider"></div><br>
                  <b>Système umoja</b><br>
                  admin@gmail.com<br>
                  4448977654
                </div>

              <?php  }   

                }else{   ?>

                  <div class="col-sm-5">
                  <b class="text-success">BENEFICIAIRE:</b>
                  <div class="dropdown-divider"></div><br>
                  <b>Système umoja</b><br>
                  admin@gmail.com<br>
                  4448977654
                </div>

              <?php  }  
                ?>
                

                <div class="col-sm-1">
                 <a href="#" data-toggle="modal"  data-target="#change<?=$value['id_membre']?>" class="f-n-hover btn btn-info btn-raised px-2 py-10 w-20 text-300"><i class="fa fa-edit" aria-hidden="true" title="Changer le bénéficiaire"></i> </a>
                </div>
              </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>



  <div id="change<?=$value['id_membre']?>" class="modal animated fadeInRight custo-fadeInRight" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Changement de beneficiaire</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="signup-form">
          <form action="<?=base_url('admin/Waters/change_beneficiaire')?>" method="post" autocomplete="off">
            <input type="hidden" name="id_beneficiaire" value="<?=$benef['id_beneficiaire']?>">
            <div class="form-group">
              <div class="row">
                <input type="hidden" value="<?=$benef['id_water_source']?>" name="id_water_source" class="form-control">
                <div class="col-md-12 form-group">
                  <label>Veuillez choisir le bénéficiaire</label>
                  <select class="form-control" name="id_membre_beneficiaire">
                    <option>--Select--</option>
                    <?php foreach ($beneficiaire as $key ) { 
                      if ($key['id_membre_beneficiaire']!=0) {
                        ?>

                        <option value="<?=$key['id_membre_beneficiaire']?>" <?php if ($key['id_membre_beneficiaire']==$benef['id_membre_beneficiaire']) echo "selected"?> ><?=$key['nom_membre'].' '.$key['prenom_membre']?></option>
                        

                    <?php  }else{
                      ?>
                     <option value="<?=$key['id_membre_beneficiaire']?>" <?php if ($key['id_membre_beneficiaire']==$benef['id_membre_beneficiaire']) echo "selected"?> >Umoja Système</option>
                    <?php } } ?>
                    
                  </select>
                </div>
              </div>          
            </div>   
            <div class="form-group col-md-12">
              <button type="submit"  class="btn btn-danger btn-lg btn-block">Changer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php } }  ?>