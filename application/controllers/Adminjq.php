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
    
        
        if (!$sidx) { //Si el índice es falso le damos le valor de 1
            $sidx = 1; 
        }
        
        //Pedimos los datos 
        $numitems = $this->Modtablajq->getNumItems();
        
        $count = ($numitems[0]['count']);
        
        if( $count > 0 ) {                       //Comprobamos si el número de registros es mayor que 0
            $total_pages = ceil($count/$limit); //Si es así, calculamos el número de páginas
        } else {
            $total_pages = 0;                   //Si no, lo ponemos a 0
        }

        if ($page > $total_pages) {
            $page = $total_pages;
        }
        
        $start = $limit*$page - $limit;
        
        $sql = $this->Modtablajq->getTabla();   // Pesimos los datos a la db
        
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
}