<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador de Home
 * @package My_Controller
 * @subpackage Home
 * @author Lebauz
 */

class Home extends MY_Controller { 
    

    public function index() {


        $str = $this->load->view('vhome','',TRUE);
        
        ///>LOG
        $datlog = new datos_log($this->session->user_data['email'], 'Login', 'LOGIN', $this->input->post());
        $this->load->model('LogUsuarios_model');
        $this->LogUsuarios_model->addTablaLogUsuarios($datlog, "");
        
        
        $this->cargaTemplate($str);

/** Código Antiguo      
//            //CABECERA              
//            $this->load->view('vhcabecera');            
//            
//            
//            //MENÚ
//            $this->load->model('Menu_model');
//            $this->load->view('vcabmenu'); 
//            $data=$this->Menu_model->mGetMenuItem();
//
//            foreach ($data as $value) {
//
//                $datos = array('Nombre' => $value['nombre'], 'Url' => $value['url']);
//                $this->load->view('velemenu', $datos);
//            };  
//            $this->load->view('vpiemenu');             
//            
//            
//            //VISTA HOME
//            $this->load->view('vhome');            
//
//            
//            //*PIE DE PÁGINA
//            $this->load->view('vbcierre');
**/                                   
    }
    
}
