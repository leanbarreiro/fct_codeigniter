<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Modelo de Login
 * @package CI_Model
 * @subpackage Login_model
 * @author Lebauz
 */
class Login_model extends CI_Model { 
    
    
    /** Comprueba si el usuario existe en la db 
    * @param String $email, 
    * @param String $password 
    * @return boolean
    */
    public function login($email, $password) {
        
        $this->load->database();
    
        $query = $this->db->get_where('usuarios', array('email' => $email));
        
        if($query->num_rows() == 1){ //Si devuelve 1, es que hay registro en la db
            
            $row = $query->row();
            
            /***hash****/
//            $opciones = ['cost' => 12];
//            $passhash = password_hash($password, PASSWORD_DEFAULT, $opciones);           
            /***********/
            
            //Verifico la contraseña coincide con la de la db
            if(password_verify($password, $row->password)){ 
                $usuactual = array('user_data'=>array(
                    "id" => $row->user_id,
                    "first_name" => $row->first_name,
                    "last_name" => $row->last_name,
                    "email" =>  $row->email,
                    "password" => $row->password,
                    "nivel" => $row->nivel,
                    "habilitado" => $row->habilitado,
                    "data_login" => getdate()),
                );
            $this->session->set_userdata($usuactual);
            return TRUE;           
            }           
        }        
        $this->session->set_userdata($usuactual);
        return FALSE;        
    }       
}

