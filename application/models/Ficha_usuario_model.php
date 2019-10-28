<?php
    
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de tabla con jqgrid
 * @package CI_Model
 * @subpackage Modtablajq
 * @author Lebauz
 */
class Ficha_usuario_model extends CI_Model {
    
    protected $tabla = 'usuarios';
    protected $fields = ['user_id', 'first_name', 'last_name', 'email', 'nivel'];
    
    public function __construct() {
        parent::__construct();   
    }
    
     /** Consulta los datos del usuario
     * @param String $id
     * @param String $tabla
     * @return Array de Strings
     */
    public function getDatosUsuario($id) {
        
        $consulta = "SELECT * FROM usuarios WHERE user_id =".$id;
        $sql = $this->db->query($consulta);
             
        return $sql->result_array();  
    }

} 
