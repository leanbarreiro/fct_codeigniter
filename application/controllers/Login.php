<?php

defined('BASEPATH') OR exit('No direct script access allowed');
  
/**
 * Controlador de Login
 * @package CI_Controller
 * @subpackage Login
 * @author Lebauz
 */

class Login extends CI_Controller {
     
    public function index() {
                
        
        ///**CARGA DE LIBRERIAS**///
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        
        ///**LOGIN**///
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_verifica');
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('login');
        } else {
            redirect('home');
        }
    }
    
   
    ///**FUNCIONES**///
    /**
     * @param 
     * @return 
     * Llama a la función login en el modelo para vericar el usuario
     */
    public function verifica() {    
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        /**Crear hash de prueba**/
//        $opciones = ['cost' => 12];
//        $passhash = password_hash('123456', PASSWORD_DEFAULT, $opciones);
        /***********************/

        $this->load->model('Login_model');
        if($this->Login_model->login($email, $password)){ 
            
            redirect('home');
        } else {
            
            $this->form_validation->set_message('Contraseña incorrecta');
            redirect('login');
        }
    }
    
    public function log_logout() {
        $datlog = new datos_log($this->session->user_data['email'], 'Login', 'LOGOUT', $this->input->get(), $this->input->post());
        $this->load->model('Log_usuarios_model');
        $this->Log_usuarios_model->addTablaLog($datlog);
        redirect('login');
    }
    

}
