<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador de Servicios
 * @package My_Controller
 * @subpackage NuestrosServicios
 * @author Lebauz
 */

class NuestrosServicios extends MY_Controller {
    
  
    public function index() {


        $str = $this->load->view('vservicios','',TRUE);
        $this->cargaTemplate($str);

/* Código Antiguo       
//        ///CABECERA
//        $this->load->view('vhcabecera');                
//
//
//        ///MENÚ
//        $this->load->model("Menu_model");
//        $this->load->view('vcabmenu'); 
//        $data=$this->Menu_model->mGetMenuItem();
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