<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Code_notif_cron extends MY_Controller

{

	function __construct()

	{

		parent::__construct();

		$this->is_verify();

	}



	public function is_verify()

	{

		if (empty($this->session->userdata('userid')))

		{

			redirect(base_url('Login/do_logout'));

		}	

	}



	function index(){
		
    $members=$this->Model->readRequete("SELECT me.id_membre,me.nom_membre,me.prenom_membre,me.email_membre,c.code_verification FROM membre me JOIN code_verification c ON C.email=me.email_membre  ORDER BY me.id_membre ASC") ;

    foreach ($members as $member) {

    	$nom=$member['nom_membre'];
    	$prenom=$member['prenom_membre'];
    	$email=$member['email_membre'];
    	$code=$member['code_verification'];


    	$msg_mail = "Cher(e) ".$prenom." ".$nom.", Bienvenue dans le système d'Umoja.Veuillez recevoir vos identifiants/détails de connexion.<br>
    		Votre nom d'utilisateur est : ".$email." ,<br>
			et le mot de passe est : ".$code." ,<br>
			Vous pouvez accéder à notre système en utilisant en cliquant <a href=".base_url().">ici</a>.<br> Cordialement.";
    	$this->notifications->send_mail($email,'IDENTIFIANTS DE CONNEXION | UMOJA',NULL,$msg_mail,NULL);
    }

    echo "Opération faite avec success";

 }


}


?>