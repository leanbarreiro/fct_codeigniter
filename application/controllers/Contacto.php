<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//class Contacto extends CI_Controller {
class Contacto extends MY_Controller {
    
    
    public function index()	{
        
        $str = $this->load->view('vcontacto','',TRUE);
        $this->cargaTemplate($str);
            
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
//            
//            $datos = array('Nombre' => $value['nombre'], 'Url' => $value['url']);
//            $this->load->view('velemenu', $datos);
//        };  
//        
//        $this->load->view('vpiemenu'); 
//        
//        
//        ///**VISTA CONTACTO**///
//        $this->load->view('vcontacto');
//        
//        
//        ///**PIE DE PÁGINA**///
//        $this->load->view('vbcierre');
                              
    }
}