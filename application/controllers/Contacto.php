<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador de Contacto
 * @package My_Controller
 * @subpackage Contacto
 * @author Lebauz
 */

class Contacto extends MY_Controller {
    
    
    public function index()	{
        
        $str = $this->load->view('vcontacto','',TRUE);
        $this->cargaTemplate($str);

/* Código Antiguo
//        ///
//        $this->load->view('vhcabecera');
//        
//        
//        ///
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
//        ///
//        $this->load->view('vcontacto');
//        
//        
//        ///
//        $this->load->view('vbcierre');
*/                             
    }
}