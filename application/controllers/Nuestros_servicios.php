<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//class Nuestros_servicios extends CI_Controller {
class Nuestros_servicios extends MY_Controller {
    
    
    public function __construct (){
        
          parent::__construct ();
          
         $str = $this->load->view('vservicios','',TRUE);
        $this->cargaTemplate($str);
        
    }
    
    
    public function index() {


//        ///**CABECERA**///  
//        $this->load->view('vhcabecera');                
//
//
//        ///**MENÚ**///
//        $this->load->model("Modmenu");
//        $this->load->view('vcabmenu'); 
//        $data=$this->Modmenu->mGetMenuItem();
//
//        foreach ($data as $value) {
//            $datos = array('Nombre' => $value['nombre'], 'Url' => $value['url']);
//            $this->load->view('velemenu', $datos);
//
//        };  
//        $this->load->view('vpiemenu');                
//
//
//        ///**VISTA SERVICIOS**///
//        $this->load->view('vservicios');                
//
//
//        ///**PIE DE PÁGINA**///
//        $this->load->view('vbcierre');  

    }
}