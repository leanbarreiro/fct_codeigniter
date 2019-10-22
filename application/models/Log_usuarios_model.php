<?php
    
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de tabla con jqgrid
 * @package CI_Model
 * @subpackage Modtablajq
 * @author Lebauz
 */

class Log_usuarios_model extends CI_Model {
    
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
    public function getTablaLog($sidx, $sord, $start, $limit) { 
        
//        $q = "SELECT id, nombre, url, descripcion, acceso FROM menu ORDER BY ".$sidx.' '.$sord.' LIMIT '.$start.' , '.$limit.'';
        $sql = $this->db->query($q);
             
        return $sql->result_array();       
    }
    
     /** Consulta el número de items totales
     * @param 
     * @return Array de Strings
     * Consulta a la db el número de items del  menú     
     */
    public function getNumItemsLog() {

//        $sql = $this->db->query('SELECT COUNT(*) AS count FROM menu');
               
        return $sql->result_array();
    }
      
    /************* TABLA LOG *************/
    
    /** Busqueda de items en db
     * @param String $sField
     * @param String $sString
     * @param String $sOper
     * @return Array de Strings
     * Consulta a la db un items con ciertas caracteristicas     
     */
    public function getSearchLog($sField, $sString, $sOper) {       
        
        //Se guarda la consulta en consulta
//        $consulta = 'SELECT id, nombre, url, descripcion, acceso FROM menu WHERE';
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
    public function addTablaLog($newd) {
        
        $usu = $newd->__get('usuario');
        $sec = $newd->__get('seccion');
        $acc = $newd->__get('accion');
        $rget = serialize($newd->__get('respuestaget'));
        $rpost = serialize($newd->__get('respuestapost')); 
        $idusu = "(SELECT user_id FROM usuarios WHERE email = "."'".$usu."'".")";
        
        $sql = "INSERT INTO log (usuario, seccion, accion, respuestaget, respuestapost, id_usuario) VALUES ( '".$usu."' ,'".$sec."','".$acc."','".$rget."','".$rpost."',".$idusu." )";
        $this->db->query($sql);      
    }
    
     /** Modifica datos en la db.
     * @param Array $newd
     * @return 
     * Edita en la db     
     */
    public function editTablaLog($newd) {
        
//         $sql = "UPDATE menu SET nombre = '" .$newd["nombre"]. "', url ='" .$newd["url"]. "', descripcion ='" .$newd["descripcion"]. "', acceso ='" .$newd["acceso"]. "' Where Id = " .$newd['id'];                
         $this->db->query($sql);         
    }
    
     /** Borra filas en la db.
     * @param String $newd
     * @return 
     * Separa el string que recibe en un array y lo recorre borrando en la db     
     */
    public function delTablaLog($newd) {
        
        //Separamos el string que nos llega por el separador ','
        $idsdel = explode(',',$newd);
        
        foreach ($idsdel as $value) {
//            $sql = 'DELETE FROM menu WHERE id = '.$value;
            $this->db->query($sql);
        }
    }
    

} 

