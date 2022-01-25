<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Configuration pour l'internationnalisation de l'application
 *
 * @author niyodonpaci@gmail.com
 */
class Language_autoload {

    function initialisation() {

	$ci =& get_instance();
	$ci->load->helper('language');
	//recuperation de la langue a chargé a partir de la session
	$current_lang = $ci->session->userdata('current_lang');

	if (!empty($current_lang)) {
		//Langue chargée par l'utilisateur
	   $ci->lang->load('messages',$current_lang);
	  } else { 
	  	//Langue chargée par defaut
	    $ci->lang->load('messages','french');
	}

  }
}