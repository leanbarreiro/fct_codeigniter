<?php
    
defined('BASEPATH') OR exit('No direct script access allowed');

class Modmenu extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
     /**
     * @param 
     * @return 
      * Consulta en la db los items del menú
     */
    public function mGetMenuItem() {
      
        //Depende del usuario cargamos diferentes items del menú
        $usuarioactual = $this->session->user_data['nivel'];
        $this->load->database();
//        $consulta = 'SELECT nombre, url FROM menu';
        $consulta = 'SELECT nombre, url FROM menu WHERE (acceso LIKE "%%'.$usuarioactual.'%%")
                                                                    or  (acceso LIKE "%%'.$usuarioactual.'")
                                                                    or  (acceso LIKE "'.$usuarioactual.'%%")';
                                             
         $sql = $this->db->query($consulta);
        
        return $sql->result_array();
        
    }
    
}
    

