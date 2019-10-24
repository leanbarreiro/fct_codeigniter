<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_CONTROLLER extends CI_Controller {
      
    
    public function __construct (){
        parent::__construct ();
      
        //Carga la libreria session
        $this->load->library('session');
        //Llama a la función para comprobar si el usuario está logueado
        $this->estalogueado();
     
    }
    
    /**Comprueba si el usuario está logueado
     * @param 
     * @return
     * Comprueba si el usuario está logueado
     */
    function estalogueado() { 
        
        $CI =& get_instance();
     
        $usuario = $CI->session->userdata('user_data');
        //Si está vacio redirige al login
        if(!isset($usuario)) {            
           redirect('login');
        }
    }
    
   
     /**Muestra la página actual
     * @param String $vista
     * @return 
     * Pinta la página actual
     */
    protected function cargaTemplate($vista) {
        
        
        //CABECERA       
        echo $this->load->view('vhcabecera','',true);  
                
        //MENÚ
        $this->load->model('Modmenu');
        echo $this->load->view('vcabmenu','',true); 
        $data=$this->Modmenu->mGetMenuItem();

        foreach ($data as $value) {

            $datos = array('Nombre' => $value['nombre'], 'Url' => $value['url']);
            echo $this->load->view('velemenu', $datos, true);
        };  
        echo $this->load->view('vpiemenu','',true);
        
        
        ///**VISTA A CARGAR**///
//        $this->load->view($vista);            
        echo $vista;
            
        //PIE DE PÁGINA
        echo $this->load->view('vbcierre','',true);
               
        ///**Alertas**///
        $addok = $this->session->flashdata('addok');
        $updateok = $this->session->flashdata('updateok');
        $deleteok = $this->session->flashdata('deleteok');
        $repassok = $this->session->flashdata('repassok');
        if($addok == 'bien') {
            $this->load->view('alertaadd');           
        }
        if($updateok == 'bien') {               
            $this->load->view('alertaupdate');           
        }
        if($deleteok == 'bien') {
            $this->load->view('alertadelete');           
        }
        if($repassok == 'mal') {
            $this->load->view('alertapassdiferentes');           
        }
        if($repassok == 'bien') {
            $this->load->view('alertapassiguales');           
        }
        /****************************/

        echo $this->load->view('fin','',true);
        
    }
    
}
