<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador Jqgrid
 * @package My_Controller
 * @subpackage Jqgrid
 * @author Lebauz
 */
    
    class Jqgrid extends MY_Controller { 


        public function index() {
            

        $str = $this->load->view('jqgrid','',TRUE);
        $this->cargaTemplate($str);
                                                
    }
    
    
}
