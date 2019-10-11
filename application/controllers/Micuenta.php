<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//class Home extends CI_Controller {
class Micuenta extends MY_Controller { 
   
    
    public function __construct (){
        
        parent::__construct ();
          
        $str = $this->load->view('micuenta','',TRUE);
        $this->cargaTemplate($str);        
    }

    public function index() {
                                   
    }
    
    /**
     * @param 
     * @return 
     * Cambia la contraseña después de verificar si las dos entradas son iguales 
     */
    public function cambiarpass() {
        
        $this->load->model('Micuenta_model');
        
        $datos = $this->input->post();
        
        if ( $datos['pass'] == $datos['repass'] AND !empty($datos['newpass']) ) { //Comprobamos que el pass coincida con el campo "repetir" y 
                                                                                    //que la contraseña nueva no venga vacía.
            $newpass = $datos['newpass'];           
        }
        
        if ( $this->Micuenta_model->changepass($newpass) AND strlen($newpass)<=8 ){ //Comprobamos que la contraseña nueva tenga almenos 8 caracteres.
                               
            $this->session->set_flashdata('repassok', 'bien');
            redirect('micuenta');
        } else {
            
            $this->session->set_flashdata('repassok', 'mal');
            redirect('micuenta');
        }       
    }
}
