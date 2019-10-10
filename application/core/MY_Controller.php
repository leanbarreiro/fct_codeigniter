<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_CONTROLLER extends CI_Controller {
      
    
//    public function __construct (){
//      parent::__construct ();
//      
//     $this->estalogueado();
//    }
    
//    public function __construct ($vistaACargar){
    public function __construct (){
      parent::__construct ();
      
     $this->estalogueado();
//     $this->cargaTemplate($vistaACargar);
    }
    


    function estalogueado() { //El usuario está o no registrado?
        $CI =& get_instance();
        
        $usuario = $CI->session->userdata('user_data');
        
        if(!isset($usuario)) {
            
           redirect('login');
        }
    }
    
    // Funcion publica para pintar la página
    public function cargaTemplate($vista) {
        
        
        ///**CABECERA**///              
        echo $this->load->view('vhcabecera','',true);  
        
        
        ///**MENÚ**///
        $this->load->model('Modmenu');
        echo $this->load->view('vcabmenu','',true); 
        $data=$this->Modmenu->mGetMenuItem();

        foreach ($data as $value) {

            $datos = array('Nombre' => $value['nombre'], 'Url' => $value['url']);
            echo $this->load->view('velemenu', $datos, true);
        };  
        echo $this->load->view('vpiemenu','',true);
        
        
        ///**VISTA A CARGAR**///
//        $this->load->view($vista);
            
            echo $vista;
        

        ///**PIE DE PÁGINA**///
        echo $this->load->view('vbcierre','',true);      
        
    }
}