<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminjq extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model("Modtablajq");
    }

    public function index() {
        
        $str = $this->load->view('tabla/tablajq','',TRUE);
        $this->cargaTemplate($str);
    }
    
    public function cargarDatosTabla() {
        
        $returnData = array();
        
        $page = $_GET['page'];  //Obtenemos la página solicitada
        $limit = $_GET['rows']; //Obtenemos el número de filas  para la cuadricula
        $sidx = $_GET['sidx'];  //Obtenemos fila de índice (clic del usu para ordenar)
        $sord = $_GET['sord'];  //Obtener la dirección
        
        $start = $limit*$page - $limit;
    
        if (!$sidx) { //Si el índice es false le damos le valor de 1
            $sidx = 1; 
        }
        
        /**Filtro de Busqueda**/
        
        $search = $_GET['_search'];
   
        if ($search === "true") { /*Si buscamos datos especificos*/
            
            $sField = $_GET['searchField'];
            $sString = $_GET['searchString'];
            $sOper = $_GET['searchOper'];
            
            $sql = $this->Modtablajq->getItemsSearch($sField, $sString, $sOper);

            $count = count($sql);
     
        } elseif ($search === "false") { /*Si se carga la tabla entera*/
            
            $sql = $this->Modtablajq->getTabla($sidx, $sord, $start, $limit); // Pesimos los datos a la db
            $numitems = $this->Modtablajq->getNumItems();
            $count = ($numitems[0]['count']);                                  
        } 
            
        /**********************/
        
        if( $count > 0 ) {                       //Comprobamos si el número de registros es mayor que 0
            $total_pages = ceil($count/$limit); //Si es así, calculamos el número de páginas
        } else {
            $total_pages = 0;                   //Si no, lo ponemos a 0
        }

        if ($page > $total_pages) {
            $page = $total_pages;
        }
        
//        $start = $limit*$page - $limit;
     
        $returnData += ['page' => $page];
        $returnData += ['total' => $total_pages];
        $returnData += ['records' => $count];
        
        $respuesta = new stdClass();
        $respuesta->page = $page;
        $respuesta->total = $total_pages;
        $respuesta->records = $count;
        
        $i=0;
        foreach ($sql as $key => $row) {
            $respuesta->rows[$i]['id']=$row["id"];
            $respuesta->rows[$i]['cell'] = array($row["id"],$row["nombre"],$row["url"]);
            $i++;
        }
       
        echo json_encode($respuesta);
         
    }
    
    public function gestionTablaMenu() {
        
       if (!empty($_POST['Nombre']) && !empty($_POST['Url']) && isset($_POST['Nombre']) && isset($_POST['Url']) ) {
           
           $datanew = $_POST; 
           
            switch ($_POST['oper']) {
                case 'add':                 /*Añadir*/                            
                    $this->Modtablajq->addTablaMenu($datanew);
                    break;
                case 'edit':                /*Modificar*/          
                    $this->Modtablajq->editTablaMenu($datanew);
                    break;
                case 'del':                 /*Borrar*/           
                    $this->Modtablajq->delTablaMenu($datanew);
                    break;
            }
       }
//       } elseif( !empty($_POST['Id']) && isset($_POST['Id'])) {
//           switch ($_POST['oper']) {
//               case 'del':                 /*Borrar*/           
//                    $this->Modtablajq->delTablaMenu($datanew);
//                    break;
//            }  
//       }
    }  
}