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
          <div class="card-body">
            <span class="text-secondary"><?=$value['subject']?></span><div class="dropdown-divider"></div>
            <div class="row">
              <?php 
                    $statut="";
                  if ($value['statut_sms']==0) {
                    $class="text-danger";
                  }else{
                        $class="text-success";
                  } ?>
                <div class="col-sm-8">
                  <i class="fas fa-check-double <?=$class?>" style="font-size: 15px"></i><b class="ml-3"><?=$value['message']?></b>
                </div>
                <div class="col-sm-4  text-primary">
                  <?=$value['date_insertion']?>
                </div>
               
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php } } ?>