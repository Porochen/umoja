<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Configuration pour l'internationnalisation de l'application
 *
 * @author niyodonpaci@gmail.com
 */
class Language extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
      
      $session_current_lang = array('current_lang' => $this->uri->segment(3));

      $this->session->set_userdata($session_current_lang);
      redirect($_SERVER['HTTP_REFERER']);
    }

  }