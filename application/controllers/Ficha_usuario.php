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
        
//        $this->cargarRepoUsuario($datosusu['user_id']);
//       $this->session->set_flashdata('id_usuario', $id );
            
        $str =   $this->load->view('ficha_usuario', $datosusu, TRUE);

        $this->cargaTemplate($str);
    }
    
    public function cargar_archivo() {
        
        $post = $this->input->post();
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
        
        $this->Ficha_usuario_model->AddArchivoUsuario($data, $post);
        
    }
    
    /**Carga los datos en la tabla de archivos por usuario.
    * @param
    * @return JSON
    * Pide los datos a la db y los carga en la tabla archivos.     
    */
    public function cargarRepoUsuario() {
        //Obtenemos las variables del GET usando los filtros XSS Y creamos 
        //una instancia del tipo stdClass para la respuesta JSON 
        
        $id = $this->input->get('id', TRUE);
        $pagina = $this->input->get('page', TRUE);
        $limite = $this->input->get('rows', TRUE);
        $sidx = $this->input->get('sidx', TRUE);
        $sord = $this->input->get('sord', TRUE);
        $search = $this->input->get('_search', TRUE);      
        $respuesta = new stdClass();
        
        //Calculamos valor del inicio de paginación
        $start = $limite * $pagina - $limite;
    
        //Si el índice es false le damos le valor de 1
        if (!$sidx) { $limite = 1; }
        
        //Comprobamos $_GET['_search'],si es true se realializa una busqueda especifica ó si es false cargamos la tabla entera
        if ($search === "true") { 
            
            $sField = $this->input->get('searchField', TRUE);
            $sString = $this->input->get('searchString', TRUE);
            $sOper = $this->input->get('searchOper', TRUE);
            
            //Pedimos los datos a la db
            $sql = $this->Ficha_usuario_model->getItemsSearchFiles($sField,$sString,$sOper, $id);
            //Calculamos el número de items
            $count = count($sql);

    
        } elseif ($search === "false") {  
            
            //Pedimos los datos a la db
            $sql = $this->Ficha_usuario_model->getTablaFiles($sidx, $sord, $start, $limite, $id);          
            //Consultamos el número de items
            $numitems = $this->Ficha_usuario_model->getNumItemsFiles($id);
            $count = $numitems[0]['count'];                                 
        } 

        //Si el número de registros es mayor a 0 calculamos el número de páginas.
        if( $count > 0 ) {          
            $total_pages = ceil($count/$limite); 
        } else { $total_pages = 0; } 
        
        //Si la pagina es mayor al total de las mismas las igualamos.
        if ($pagina > $total_pages) {$pagina = $total_pages;}

        //Se guardan en el objeto $repuesta de tipo "stdClass" los valores necesarios para montar la tabla.
        $respuesta->page = $pagina;
        $respuesta->total = $total_pages;
        $respuesta->records = $count;

        foreach ($sql as $key => $row) {
            
            $respuesta->rows[$key]['id_archivo'] = $row["id_archivo"];
            $respuesta->rows[$key]['cell'] = array($row["id_archivo"],$row["nombre"],$row["nombre_origen"],$row['tipo'],$row['ruta'],$row['size'],$row['fecha']);
        }
        
        //Códificamos a JSON
        echo json_encode($respuesta);
    
    }
    
    public function mostrarPdf() {
        
        $id_archivo = $this->input->get('id', TRUE);
        $idusu = $this->input->get('idusu', TRUE);
        
        $nombre = $this->Ficha_usuario_model->getNombreFile($id_archivo);
        $ruta = 'C:/web/updates/'.$idusu.'/'.$nombre[0]['nombre'];
        
        header('Content-type: application/pdf');    
        @readfile($ruta);
        
    }
}