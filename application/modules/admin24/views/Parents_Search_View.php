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
                  <b><?=$page++?>.</b>&nbsp;&nbsp;<b class="text-success">PARENT :</b>
                  <div class="dropdown-divider"></div><br>
                  <b><?=$value['nom_membre'].' '.$value['prenom_membre']?></b><br>
                  <?=$value['email_membre']?><br>
                  <?=$value['tele_membre']?>
                </div>
                <?php 

                $child=$this->Model->readRequete("SELECT DISTINCT(id_membre), m.nom_membre,m.prenom_membre,m.email_membre,m.tele_membre,m.date_insertion FROM membre m JOIN beneficiaire b ON b.id_membre_donateur=m.id_membre WHERE b.id_water_direct=".$value['id_membre']." ORDER BY m.date_insertion ASC") ;
                $i=1;
                foreach ($child as $key) { ?>
                <div class="col-sm-4">
                  <b class="text-success">FIRE N° <?=$i++?>:</b>
                  <div class="dropdown-divider"></div><br>
                  <b><?=$key['nom_membre'].' '.$key['prenom_membre']?></b><br>
                  <?=$key['email_membre']?><br>
                  <?=$key['tele_membre']?>
                </div>
               <?php } ?>
              
              </div>
          </div>
        </div>
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