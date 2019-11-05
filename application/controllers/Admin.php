<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador principal
 * @package My_Controller
 * @subpackage Admin
 * @author Lebauz
 */

class Admin extends MY_Controller {
    
    public function index() {
        
        $this->load->model("Admin_model");
        $datat= $this->Admin_model->mGetTabla();
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
    
    /** Actualiza la tabla
     * @param 
     * @return 
     *Llama a la función mUpdateTabla() 
     */
    public function updateTable() {

        //Guardamos los datos del post en un a variable
        $datnew = $this->input->post();
        
        //Controlamos si viene algún campo vacío
        foreach ($datnew as $value) {
            $estavacio = "";
            if (!empty($value) && isset($value) ) {
                  $estavacio = TRUE;
            }else{
                $estavacio = FALSE;
                redirect('admin'); 
            }                   
        }
        //Si es TRUE llamamos a la función para actualizar
        if($estavacio == TRUE){
            $this->load->model("Admin_model");
            $this->Admin_model->mUpdateTabla($datnew);                    
        }
    }
                      
    /**Añade en la tabla
     * @param 
     * @return 
     * Añade una fila en la tabla
     */
    public function addTable() {
        if (!empty($_POST['nomform']) && !empty($_POST['urlform']) && isset($_POST['nomform']) && isset($_POST['urlform']) ) {

            $datanew = $_POST;
            $this->load->model("Admin_model");
            $this->Admin_model->mAddTabla($datanew);
        }else{                
            redirect('admin'); 
        }             
    }           
}