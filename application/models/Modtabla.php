<?php
    
defined('BASEPATH') OR exit('No direct script access allowed');

class Modtabla extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    /**
     * @param 
     * @return $sql->result_array() type Array
     */
    public function mGetTabla() {
      
        $this->load->database();
        $sql = $this->db->query('SELECT id, nombre, url FROM menu');
               
        return $sql->result_array();
        
    }
    
   public function mUpdateTabla($newdatos) {
 
        $array = array();
        
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
                
                $sql = 'DELETE FROM menu WHERE id = '.$valID; 
                $this->db->query($sql);
                
            }  
            $numRegistrosDEL = $this->db->affected_rows();
            if ($numRegistrosDEL > 0) { 
                $this->session->set_flashdata('deleteok', 'bien');
           } 
        }
        foreach($array as $id => $datos){
            $sql = "UPDATE menu SET nombre = '" .$datos["Nombre"]. "', url ='" .$datos["URL"]. "' Where Id = " .$id;                
            $this->db->query($sql);                   
        }
        
        $numRegistrosUP = $this->db->affected_rows();
            if ($numRegistrosUP > 0) { 
                $this->session->set_flashdata('updateok', 'bien');
        }
        
        redirect('admin');            
        }
       
    
    public function mAddTabla($newd) {
               
            $sql = "INSERT INTO menu (nombre, url) VALUES ( '".$newd["nomform"]."' ,'".$newd["urlform"]."' )";
            $this->db->query($sql);
                        
            $numRegistros = $this->db->affected_rows();
            if ($numRegistros > 0) { //Comprobamos si la nos devuelven filas modificadas en la db.
                $this->session->set_flashdata('addok', 'bien');
            } 
            redirect('admin');   
        }                           
    } 

