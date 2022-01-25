<?php

/**
 * 
 */
class Settings extends MY_Controller
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

		$settings['logo']=$this->Model->getValueSettings('logo') ;
    $settings['name_apk']=$this->Model->getValueSettings('name_apk') ;
    $settings['theme_apk']=$this->Model->getValueSettings('theme_apk') ;
    $settings['num_support']=$this->Model->getValueSettings('num_support') ;
     $settings['email_support']=$this->Model->getValueSettings('email_support') ;
     $settings['reglement']=$this->Model->getValueSettings('reglement') ;

    $settings['admin_fees']=$this->Model->getValueSettings('admin_fees') ;
    $settings['compte_bancaire']=$this->Model->getValueSettings('compte_bancaire') ;

     $settings['home_word']=$this->Model->getValueSettings('home_word') ;

    $settings['admin']=$this->Model->readOne('membre',array('id_membre' =>1));
		$this->load->view('Settings_View',$settings);
	}
	public function upload_file($nom_file,$nom_champ)
{
      $ref_folder =FCPATH.'assets/photo/settings_images';
      $code=date("YmdHis").uniqid();
      $fichier=basename($code);
      $file_extension = pathinfo($nom_champ, PATHINFO_EXTENSION);
      $file_extension = strtolower($file_extension);
      // $valid_ext = array('gif','jpg','png','jpeg','JPG','PNG','JPEG');

      if(!is_dir($ref_folder)) //create the folder if it does not already exists   
      {
          mkdir($ref_folder,0777,TRUE);
                                                     
      } 
      move_uploaded_file($nom_file, "$ref_folder/$fichier.$file_extension");
      $image_name=$fichier.".".$file_extension;
      return $image_name;
}

	public function update_logo()
	{
		$logo=$this->upload_file($_FILES['sitelogo']['tmp_name'],$_FILES['sitelogo']['name']);
		$this->Model->setValueStore('logo',$logo);

		redirect(base_url('settings/Settings')) ;
	}

	public function update_nameapk()
	{
		$name_apk=$this->input->post('name_apk');
		// print_r($name_apk);
		// exit();
  	
    $this->Model->setValueStore('name_apk',$name_apk);
		redirect(base_url('settings/Settings')) ;

	}

	public function update_themeapk()
	{
		$theme_apk=$this->input->post('theme_apk');
  	
    $this->Model->setValueStore('theme_apk',$theme_apk);
		redirect(base_url('settings/Settings')) ;

	}

	public function update_support()
	{
		$num_support=$this->input->post('num_support');
  	
    $this->Model->setValueStore('num_support',$num_support);
		redirect(base_url('settings/Settings')) ;

	}

	public function update_email()
	{
		$email_support=$this->input->post('email_support');
  	
    $this->Model->setValueStore('email_support',$email_support);
		redirect(base_url('settings/Settings')) ;

	}

	

	public function update_admin_fees()
	{
		$admin_fees=$this->input->post('admin_fees');
  	
    $this->Model->setValueStore('admin_fees',$admin_fees);
		redirect(base_url('settings/Settings')) ;

	}

	public function update_compte_bancaire()
	{
		$compte_bancaire=$this->input->post('compte_bancaire');
  	
    $this->Model->setValueStore('compte_bancaire',$compte_bancaire);
		redirect(base_url('settings/Settings')) ;

	}

	public function introduction()
	{
		$home_word=$this->input->post('home_word');
  	
    $this->Model->setValueStore('home_word',$home_word);
		redirect(base_url('settings/Settings')) ;
	}

	public function update_admin()
	{
		$nom_membre=$this->input->post('nom_membre');
		$prenom_membre=$this->input->post('prenom_membre');
		$tele_membre=$this->input->post('tele_membre');
		$email_membre=$this->input->post('email_membre');

		$data=array('nom_membre' => $nom_membre, 
								'prenom_membre' => $prenom_membre,
							  'tele_membre' => $tele_membre,
						    'email_membre' => $email_membre,);
		$this->Model->update('membre',array('id_membre'=>1),$data);
		$this->Model->update('users',array('id_membre'=>1),array('username'=>$email_membre));

		redirect(base_url('Login/admin_logout')) ;

	}

	public function reglement()
	{
		$reglement=$this->input->post('reglement');
  	
    $this->Model->setValueStore('reglement',$reglement);
		redirect(base_url('settings/Settings')) ;
	}

}