<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador del log de tabla "menu"
 * @package My_Controller
 * @subpackage Log_menu
 * @author Lebauz
 */

class Log_menu extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        
        //Carga el modelo
        $this->load->model("Log_menu_model");
    }

    public function index() {
        
        //Carga la vista y la enviamos al controlador principal
        $str = $this->load->view('log_menu','',TRUE);
        $this->cargaTemplate($str);
    }
    
    /**Carga los datos en la tabla de logs.
    * @param
    * @return JSON
    * Pide los datos a la db y los carga en la tabla.     
    */
    public function cargarDatosLogMenu() {
               
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
            $sql = $this->Log_menu_model->getSearchLogMenu($sField,$sString,$sOper);
            
            //Calculamos el número de items
            $count = count($sql);
    
        } elseif ($search === "false") {  
            
            // Pedimos los datos a la db
            $sql = $this->Log_menu_model->getTablaLogMenu($sidx, $sord, $start, $limite);          
            //Consultamos el número de items
            $numitems = $this->Log_menu_model->getNumItemsLogMenu();
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
            $respuesta->rows[$key]['cell'] = array($row["id"],$row["usuario"],$row["seccion"],$row['accion'],$row['cambios'],$row['fecha']);
        }
        
       //Códificamos a JSON
        echo json_encode($respuesta);
    }
    
    /**Gestiona el crud de la tabla logs.
    * @param
    * @return JSON
    * Busca, añade, modifica y borra.     
    */
    public function gestionTablaLogMenu() {
 
/*
//       //Recogemos los datos del post usando los filtros XSS 
//       $arraypost = $this->input->post(array('id','nombre','url','descripcion','acceso') ,TRUE);
//       $oper = $this->input->post('oper', TRUE);
//   
//       //Administra la llamada a las funciones dependiendo del valor del $oper
//       switch ($oper) {
//           case 'add':
//                $this->Modtablajq->addTablaMenu($arraypost);
//                 break;
//           case 'edit':
//                $this->Modtablajq->editTablaMenu($arraypost);
//                 break;
//           case 'del':
//                $this->Modtablajq->delTablaMenu($arraypost['id']);
//                 break;
//       }
*/ 
        
    }
}