<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model { 
    
    public function login($email, $password) {
        
        $this->load->database();
    
        $query = $this->db->get_where('usuarios', array('email' => $email));
        
        if($query->num_rows() == 1){ //Si devuelve 1, es que hay registro en la db
            
            $row = $query->row();
            
            /***hash****/
//            $opciones = ['cost' => 12];
//            $passhash = password_hash($password, PASSWORD_DEFAULT, $opciones);           
            /***********/

            if(password_verify($password, $row->password)){ //Verifico la contraseña coincide con la de la db
                $usuactual = array('user_data'=>array(
                    "first_name" => $row->first_name,
                    "last_name" => $row->last_name,
                    "email" =>  $row->email,
                    "password" => $row->password),
                );
            $this->session->set_userdata($usuactual);
            return TRUE;
            
            }           
        }
        
        $this->session->set_userdata($usuactual);
//        $this->session->set_flashdata('loginok', 'incorrecto');
        return FALSE;
        
    }
    
    
}

