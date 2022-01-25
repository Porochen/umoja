<?php include VIEWPATH.'template/includes/header.php';?>

    <!-- Sidebar -->

<?php include VIEWPATH.'template/includes/sidebar_menu.php';?>

    <!-- End Sidebar -->



    <div class="main-panel">

      <div class="container">









        <div class="panel-header bg-primary-gradient">

          <div class="page-inner py-5">

            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">

              <div>

                <h2 class="text-white pb-2 fw-bold"><?=lang('dashbord')?></h2>

              </div>

              <div class="ml-md-auto py-2 py-md-0">

              <!-- PAGE-HEADER -->

              <div class="page-header">

                <ol class="breadcrumb">

                  <li class="breadcrumb-item">

                    <a href="#"><?=lang('acceuil')?></a>

                  </li>

                  <li class="breadcrumb-item active" aria-current="page">

                    <?=lang('dashbord')?>

                  </li>

                </ol>

              </div>

                            <!-- PAGE-HEADER END -->

              </div>

            </div>

          </div>

        </div>







        <div class="page-inner mt--5">

          <div class="row mt--2 ">

            <div class="col-md-9">



              <div class="row">



              <div class="col-md-4 col-xl-4">

                <div class="card overflow-hidden">

                  <div class="card-body">

                    <div class="row">

                      <div class="col-7 col-md-6">

                        <h2 class="mb-1 number-font display-4 font-weight-bold text-dark">

                          <?PHP 

                          $id= $this->session->userdata('memberid');

                          echo $niveau1;

                          ?> 

                        </h2>

                      </div>

                      <div class="col-5 col-md-6">

                        <h6 class="mb-0"><?=lang('niveau1')?></h6>



                        <div class="px-2 pb-2 pb-md-0 text-center">

                      <div id="circles-2"></div>

                    </div>

                        <!-- <div class="chart-wrapper chart-back">

                          <canvas id="bouncerate" class=""></canvas>

                        </div> -->

                      </div>

                      <p class="mb-0 text-muted text-center">

                          <span class="mb-0 text-success fs-13 ">
                            <?=lang('membres_niveau1')?>

                          </span>

                        </p>

                    </div>

                  </div>

                </div>

              </div>

             <div class="col-md-4 col-xl-4">

                <div class="card overflow-hidden">

                  <div class="card-body">

                    <div class="row">

                      <div class="col-7 col-md-6">

                        <h2 class="mb-1 number-font display-4 font-weight-bold text-dark">

                         <?= $niveau2;?>                  

                         </h2>

                       

                      </div>

                      <div class="col-5 col-md-6">

                        <h6 class="mb-0"><?=lang('niveau2')?></h6>



                        <div class="px-2 pb-2 pb-md-0 text-center">

                      <div id="circles-3"></div>

                    </div>

                        <!-- <div class="chart-wrapper chart-back">

                          <canvas id="bouncerate" class=""></canvas>

                        </div> -->

                      </div>

                       <p class="mb-0 text-muted text-center">

                          <span class="mb-0 text-success fs-13 ">

                            <?=lang('membres_niveau2')?>

                          </span>

                        </p>

                    </div>

                  </div>

                </div>

              </div> 

              <div class="col-md-4 col-xl-4">

                <div class="card overflow-hidden">

                  <div class="card-body">

                    <div class="row">

                      <div class="col-7 col-md-6">

                        <h2 class="mb-1 number-font display-4 font-weight-bold text-dark">

                         <?=$niveau3;?>                       

                        </h2>

                        

                      </div>

                      <div class="col-5 col-md-6">

                        <h6 class="mb-0"><?=lang('niveau3')?></h6>



                        <div class="px-2 pb-2 pb-md-0 text-center">

                      <div id="circles-4"></div>

                    </div>

                      </div>

                       <p class="mb-0 text-muted text-center">

                          <span class="mb-0 text-success fs-13 ">

                            <?=lang('membres_niveau3')?>

                          </span>

                        </p>

                    </div>

                  </div>

                </div>

              </div>

              </div>



               <div class="row">

              <div class="col-sm-12 col-lg-12 col-xl-12">

                <div class="card">

                  <div class="card-body">

                    <h3 class="mb-1"><?=lang('analyse_de_reseau')?></h3>

                    <p class="text-muted mb-5"><?=lang('reseau_et_sante')?></p>

                    <div class="row mt-4">



                      <div class="col-md-4 dash-1">

                        <h6 class="mb-1"><span class="dot-label bg-primary"></span><?=lang('niveau1')?></h6>

                        <h2 class="mb-1">

                        <?=($niveau1*100)/2;

                         ?>%</h2>

                        <span class=" mb-0 text-muted">

                        <b><?= $niveau1;?></b>/2 <?=lang('membres')?></span>

                      </div>



                      <div class="col-md-4 dash-1">

                        <h6 class="mb-1"><span class="dot-label bg-secondary"></span><?=lang('niveau2')?></h6>

                        <h2 class="mb-1"><?=($niveau2*100)/4;?>%</h2>

                        <span class=" mb-0 text-muted">

                          <b><?= $niveau2;?></b>/4 <?=lang('membres')?></span>

                      </div>



                      <div class="col-md-4">

                        <h6 class="mb-1"><span class="dot-label bg-danger"></span><?=lang('niveau3')?></h6>

                        <h2 class="mb-1"><?=($niveau3*100)/8;?>%</h2>

                        <span class=" mb-0 text-muted">

                          <b><?= $niveau3;?></b>/8 <?=lang('membres')?></span>

                      </div>

                    </div>

                    <div class="progress progress-md mt-5">

                      <div class="<?php echo $data_bar1;?>"></div>

                      <div class="<?php echo $data_bar2;?>"></div>

                      <div class="<?php echo $data_bar3;?>"></div>

                    </div>

                  </div>

                </div>

                </div>

              </div>  



            </div>

            <div class="col-md-3">

              <div class="row">



                      <div class="col-md-12">

            <div class="card">

              <div class="card-header">

                <div class="card-title"><?=lang('rapport_statutaire')?></div>

              </div>

              <div class="card-body">



                

                <div class="mb-2">

                  <p class="mb-0"><?=lang('verification_de_compte')?><span class="float-right font-weight-semibold">

                    <?=$verification;

                    ?> 

                   %



                  </span></p>

                  <div class="progress  progress-xs">

                    <div class="<?php echo $data_veri ;?>" role="progressbar"></div>

                  </div>

                </div>



                

                <div class="mb-2">

                  <p class="mb-0"><?=lang('methode_de_paiement_prefere')?><span class="float-right font-weight-semibold">

                    <?=$payement?>%</span></p>

                  <div class="progress  progress-xs">

                    <div class="<?=$data_payement?>" role="progressbar"></div>

                  </div>

                </div>



                

                <div class="mb-2">

                  <p class="mb-0"><?=lang('semence')?><span class="float-right font-weight-semibold">

                    <?=$graine;

                   ?>%</span></p>

                  <div class="progress  progress-xs">

                    <div class="<?php echo $data_graine;?>" role="progressbar"></div>

                  </div>

                </div>



                

                <div class="mb-2">

                  <p class="mb-0"><?=lang('recolter')?><span class="float-right font-weight-semibold">

                    <?=($recolte*100)/8;?>%</span></p>

                  <div class="progress  progress-xs">

                    <div class="<?=$data_recolte;

                   ?>" role="progressbar"></div>

                  </div>

                </div>



                

                <div class="mb-2">

                  <p class="mb-0"><?=lang('donation')?><span class="float-right font-weight-semibold">

                    <?=$don;?>%</span></p>

                  <div class="progress  progress-xs">

                    <div class="<?=$data_don;?>" role="progressbar"></div>

                  </div>

                </div>



                <div class="mb-2">

                  <p class="mb-0"><?=lang('niveau1')?><span class="float-right font-weight-semibold">

                    <?=($niveau1*100)/2;?>%</span></p>

                  <div class="progress  progress-xs">

                    <div class="<?php echo $data_bar1;?>" role="progressbar"></div>

                  </div>

                </div>



                <div class="mb-2">

                  <p class="mb-0"><?=lang('niveau2')?><span class="float-right font-weight-semibold">

                    <?=($niveau2*100)/4;?>%</span></p>

                  <div class="progress  progress-xs">

                    <div class="<?php echo $data_bar2;?>" role="progressbar"></div>

                  </div>

                </div>



                <div class="mb-2">

                  <p class="mb-0"><?=lang('niveau3')?><span class="float-right font-weight-semibold">

                   <?=($niveau3*100)/8; ?>%</span></p>

                  <div class="progress  progress-xs">

                    <div class="<?php echo $data_bar3;?>" role="progressbar"></div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        <!-- ROW-1 CLOSED -->

  

              </div>

            </div>



          </div>





          <!-- ROW-2 OPEN -->

        <div class="row">

          <div class="col-md-12">

            <div class="card">

              <div class="row">



                <div class="col-xl-4 col-lg-6 col-sm-6 pr-0 pl-0 border-right">

                  <div class="card-body text-center">

                    <h6 class="mb-0"><?=lang('lot_complet')?></h6>

                    <?php

                      $id_niveau= $this->session->userdata('id_niveau');
                      $lot=0;
                      $received=0;
                      if ($id_niveau==1) {
                        $lot=50*8;
                        $received=$recu*50;
                      }elseif($id_niveau==2)
                      {
                         $lot=150*8;
                         $received=$recu*150;
                      }elseif($id_niveau==3)
                      {
                         $lot=500*8;
                         $received=$recu*500;
                      }elseif($id_niveau==4)
                      {
                         $lot=1000*8;
                         $received=$recu*1000;
                      }elseif ($id_niveau==5) {
                        $lot=2000*8;
                        $received=$recu*2000;
                      }

                    ?>

                    <h2 class="mb-1 mt-2">$ <?=$lot?></h2>

                    <p class="mb-0 text-muted">

                      <span class="mb-0 text-default fs-13 ml-1">

                        <i class="fe fe-arrow-right"></i><?=lang('total_des_cadeaux')?>

                      </span>

                    </p>

                  </div>

                </div>



                

                <div class="col-xl-4 col-lg-6 col-sm-6 pr-0 pl-0 border-right">

                  <div class="card-body text-center">

                    <h6 class="mb-0"><?=lang('recu')?></h6>

                    <h2 class="mb-1 mt-2 text-success">$

                    <?=$received ;?></h2>

                    <p class="mb-0 text-muted">

                      <span class="mb-0 text-success fs-13 ml-1">

                        <i class="fe fe-arrow-up"></i><?=lang('cadeaux_reçus')?>
                      </span>

                    </p>

                  </div>

                </div>

                <div class="col-xl-4 col-lg-6 col-sm-6 pr-0 pl-0 border-right">

                  <div class="card-body text-center">

                    <h6 class="mb-0"><?=lang('remarquable')?></h6>

                    <h2 class="mb-1 mt-2 text-danger">$

                      <?=($lot-$received);?></h2>

                    <p class="mb-0 text-muted">

                      <span class="mb-0 text-danger fs-13 ml-1">

                        <i class="fe fe-arrow-down"></i> <?=lang('cadeaux_en_attente')?>

                      </span>

                    </p>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

        <!-- ROW-2 CLOSED -->


        </div>

   

<!-- Footer --> 
<?php $data=$this->Model->readRequeteOne("SELECT COUNT(id_membre_tier2)  AS tier from tier2 WHERE id_water_source= 1 ");?>

<?php include VIEWPATH.'template/includes/footer.php';?>

<!-- End Footer --> 


  <script>

    Circles.create({

      id:'circles-1',

      radius:45,

      value:70,

      maxValue:100,

      width:7,

      text: 5,

      colors:['#f1f1f1', '#FF9E27'],

      duration:400,

      wrpClass:'circles-wrp',

      textClass:'circles-text',

      styleWrapper:true,

      styleText:true

    })



    Circles.create({

      id:'circles-2',

      radius:45,

      value:<?=($niveau1*100)/2;?>,

      maxValue:100,

      width:7,

      text: <?=($niveau1*100)/2;?>,

      colors:['#f1f1f1', '#318CE7'],

      duration:400,

      wrpClass:'circles-wrp',

      textClass:'circles-text',

      styleWrapper:true,

      styleText:true

    })

    Circles.create({

      id:'circles-3',

      radius:45,

      value:<?=($niveau2*100)/4;?>,

      maxValue:100,

      width:7,

      text:<?=($niveau2*100)/4;?>,

      colors:['#f1f1f1','#EF9B0F'],

      duration:400,

      wrpClass:'circles-wrp',

      textClass:'circles-text',

      styleWrapper:true,

      styleText:true

    })



    Circles.create({

      id:'circles-4',

      radius:45,

      value:<?=($niveau3*100)/8;?>,

      maxValue:100,

      width:7,

      text:<?=($niveau3*100)/8;?>,

      colors:['#f1f1f1', '#F25961'],

      duration:400,

      wrpClass:'circles-wrp',

      textClass:'circles-text',

      styleWrapper:true,

      styleText:true

    })



    var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');



    var mytotalIncomeChart = new Chart(totalIncomeChart, {

      type: 'bar',

      data: {

        labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],

        datasets : [{

          label: "Total Income",

          backgroundColor: '#ff9e27',

          borderColor: 'rgb(23, 125, 255)',

          data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],

        }],

      },

      options: {

        responsive: true,

        maintainAspectRatio: false,

        legend: {

          display: false,

        },

        scales: {

          yAxes: [{

            ticks: {

              display: false //this will remove only the label

            },

            gridLines : {

              drawBorder: false,

              display : false

            }

          }],

          xAxes : [ {

            gridLines : {

              drawBorder: false,

              display : false

            }

          }]

        },

      }

    });



    $('#lineChart').sparkline([105,103,123,100,95,105,115], {

      type: 'line',

      height: '70',

      width: '100%',

      lineWidth: '2',

      lineColor: '#ffa534',

      fillColor: 'rgba(255, 165, 52, .14)'

    });

  </script>