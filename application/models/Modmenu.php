<?php
    
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo del Menú
 * @package CI_Model
 * @subpackage Modmenu
 * @author Lebauz
 */

class Modmenu extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
     /**Consulta los items de la tabla dependiendo el rol del usuario
     * @param 
     * @return Array de Strings
      * Consulta en la db los items del menú
     */
    public function mGetMenuItem() {
      
        //Depende del usuario cargamos diferentes items del menú
        $usuarioactual = $this->session->user_data['nivel'];
        $this->load->database();
        //Buscamos en la columna acceso de la tabla menu, donde se encuentran los roles que pueden acceder a ese item
        $consulta = 'SELECT nombre, url FROM menu WHERE (acceso LIKE "%%'.$usuarioactual.'%%")
                                                                    or  (acceso LIKE "%%'.$usuarioactual.'")
                                                                    or  (acceso LIKE "'.$usuarioactual.'%%")';                                            
        $sql = $this->db->query($consulta);
        
        return $sql->result_array();  
    }    
}
    

