<?php
    
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de tabla con jqgrid
 * @package CI_Model
 * @subpackage Usuarios_model
 * @author Lebauz
 */
class Usuarios_model extends CI_Model {
    
    protected $tabla = 'usuarios';
    protected $fields = ['user_id', 'first_name', 'last_name', 'email', 'nivel', 'ultimo_archivo_subido'];
    
    public function __construct() {
        parent::__construct();   
    }
    
     /** Consulta los datos actuales
     * @param String $id
     * @param String $tabla
     * @return Array de Strings
     */
    public function getDatosActuales($id, $tabla) {
        
        $consulta = "SELECT first_name, last_name, email, nivel FROM ".$tabla." WHERE user_id =".$id;
        $sql = $this->db->query($consulta);
             
        return $sql->result_array();  
    }
    
    /** Descarga datos de la tabla Usuarios
     * @param String $sidx
     * @param String $sord
     * @param String $start
     * @param $limit 
     * @return Array de Strings
     * Consulta a la db los datos de los usuarios    
     */
    public function getTablaUsers($sidx, $sord, $start, $limit) { 
        
        $consulta = "SELECT " . join(",",$this->fields) . " FROM $this->tabla WHERE habilitado = 1 ORDER BY ".$sidx.' '.$sord.' LIMIT '.$start.' , '.$limit.'';
        $sql = $this->db->query($consulta);
  
        return $sql->result_array();       
    }
    
     /** Consulta el número de usuarios
     * @param 
     * @return Array de Strings
     * Consulta a la db el número de usuarios     
     */
    public function getNumItemsUsers() {

        $sql = $this->db->query('SELECT COUNT(*) AS count FROM '.$this->tabla.' WHERE habilitado = 1');
               
        return $sql->result_array();
    }
  
     /** Busqueda de usuarios en db
     * @param String $sField
     * @param String $sString
     * @param String $sOper
     * @return Array de Strings
     * Consulta a la db un usuario con ciertas caracteristicas     
     */
    public function getItemsSearchUsers($sField, $sString, $sOper) {       
        
        //Se guarda la consulta en consulta
        $consulta = "SELECT " . join(",",$this->fields) . " FROM $this->tabla WHERE";
        $consulta .= ' '.(strtolower($sField)).' ';
        
        //Controlamos el operador que nos envía la tabla
        switch ($sOper) { 
            case 'eq':
                $sOper = "=";
                $flag = true;
                break;
            case 'ne': 
                $sOper = "!=";
                $flag = true;
                break;
            case 'lt':
                $sOper = "<";
                $flag = true;
                break;
            case 'gt':
                $sOper = ">";
                $flag = true;
                break;
            case 'bw': 
                $sOper = "LIKE";
                $flag = false;
                $consulta .= $sOper;
                $consulta .= " '".$sString."%'"; 
                break;
            case 'ew': 
                $sOper = "LIKE";
                $flag = false;
                $consulta .= $sOper;
                $consulta .= " '%".$sString."'"; 
                break;
            case 'cn': 
                $sOper = "LIKE";
                $flag = false;
                $consulta .= $sOper;
                $consulta .= " '%".$sString."%'"; 
                break;
        }
        
        if ($flag === true) {
            $consulta .= $sOper;
            $consulta .= " '".$sString."'"; 
        }        
        //Realiza la consulta     
        $sql = $this->db->query($consulta);

        return $sql->result_array();
    }
    
     /** Añade un usuario a la db.
     * @param Array $newd 
     * @return 
     * Añade a la db     
     */
    public function addTablaUsers($newd) {

        $sql = "INSERT INTO ".$this->tabla." (first_name, last_name, email, nivel) VALUES ( '".$newd["first_name"]."' ,'".$newd["last_name"]."','".$newd["email"]."','".$newd["nivel"]."' )";
        $this->db->query($sql);
        return true;
    }
    
     /** Modifica datos de usuarios en la db.
     * @param Array $newd
     * @return 
     * Edita en la db     
     */
    public function editTablaUsers($newd, $id) {
        
         $sql = "UPDATE ".$this->tabla." SET first_name = '" .$newd["first_name"]. "', last_name ='" .$newd["last_name"]. "', email ='" .$newd["email"]. "', nivel ='" .$newd["nivel"]. "' Where user_id = " .$id;                
         $this->db->query($sql);
         return true;
    }
    
     /** Desabilita una fila de la tabla usuarios en la db.
     * @param String $newd
     * @return Boolean
     */
    public function delTablaUsers($newd) {
        
        //Separamos el string que nos llega por el separador ','
        $idsdel = explode(',',$newd);
        
        foreach ($idsdel as $value) {
            $sql = "UPDATE ".$this->tabla." SET habilitado = 0 WHERE user_id = ".$value;
//            $sql = "DELETE FROM ".$this->tabla." WHERE user_id = ".$value;
            $this->db->query($sql);
        }
        return true;
    }  
} 

