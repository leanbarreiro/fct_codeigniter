<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//class Login extends CI_Controller {           
class Login extends CI_Controller {
   
   
    public function index() {
                
        
        ///**CARGA DE LIBRERIAS**///
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        
        ///**LOGIN**///
        $this->load->model('Login_model');
        
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_verifica');
        
        if($this->form_validation->run() == FALSE) {
            
            $this->load->view('login');
        } else {
            redirect('home');
        }
    }
    
    
    ///**FUNCIONES**///
    public function verifica() {    
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if($this->Login_model->login($email, $password)){ 
            
            redirect('home');
        } else {
            
            $this->form_validation->set_message('Contraseña incorrecta');
            redirect('login');
        }
    }
    

}