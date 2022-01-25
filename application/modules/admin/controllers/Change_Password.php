<?php 

/**
 * 
 */
class Change_Password extends MY_Controller
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


	public function check_password()
	{
		$opwd=$this->input->post('opwd');
		$npwd=$this->input->post('npwd');
		$npwd2=$this->input->post('npwd2');
		$email=$this->session->userdata('username');

		$criteres['username']=$email;
		$criteria['email']=$email;
		$curentpassword=$this->Model->readOne('users',$criteres);


		if($curentpassword['password']==md5($opwd))
       {
          $password=md5($npwd);

          $data_pwd=array(
	              	'password'=>$password
	              );

          $this->Model->update('users',$criteres,$data_pwd);

                
			  	$data_code=array(
			               'code_verification'=>$npwd
			              );

				$this->Model->update('code_verification',$criteria,$data_code);

        $data = array('response' => "success", 'message' =>"Mot de passe changé avec succès.");
    }else{
      $data = array('response' => "error", 'message' =>"Mot de passe actuel non correct.");
    }
     echo json_encode($data);
		
	}


	public function change_password_view()
	{
		$id=$this->session->userdata('memberid');
		$data['admin']=$this->Model->readRequeteOne("SELECT * FROM admin WHERE id_admin=".$id) ;
		$this->load->view('Profile_admin_View',$data);
	}

	public function Update_Profile()

	{

		$id=$this->input->post('id_admin');

		$fname=$this->input->post('fname');

		$lname=$this->input->post('lname');

		$email=$this->input->post('email');

		$phone=$this->input->post('phone');


		$data = array('nom_admin' => $fname,

							  'prenom_admin' => $lname,

							  'email_admin' => $email,

							  'phone_admin' => $phone,

					   );

		$this->Model->update('admin',array('id_admin'=>$id),$data);
		redirect(base_url('admin/Change_Password/change_password_view'));

	}

}