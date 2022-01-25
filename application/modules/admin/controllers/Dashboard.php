<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');



class Dashboard extends MY_Controller

{ 

  function __construct()

  {
    parent::__construct();
    $this->is_verify();
  }



  public function is_verify()

  {
    if (empty($this->session->userdata('memberid')))
    {
      redirect(base_url('Login/do_logout'));
    } 

  }

  

  function index()

  {
    $this->activity();
  }

  function Profile()
  {
    $this->load->view('admin/Profile_View');
  }



  function Active_network()

  {   //id de membre qui se connecte (session)

    $id_source=$this->session->userdata('memberid');
    //niveau actuel du membre connecté
    $id_niveau=$this->session->userdata('id_niveau');;

    $data['source']=$this->Model->readRequeteOne('SELECT * FROM membre WHERE id_membre='.$id_source.'');

    // parrain du membre connecté

    $data['parrain']=$this->Model->readRequeteOne('SELECT * FROM tier1 t JOIN membre m ON t.id_water_source=m.id_membre WHERE t.id_membre_tier1='.$id_source.'');

        // liste des membres du 1st tier

    $first_tier=$this->Model->read('tier1',['id_water_source'=>$id_source]);

        $first=array();

    foreach ($first_tier as $value) {

      $first[]=$this->Model->readRequeteOne('SELECT * FROM tier1 t JOIN membre m ON m.id_membre=t.id_membre_tier1 WHERE t.id_membre_tier1='.$value['id_membre_tier1'].' ORDER BY t.date_insertion');

      }

        // liste des membres du 2nd tier

        $second_tier=$this->Model->read('tier2',['id_water_source'=>$id_source]);

        $second=array();

    foreach ($second_tier as $value) {

      $second[]=$this->Model->readRequeteOne('SELECT * FROM tier2 t JOIN membre m ON m.id_membre=t.id_membre_tier2 WHERE t.id_membre_tier2='.$value['id_membre_tier2'].' ORDER BY t.date_insertion');

      }

        // liste des membres du 3rd tier

    $third_tier=$this->Model->read('tier3',['id_water_source'=>$id_source]);

        $third=array();

    foreach ($third_tier as $value) {

      $third[]=$this->Model->readRequeteOne('SELECT * FROM tier3 t JOIN membre m ON m.id_membre=t.id_membre_tier3 WHERE t.id_membre_tier3='.$value['id_membre_tier3'].' ORDER BY t.date_insertion');

      }

        $data['first_tier']=$first;
        $data['second_tier']=$second;
    $data['third_tier']=$third;
    $data['niveau_actuel']=$id_niveau;
    $this->load->view('admin/Active_Network_View',$data);

    // echo '<pre>';
    // print_r($third);
    // echo '<pre>';

  }



  function Waiting_list()

  {

    $id_source=$this->session->userdata('memberid');

    $data['source']=$this->Model->readRequeteOne('SELECT * FROM membre WHERE id_membre='.$id_source.'');

    $data['user_in_waiting']=$this->Model->readRequete("SELECT m.id_membre,m.nom_membre,m.prenom_membre,m.email_membre,m.tele_membre,m.date_insertion FROM tier1 t JOIN users u ON u.id_membre=t.id_membre_tier1 JOIN membre m ON m.id_membre=t.id_membre_tier1 WHERE t.id_water_source=".$id_source." AND u.statut_user=0");

    $this->load->view('admin/Waiting_List_View',$data);

  }





  function approuver_waiting_list(){

    $id_membre=$this->input->post('id_membre');
    $data_update=array('statut_user'=>1);

    $this->Model->update('users',['id_membre'=>$id_membre],$data_update);

    redirect('admin/Dashboard/Waiting_list');

  }



  function new_fire(){

        //id de membre qui se connecte (session)

        $id_source=$this->session->userdata('memberid') ;

        $out_put='<div class="alert alert-success text-center" id ="sms">
        Membre enregistré avec succes
        </div>';

    $nom_membre=$this->input->post('nom_membre');
    $prenom_membre=$this->input->post('prenom_membre');
    $email_membre=$this->input->post('email_membre');
    $tele_membre=$this->input->post('tele_membre');
    $code=$this->input->post('code');

        $verify_member=$this->Model->readOne('membre',['email_membre'=>$email_membre]);

        if (empty($verify_member['email_membre'])) {

            $verify_total=$this->Model->readRequeteOne("SELECT COUNT(*) AS total FROM tier1 t WHERE t.id_water_source='".$id_source."'");

          if ($verify_total['total']>=2) {

            $out_put='<div class="alert alert-success text-center" id ="sms">
            Vous avez deja deux fires .
            </div>';

          }else{

            $code_verify=$this->Model->readOne('code_verification',array('email'=>$email_membre));

               // verification du code fourni
            if ($code_verify['code_verification']==$code) {
                   
                   $code_membre=$this->notifications->Code_membre();

               $data=array('nom_membre'=>$nom_membre,
                        'prenom_membre'=>$prenom_membre,
                        'email_membre'=>$email_membre,
                        'tele_membre'=>$tele_membre,
                        'code_membre'=>$code_membre,
                      );

                 $id_new_member=$this->Model->createLastId('membre',$data);
                   
                   $verify_if_membre_empty=$this->Model->read('tier1');
                   //insert du nouveau fire et son water
                 if (empty($verify_if_membre_empty)) {

                      $id_source=0;
                 }

                  $data_first=array('id_membre_tier1'=>$id_new_member,
                                    'id_water_source'=>$id_source
                                   );

                  $this->Model->create('tier1',$data_first);
                  $action='Insertion';
                  $description="Enregistrement d'un nouveau membre de ma descendance (".$prenom_membre.' '.$nom_membre." )";
                  $this->Save_history($action,$description);
                  // login info for user

                  $login_info=array('id_membre'=>$id_new_member,
                                    'username'=>$email_membre,
                                    'password'=>md5($code)
                                   );

                  $this->Model->create('users',$login_info);

                  // insert into parents
                  $data_parent=array('id_membre'=>$id_source);
                  $this->Model->create('parents',$data_parent);
                  // recuperation de l'id de son parent dans la table tier1
                $parrain=$this->Model->readRequeteOne("SELECT * FROM tier1 WHERE id_membre_tier1='".$id_source."'");

          
               $verify_water='';

          if (!empty($parrain['id_water_source']) && $parrain['id_water_source']!=0){
                // recuperation de l'id du water principal
            $verify_water=$this->Model->readRequeteOne("SELECT * FROM tier1 WHERE id_membre_tier1='".$parrain['id_water_source']."'");

                // verifier le total de de ses fires au niveau 2
            $total_for_water_second=$this->Model->readRequeteOne("SELECT COUNT(*) AS total FROM tier2 t WHERE t.id_water_source='".$parrain['id_water_source']."'");

              if ($total_for_water_second['total']<4) {              

               $data_second=array('id_membre_tier2'=>$id_new_member,
                                   'id_water_source'=>$parrain['id_water_source']
                                  );

                 $this->Model->create('tier2',$data_second);

              }

          }



          if (!empty($verify_water)) {
                //total des fires 2e niv pour le water principal
            $total_for_water_verified=$this->Model->readRequeteOne("SELECT COUNT(*) AS total FROM tier2 t WHERE t.id_water_source='".$verify_water['id_water_source']."'");

                //total des fires 3e niv pour le water principal
            $total_for_water_third=$this->Model->readRequeteOne("SELECT COUNT(*) AS total FROM tier3 t WHERE t.id_water_source='".$verify_water['id_water_source']."'");

            if ($total_for_water_verified['total']>=2 && $total_for_water_third['total']<8) {

                $data_third=array('id_membre_tier3'=>$id_new_member,
                                    'id_water_source'=>$verify_water['id_water_source']
                                  );                  

                    $this->Model->create('tier3',$data_third);  
            }


                 // insert into water table
                   $test_water=$this->Model->readOne('water',['id_membre'=>$verify_water['id_water_source']]);

                   if (empty($test_water)) {

                  $data_water=array('id_membre'=>$verify_water['id_water_source'],
                                      'niveau_1'=>1,
                                     );
                    $this->Model->create('water',$data_water);

                    $this->beneficiaire($id_new_member,$id_source,$verify_water['id_water_source']);
                }

          }


            } else {

              $out_put='<div class="alert alert-success text-center" id ="sms">Le code que vous venez de saisir ne correspond pas au code fourni sur votre email.</div>';
            }


           }


        }else{

          $out_put='<div class="alert alert-success text-center" id ="sms">

          L\'email de <strong><em>'. $email_membre.'<em></strong> est déjà enregistré dans notre système,vous pouvez utiliser un autre.Merci</div>';

      // $this->session->set_flashdata($data);

        }

    echo $out_put;
  }





  function send_mail(){

    $nom_membre=$this->input->post('nom_membre');
  $prenom_membre=$this->input->post('prenom_membre');
  $email_membre=$this->input->post('email_membre');

    $verif=$this->Model->readOne('code_verification',array('email'=>$email_membre));
  $code=0;

    if (empty($verif)) {

      $code=$this->notifications->Code_verification(6);
      $data = array('email' => $email_membre,'code_verification' => $code);
        $this->Model->create('code_verification',$data);
    }else{

      $code=$verif['code_verification'];

    }

    $msg_mail = "Chèr(e) ".$prenom_membre." ".$nom_membre.",Votre code de verification est: <strong>".$code."</strong> , il s'agit aussi de votre mot de passe pour ce connecter dans le système de Umoja.<br> Cordialement.";            

   $this->notifications->send_mail($email_membre,'CODE DE VERIFICATION | UMOJA',NULL,$msg_mail,NULL);

      $message='<div class="alert alert-success text-center">
          Code envoyé avec succès.Merci</div>';

    echo $message;
}



   
   function beneficiaire($id_new_fire='',$id_water_direct='',$id_water_source=''){
      
      // $all_fires=$this->Model->read('tier1');

      // foreach ($all_fires as $value) {
        
      //  $id_water_direct=$value['id_water_source'];
      //  $id_new_fire=$value['id_membre_tier1'];


       $total_member=$this->Model->readRequeteOne('SELECT COUNT(*) AS total FROM membre WHERE id_membre <='.$id_new_fire.'');
       
       $id_membre_beneficiaire=0;
       $code_niveau='';
       // $id_water_source=0;

       if ($total_member['total']<=8) {
          $id_membre_beneficiaire=0; // compte solidalite
          $code_niveau=''; 
          $id_water_source=0;
       }

       if ($total_member['total']>=9) {

          $id_water_source=$id_water_source;

          //total de gift qu'il a deja pris (celui du niveau 2)
          $gift_niv_1=$this->Model->readRequeteOne('SELECT COUNT(*) AS total_gift FROM beneficiaire WHERE id_membre_beneficiaire='.$id_water_source.'');

          if ($gift_niv_1['total_gift']<2) {
               // beneficiaire ( water niveau 1)
              $id_membre_beneficiaire=$id_water_source; 
              $code_niveau='2'; 
              $id_water_source=$id_water_source;

          }else{

          // water beneficiaire (celui du niveau 2)
          $water_ben=$this->Model->readRequeteOne("SELECT * FROM tier3 WHERE id_membre_tier3=".$id_water_source."");

          //verifions si ce water existe
          if (!empty($water_ben)) {
            $water_ben_niv_2=$this->Model->readRequeteOne("SELECT * FROM water w WHERE w.id_membre=".$water_ben['id_water_source']." AND w.niveau_2=1");

          $id_water_source=$water_ben['id_water_source'];

            if (!empty($water_ben_niv_2)) {
                //total de gift qu'il a deja pris (celui du niveau 2)
                     $gift_niv_2=$this->Model->readRequeteOne('SELECT COUNT(*) AS total_gift_niv_2 FROM beneficiaire WHERE id_membre_beneficiaire='.$water_ben['id_water_source'].'');

                   if ($gift_niv_2['total_gift_niv_2']<3) {
                       
                     $id_membre_beneficiaire=$water_ben['id_water_source']; // water niv_2
                     $code_niveau='2'; 
                   }else{
                     $id_membre_beneficiaire=0; // compte solidalite
                     $code_niveau=''; 
                   }

              }else{

                 $id_membre_beneficiaire=0; // compte solidalite
                 $code_niveau=''; 
              }


            } else {  // si ce water n'existe pas
                 $id_membre_beneficiaire=0; // compte solidalite
               $code_niveau=''; 
              }
          
          
          }
          
          
        }


       $data_beneficiaire=array('id_water_direct'=>$id_water_direct,
                                'id_water_source'=>$id_water_source,
                                'id_membre_beneficiaire'=>$id_membre_beneficiaire,
                                'id_membre_donateur'=>$id_new_fire,
                                'code_niveau'=>$code_niveau);
       $this->Model->create('beneficiaire',$data_beneficiaire);
      // }

  }

}