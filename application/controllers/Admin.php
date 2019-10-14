<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//class Admin extends CI_Controller {
class Admin extends MY_Controller {
    
    

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
//        ///**CABECERA**///           
//        $this->load->view('vhcabecera');
//
//
//        ///**MENÚ**///
//        $this->load->model("Modmenu");
//        $this->load->view('vcabmenu'); 
//        $data=$this->Modmenu->mGetMenuItem();                            
//        foreach ($data as $value) {
//            $datos = array('Nombre' => $value['nombre'], 'Url' => $value['url']);                     
//            $this->load->view('velemenu', $datos);
//        };                       
//        $this->load->view('vpiemenu');
//
//
//        ///**TABLA**///
//        $this->load->model("Modtabla");
//        $datat= $this->Modtabla->mGetTabla();
//        $this->load->view('tabla/vcabtabla');
//
//        $this->load->view('tabla/vdatoscab');
//
//        foreach ($datat as $value) {
//            $datost = array('Id' => $value['id'], 'Nombre' => $value['nombre'], 'Url' => $value['url']);
//
//            $this->load->view('tabla/vdatos', $datost);
//
//        };  
//        $this->load->view('tabla/vfintabla');
//
//
//        ///**PIE DE PÁGINA**///            
//        $this->load->view('vbcierre');
//
//
//        ///**Alertas**///
//        $addok = $this->session->flashdata('addok');
//        $updateok = $this->session->flashdata('updateok');
//        $deleteok = $this->session->flashdata('deleteok');
//        if($addok == 'bien') {
//            $this->load->view('alertaadd');           
//        }
//        if($updateok == 'bien') {               
//            $this->load->view('alertaupdate');           
//        }
//        if($deleteok == 'bien') {
//            $this->load->view('alertadelete');           
//        }            
//        /****************************/
//
//        $this->load->view('fin');

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