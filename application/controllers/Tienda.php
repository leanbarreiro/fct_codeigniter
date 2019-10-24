<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador de Tienda
 * @package My_Controller
 * @subpackage Tienda
 * @author Lebauz
 */

class Tienda extends MY_Controller {
    
    
    public function index() {
          
        $str = $this->load->view('vtienda','',TRUE);
//        $str = 'vtienda';
        $this->cargaTemplate($str);

/* Código Antiguo
//        ///CABECERA     
//        $this->load->view('vhcabecera'); 
//
//
//        ///MENÚ/
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
//        ///VISTA MENÚ
//        $this->load->view('vtienda');
//
//
//        ///PIE DE PÁGINA
//        $this->load->view('vbcierre');
*/
    }
}