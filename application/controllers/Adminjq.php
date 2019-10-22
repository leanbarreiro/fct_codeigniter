<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador principal con jqgrid
 * @package My_Controller
 * @subpackage Adminjq
 * @author Lebauz
 */

class Adminjq extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        
        //Carga el modelo
        $this->load->model("Modtablajq");
    }

    public function index() {
        
        //Carga la vista y la enviamos al controlador principal
        $str = $this->load->view('tabla/tablajq','',TRUE);
        $this->cargaTemplate($str);
    }
    
    /**Carga los datos en la tabla de items de menú.
    * @param
    * @return JSON
    * Pide los datos a la db y los carga en la tabla.     
    */
    public function cargarDatosTabla() {
               
        //Obtenemos las variables del GET usando los filtros XSS Y creamos 
        //una instancia del tipo stdClass para la respuesta JSON    
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
        
        //Comprobamos $_GET['_search'],si es true se realializa una busqueda especifica 
        //ó si es false cargamos la tabla entera
        if ($search === "true") { 
            
            $sField = $this->input->get('searchField', TRUE);
            $sString = $this->input->get('searchString', TRUE);
            $sOper = $this->input->get('searchOper', TRUE);
            
            //Pedimos los datos a la db
            $sql = $this->Modtablajq->getItemsSearch($sField,$sString,$sOper);
            //Calculamos el número de items
            $count = count($sql);
    
        } elseif ($search === "false") {  
            
            // Pedimos los datos a la db
            $sql = $this->Modtablajq->getTabla($sidx, $sord, $start, $limite);          
            //Consultamos el número de items
            $numitems = $this->Modtablajq->getNumItems();
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
            
            $respuesta->rows[$key]['id'] = $row["id"];
            $respuesta->rows[$key]['cell'] = array($row["id"],$row["nombre"],$row["url"],$row['descripcion'],$row['acceso']);
        }
        
        ///>LOG
//        $datlog = new datos_log($this->session->user_data['email'], 'Carga Datos Menú', 'Carga', $this->input->get(), $this->input->post(), fecha_formateada());
//        $this->load->model('Log_usuarios_model');
//        $this->Log_usuarios_model->addTablaLog($datlog);
        
       //Códificamos a JSON
        echo json_encode($respuesta);
    }
    
    /**Gestiona el crud de la tabla de items de menú..
    * @param
    * @return JSON
    * Busca, añade, modifica y borra.     
    */
    public function gestionTablaMenu() {
    
       //Recogemos los datos del post usando los filtros XSS 
       $arraypost = $this->input->post(array('id','nombre','url','descripcion','acceso') ,TRUE);
       $oper = $this->input->post('oper', TRUE);
   
       //Administra la llamada a las funciones dependiendo del valor del $oper
       switch ($oper) {
           case 'add':
//                $this->Modtablajq->addTablaMenu($arraypost);
                if ($this->Modtablajq->addTablaMenu($arraypost)) {
                    ///>LOG
                    $datlog = new datos_log($this->session->user_data['email'], 'Menú', 'ADD', $this->input->get(), $this->input->post());
                    $this->load->model('Log_usuarios_model');
                    $this->Log_usuarios_model->addTablaLog($datlog);
                }                
                 break;
           case 'edit':
//                $this->Modtablajq->editTablaMenu($arraypost);
                if ($this->Modtablajq->editTablaMenu($arraypost)) {
                    ///>LOG
                    $datlog = new datos_log($this->session->user_data['email'], 'Menú', 'UPDATE', $this->input->get(), $this->input->post());
                    $this->load->model('Log_usuarios_model');
                    $this->Log_usuarios_model->addTablaLog($datlog);
                }   
                 break;
           case 'del':
//                $this->Modtablajq->delTablaMenu($arraypost['id']);
               if ($this->Modtablajq->delTablaMenu($arraypost['id'])) {
                    ///>LOG
                    $datlog = new datos_log($this->session->user_data['email'], 'Menú', 'DELETE', $this->input->get(), $this->input->post());
                    $this->load->model('Log_usuarios_model');
                    $this->Log_usuarios_model->addTablaLog($datlog);
                }  
                 break;
       }
    }
    
    
    /**Carga los datos en la tabla de usuarios.
    * @param
    * @return JSON
    * Pide los datos a la db y los carga en la tabla usuarios.     
    */
    public function cargarDatosUsu() {
        //Obtenemos las variables del GET usando los filtros XSS Y creamos 
        //una instancia del tipo stdClass para la respuesta JSON    
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
        
        //Comprobamos $_GET['_search'],si es true se realializa una busqueda especifica 
        //ó si es false cargamos la tabla entera
        if ($search === "true") { 
            
            $sField = $this->input->get('searchField', TRUE);
            $sString = $this->input->get('searchString', TRUE);
            $sOper = $this->input->get('searchOper', TRUE);
            
            //Pedimos los datos a la db
            $sql = $this->Modtablajq->getItemsSearchUsers($sField,$sString,$sOper);
            //Calculamos el número de items
            $count = count($sql);
    
        } elseif ($search === "false") {  
            
            // Pedimos los datos a la db
            $sql = $this->Modtablajq->getTablaUsers($sidx, $sord, $start, $limite);          
            //Consultamos el número de items
            $numitems = $this->Modtablajq->getNumItemsUsers();
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
            
            $respuesta->rows[$key]['user_id'] = $row["user_id"];
            $respuesta->rows[$key]['cell'] = array($row["user_id"],$row["first_name"],$row["last_name"],$row['email'],$row['nivel']);
        }
        
       //Códificamos a JSON
        echo json_encode($respuesta);
    }
    
    /**Gestiona el crud de la tabla de usuarios.
    * @param
    * @return JSON
    * Busca, añade, modifica y borra.     
    */
    public function gestionTablaUsers() {
       //Recogemos los datos del post usando los filtros XSS 
       $arraypost = $this->input->post(array('id','first_name','last_name','email','nivel') ,TRUE);
       
       $oper = $this->input->post('oper', TRUE);
   
       //Administra la llamada a las funciones dependiendo del valor del $oper
       switch ($oper) {
           case 'add':
//                $this->Modtablajq->addTablaUsers($arraypost);
               if ($this->Modtablajq->addTablaUsers($arraypost)) {
                    ///>LOG
                    $datlog = new datos_log($this->session->user_data['email'], 'Usuarios', 'ADD', $this->input->get(), $this->input->post());
                    $this->load->model('Log_usuarios_model');
                    $this->Log_usuarios_model->addTablaLog($datlog);
                } 
                 break;
           case 'edit':
//                $this->Modtablajq->editTablaUsers($arraypost);
                if ($this->Modtablajq->editTablaUsers($arraypost)) {
                    ///>LOG
                    $datlog = new datos_log($this->session->user_data['email'], 'Usuarios', 'UPDATE', $this->input->get(), $this->input->post());
                    $this->load->model('Log_usuarios_model');
                    $this->Log_usuarios_model->addTablaLog($datlog);
                } 
                 break;
           case 'del':
//                $this->Modtablajq->delTablaUsers($arraypost['id']);
                if ($this->Modtablajq->delTablaUsers($arraypost['id'])) {
                     ///>LOG
                     $datlog = new datos_log($this->session->user_data['email'], 'Usuarios', 'DELETE', $this->input->get(), $this->input->post());
                     $this->load->model('Log_usuarios_model');
                     $this->Log_usuarios_model->addTablaLog($datlog);
                 } 
                 break;
       }

   }
    
}