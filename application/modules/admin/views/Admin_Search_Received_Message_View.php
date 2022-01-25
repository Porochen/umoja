<?php 

if (empty($received)) { ?>

  
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

foreach ($received as $value) { ?>

  <div class="container-fluid">
    <div class="main-body">
      <div class="card">
        <div class="col-md-12">
          <div class="card-body">
            <?php
                $sender=$this->Model->readRequeteOne("SELECT m.nom_membre,m.prenom_membre,m.email_membre FROM membre m  WHERE m.id_membre=".$value['id_member_sender']."");
                 ?>
            <span class="text-secondary"><?=$value['subject']?></span><div class="dropdown-divider"></div>
            <div class="row">
                <div class="col-sm-2">
                  <button class="btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="<?=$sender['prenom_membre'].' '.$sender['prenom_membre']?>">
                <i class="fa fa-user" style="font-size:35px"></i>
              </button>
                  <br>
                  <?=$sender['prenom_membre']?>
                </div>
                <div class="col-sm-5">
                  <?=$value['message']?>
                </div>
                <div class="col-sm-3  text-primary">
                  <?=$value['date_insertion']?>
                </div>
                <div class="col-sm-2  text-primary">
                  <div class="dropdown">
                              <span class="dropdown-toggle dropdown-bg btn" role="button" id="dropdownMenuButton5"
                                 data-toggle="dropdown" aria-expanded="false">
                              Action
                              </span>
                              <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton5"
                                 >
                                 <a class="dropdown-item" href="<?=base_url('admin/Admin_Support/reply/').$value['id_member_sender']."/".$value['id_notification']?>"><i class="ri-pencil-fill mr-2"></i>Reply</a>
                              </div>
                           </div>
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
