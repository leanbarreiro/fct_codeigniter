<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    //class Home extends CI_Controller {
    class Jqgrid extends MY_Controller { 


        public function index() {
            

        $str = $this->load->view('jqgrid','',TRUE);
        $this->cargaTemplate($str);
                                                
    }
    
    
}
