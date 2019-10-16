<?php
    
defined('BASEPATH') OR exit('No direct script access allowed');

class Modtablajq extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        
//        $this->load->database();
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
        
        $s = 'SELECT id, nombre, url FROM menu WHERE';
        $s .= ' '.(strtolower($sField)).' ';
        
        switch ($sOper) { /*Controlamos el operador que nos envía la tabla*/
            case 'eq':
                $sOper = "=";
                $b = true;
                break;
            case 'ne': 
                $sOper = "!=";
                $b = true;
                break;
            case 'lt':
                $sOper = "<";
                $b = true;
                break;
            case 'gt':
                $sOper = ">";
                $b = true;
                break;
            case 'bw': 
                $sOper = "LIKE";
                $b = false;
                $s .= $sOper;
                $s .= " '".$sString."%'"; 
                break;
            case 'ew': 
                $sOper = "LIKE";
                $b = false;
                $s .= $sOper;
                $s .= " '%".$sString."'"; 
                break;
            case 'cn': 
                $sOper = "LIKE";
                $b = false;
                $s .= $sOper;
                $s .= " '%".$sString."%'"; 
                break;
        }
        
        if ($b === true) {
            $s .= $sOper;
            $s .= " '".$sString."'"; 
        }
             
        $sql = $this->db->query($s);

        return $sql->result_array();
    }
    
    public function addTablaMenu($newd) {

        $sql = "INSERT INTO menu (nombre, url) VALUES ( '".$newd["Nombre"]."' ,'".$newd["Url"]."' )";
        $this->db->query($sql);      
    }
    
    public function editTablaMenu($newd) {
        
         $sql = "UPDATE menu SET nombre = '" .$newd["Nombre"]. "', url ='" .$newd["Url"]. "' Where Id = " .$newd['Id'];                
         $this->db->query($sql);         
    }
    
    public function delTablaMenu($newd) {
        
         $sql = 'DELETE FROM menu WHERE id = '.$newd['Id']; 
         $this->db->query($sql);
    }
             
                     
} 

