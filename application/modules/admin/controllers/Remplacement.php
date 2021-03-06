<?php

/**
 * 
 */
class Remplacement extends MY_Controller
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
 	$this->load->view('Replace_View');
 }


 public	function listing($key_search=''){

 		$key_search=$this->input->post('critere');
		 $page_set=$this->input->post('page');

         $limit=15;
         $page=0;
         $output='';

         if (!empty($page_set)) {
         	$page=$page_set;
         }else{
         	$page=1;
         }

         $start_form=($page-1)*$limit;
          
   $critere = !empty($key_search) ? '  and (m.nom_membre LIKE "%'.$key_search.'%" OR m.prenom_membre LIKE "%'.$key_search.'%" OR m.email_membre LIKE "%'.$key_search.'%" OR m.tele_membre LIKE "%'.$key_search.'%" OR  CONCAT(m.nom_membre," ",m.prenom_membre) LIKE "%'.$key_search.'%" )' : '';

   $data['page']=$page;
		
    $data['replace']=$this->Model->readRequete("SELECT m.id_membre, m.nom_membre,m.prenom_membre,m.email_membre,m.tele_membre,m.date_insertion FROM membre m WHERE 1  ".$critere." ORDER BY m.date_insertion ASC LIMIT ".$start_form.",".$limit."") ;

    $total_record=$this->Model->readRequeteOne('SELECT COUNT(*) AS total_record FROM membre WHERE 1');

     $total_page=ceil($total_record['total_record']/$limit);

	     $output.='<nav aria-label="...">
					  <ul class="pagination">';

					 if ($page>1) {

					  	$previous=$page-1;
		 $output.='<li class="page-item" id="'.$previous.'">
					      <a class="page-link" href="javascript:void(0)" tabindex="-1">Previous</a>
				   </li>';

					  }

			        $active_class='';
				    $avant=0;
				    $apres=0;

			for ($i=1; $i <= $total_page ; $i++) { 
					
					$avant=$page-3;
					$apres=$page+3;

				if (($avant-1)==$i) {
				$output.='<li class="page-item"">
					...<span class="sr-only">(current)</span>
				  </li>';
				}

		        if ($i>=$avant && $i<=$apres) {
		        
		        $active_class=$i==$page?'active':'';
		        $output.='<li class="page-item '.$active_class.'" id="'.$i.'">
					<a class="page-link" href="javascript:void(0)">'.$i.'<span class="sr-only">(current)</span></a>
				  </li>';

		        }

		         if (($apres+1)==$i) {
				$output.='<li class="page-item"">
					...<span class="sr-only">(current)</span>
				  </li>';
				}

		        
			}



			if ($page<$total_page) {

					  	$next=$page+1;
		 $output.='<li class="page-item" id="'.$next.'">
					      <a class="page-link" href="javascript:void(0)" tabindex="-1">Next</a>
				   </li>';
				}

	    $output.='</ul>
					</nav>';
					  	    
         $data['pagination']=$output;


	  $replace_info=$this->load->view('Replace_Search_View',$data,TRUE);
	     echo json_encode($replace_info);
 }

 public function replaceOne()
 {
		$id_membre=$this->input->post('id_membre');
		$nom_membre=$this->input->post('nom_membre');

		$prenom_membre=$this->input->post('prenom_membre');

		$email_membre=$this->input->post('email_membre');

		$tele_membre=$this->input->post('tele_membre');

		$motif=$this->input->post('motif');

		$preuve=$this->upload_file($_FILES['PHOTO']['tmp_name'],$_FILES['PHOTO']['name']);


		$code=$this->input->post('code');


		$out_put="";


		$code_verify=$this->Model->readOne('code_verification',array('email'=>$email_membre));

		
    $code_membre=$this->notifications->Code_membre();

		$data=array('id_membre'=>$id_membre,
								'nom_membre'=>$nom_membre,
	              'prenom_membre'=>$prenom_membre,
	              'email_membre'=>$email_membre,
	              'tele_membre'=>$tele_membre,
	              'code_membre'=>$code_membre,
	              'remplace'=>1,
	              );


    $verify_member=$this->Model->readOne('membre',['email_membre'=>$email_membre]);


        if (empty($verify_member['email_membre'])) {

        	

        		if ($code_verify['code_verification']==$code) {


        			$mbr_remplace=$this->Model->readOne('membre',['id_membre'=>$id_membre]);

        			$data_replace=array(
								'nom_membre'=>$mbr_remplace['nom_membre'],
	              'prenom_membre'=>$mbr_remplace['prenom_membre'],
	              'email_membre'=>$mbr_remplace['email_membre'],
	              'tele_membre'=>$mbr_remplace['tele_membre'],
	              'sexe'=>$mbr_remplace['sexe'],
	              'id_pays'=>$mbr_remplace['id_pays'],
	              'ville_membre'=>$mbr_remplace['ville_membre'],
	              'date_naissance'=>$mbr_remplace['date_naissance'],
	              'photo_membre'=>$mbr_remplace['photo_membre'],
	              'facebook_url'=>$mbr_remplace['facebook_url'],
	              'telegram_url'=>$mbr_remplace['telegram_url'],
	              'id_mode_paiement'=>$mbr_remplace['id_mode_paiement'],
	              'motif' => $motif,
								'preuve' => $preuve,
								'id_niveau'=>$mbr_remplace['id_niveau'],
	              );
        			$id_replace=$this->Model->createLastId('membre_remplace',$data_replace);

        			$this->Model->create('historique_remplacement',array('id_membre_remplace' =>$id_membre ,'id_membre_insere'=>$id_replace,'id_admin'=>$this->session->userdata('memberid') ));

        	     
        	   $this->Model->update('membre',array('id_membre' => $id_membre),$data);


                  // login info for user

                  $login_info=array('id_membre'=>$id_membre,

                                    'username'=>$email_membre,

                                    'password'=>md5($code)

                                   );

               $this->Model->update('users',array('id_membre'=>$id_membre),$login_info);

                  $out_put='<div class="alert alert-success text-center" id ="sms">Remplacement fait avec success.</div>';

		        }else{

		        	$out_put='<div class="alert alert-success text-center" id ="sms">Le code que vous venez de saisir ne correspond pas au code fourni sur votre email.</div>';

		        }

		      }else{



        	$out_put='<div class="alert alert-success text-center" id ="sms">

        	L\'email de <strong><em>'. $email_membre.'<em></strong> est d??j?? enregistr?? dans notre syst??me,vous pouvez utiliser un autre.Merci</div>';


        }

		echo json_encode($out_put);

 }


 public function histo_replace()
 {
 		$this->load->view('Historique_Remplacement_View');
 }

 public function histo_listing($key_search='')
 {
 		
 		$key_search=$this->input->post('critere');
		 $page_set=$this->input->post('page');

         $limit=15;
         $page=0;
         $output='';

         if (!empty($page_set)) {
         	$page=$page_set;
         }else{
         	$page=1;
         }

         $start_form=($page-1)*$limit;
 		$critere = !empty($key_search) ? '  and (mr.nom_membre LIKE "%'.$key_search.'%" OR mr.prenom_membre LIKE "%'.$key_search.'%" OR mr.email_membre LIKE "%'.$key_search.'%" OR mr.tele_membre LIKE "%'.$key_search.'%" OR  CONCAT(mr.nom_membre," ",mr.prenom_membre) LIKE "%'.$key_search.'%" )' : '';

		$data['page']=$page;
    $data['parent']=$this->Model->readRequete("SELECT mr.id_membre_remplace,hr.id_membre_remplace as id_mbr_rep,hr.id_membre_insere, mr.nom_membre,mr.prenom_membre,mr.email_membre,mr.tele_membre,mr.date_insertion,mr.preuve,mr.motif,CONCAT(mr.nom_membre,' ',mr.prenom_membre),hr.id_admin  FROM membre_remplace mr JOIN historique_remplacement hr ON hr.id_membre_insere=mr.id_membre_remplace WHERE 1 ".$critere." ORDER BY hr.date_insertion ASC LIMIT ".$start_form.",".$limit."") ; 

    $total_record=$this->Model->readRequeteOne('SELECT COUNT(*) AS total_record FROM historique_remplacement WHERE 1');

    $total_page=ceil($total_record['total_record']/$limit);

	     $output.='<nav aria-label="...">
					  <ul class="pagination">';

					 if ($page>1) {

					  	$previous=$page-1;
		 $output.='<li class="page-item" id="'.$previous.'">
					      <a class="page-link" href="javascript:void(0)" tabindex="-1">Previous</a>
				   </li>';

					  }

			        $active_class='';
				    $avant=0;
				    $apres=0;

			for ($i=1; $i <= $total_page ; $i++) { 
					
					$avant=$page-3;
					$apres=$page+3;

				if (($avant-1)==$i) {
				$output.='<li class="page-item"">
					...<span class="sr-only">(current)</span>
				  </li>';
				}

		        if ($i>=$avant && $i<=$apres) {
		        
		        $active_class=$i==$page?'active':'';
		        $output.='<li class="page-item '.$active_class.'" id="'.$i.'">
					<a class="page-link" href="javascript:void(0)">'.$i.'<span class="sr-only">(current)</span></a>
				  </li>';

		        }

		         if (($apres+1)==$i) {
				$output.='<li class="page-item"">
					...<span class="sr-only">(current)</span>
				  </li>';
				}

		        
			}



			if ($page<$total_page) {

					  	$next=$page+1;
		 $output.='<li class="page-item" id="'.$next.'">
					      <a class="page-link" href="javascript:void(0)" tabindex="-1">Next</a>
				   </li>';
				}

	    $output.='</ul>
					</nav>';
					  	    
         $data['pagination']=$output;
	  $parents_info=$this->load->view('Histo_Remplacement_Search_View',$data,TRUE);
	     echo json_encode($parents_info);
 }


 public function upload_file($nom_file,$nom_champ)
	{
      $ref_folder =FCPATH.'assets/photo/proof_replace';
      $code=date("YmdHis").uniqid();
      $fichier=basename($code);
      $file_extension = pathinfo($nom_champ, PATHINFO_EXTENSION);
      $file_extension = strtolower($file_extension);

      if(!is_dir($ref_folder)) 
      {
          mkdir($ref_folder,0777,TRUE);
                                                     
      } 
      move_uploaded_file($nom_file, "$ref_folder/$fichier.$file_extension");
      $image_name=$fichier.".".$file_extension;
      return $image_name;
}

 

}

?>