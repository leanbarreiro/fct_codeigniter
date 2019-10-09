<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_CONTROLLER extends CI_Controller {
      
    
    public function __construct (){
      parent::__construct ();
      
     $this->estalogueado();
    }


    function estalogueado() { //El usuario está o no registrado?
        $CI =& get_instance();
        
        $usuario = $CI->session->userdata('user_data');
        
        if(!isset($usuario)) {
            
           redirect('login');
        }
    }
}