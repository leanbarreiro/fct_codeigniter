<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de MiCuenta
 * @package CI_Model
 * @subpackage MiCuenta_model
 * @author Lebauz
 */

class MiCuenta_model extends CI_Model { 
    
    /**
     * @param String $newpass
     * @return boolean 
     * Actualiza la contraseña en la db. 
     */
    public function changepass($newpass){

        $this->load->database();
        
        /***hash****/
        $opciones = ['cost' => 12];
        $passhash = password_hash($newpass, PASSWORD_DEFAULT, $opciones);           
        /***********/        
    
        $query = $this->db->query('UPDATE usuarios SET password = "'.$passhash.'" WHERE email = "'.$_SESSION["user_data"]["email"].'"');
        
        return TRUE;              
    }        
}