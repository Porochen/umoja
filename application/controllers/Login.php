<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends MY_Controller
{	

	function __construct() 
	{
		parent::__construct();
	}
	
	public function index() {
        $this->load->view('Login_View'); 
        
    }

    public function lu_et_approuve(){
        $this->load->view('lu_et_approuve') ;
    }

    public function approuve(){
        $id_membre=$this->session->userdata('memberid');
        $this->Model->update('membre',['id_membre'=>$id_membre],['lu_et_approuve'=>1]);
        redirect(base_url('dashboard/Dashboard_Main'));
    }

	public function do_login() {
        $message=array();
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Model->readOne('users', ['username'=> $username,'statut_user'=>1,'user_title'=>1]);

        if (!empty($user)) {
            if ($user['password'] == md5($password) ) 
            {
                $mail=$user['username'];
                $member = $this->Model->readOne('membre', ['email_membre'=> $mail]);
              
                
                $session = array(
                    'userid' => $user['id_user'],
                    'username' => $user['username'],
                    'user_title'=>$user['user_title'],
                    'memberid' => $member['id_membre'],
                    'nom' => $member['nom_membre'],
                    'prenom' => $member['prenom_membre'],
                    'id_niveau'=>$member['id_niveau'],
                );

                $this->session->set_userdata($session);

                if ($member['lu_et_approuve']!=0) {
                    redirect(base_url('dashboard/Dashboard_Main'));
                }else{
                    redirect(base_url('Login/lu_et_approuve'));
                }
                
            } else{
                $message['message']= "<div class='alert alert-danger text-center'> Le mot de passe incorect !</div>";
            }
            
        } else{
            $message['message'] = "<div class='alert alert-danger text-center'> L'utilisateur n'existe pas dans notre syst??me !</div>";
        }

        $this->session->set_flashdata($message) ;
        redirect(base_url('Login/index'));
            
    }


    public function do_logout() {

        $action='Connexion';
        $description="Derni??re connexion";
        $this->Save_history($action,$description);

        $session = array(
            'userid' => NULL,
            'username' => NULL,
            'memberid' => NULL,
            'image' => NULL,
            'nom' => NULL,
            'prenom' => NULL,
            'user_title'=>NULL,
        );

        $this->session->set_userdata($session);
        
        redirect(base_url());
    }

     public function admin_do_logout() {
        $session = array(
            'userid' => NULL,
            'username' => NULL,
            'memberid' => NULL,
            'image' => NULL,
            'nom' => NULL,
            'prenom' => NULL,
            'user_title'=>NULL,
        );

        $this->session->set_userdata($session);
        redirect(base_url('Login/admin_login'));
    }
 
    public function recover_password($value='')
    {
       $this->load->view('Recover_Password_View');
    }

    public function recover()
 {
     $email = $this->input->post('email');

     $user=$this->Model->readRequeteOne('SELECT m.nom_membre,m.prenom_membre,m.email_membre FROM membre m JOIN users u ON u.username=m.email_membre WHERE m.email_membre="'.$email.'"');
     if (!empty($user)) {

        $code=$this->notifications->Code_verification(6);
        $msg_mail = "Cher(e), ".$user['nom_membre']." ".$user['prenom_membre'].",Votre mot de passe vient d'etre modifi??, Votre nouveau mot de passe actuel est :".$code."<br> Cordialement.";

        $email=$user['email_membre'];

        $this->Model->update('users',array('username'=>$email),array('password'=>md5($code)));
        $this->Model->update('code_verification',array('email'=>$email),array('code_verification'=>$code));
             
        $this->notifications->send_mail($email,'CHANGEMENT DE MOT DE PASSE',NULL,$msg_mail,NULL);

        $data = array('response' => "success", 'message' =>"Votre mot de passe est modifi??.Consultez votre bo??te email");
     }else{
        $data = array('response' => "error", 'message' =>"Nous n'avons pas pu recuperer votre.Verifiez votre email.");
     }

     echo json_encode($data);
 }

    public function admin_login($message = NULL)
    { 
        $data['sms'] = $message;
        $this->load->view('Admin_Login_View',$data);
    }

 public function admin_do_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Model->readOne('users', ['username'=> $username,'statut_user'=>1,'user_title'=>2]);

        if (!empty($user)) {
            if ($user['password'] == md5($password) ) 
            {
                
              
                $mail=$user['username'];
                $admin = $this->Model->readOne('admin', ['email_admin'=> $mail]);
              
                
                $session = array(
                    'userid' => $user['id_user'],
                    'username' => $user['username'],
                    'user_title'=>$user['user_title'],
                    'memberid' => $admin['id_admin'],
                    'nom' => $admin['nom_admin'],
                    'prenom' => $admin['prenom_admin'],
                );

                $this->session->set_userdata($session);

                redirect(base_url('admin/Admin'));
                
            } else
                $message = "<div class='alert alert-danger text-center'> Le mot de passe incorect !</div>";
            
        } else
            $message = "<div class='alert alert-danger text-center'> L'utilisateur n'existe pas dans notre syst??me !</div>";

        $this-> admin_login($message);
    }


}