<?php

if (!defined('BASEPATH'))  exit('No direct script access allowed');



class Dashboard_Main extends MY_Controller

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

		

        $id= $this->session->userdata('memberid');

        $id_niveau= $this->session->userdata('id_niveau');


        $niveau=0;
        if ($id_niveau==1) {
          $niveau=1;
        }elseif ($id_niveau==2) {
          $niveau=2;
        }elseif ($id_niveau==3) {
          $niveau=3;
        }elseif ($id_niveau==4) {
          $niveau=4;
        }elseif ($id_niveau==5) {
          $niveau=5;
        }


           //POUR LE 1ER NIVEAU

        $db1=$this->Model->readRequeteOne("SELECT COUNT(id_membre_tier1)  AS tie1 from tier1 t1 JOIN membre m ON m.id_membre=t1.id_membre_tier1 WHERE t1.id_water_source= ".$id." AND m.id_niveau=".$niveau." ");

        $niv1=0;

        if(empty($db1))

        {

          $niv1=0;

        }

        else

        {

          $niv1=$db1['tie1'];



         }
          
      
       

         //POUR LE 2 NIVEAU

        $db2=$this->Model->readRequeteOne("SELECT COUNT(id_membre_tier2)  AS tie2 from tier2 t2 JOIN membre m ON m.id_membre=t2.id_membre_tier2 WHERE t2.id_water_source= ".$id." AND m.id_niveau=".$niveau." ");



        $niv2=0;

        if(empty($db2))

        {

          $niv2=0;

        }

        else

        {

          $niv2=$db2['tie2'];

         }

         //POUR LE 3 NIVEAU

         $db3=$this->Model->readRequeteOne("SELECT COUNT(id_membre_tier3)  AS tie3 from tier3 t3 JOIN membre m ON m.id_membre=t3.id_membre_tier3 WHERE t3.id_water_source= ".$id." AND m.id_niveau=".$niveau." ");

         $niv3=0;

        if(empty($db3))

        {

          $niv3=0;

        }

        else

        {

          $niv3=$db3['tie3'];

        }

        //POUR GIFTS RECU 

        $db4=$this->Model->readRequeteOne("SELECT COUNT(id_membre_receveur)  AS proof FROM proof_paiement p JOIN membre m ON m.id_membre=p.id_membre_receveur WHERE p.id_membre_receveur= ".$id." AND m.id_niveau=".$niveau." AND niveau_membre_receveur=".$niveau);

        $recu=0;

        if(empty($db4))

        {

          $recu=0;

        }

        else

        {

          $recu=$db4['proof'];

        }

        //POUR VERIFICATION DU COMPTE

        $db5=$this->Model->readRequeteOne("SELECT  * from membre WHERE id_membre=".$id);

        $veri=0;

        if($db5['tele_membre']==null)

        {

          $veri=0;  

        }

        else

        {

         $veri=50;

         

         if($db5['facebook_url']!=null)

          {

            $veri=$veri+10;

          }

        if($db5['telegram_url']!=null)

        {

            $veri=$veri+10;

      



          }

        if($db5['photo_membre']!=null)

        {

            $veri=$veri+20;

      



          }

        if($db5['id_mode_paiement']!=0)

          {

            $veri=$veri+10;

          }

         }

         //POUR MODE DE PAYEMENT PREFERE

         $db6=$this->Model->readRequeteOne("SELECT *   from membre WHERE id_membre=".$id);

        $db6['id_mode_paiement'];

       if($db6['id_mode_paiement']==0)

        {

          $paye="0";

        }

        else

        {

         $paye="100";

         }

         //POUR GRAINE

         $db7=$this->Model->readRequeteOne("SELECT  * from proof_paiement WHERE id_membre_donateur=".$id);

        $graine=0;

        if(empty($db7))

        {

          $graine=0;

           

        }

        else

        {

          $graine=100;

            

        }

        //POUR GIFTS RECU ET RECOLTE

        $db8=$this->Model->readRequeteOne("SELECT  count(id_membre_receveur) AS receveur from proof_paiement WHERE id_membre_receveur=".$id);

        $recolte=0;

        if(empty($db8))

        {

          $recolte=0;

           

        }

        else

        {

          $recolte=$db8['receveur'];

            

        }

        //POUR DON CARITATIF

        $data=$this->Model->readRequeteOne("SELECT * from donation WHERE id_membre=".$id);

        

         if(empty($data))

        {

          $don=0;

           

        }

        else

        {

          $don=100;

            

        }

        $data_don="progress-bar bg-secondary w-". $don;

        



         $data_recolte="progress-bar bg-info w-".$recolte;

         $data_graine="progress-bar bg-info w-".$graine;

         $data_payement="progress-bar bg-pink w-".$paye;            

         $data_veri="progress-bar bg-primary w-".$veri;

         $data_bar1="progress-bar bg-primary w-".( $niv1*100)/2;

         $data_bar2="progress-bar bg-warning w-".( $niv2*100)/4;

         $data_bar3="progress-bar bg-danger w-".( $niv3*100)/8;

         

         $data = array('niveau1' =>$niv1,'niveau2' =>$niv2,'niveau3' =>$niv3,'data_bar1'=>$data_bar1,'data_bar2'=>$data_bar2,'data_bar3'=>$data_bar3,'recu'=>$recu,'verification'=>$veri,'data_veri'=>$data_veri,'payement'=>$paye,'data_payement'=>$data_payement,'graine'=>$graine,'data_graine'=>$data_graine,'recolte'=>$recolte,'data_recolte'=>$data_recolte,'don'=>$don,'data_don'=>$data_don);

	     $this->load->view('dashboard/Dashboard_View',$data);

	}



	function Profile()

	{

		$this->load->view('admin/Profile_View');

	}



	function Active_network()

	{

		$this->load->view('admin/Active_Network_View');

	}



	function Waiting_list()

	{

		$this->load->view('admin/Waiting_List_View');

	}



	function Seed()

	{

		$this->load->view('admin/Seed_View');

	}

	function donation()

	{

		$this->load->view('admin/Donnation_View');

	}

	function recolte()

	{

		$this->load->view('admin/Recolte_View');

	}







}