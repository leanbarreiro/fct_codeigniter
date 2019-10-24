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
        
//        $prueba = new Usuario();

        $str = $this->load->view('vhome','',TRUE);
        
        ///>LOG
        $datlog = new datos_log('<b>'.$this->session->user_data['email'].'</b>', 'Login', '<b>LOGIN</b>', $this->input->post());
        $this->load->model('Log_usuarios_model');
        $this->Log_usuarios_model->addTablaLogUsuarios($datlog, "");
        
        
        $this->cargaTemplate($str);
 
/** Código Antiguo      
//            //CABECERA              
//            $this->load->view('vhcabecera');            
//            
//            
//            //MENÚ
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
//            //VISTA HOME
//            $this->load->view('vhome');            
//
//            
//            //*PIE DE PÁGINA
//            $this->load->view('vbcierre');
**/                                   
    }
    
}
