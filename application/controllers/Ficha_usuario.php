<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador de Ficha de usuario
 * @package My_Controller
 * @subpackage Ficha_usuario
 * @author Lebauz
 */
class Ficha_usuario extends MY_Controller {
    
    
    public function index()	{
        
        //CARGA DE LIBRERIAS
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $id = $this->input->get('id');
        $this->load->model('Ficha_usuario_model');
        $datos = $this->Ficha_usuario_model->getDatosUsuario($id);
        
        $d = '';
        
        $str = $this->load->view('ficha_usuario',$datos,TRUE);
        $this->cargaTemplate($str);                          
    }
}