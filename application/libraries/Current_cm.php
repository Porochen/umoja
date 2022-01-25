<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

   class Current_cm {

        protected $CI;

        // We'll use a constructor, as you can't directly call a function
        // from a property definition.
        public function __construct()
        {
                // Assign the CodeIgniter super-object
                $this->CI =& get_instance();
        }

        public function current_class()
        {
                $class=$this->CI->router->fetch_class();
                $out_put='';

                if($class== 'Dashboard_Main'){
                 $out_put='dashboard';       
                }

                if($class=='Membre') {
                  $out_put='profile';
                }

                if($class=='Dashboard') {
                  $out_put='membre_info';
                }

                if($class=='Historique_Niveau') {
                  $out_put='membre_info';
                }

                if($class=='Graine') {
                  $out_put='cadeaux';
                }

                if($class=='Activity') {
                  $out_put='activite';
                }

                if($class=='Recolte') {
                  $out_put='cadeaux';
                }
                if($class=='Boutique') {
                  $out_put='boutique';
                }

                if($class=='Annonce') {
                  $out_put='annonce';
                }

                if($class=='Projet') {
                  $out_put='projet';
                }
                if($class=='CrowdFunding') {
                  $out_put='crowdFunding';
                }

                return $out_put;
                
        }

        public function current_method()
        {
           $class=$this->CI->router->fetch_class();
           return $class;
        }

}