<?php
    
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de tabla con jqgrid
 * @package CI_Model
 * @subpackage Modtablajq
 * @author Lebauz
 */

class Modtablajq extends CI_Model {
    protected $tabla = 'menu';
    protected $fields = ['id', 'nombre', 'url', 'descripcion', 'acceso'];
    public function __construct() {
        parent::__construct();
        
    }
    
    public function getDatosActuales($id, $tabla) {
        $q = "SELECT * FROM ".$tabla." WHERE id =".$id;
        $sql = $this->db->query($q);
             
        return $sql->result_array();  
    }
    
    /** Descarga datos de la tabla Menu
     * @param String $sidx
     * @param String $sord
     * @param String $start
     * @param $limit 
     * @return Array de Strings
     * Consulta a la db los datos para el menú     
     */
    public function getTabla($sidx, $sord, $start, $limit) { 
        
        $q = "SELECT " . join(",",$this->fields) . " FROM $this->tabla WHERE habilitado = 1 ORDER BY ".$sidx.' '.$sord.' LIMIT '.$start.' , '.$limit.'';
        $sql = $this->db->query($q);
             
        return $sql->result_array();       
    }
      
     /** Consulta el número de items totales
     * @param 
     * @return Array de Strings
     * Consulta a la db el número de items del  menú     
     */
    public function getNumItems() {

        $sql = $this->db->query('SELECT COUNT(*) AS count FROM '.$this->tabla.' WHERE habilitado = 1');
               
        return $sql->result_array();
    }
     
    /*************TABLA ITEMS DE MENÚ*************/
    
    /** Busqueda de items en db
     * @param String $sField
     * @param String $sString
     * @param String $sOper
     * @return Array de Strings
     * Consulta a la db un items con ciertas caracteristicas     
     */
    public function getItemsSearch($sField, $sString, $sOper) {       
        
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
    
     /** Añade un item a la db.
     * @param Array $newd 
     * @return 
     * Añade a la db     
     */
    public function addTablaMenu($newd) {

        $sql = "INSERT INTO ".$this->tabla." (nombre, url, descripcion, acceso) VALUES ( '".$newd["nombre"]."' ,'".$newd["url"]."','".$newd["descripcion"]."','".$newd["acceso"]."' )";
        $this->db->query($sql);
        return true;
    }
    
     /** Modifica datos en la db.
     * @param Array $newd
     * @return 
     * Edita en la db     
     */
    public function editTablaMenu($newd) {
        
        $sql = "UPDATE ".$this->tabla." SET nombre = '" .$newd["nombre"]. "', url ='" .$newd["url"]. "', descripcion ='" .$newd["descripcion"]. "', acceso ='" .$newd["acceso"]. "' Where Id = " .$newd['id'];                
        $this->db->query($sql);
        return true;         
    }
    
     /**Desabilita la fila en la db.
     * @param String $newd
     * @return boolean   
     */
    public function delTablaMenu($newd) {
        
        //Separamos el string que nos llega por el separador ','
        $idsdel = explode(',',$newd);
        
        foreach ($idsdel as $value) {
            $sql = "UPDATE ".$this->tabla." SET habilitado = 0 WHERE id = ".$value;
//            $sql = 'DELETE FROM menu WHERE id = '.$value;
            $this->db->query($sql);
        }
        return true;
    }
    
} 

