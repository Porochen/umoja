<?php



/**

 * 

 */

class Membre extends MY_Controller

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



	

	





	public function Profile()

	{

		$id=$this->session->userdata('memberid');

		$data['member']=$this->Model->readRequeteOne("SELECT * FROM membre WHERE id_membre=".$id."") ;

		$data['pays']=$this->Model->read('pays');

		$data['mode_paiement']=$this->Model->read('mode_paiement');

		$this->load->view('Profile_View',$data);

	}

public function upload_file($nom_file,$nom_champ)

{

      $ref_folder =FCPATH.'assets/photo/profile';

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



	public function Update_Profile()

	{

		$id=$this->input->post('id_membre');

		$fname=$this->input->post('fname');

		$lname=$this->input->post('lname');

		$email=$this->input->post('email');

		$phone=$this->input->post('phone');

		$gender=$this->input->post('gender');

		$birth=$this->input->post('birth');

		$pays=$this->input->post('pays');

		$state=$this->input->post('state');

		$facebook=$this->input->post('facebook');

		$telegram=$this->input->post('telegram');

		$img1=$this->input->post('img');

		$img=$this->upload_file($_FILES['img']['tmp_name'],$_FILES['img']['name']);

		if (empty($img1)) {
			$img=NULL;
		}

		$data = array('nom_membre' => $fname,

					  'prenom_membre' => $lname,

					  'email_membre' => $email,

					  'tele_membre' => $phone,

						'sexe'=>  $gender,

						'date_naissance'=>  $birth,

						'photo_membre'=>	$img,

						'id_pays'=>	$pays,

						'ville_membre'=>	$state,

						'facebook_url'=>	$facebook,

						'telegram_url'=>	$telegram,

					   );

		$this->Model->update('membre',array('id_membre'=>$id),$data);



		redirect(base_url('membre/Membre/Profile/').$id);

	}



	public function mode_paiement()

	{

		$id=$this->input->post('id_membre');

		$mode=$this->input->post('mode');



		$data = array('id_mode_paiement' => $mode,

					   );

		$this->Model->update('membre',array('id_membre'=>$id),$data);

		redirect(base_url('membre/Membre/Profile'));

	}

}



?>