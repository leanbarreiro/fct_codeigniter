<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador Principal
 * @package CI_Controller
 * @subpackage MY_CONTROLLER
 * @author Lebauz
 */
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
        $this->load->model('Menu_model');
        echo $this->load->view('vcabmenu','',true); 
        $data=$this->Menu_model->mGetMenuItem();

        foreach ($data as $value) {

            $datos = array('Nombre' => $value['nombre'], 'Url' => $value['url']);
            echo $this->load->view('velemenu', $datos, true);
        };  
        echo $this->load->view('vpiemenu','',true);
             
        //VISTA A CARGAR
//        $this->load->view($vista);            
        echo $vista;
            
        //PIE
        echo $this->load->view('vbcierre','',true);
               
/**Alertas parte antigua********************/
        $addok = $this->session->flashdata('addok');                   
        $updateok = $this->session->flashdata('updateok');
        $deleteok = $this->session->flashdata('deleteok');
        $repassok = $this->session->flashdata('repassok');
        if($addok == 'bien') {
            $this->load->view('alertas/alertaadd');           
        }
        if($updateok == 'bien') {               
            $this->load->view('alertas/alertaupdate');           
        }
        if($deleteok == 'bien') {
            $this->load->view('alertas/alertadelete');           
        }
        if($repassok == 'mal') {
            $this->load->view('alertas/alertapassdiferentes');           
        }
        if($repassok == 'bien') {
            $this->load->view('alertas/alertapassiguales');           
        }
/*********************************************************/

        echo $this->load->view('fin','',true);
        
    }
    
}
