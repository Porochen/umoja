<?php
defined('BASEPATH') OR exit('No direct script access allowed');



/**

  * @author uyc.tic@gmail.com

*/

class Model extends CI_Model{





  function create($table, $data) {

        $query = $this->db->insert($table, $data);

        return ($query) ? true : false;

    }



    function read($table,$criteres = array()) {

        $this->db->where($criteres);

        $query = $this->db->get($table);

        return $query->result_array();

    }



    function update($table, $criteres, $data) {

        $this->db->where($criteres);

        $query = $this->db->update($table, $data);

        return ($query) ? true : false;

    }



    function delete($table,$criteres){

        $this->db->where($criteres);

        $query = $this->db->delete($table);

        return ($query) ? true : false;

    }



    function readOne($table, $criteres) {

        $this->db->where($criteres);

        $query = $this->db->get($table);

        return $query->row_array();

    }



    function readRequete($requete){

      $query=$this->db->query($requete);

      if ($query) {

         return $query->result_array();

      }

    }



    function readRequeteOne($requete){

      $query=$this->db->query($requete);

      if ($query) {

        return $query->row_array();

      }

    }



    function vider($requete){

         $query=$this->db->query($requete);

          return $query;

    }





    function createLastId($table, $data) {

        $query = $this->db->insert($table, $data);

       if ($query) {

            return $this->db->insert_id();

        }

    }



    public function Set_History($id_membre,$action,$description){
        $this->db->insert('tracabilite', array(
                    'id_membre' => $id_membre,
                    'action' => $action,
                    'description' =>$description ));
    }
    

    

    function createBatch($table,$data){   

      $query=$this->db->insert_batch($table, $data);

      return ($query) ? true : false;

    }



    function readLimit($table,$limit)

    {

     $this->db->limit($limit);

     $query= $this->db->get($table);

     

      if($query)

       {

           return $query->result_array();

       }   

    }

 



    function updateBatch($table, $criteres, $data) {

        $this->db->where($criteres);

        $query = $this->db->update_batch($table, $data);

        return ($query) ? true : false;

    }





    function checkValue($table, $criteres) {

        $this->db->where($criteres);

        $query = $this->db->get($table);

        if($query->num_rows() > 0)

        {

           return true ;

        }

        else{

           return false;

       }

    }

    public function getValueSettings($key)

    {

        $query = $this->db->query("SELECT value FROM settings WHERE thekey = ? LIMIT 1", [$key]);

        $value = $query->row_array();

        if(!$value) {

            return null;

        }

        return $value['value'];

    }



     public function setValueStore($key, $value)

    {

        $this->db->where('thekey', $key);

        $query = $this->db->get('settings');

        if ($query->num_rows() > 0) {

            $this->db->where('thekey', $key);

            if (!$this->db->update('settings', array('value' => $value))) {

                log_message('error', print_r($this->db->error(), true));

                show_error(lang('database_error'));

            }

        } else {

            if (!$this->db->insert('settings', array('value' => $value, 'thekey' => $key))) {

                log_message('error', print_r($this->db->error(), true));

                show_error(lang('database_error'));

            }

        }



    }

        public function readData($requete)

        { 

            $query =$this->make_requete($requete);

            return $query->result();

        } 

        public function make_requete($requete)

        {

          return $this->db->query($requete);

        }

          public function readAll_data($requete)

        {

           $query =$this->make_requete($requete); 

           return $query->num_rows();

        }

        public function read_filtred($requete)

        {

             $query =$this->make_requete($requete);

            return $query->num_rows();



        }

    }
?>