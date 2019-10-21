<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador de Servicios
 * @package My_Controller
 * @subpackage Nuestros_servicios
 * @author Lebauz
 */

class Nuestros_servicios extends MY_Controller {
    
    
    
    public function index() {


        $str = $this->load->view('vservicios','',TRUE);
        $this->cargaTemplate($str);

/* Código Antiguo       
//        ///CABECERA
//        $this->load->view('vhcabecera');                
//
//
//        ///MENÚ
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
//        ///VISTA SERVICIOS
//        $this->load->view('vservicios');                
//
//
//        ///PIE DE PÁGINA
//        $this->load->view('vbcierre');  
*/
        
    }
}