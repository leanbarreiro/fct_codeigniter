<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//class Admin extends CI_Controller {
class Adminjq extends MY_Controller {
    
    

    public function index() {
        
        $this->load->model("Modtabla");
        $datat= $this->Modtabla->mGetTabla();
        $strvista = $this->load->view('tabla/vcabtabla', '', TRUE);
                       
        $strvista .= $this->load->view('tabla/vdatoscab', '', TRUE);
                  
        foreach ($datat as $value) {
            $datost = array('Id' => $value['id'], 'Nombre' => $value['nombre'], 'Url' => $value['url']);
            
        $strvista .=   $this->load->view('tabla/vdatos', $datost, TRUE);

       };  
        $strvista .= $this->load->view('tabla/vfintabla', '', TRUE);
       
        $this->cargaTemplate($strvista);       


    }

    
    
    ////////////FUNCIONES/////////////
    /**
     * @param 
     * @return 
     *Llama a la función mUpdateTabla() 
     */
    public function updateTable() {

        
        $datnew = $this->input->post();
        
        foreach ($datnew as $value) {
            $estavacio = "";
            if (!empty($value) && isset($value) ) {
                  $estavacio = TRUE;
            }else{
                $estavacio = FALSE;
                redirect('admin'); 
            }                   
        }
        if($estavacio == TRUE){
                $this->load->model("Modtabla");
                $this->Modtabla->mUpdateTabla($datnew);                    
        }
    }
                      
    /**
     * @param 
     * @return 
     * Añade una fila en la tabla
     */
    public function addTable() {
        if (!empty($_POST['nomform']) && !empty($_POST['urlform']) && isset($_POST['nomform']) && isset($_POST['urlform']) ) {

            $datanew = $_POST;
            $this->load->model("Modtabla");
            $this->Modtabla->mAddTabla($datanew);
        }else{                
            redirect('admin'); 
        }             
    }           
}