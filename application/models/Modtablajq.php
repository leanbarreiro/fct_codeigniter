<?php
    
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de tabla con jqgrid
 * @package CI_Model
 * @subpackage Modtablajq
 * @author Lebauz
 */

class Modtablajq extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        
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
        
        $q = "SELECT id, nombre, url, descripcion, acceso FROM menu ORDER BY ".$sidx.' '.$sord.' LIMIT '.$start.' , '.$limit.'';
        $sql = $this->db->query($q);
             
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
        
        $q = "SELECT user_id, first_name, last_name, email, nivel FROM usuarios ORDER BY ".$sidx.' '.$sord.' LIMIT '.$start.' , '.$limit.'';
        $sql = $this->db->query($q);
  
        return $sql->result_array();       
    }
    
     /** Consulta el número de items totales
     * @param 
     * @return Array de Strings
     * Consulta a la db el número de items del  menú     
     */
    public function getNumItems() {

        $sql = $this->db->query('SELECT COUNT(*) AS count FROM menu');
               
        return $sql->result_array();
    }
    
     /** Consulta el número de usuarios
     * @param 
     * @return Array de Strings
     * Consulta a la db el número de usuarios     
     */
    public function getNumItemsUsers() {

        $sql = $this->db->query('SELECT COUNT(*) AS count FROM usuarios');
               
        return $sql->result_array();
    }
    
    /******TABLA ITEMS DE MENÚ********/
    
    /** Busqueda de items en db
     * @param String $sField
     * @param String $sString
     * @param String $sOper
     * @return Array de Strings
     * Consulta a la db un items con ciertas caracteristicas     
     */
    public function getItemsSearch($sField, $sString, $sOper) {       
        
        //Se guarda la consulta en consulta
        $consulta = 'SELECT id, nombre, url, descripcion, acceso FROM menu WHERE';
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

        $sql = "INSERT INTO menu (nombre, url, descripcion, acceso) VALUES ( '".$newd["nombre"]."' ,'".$newd["url"]."','".$newd["descripcion"]."','".$newd["acceso"]."' )";
        $this->db->query($sql);      
    }
    
     /** Modifica datos en la db.
     * @param Array $newd
     * @return 
     * Edita en la db     
     */
    public function editTablaMenu($newd) {
        
         $sql = "UPDATE menu SET nombre = '" .$newd["nombre"]. "', url ='" .$newd["url"]. "', descripcion ='" .$newd["descripcion"]. "', acceso ='" .$newd["acceso"]. "' Where Id = " .$newd['id'];                
         $this->db->query($sql);         
    }
    
     /** Borra filas en la db.
     * @param String $newd
     * @return 
     * Separa el string que recibe en un array y lo recorre borrando en la db     
     */
    public function delTablaMenu($newd) {
        
        //Separamos el string que nos llega por el separador ','
        $idsdel = explode(',',$newd);
        
        foreach ($idsdel as $value) {
            $sql = 'DELETE FROM menu WHERE id = '.$value;
            $this->db->query($sql);
        }
    }
    
    /**********TABLA DE USUARIOS************/
    
     /** Busqueda de usuarios en db
     * @param String $sField
     * @param String $sString
     * @param String $sOper
     * @return Array de Strings
     * Consulta a la db un usuario con ciertas caracteristicas     
     */
    public function getItemsSearchUsers($sField, $sString, $sOper) {       
        
        //Se guarda la consulta en consulta
        $consulta = 'SELECT user_id, first_name, last_name, email, nivel FROM usuarios WHERE';
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

        $sql = "INSERT INTO usuarios (first_name, last_name, email, nivel) VALUES ( '".$newd["first_name"]."' ,'".$newd["last_name"]."','".$newd["email"]."','".$newd["nivel"]."' )";
        $this->db->query($sql);      
    }
    
     /** Modifica datos de usuarios en la db.
     * @param Array $newd
     * @return 
     * Edita en la db     
     */
    public function editTablaUsers($newd) {
        
         $sql = "UPDATE usuarios SET first_name = '" .$newd["first_name"]. "', last_name ='" .$newd["last_name"]. "', email ='" .$newd["email"]. "', nivel ='" .$newd["nivel"]. "' Where user_id = " .$newd['id'];                
         $this->db->query($sql);         
    }
    
     /** Borra filas de la tabla usuarios en la db.
     * @param String $newd
     * @return 
     * Separa el string que recibe en un array y lo recorre borrando en la db     
     */
    public function delTablaUsers($newd) {
        
        //Separamos el string que nos llega por el separador ','
        $idsdel = explode(',',$newd);
        
        foreach ($idsdel as $value) {
            $sql = 'DELETE FROM usuarios WHERE user_id = '.$value;
            $this->db->query($sql);
        }
    }  
} 

