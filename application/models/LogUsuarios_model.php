<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de tabla con jqgrid
 * @package CI_Model
 * @subpackage LogMenu_model
 * @author Lebauz
 */
class LogUsuarios_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();     
    }
    
    /** Consulta el último id registrado
    * @param String $sidx
    * @param String $sord
    * @param String $start
    * @param $limit 
    * @return Array de Strings   
    */
    public function getUltimoId($tabla) {

        $consulta = "SELECT MAX(user_id)+1 as id FROM ".$tabla;
//        $consulta = "select last_insert_id() as id";
        $sql = $this->db->query($consulta);
             
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
    public function getTablaLogUsuarios($sidx, $sord, $start, $limit) { 
        
        //Pedimos los datos junto a una sub-consulta para que nos devuelva el nombre del usuario
        $consulta = "SELECT id, usuario, seccion, accion, cambios, fecha FROM log_usuarios ORDER BY ".$sidx.' '.$sord.' LIMIT '.$start.' , '.$limit.'';
        
/**Consulta
        $consulta = "SELECT log_usuarios.id, usuarios.email as usuario, log_usuarios.seccion, log_usuarios.accion, log_usuarios.cambios, log_usuarios.fecha 
                        FROM log_usuarios 
                        INNER JOIN usuarios ON log_usuarios.id = usuarios.user_id
                        ORDER BY ".$sidx.' '.$sord.' LIMIT '.$start.' , '.$limit.'';
 */
    
        $sql = $this->db->query($consulta);
             
        return $sql->result_array();
    }
    
     /** Consulta el número de items totales
     * @param 
     * @return Array de Strings
     * Consulta a la db el número de items del  menú     
     */
    public function getNumItemsLogUsuarios() {

        $sql = $this->db->query('SELECT COUNT(*) AS count FROM log_usuarios');
               
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
    public function getSearchLogUsuarios($sField, $sString, $sOper) {       
        
        //Se guarda la consulta en consulta
        $consulta = 'SELECT id, usuario, seccion, accion, cambios, fecha FROM log_usuarios WHERE';
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
     
    public function addTablaLogUsuarios($newd, $oldd) {
        
        $usuario = $newd->__get('usuario');
        $seccion = $newd->__get('seccion');
        $accion = $newd->__get('accion');
        $cambios = formatear_respuesta($newd->__get('cambios'), $accion, $oldd);
        
        $idusuario = "(SELECT user_id FROM usuarios WHERE email = "."'".$usuario."'".")";
        
        $sql = "INSERT INTO log_usuarios (usuario, seccion, accion, cambios, id_usuario) VALUES ( '".$usuario."' ,'".$seccion."','".$accion."','"
                                                                                                                    .$cambios."',".$idusuario." )";
        $this->db->query($sql);      
    }
    
        
     /** Añade un regitro a la tabla de log del usuario.
     * @param Object $datalog  datos del log
     * @param Array $data  datos del archivo
     * @return .    
     */
    public function addTablaLogUsuarioFicha($datalog, $data) {
        
        $usuario = $datalog->__get('usuario');
        $seccion = $datalog->__get('seccion');
        $accion = $datalog->__get('accion');
        $datos = $datalog->__get('cambios');
        $cambios = "id_usu:".$datos['user_id']."||nom_original:".$data['success']['client_name'].">nombre:"
                                    .$data['success']['file_name']."||ruta:".$data['success']['full_path'];
        
        $idusuario = "(SELECT user_id FROM usuarios WHERE email = "."'".$usuario."'".")";
        
        $sql = "INSERT INTO log_usuarios (usuario, seccion, accion, cambios, id_usuario) VALUES ( '".$usuario."' ,'".$seccion."','".$accion."','"
                                                                                                                    .$cambios."',".$idusuario." )";
        $this->db->query($sql);      
    }
    

} 