<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excel_import extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('excel');
  }

  function index()
  {

    if(isset($_FILES["file"]["name"]))
    {
      $path = $_FILES["file"]["tmp_name"];
      $object = PHPExcel_IOFactory::load($path);
      foreach($object->getWorksheetIterator() as $worksheet)
      {
        $highestRow = $worksheet->getHighestRow(); 
        $highestColumn = $worksheet->getHighestColumn();
        for($row=2; $row<=$highestRow; $row++)
        {
          $id_membre = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
          $nom_membre = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
          $prenom_membre = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
          $email_membre = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
          $tele_membre = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
          $id_water = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
          $data[] = array(
            'id_membre'       =>  $id_membre,
            'nom_membre'    =>  $nom_membre,
            'prenom_membre'   =>  $prenom_membre,
            'email_membre'    =>  $email_membre,
            'tele_membre'   =>  $tele_membre,
            'id_water'        =>  $id_water
          );
        }
      }

      $this->Model->createBatch('tempo_membre',$data);
      // $sms='<br>
   //              <div id="message" class="alert alert-success text-center col-md-12 ">
   //                  <strong> Oup! </strong>
   //                    données importées avec succès  .
   //              </div>
   //              <br>' ;
      // echo $sms;

      $this->temo_to_membre();
    }
  }

   function temo_to_membre(){

    $all_data_tempo=$this->Model->read('tempo_membre');

    foreach ($all_data_tempo as $value) {

      $fires=$this->Model->readRequete('SELECT * FROM tempo_membre WHERE id_water='.$value['id_membre'].'');

      
            //verifier si le membre etait deja enregistre
        $verify_member=$this->Model->readOne('membre',['email_membre'=>$value['email_membre']]);

            $code_membre=$this->notifications->Code_membre();
          // generation du code (password)
            $password=$this->notifications->Code_verification(6);
            // $password=md5($password);

          if (empty($verify_member['email_membre'])) {
              $data_membre=array('nom_membre'=>$value['nom_membre'],
                        'prenom_membre'=>$value['prenom_membre'],
                        'email_membre'=>$value['email_membre'],
                        'tele_membre'=>$value['tele_membre'],
                        'code_membre'=>$code_membre,
                      );
              $id_new_member=$this->Model->createLastId('membre',$data_membre);

              // login info for user
              $login_info=array('id_membre'=>$id_new_member,
                                'username'=>$value['email_membre'],
                                'password'=>md5($password),
                                'statut_user'=>1,
                               );
              $this->Model->create('users',$login_info);

              //stockage du code (code_verification)
              $data_code = array('email' => $value['email_membre'],'code_verification' => $password);
              $this->Model->create('code_verification',$data_code);

              $the_first=$this->Model->read('tier1');

              if (empty($the_first)) {
                $first=array('id_membre_tier1'=>$id_new_member,
                                'id_water_source'=>0,
                                'depacement'=>0
                               );
                    $this->Model->create('tier1',$first);
              }
          } 

        
        






            ##########< enregistrement des fires >#############
            $wter_source=$this->Model->readOne('membre',['email_membre'=>$value['email_membre']]);
            $id_source=$wter_source['id_membre'];
        //verifier s'il a deja 2 fires
            $verify_total=$this->Model->readRequeteOne("SELECT COUNT(*) AS total FROM tier1 t WHERE t.id_water_source='".$id_source."'");

                  $depacement_1st=0;
            if ($verify_total['total']>=2) {
                $depacement_1st=1;
            }

            
        //insertion de ses deux fires        
        foreach ($fires as $fire) {

          //verifier si le membre etait deja enregistre
    $verify_fire=$this->Model->readOne('membre',['email_membre'=>$fire['email_membre']]);

            $is_doublo=0;

          if (!empty($verify_fire['email_membre'])) {
              $is_doublo=1;
          } 

          $code_fire=$this->notifications->Code_membre();

          $data_fire=array('nom_membre'=>$fire['nom_membre'],
                            'prenom_membre'=>$fire['prenom_membre'],
                            'email_membre'=>$fire['email_membre'],
                            'tele_membre'=>$fire['tele_membre'],
                            'code_membre'=>$code_fire,
                            'is_doublo'=>$is_doublo,
                          );

        $id_new_fire=$this->Model->createLastId('membre',$data_fire);

          $data_first=array('id_membre_tier1'=>$id_new_fire,
                            'id_water_source'=>$id_source,
                            'depacement'=>$depacement_1st
                           );
            $this->Model->create('tier1',$data_first);


              // insert into parents table
              $test_parents=$this->Model->readOne('parents',['id_membre'=>$id_source]);

              if (empty($test_parents)) {
                $data_parent=array('id_membre'=>$id_source);
                $this->Model->create('parents',$data_parent);
              } 

              // generation du code (password) for new fire
              $password_fire=$this->notifications->Code_verification(6);
              // $password_fire=md5($password_fire);     
              // login info for new fire
              $login_fire=array('id_membre'=>$id_new_fire,
                                'username'=>$fire['email_membre'],
                                'password'=>md5($password_fire),
                                'statut_user'=>1,
                               );
              $this->Model->create('users',$login_fire);

              // stockage du code (password) du nouveau fire
              $data_code_fire = array('email' => $fire['email_membre'],'code_verification' => $password_fire);
              $this->Model->create('code_verification',$data_code_fire);


            // recherche du water source en 2nd tier (pour le water src actuel)
          $water_2nd_tier=$this->Model->readRequeteOne("SELECT * FROM tier1 WHERE id_membre_tier1='".$id_source."'");

            $water_3rd_tier='';

          if (!empty($water_2nd_tier['id_water_source'])){
                
                // recherche du water source en 3rd tier (pour le water src actuel)
                $water_3rd_tier=$this->Model->readRequeteOne("SELECT * FROM tier1 WHERE id_membre_tier1='".$water_2nd_tier['id_water_source']."'");

            $total_for_water_second=$this->Model->readRequeteOne("SELECT COUNT(*) AS total FROM tier2 t WHERE t.id_water_source='".$water_2nd_tier['id_water_source']."'");

                   $depacement_2nd=0;

              if ($total_for_water_second['total']>4) {
                  $depacement_2nd=1;
               }

              $data_second=array('id_membre_tier2'=>$id_new_fire,
                                 'id_water_source'=>$water_2nd_tier['id_water_source'],
                                 'depacement'=>$depacement_2nd
                                  );

                 $this->Model->create('tier2',$data_second);
          }



          if (!empty($water_3rd_tier)) {

            $total_for_water_verified=$this->Model->readRequeteOne("SELECT COUNT(*) AS total FROM tier2 t WHERE t.id_water_source='".$water_3rd_tier['id_water_source']."'");

            $total_for_water_third=$this->Model->readRequeteOne("SELECT COUNT(*) AS total FROM tier3 t WHERE t.id_water_source='".$water_3rd_tier['id_water_source']."'");
                   $depacement_3rd=0;
                   $niveau_1=2;
                   $niveau_2=0;

                if ($total_for_water_third['total']=7) {
                    $niveau_2=2;
                    $this->Model->update('membre',['id_membre'=>$water_3rd_tier['id_water_source']],['id_niveau'=>3]);
                  }

                if ($total_for_water_third['total']>8) {
                     $depacement_3rd=1;
                  }

                 if ($total_for_water_verified['total']>=1) {

                    $data_third=array('id_membre_tier3'=>$id_new_fire,
                                      'id_water_source'=>$water_3rd_tier['id_water_source'],
                                      'depacement'=>$depacement_3rd
                                  );
                  
                    $this->Model->create('tier3',$data_third);

                   // insert into water table
                   $test_water=$this->Model->readOne('water',['id_membre'=>$water_3rd_tier['id_water_source']]);

                   if (empty($test_water)) {

                  $data_water=array('id_membre'=>$water_3rd_tier['id_water_source'],
                                    'niveau_1'=>$niveau_1,
                                    'niveau_2'=>$niveau_2
                                     );
                  $this->Model->create('water',$data_water);
                }
                      
            }
          }

        }

     }
       
       
     echo "valide";
  }



function beneficiaire(){
  $all_fires=$this->Model->read('tier1');
  $id_parent=0;
  $id_water=0;
  $id_beneficiaire=0;
  $code_niveau=0;
 
   foreach ($all_fires as $value) {

  $id_fire=$value['id_membre_tier1'];
  $id_parent=$value['id_water_source'];

  // water du fire
  $water=$this->Model->readOne('tier3',['id_membre_tier3'=>$id_fire]);
  //verify if water fire exist
  if (!empty($water)) {
    
    $all_fires=$this->Model->readOne('tier3',['id_water_source'=>$water['id_water_source']]);

    foreach ($all_fires as $fire) {
      
      // verify total of gifts h got
    $total_gift=$this->Model->readRequeteOne('SELECT COUNT(*) AS total_gift FROM beneficiaire WHERE id_membre_beneficiaire='.$water['id_water_source'].'');

    if ($total_gift['total_gift']<2) {

        $id_water=$water['id_water_source'];
        $id_beneficiaire=$water['id_water_source'];
        $code_niveau=2;
     }else{
       $water_water=$this->Model->readOne('tier3',['id_membre_tier3'=>$water['id_water_source']]);
         if (!empty($water_water)) {

             $total_gift_w2=$this->Model->readRequeteOne('SELECT COUNT(*) AS total_gift_w2 FROM beneficiaire WHERE id_membre_beneficiaire='.$water_water['id_water_source'].' AND `id_membre_donateur` IN(SELECT t.id_membre_tier3 FROM tier3 t WHERE t.id_water_source='.$water['id_water_source'].')');

             if ($total_gift_w2['total_gift_w2']<3) {

                $id_water=$water['id_water_source'];
                $id_beneficiaire=$water_water['id_water_source'];
                $code_niveau=3;
             }else{
               $id_water=$water['id_water_source'];
               $id_beneficiaire=0;
               $code_niveau=2;
             }

         }else{
           $id_water=$water['id_water_source'];
           $id_beneficiaire=0;
           $code_niveau=2;
         }
     }

    }

  }else{
    $id_water=0;
    $id_beneficiaire=0;
    $code_niveau=2;
  }


  $data_beneficiaire=array('id_water_direct'=>$id_parent,
                           'id_water_source'=>$id_water,
                           'id_membre_beneficiaire'=>$id_beneficiaire,
                           'id_membre_donateur'=>$id_fire,
                           'code_niveau'=>$code_niveau
                            );

   $this->Model->create('beneficiaire',$data_beneficiaire);


   }
}


  function beneficiaire_niveau_2(){
    // tous les waters qui sont en 2e niveau
    $all_membre=$this->Model->readRequete('SELECT m.id_membre,m.id_niveau,t.id_water_source FROM tier3 t JOIN membre m ON t.id_water_source=m.id_membre WHERE m.id_niveau=3 GROUP BY t.id_water_source') ;

    foreach ($all_membre as $value) {
      // tous les fires du water
      $all_fires=$this->Model->readRequete('SELECT m.id_membre,m.id_niveau,t.id_membre_tier3,t.id_water_source FROM tier3 t JOIN membre m ON t.id_membre_tier3=m.id_membre WHERE t.id_water_source='.$value['id_water_source'].' AND m.id_niveau=3') ;
      
        $id_beneficiaire=0;
        $id_parent=0;
        $id_donateur=0;
        $code_niveau=0;

          if (!empty($all_fires)) {

            foreach ($all_fires as $fire) {
         // verifier s'il a deja encore eu des gifts

          $verify_gift=$this->Model->readRequeteOne('SELECT COUNT(*) AS total_gift  FROM beneficiaire b WHERE b.id_membre_beneficiaire='.$value['id_membre'].' AND b.code_niveau=3 AND b.id_membre_donateur IN(SELECT t.id_membre_tier3 FROM tier3 t WHERE t.id_water_source='.$value['id_membre'].')') ;

             $parent=$this->Model->readOne('tier1',['id_membre_tier1'=>$fire['id_membre_tier3']]);

            if ($verify_gift['total_gift']<5) {
              // il est le beneficiaire
                $id_beneficiaire=$value['id_membre'];
                $id_donateur=$fire['id_membre_tier3'];
                $id_parent=$parent['id_water_source'];
                $code_niveau=3;
            }else{
                $id_beneficiaire=0;
                $id_donateur=$fire['id_membre_tier3'];
                $id_parent=$parent['id_water_source'];
                $code_niveau=3;
            }

            $data_beneficiaire=array('id_water_direct'=>$id_parent,
                                     'id_water_source'=>$value['id_membre'],
                                     'id_membre_beneficiaire'=>$id_beneficiaire,
                                     'id_membre_donateur'=>$id_donateur,
                                     'code_niveau'=>$code_niveau
                                      );

            $this->Model->create('beneficiaire',$data_beneficiaire);

           if ($verify_gift['total_gift']=7) {
            $data=array('id_niveau'=>4);
            $this->Model->update('membre',['id_membre'=>$value['id_membre']],$data);
          }
        }

      }
    }


  }




  function beneficiaire_niveau_3(){
    // tous les waters qui sont en 2e niveau
    $all_membre=$this->Model->readRequete('SELECT m.id_membre,m.id_niveau,t.id_water_source FROM tier3 t JOIN membre m ON t.id_water_source=m.id_membre WHERE m.id_niveau=4 GROUP BY t.id_water_source') ;

    foreach ($all_membre as $value) {
      // tous les fires du water
      $all_fires=$this->Model->readRequete('SELECT m.id_membre,m.id_niveau,t.id_membre_tier3,t.id_water_source FROM tier3 t JOIN membre m ON t.id_membre_tier3=m.id_membre WHERE t.id_water_source='.$value['id_water_source'].' AND m.id_niveau=4') ;
      
        $id_beneficiaire=0;
        $id_parent=0;
        $id_donateur=0;
        $code_niveau=0;

          if (!empty($all_fires)) {

            foreach ($all_fires as $fire) {
         // verifier s'il a deja encore eu des gifts
              
          $verify_gift=$this->Model->readRequeteOne('SELECT COUNT(*) AS total_gift  FROM beneficiaire b WHERE b.id_membre_beneficiaire='.$value['id_membre'].' AND b.code_niveau=4 AND b.id_membre_donateur IN(SELECT t.id_membre_tier3 FROM tier3 t WHERE t.id_water_source='.$value['id_membre'].')') ;

             $parent=$this->Model->readOne('tier1',['id_membre_tier1'=>$fire['id_membre_tier3']]);

            if ($verify_gift['total_gift']<5) {
              // il est le beneficiaire
                $id_beneficiaire=$value['id_membre'];
                $id_donateur=$fire['id_membre_tier3'];
                $id_parent=$parent['id_water_source'];
                $code_niveau=4;
            }else{
                $id_beneficiaire=0;
                $id_donateur=$fire['id_membre_tier3'];
                $id_parent=$parent['id_water_source'];
                $code_niveau=4;
            }

            $data_beneficiaire=array('id_water_direct'=>$id_parent,
                                     'id_water_source'=>$value['id_membre'],
                                     'id_membre_beneficiaire'=>$id_beneficiaire,
                                     'id_membre_donateur'=>$id_donateur,
                                     'code_niveau'=>$code_niveau
                                      );

            $this->Model->create('beneficiaire',$data_beneficiaire);

           if ($verify_gift['total_gift']=7) {
            $data=array('id_niveau'=>5);
            $this->Model->update('membre',['id_membre'=>$value['id_membre']],$data);
          }
        }

      }
    }


  }





}