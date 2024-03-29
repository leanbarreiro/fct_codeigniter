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
                
        
        //CARGA DE LIBRERIAS
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        //LOGIN/
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_verifica');
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('login');
        } else {
            redirect('home');
        }
    }
    
    /**Llama a la función login en el modelo para vericar el usuario
     * @param 
     * @return 
     * Llama a la función login en el modelo para vericar el usuario
     */
    public function verifica() {    
        $email = $this->input->post('email');
        $password = $this->input->post('password');

/**Hash       
        //Crear hash de prueba
        $opciones = ['cost' => 12];
        $passhash = password_hash('123456', PASSWORD_DEFAULT, $opciones);
*/

        $this->load->model('Login_model');
        if($this->Login_model->login($email, $password)){ 
            
            redirect('home');
        } else {
            
            $this->form_validation->set_message('Contraseña incorrecta');
            redirect('login');
        }
    }
    
    /**Cierra la sesion
    * @param 
    * @return 
    * Cierra la sesion
    */
    public function log_logout() {
        
         //LOG - creamos una instancia del objeto 'datos_log' y enviamos los datos a la función de añadir en la tabla.
        $datlog = new datos_log($this->session->user_data['email'], 'Login', 'LOGOUT', $this->input->post());
        $this->load->model('LogUsuarios_model');
        $this->LogUsuarios_model->addTablaLogUsuarios($datlog, "");
        
        redirect('login');
    }
    

}
