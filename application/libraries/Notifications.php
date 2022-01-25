<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notifications

{

	protected $CI;



	public function __construct()

	{

	    $this->CI = & get_instance();

      $this->CI->load->library('email');

      $this->CI->load->model('Model');

	}







  function send_mail($emailTo = array(), $subjet, $cc_emails = array(), $message, $attach = array()){



        $config['protocol'] = 'smtp';
        $config['SMTPAuth'] = TRUE;

        $config['smtp_host'] = 'send.one.com';

        $config['smtp_port'] = 587;

        $config['smtp_user'] = 'support@uumoja.org';

        $config['smtp_pass'] = 'Ujamabenedi$978';
        
        $config['smtp_crypto'] = 'tls';

        $config['mailtype'] = 'html';

        $config['charset'] = 'UTF-8';

        $config['wordwrap'] = TRUE;

        $config['smtp_timeout'] = 30;

        // $config['newline'] = "\r\n";

        $this->CI->email->initialize($config);
        
        $this->CI->email->set_newline("\r\n");

        $this->CI->email->set_mailtype("html");

        $this->CI->email->from('support@uumoja.org', 'UMOJA NETWORK MEMBERSHIP');

        $this->CI->email->to($emailTo);

        $this->CI->email->cc($cc_emails);

        



        $this->CI->email->subject($subjet);

        $this->CI->email->message($message);



        if (!empty($attach)) {

            foreach ($attach as $att)

                $this->CI->email->attach($att);

        }

        if (!$this->CI->email->send()) {

            show_error($this->CI->email->print_debugger());

        } 

            else; 

    }



    public function Code_verification($taille)

   {

     $Caracteres = '0123456789';

      $QuantidadeCaracteres = strlen($Caracteres);

      $QuantidadeCaracteres--;



      $Hash=NULL;

        for($x=1;$x<=$taille;$x++){

            $Posicao = rand(0,$QuantidadeCaracteres);

            $Hash .= substr($Caracteres,$Posicao,1);

        }

        return $Hash;

   }


   public function Code_membre()
   {
      $Caracteres = '0123456789';
      $QuantidadeCaracteres = strlen($Caracteres);
      $QuantidadeCaracteres--;

      $Hash=NULL;
        for($x=1;$x<=10;$x++){
            $Posicao = rand(0,$QuantidadeCaracteres);
            $Hash .= substr($Caracteres,$Posicao,1);
        }
      $code_alph=substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);
      $code=$code_alph.''.$Hash;
        return $code;
   }





}

?>