<?php 

if (empty($sent)) { ?>

  
            <div class="card">
              <div class="card-body p-6 mt-4">
                <div class="inbox-body">
                  <div class="table-responsive">
                    <table class="table table-inbox table-hover text-nowrap">
                      <tbody>

                                                <tr>
                          <td colspan="4">
                            <center>
                              <h4>NO MESSAGE IN THE INBOX</h4>
                            </center>
                          </td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
<?php }else{

foreach ($sent as $value) { ?>

  <div class="container-fluid">
    <div class="main-body">
      <div class="card">
        <div class="col-md-12">
          <?php

            if ($value['id_member_rec']!=NULL) {
              $recev=$this->Model->readRequeteOne("SELECT m.nom_membre,m.prenom_membre,m.email_membre FROM membre m  WHERE m.id_membre=".$value['id_member_rec']);
                $nom=$recev['nom_membre'];
                $prenom=$recev['prenom_membre'];
            }else{
                $nom="Tous";
                $prenom="les membres";
            }
               
                 ?>
          <div class="card-body">
            <span class="text-secondary"><?=$value['subject']?></span><div class="dropdown-divider"></div>
            <div class="row">
              <?php 
                 $read_by= $value['read_by'];
                 $array=explode(',', $read_by);

                 $class="";
                  $nbr=0;
                 
                  if ($value['id_member_rec']==NULL) {
                    $nbr=sizeof($array)-1;
                  }else{
                     if (in_array($value['id_member_rec'],$array)) {
                   $class="text-success";
                  }else{
                    $class="text-danger";
                  }
                }
                
                 

                   ?>
              <div class="col-sm-2">
                  <i class="fa fa-share" aria-hidden="true"></i><button class="btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="<?=$nom.' '.$prenom?>">
                <i class="fa fa-user" style="font-size:35px"></i>
              </button>
                  <br>
                  <?=$prenom?>
                </div>
                <div class="col-sm-7">
                  <?php if($value['id_member_rec']==NULL){ ?>
                      <?=  $nbr ?>
                  <?php }else{ ?>
                  <i class="fas fa-check-double <?=$class?>" style="font-size: 15px"></i>
                <?php } ?>
                  <b class="ml-3"><?=$value['message']?></b>
                </div>
                <div class="col-sm-3  text-primary">
                  <?=$value['date_insertion']?>
                </div>
               
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php } } ?>

<script type="text/javascript">
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
