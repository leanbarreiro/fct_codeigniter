<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador de MiCuenta
 * @package My_Controller
 * @subpackage MiCuenta
 * @author Lebauz
 */

class MiCuenta extends MY_Controller { 
   

    public function index() {
                               
        $str = $this->load->view('micuenta','',TRUE);
        $this->cargaTemplate($str);           
    }
    
    /**
     * @param 
     * @return 
     * Cambia la contraseña después de verificar si las dos entradas son iguales 
     */
    public function cambiarpass() {
        
        $this->load->model('MiCuenta_model');
        
        $datos = $this->input->post();
        
        if ( $datos['pass'] == $datos['repass'] 
                AND (!empty($datos['newpass'])) 
                AND strlen($datos['newpass'])>=6 ) { //Comprobamos que el pass coincida con el campo "repetir" y 
                                                        //que la contraseña nueva no venga vacía y que tenga almenos 8 caracteres.
            $newpass = $datos['newpass'];
            $this->MiCuenta_model->changepass($newpass);                  
            $this->session->set_flashdata('repassok', 'bien');
            redirect('micuenta');
        } else {
            
            $this->session->set_flashdata('repassok', 'mal');
            redirect('micuenta');
        }
    }
}
