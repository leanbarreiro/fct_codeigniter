<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador Admin jqgrid
 * @package My_Controller
 * @subpackage Adminjq
 * @author Lebauz
 */
class Adminjq extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        
        //Carga de modelos
        $this->load->model("Adminjq_model");
        $this->load->model("Usuarios_model");
        $this->load->model('LogMenu_model');
        $this->load->model('LogUsuarios_model');
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

        //Comprobamos $_GET['_search'],si es true se realializa una busqueda especifica ó si es false cargamos la tabla entera
        if ($search === "true") { 
            
            $sField = $this->input->get('searchField', TRUE);
            $sString = $this->input->get('searchString', TRUE);
            $sOper = $this->input->get('searchOper', TRUE);
            
            //Pedimos los datos a la db
            $sql = $this->Adminjq_model->getItemsSearch($sField,$sString,$sOper);
            
            //Calculamos el número de items
            $count = count($sql);
  
        } elseif ($search === "false") {  
            
            // Pedimos los datos a la db
            $sql = $this->Adminjq_model->getTabla($sidx, $sord, $start, $limite);
            
            /**Uso de la función general de consultas
            $sql = $this->Adminjq_model->generalSelect($colum=['id', 'nombre', 'url', 'descripcion', 'acceso', 'habilitado'], 
                                                    "menu", 
                                                    true, 
                                                    "habilitado = 1", 
                                                    true, 
                                                    $order=[$sidx, $sord], 
                                                    true, 
                                                    $limit=[$start, $limite]);
            */

            //Consultamos el número de items
            $numitems = $this->Adminjq_model->getNumItems();
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
                //Consultamos el ultimo id insertado
                $ultimoid = $this->LogMenu_model->getUltimoId('menu');

                if ($this->Adminjq_model->addTablaMenu($arraypost)) {

                    //LOG - creamos una instancia del objeto 'datos_log' y enviamos los datos a la función de añadir en la tabla.
                    $datlog = new datos_log($this->session->user_data['email'], 'Tabla: "menu"', 'ADD', $this->input->post());
                    $this->LogMenu_model->addTablaLogMenu($datlog, $ultimoid);
                }                
                 break;
            case 'edit':

                $arraydatosold = $this->Adminjq_model->getDatosActuales($arraypost['id'],'menu');

                $diferencia = array_diff($arraydatosold[0], $arraypost);

                if (!empty($diferencia)) {

                    if ($this->Adminjq_model->editTablaMenu($arraypost)) {

                        //LOG - creamos una instancia del objeto 'datos_log' y enviamos los datos a la función de añadir en la tabla.
                        $datlog = new datos_log($this->session->user_data['email'], 'Tabla: "menu"', 'UPDATE', $this->input->post());
                        $this->LogMenu_model->addTablaLogMenu($datlog, $arraydatosold);
                    } 
                }
                break;
            case 'del':

                $arraydatosold = $this->Adminjq_model->getDatosActuales($arraypost['id'],'menu');

                if ($this->Adminjq_model->delTablaMenu($arraypost['id'])) {

                    //LOG - creamos una instancia del objeto 'datos_log' y enviamos los datos a la función de añadir en la tabla.
                    $datlog = new datos_log($this->session->user_data['email'], 'Tabla: "menu"', 'DELETE', $this->input->post());
                    $this->LogMenu_model->addTablaLogMenu($datlog, $arraydatosold);
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
        
        //Comprobamos $_GET['_search'],si es true se realializa una busqueda especifica ó si es false cargamos la tabla entera
        if ($search === "true") { 
            
            $sField = $this->input->get('searchField', TRUE);
            $sString = $this->input->get('searchString', TRUE);
            $sOper = $this->input->get('searchOper', TRUE);
            
            //Pedimos los datos a la db
            $sql = $this->Usuarios_model->getItemsSearchUsers($sField,$sString,$sOper);
            //Calculamos el número de items
            $count = count($sql);
    
        } elseif ($search === "false") {  
            
            //Pedimos los datos a la db
            $sql = $this->Usuarios_model->getTablaUsers($sidx, $sord, $start, $limite);          
            //Consultamos el número de items
            $numitems = $this->Usuarios_model->getNumItemsUsers();
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
            $respuesta->rows[$key]['cell'] = array($row["user_id"],$row["first_name"],$row["last_name"],$row['email'],$row['nivel'],$row['ultimo_archivo_subido']);
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
        $arraypost = $this->input->post(array('user_id','first_name','last_name','email','nivel') ,TRUE);
       
        $id = $this->input->post('id', TRUE);
        $oper = $this->input->post('oper', TRUE);

   
       //Administra la llamada a las funciones dependiendo del valor de $oper que viene por POST
        switch ($oper) {
            case 'add':
                //Consultamos el ultimo id insertado
                $ultimoid = $this->LogUsuarios_model->getUltimoID('usuarios');

                if ($this->Usuarios_model->addTablaUsers($arraypost)) {

                     //LOG - creamos una instancia del objeto 'datos_log' y enviamos los datos a la función de añadir en la tabla.
                     $datlog = new datos_log($this->session->user_data['email'], 'Tabla: "usuarios"', 'ADD', $this->input->post());
                     $this->LogUsuarios_model->addTablaLogUsuarios($datlog, $ultimoid);
                } 

                break;
           case 'edit':
               
                $arraydatosold = $this->Usuarios_model->getDatosActuales($id,'usuarios');
               
                $diferencia = array_diff($arraydatosold[0], $arraypost);
               
                if (!empty($diferencia)) {
               
                    if ($this->Usuarios_model->editTablaUsers($arraypost, $id)) {

                        //LOG - creamos una instancia del objeto 'datos_log' y enviamos los datos a la función de añadir en la tabla.
                        $datlog = new datos_log($this->session->user_data['email'], 'Tabla: "usuarios"', 'UPDATE', $this->input->post());
                        $this->LogUsuarios_model->addTablaLogUsuarios($datlog, $arraydatosold);
                    }
                }
                 break;
           case 'del':
               /**/
                $id_post = $this->input->post('id', TRUE);
                $arraydatosold = $this->Usuarios_model->getDatosActuales($id_post,'usuarios');
               
                if ($this->Usuarios_model->delTablaUsers($id_post)) {

                    //LOG - creamos una instancia del objeto 'datos_log' y enviamos los datos a la función de añadir en la tabla.
                    $datlog = new datos_log($this->session->user_data['email'], 'Tabla: "usuarios"', 'DELETE', $this->input->post());
                    $this->LogUsuarios_model->addTablaLogUsuarios($datlog, $arraydatosold);
                }                          
                break;
       }

   }
    
}