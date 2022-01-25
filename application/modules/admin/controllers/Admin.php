<?php
/**
 * 
 */
class Admin extends MY_Controller
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
			redirect(base_url('Login/admin_do_logout'));
		}	
	}

	

	public function index()
	{
		 $id= $this->session->userdata('memberid');
        //POUR TOUS LES MEMBRES
        $db1=$this->Model->readRequeteOne("SELECT COUNT(id_membre_tier1)  AS tie1 from tier1 ");

                        
        $niv1=0;
        if(empty($db1))
        {
          $niv1=0;
        }
        else
        {
          $niv1=$db1['tie1'];

         }
         //POUR LEs parents
        $db2=$this->Model->readRequeteOne("SELECT COUNT(id_parent)  AS parent from parents");

        $niv2=0;
        if(empty($db2))
        {
          $niv2=0;
        }
        else
        {
          $niv2=$db2['parent'];
         }
         //POUR LEs waters
         $db3=$this->Model->readRequeteOne("SELECT COUNT(id_water)  AS water from water ");
         $niv3=0;
        if(empty($db3))
        {
          $niv3=0;
        }
        else
        {
          $niv3=$db3['water'];
        }

        //POUR ARGENT
         $n1=$this->Model->readRequeteOne("SELECT COUNT(id_membre)  AS n1 from membre WHERE id_membre>1 AND id_niveau=1  ");
         $argent=0;
        if(empty($n1))
        {
          $argent=0;
        }
        else
        {
          $argent=$n1['n1'];
        }


        //POUR BRONZE
         $n2=$this->Model->readRequeteOne("SELECT COUNT(id_membre)  AS n2 from membre WHERE id_membre>1 AND  id_niveau=2 ");
         $bronze=0;
        if(empty($n2))
        {
          $bronze=0;
        }
        else
        {
          $bronze=$n2['n2'];
        }

        //POUR BRONZE
         $n3=$this->Model->readRequeteOne("SELECT COUNT(id_membre)  AS n3 from membre WHERE id_niveau=3 ");
         $or=0;
        if(empty($n3))
        {
          $or=0;
        }
        else
        {
          $or=$n3['n3'];
        }


        //POUR BRONZE
         $n4=$this->Model->readRequeteOne("SELECT COUNT(id_membre)  AS n4 from membre WHERE id_niveau=4 ");
         $saphir=0;
        if(empty($n4))
        {
          $saphir=0;
        }
        else
        {
          $saphir=$n4['n4'];
        }
        
         //POUR saphir
         $n5=$this->Model->readRequeteOne("SELECT COUNT(id_membre)  AS n5 from membre WHERE id_niveau=5 ");
         $diamand=0;
        if(empty($n5))
        {
          $diamand=0;
        }
        else
        {
          $diamand=$n5['n5'];
        }
         $data = array('mbr' =>$niv1,'parent' =>$niv2,'water' =>$niv3,'argent'=>$argent,'bronze'=>$bronze ,'or'=>$or,'diamand'=>$diamand,'saphir'=>$saphir);
		
		$this->load->view('Admin_dashboard_View',$data);
	}

	function Active_network()
	{   //id de membre qui se connecte (session)
		$id_source=$this->session->userdata('memberid');
		$data['source']=$this->Model->readRequeteOne('SELECT * FROM membre WHERE id_membre='.$id_source.'');
		// parrain
		$data['parrain']=$this->Model->readRequeteOne('SELECT * FROM tier1 t JOIN membre m ON m.id_membre=t.id_water_source WHERE t.id_membre_tier1='.$id_source.'');
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

		$this->load->view('admin/admin/Active_Network_View',$data);

	}

	function Waiting_list()
	{
		$id_source=$this->session->userdata('memberid');
		$data['source']=$this->Model->readRequeteOne('SELECT * FROM membre WHERE id_membre='.$id_source.'');
		$data['user_in_waiting']=$this->Model->readRequete("SELECT m.id_membre,m.nom_membre,m.prenom_membre,m.email_membre,m.tele_membre,m.date_insertion FROM tier1 t JOIN users u ON u.id_membre=t.id_membre_tier1 JOIN membre m ON m.id_membre=t.id_membre_tier1 WHERE t.id_water_source=".$id_source." AND u.statut_user=0");
		$this->load->view('admin/admin/Waiting_List_View',$data);
	}


	function approuver_waiting_list(){
		$id_membre=$this->input->post('id_membre');

		$data_update=array('statut_user'=>1);
		$this->Model->update('users',['id_membre'=>$id_membre],$data_update);
		redirect('admin/Admin/Waiting_list');
	}

	function new_fire(){
        //id de membre qui se connecte (session)
        $id_source=$this->session->userdata('memberid') ;
        $out_put='Membre enregistré avec succes';

		$nom_membre=$this->input->post('nom_membre');
		$prenom_membre=$this->input->post('prenom_membre');
		$email_membre=$this->input->post('email_membre');
		$tele_membre=$this->input->post('tele_membre');
		$code=$this->input->post('code');

		$code_verify=$this->Model->readOne('code_verification',array('email'=>$email_membre));
		$verify_if_membre_empty=$this->Model->read('tier1');


		$data=array('nom_membre'=>$nom_membre,
	                'prenom_membre'=>$prenom_membre,
	                'email_membre'=>$email_membre,
	                'tele_membre'=>$tele_membre
	              );


        $verify_member=$this->Model->readOne('membre',['email_membre'=>$email_membre]);
        $verify_first=$this->Model->readRequeteOne("SELECT * FROM tier1 t JOIN membre m ON m.id_membre=t.id_membre_tier1 WHERE m.email_membre='".$email_membre."'");
        $verify_total=$this->Model->readRequeteOne("SELECT COUNT(*) AS total FROM tier1 t WHERE t.id_water_source='".$id_source."'");



        if (empty($verify_member['email_membre'])) {
        	
        	if ($verify_total['total']>=2) {
        		$out_put="il a deja 2 fires";
        		$out_put='<div class="alert alert-success text-center" id ="sms">
        		Vous avez deja deux fires .
        		</div>';
        	}else{

        		// verification du code fourni

        		if ($code_verify['code_verification']==$code) {
        	     

        	       $id_new_member=$this->Model->createLastId('membre',$data);
        	      //insert du nouveau fire et son water

        	       if (empty($verify_if_membre_empty)) {
        	       	    $id_source=0;
        	       }
        	       
                  $data_first=array('id_membre_tier1'=>$id_new_member,
                                    'id_water_source'=>$id_source
                                   );
                  $this->Model->create('tier1',$data_first);

                  // login info for user

                  $login_info=array('id_membre'=>$id_new_member,
                                    'username'=>$email_membre,
                                    'password'=>md5($code)
                                   );
                  $this->Model->create('users',$login_info);



        	$id_water=$this->Model->readRequeteOne("SELECT * FROM tier1 WHERE id_membre_tier1='".$id_source."'");

        	$verify_water=$this->Model->readRequeteOne("SELECT * FROM tier1 WHERE id_membre_tier1='".$id_water['id_water_source']."'");

        	if (!empty($id_water['id_water_source']) && $id_water['id_water_source']!=0){

        		$total_for_water_second=$this->Model->readRequeteOne("SELECT COUNT(*) AS total FROM tier2 t WHERE t.id_water_source='".$id_water['id_water_source']."'");


        	    if ($total_for_water_second['total']<4) {
            	 
            	 $data_second=array('id_membre_tier2'=>$id_new_member,
	                                 'id_water_source'=>$id_water['id_water_source']
	                                );

                 $this->Model->create('tier2',$data_second);

            	}
        	}

        	if (!empty($verify_water)) {

        		$total_for_water_verified=$this->Model->readRequeteOne("SELECT COUNT(*) AS total FROM tier2 t WHERE t.id_water_source='".$verify_water['id_water_source']."'");

        		$total_for_water_third=$this->Model->readRequeteOne("SELECT COUNT(*) AS total FROM tier3 t WHERE t.id_water_source='".$verify_water['id_water_source']."'");

        		if ($total_for_water_verified['total']>=2 && $total_for_water_third['total']<8) {

        		    $data_third=array('id_membre_tier3'=>$id_new_member,
	                                  'id_water_source'=>$verify_water['id_water_source']
	                                );
                  
                    $this->Model->create('tier3',$data_third);	
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
   
             
   //$this->notifications->send_mail($email_membre,'CODE DE VERIFICATION | UMOJA',NULL,$msg_mail,NULL);

      $message='<div class="alert alert-success text-center">
        	Code envoyé avec succès.Merci</div>';	

    echo $message;
    
}
}

?>