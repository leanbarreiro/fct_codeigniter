<?php
    
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de tabla
 * @package CI_Model
 * @subpackage Modtabla
 * @author Lebauz
 */

class Modtabla extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    /**Consulta a la db los datos para el menú 
     * @param 
     * @return Array de Strings
     * Consulta a la db los datos para el menú     
     */
    public function mGetTabla() {
      
        //Consultamos todos los datos a la db
        $this->load->database();
        $sql = $this->db->query('SELECT id, nombre, url FROM menu');
               
        return $sql->result_array();       
    }
       
    /**Actualiza la tabla (borra y modifica)
     * @param Array $newdatos
     * @return 
      * Actualiza la tabla (borra y modifica) 
     */
   public function mUpdateTabla($newdatos) {
 
        $array = array();
        
        //Recorremos el array que nos llega y vamos guardando el $array los datos formateados 
        foreach($newdatos as $dato => $valor){

            if (substr($dato, 0, 7) == "nombre:"){
                $valorID = substr($dato, 7);
                $array[$valorID]["Nombre"] = $valor;
            }

            if (substr($dato, 0, 4) == "url:"){
                $valorID = substr($dato, 4);
                $array[$valorID]["URL"] = $valor;
            }
            
            if (substr($dato, 0, 7) == "borrar:"){
                $valID = substr($dato, 7);
                $array[$valID]["Borrar"] = $valor;
                
                //Si alguno de los campos se ha marcado para borrar, se borra antes de actualizar
                $sql = 'DELETE FROM menu WHERE id = '.$valID; 
                $this->db->query($sql);
                
            }
            //Contamos número de registros a borrar
            $numRegistrosDEL = $this->db->affected_rows();
            
            //Guardamos en una variable 'flasdata' que se ha hecho el borrado
            if ($numRegistrosDEL > 0) { 
                $this->session->set_flashdata('deleteok', 'bien');
           } 
        }
        //Recorremos el array con datos y vamos actualizando 
        foreach($array as $id => $datos){
            $sql = "UPDATE menu SET nombre = '" .$datos["Nombre"]. "', url ='" .$datos["URL"]. "' Where Id = " .$id;                
            $this->db->query($sql);                   
        }
        //Contamos número de registros a actualizar
        $numRegistrosUP = $this->db->affected_rows();
        //Guardamos en una variable 'flasdata' que se ha hecho el actualizado
            if ($numRegistrosUP > 0) { 
                $this->session->set_flashdata('updateok', 'bien');
        }
        //Redirigimos a la vista admin.
        redirect('admin');            
        }
       
    /**Realiza el insert en la db 
     * @param Array $newd
     * @return 
      * Realiza el insert en la db 
     */    
    public function mAddTabla($newd) {
               
            //Realizamos la consulta a la db
            $sql = "INSERT INTO menu (nombre, url) VALUES ( '".$newd["nomform"]."' ,'".$newd["urlform"]."' )";
            $this->db->query($sql);
            
            //Consultamos el número de registros
            $numRegistros = $this->db->affected_rows();
            
            //Comprobamos si la nos devuelven filas modificadas en la db
            if ($numRegistros > 0) { 
                $this->session->set_flashdata('addok', 'bien');
            }
            //Redirijimos a la vista de admin
            redirect('admin');   
        }                           
    } 

