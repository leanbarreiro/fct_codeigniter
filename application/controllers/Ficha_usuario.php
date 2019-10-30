<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador de Ficha de usuario
 * @package My_Controller
 * @subpackage Ficha_usuario
 * @author Lebauz
 */
class Ficha_usuario extends MY_Controller {
    
    
        public function __construct() {
        parent::__construct();
        
        //CARGA DE LIBRERIAS
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Ficha_usuario_model');
    }
    
    public function index()	{
    
        $id = $this->input->get('id');

        $datos = $this->Ficha_usuario_model->getDatosUsuario($id);
        
        $datosusu = array('user_id' => $datos[0]['user_id'], 
                            'first_name' => $datos[0]['first_name'], 
                            'last_name' => $datos[0]['last_name'],
                            'email' => $datos[0]['email'], 
                            'nivel' => $datos[0]['nivel'], 
                            'habilitado' => $datos[0]['habilitado']);
            
        $str =   $this->load->view('ficha_usuario', $datosusu, TRUE);

        $this->cargaTemplate($str);

    }
    
    public function cargar_archivo() {
        
        $post = $this->input->post();
//        $id_usuario = $this->input->post('user_id');
 
        $mi_archivo = 'mi_archivo';
        $config['upload_path'] = 'updates/'.$post['user_id'].'/';
        $config['file_name'] = RandomString();
        $config['allowed_types'] = 'pdf|odt|docx';
//        $config['remove_spaces']=TRUE;
        $config['max_size'] = 2048;

        
        $ruta = 'updates/'.$post['user_id'].'/';
        
        if(!file_exists($ruta)){
                mkdir($ruta, 0777);
        }
        
        $this->load->library('upload',$config);
        
 
        if(!$this->upload->do_upload($mi_archivo)) {
            
            //error
//            $data['error'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            
            return;
        } else {
            //subida ok
            $data['success'] = $this->upload->data();
                      
        }
        
        $this->Ficha_usuario_model->ModificarUsuario($data, $post);
        
        
    }
}