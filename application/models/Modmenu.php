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
      
        $this->load->database();
        $sql = $this->db->query('SELECT nombre, url FROM menu');
        
        return $sql->result_array();
        
    }
    
}
    
?>
