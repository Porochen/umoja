<?php 

if (empty($code)) { ?>

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
foreach ($code as $value) { ?>

  <div class="container-fluid">
    <div class="main-body">
      <div class="card">
        <div class="col-md-12">
          <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                  <b><?=$page++?>.</b>&nbsp;&nbsp; <?=$value['email']?>
                </div>
                <div class="col-sm-3  text-secondary">
                  <?=$value['code_verification']?>
                </div>
                <div class="col-sm-4">
                 <?=$value['date_insertion']?>
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