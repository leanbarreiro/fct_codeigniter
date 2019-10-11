<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//class Home extends CI_Controller {
class Home extends MY_Controller { 
   
    
    public function __construct (){
        
        parent::__construct ();
         
        $str = $this->load->view('vhome','',TRUE);
        $this->cargaTemplate($str);
        
    }


    public function index() {

        
//            ///**CABECERA**///              
//            $this->load->view('vhcabecera');            
//            
//            
//            ///**MENÚ**///
//            $this->load->model('Modmenu');
//            $this->load->view('vcabmenu'); 
//            $data=$this->Modmenu->mGetMenuItem();
//
//            foreach ($data as $value) {
//
//                $datos = array('Nombre' => $value['nombre'], 'Url' => $value['url']);
//                $this->load->view('velemenu', $datos);
//            };  
//            $this->load->view('vpiemenu');             
//            
//            
//            ///**VISTA HOME**///
//            $this->load->view('vhome');            
//
//            
//            ///**PIE DE PÁGINA**///
//            $this->load->view('vbcierre');
                                   
    }
}
?>