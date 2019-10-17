<?php
    
defined('BASEPATH') OR exit('No direct script access allowed');

class Modtablajq extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        
    }
    
    /** Descarga datos de la tabla
     * @param 
     * @return $sql->result_array() type Array
     * Consulta a la db los datos para el menú     
     */
    public function getTabla($sidx, $sord, $start, $limit) { 
        
        $q = "SELECT id, nombre, url FROM menu ORDER BY ".$sidx.' '.$sord.' LIMIT '.$start.' , '.$limit.'';
        $sql = $this->db->query($q);
             
        return $sql->result_array();       
    }
    
     /** Consulta el número de items totales
     * @param 
     * @return $sql->result_array() type Array
     * Consulta a la db los datos para el menú     
     */
    public function getNumItems() {

        $sql = $this->db->query('SELECT COUNT(*) AS count FROM menu');
               
        return $sql->result_array();
    }
    
    /** Busqueda de items en db
     * @param 
     * @return $sql->result_array() type Array
     * Consulta a la db un items con ciertas caracteristicas     
     */
    public function getItemsSearch($sField, $sString, $sOper) {       
        
        //Se guarda la consulta en consulta
        $consulta = 'SELECT id, nombre, url FROM menu WHERE';
        $consulta .= ' '.(strtolower($sField)).' ';
        
        /*Controlamos el operador que nos envía la tabla*/
        switch ($sOper) { 
            case 'eq':
                $sOper = "=";
                $bandera = true;
                break;
            case 'ne': 
                $sOper = "!=";
                $bandera = true;
                break;
            case 'lt':
                $sOper = "<";
                $bandera = true;
                break;
            case 'gt':
                $sOper = ">";
                $bandera = true;
                break;
            case 'bw': 
                $sOper = "LIKE";
                $bandera = false;
                $consulta .= $sOper;
                $consulta .= " '".$sString."%'"; 
                break;
            case 'ew': 
                $sOper = "LIKE";
                $bandera = false;
                $consulta .= $sOper;
                $consulta .= " '%".$sString."'"; 
                break;
            case 'cn': 
                $sOper = "LIKE";
                $bandera = false;
                $consulta .= $sOper;
                $consulta .= " '%".$sString."%'"; 
                break;
        }
        
        if ($bandera === true) {
            $consulta .= $sOper;
            $consulta .= " '".$sString."'"; 
        }
        
        //Realiza la consulta     
        $sql = $this->db->query($consulta);

        return $sql->result_array();
    }
    
     /** Añade un item a la db.
     * @param $newd type Array
     * @return 
     * Añade a la db     
     */
    public function addTablaMenu($newd) {

        $sql = "INSERT INTO menu (nombre, url) VALUES ( '".$newd["nombre"]."' ,'".$newd["url"]."' )";
        $this->db->query($sql);      
    }
    
     /** Modifica datos en la db.
     * @param $newd type Array
     * @return 
     * Edita en la db     
     */
    public function editTablaMenu($newd) {
        
         $sql = "UPDATE menu SET nombre = '" .$newd["nombre"]. "', url ='" .$newd["url"]. "' Where Id = " .$newd['id'];                
         $this->db->query($sql);         
    }
    
     /** Borra filas en la db.
     * @param $newd type String
     * @return 
     * Separa el string que recibe en un array y lo recorre borrando en la db     
     */
    public function delTablaMenu($newd) {
        
        $idsdel = explode(',',$newd);
        
        foreach ($idsdel as $value) {
            $sql = 'DELETE FROM menu WHERE id = '.$value;
            $this->db->query($sql);
        }
    }                
} 

