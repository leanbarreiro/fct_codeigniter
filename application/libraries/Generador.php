<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Generador de código de CodeIgniter 
 * @author Lebauz
 */
class Generador {
    
    #Variables
    private $bd;
    private $nombreDeLaBaseDeDatos;
    private $directorioDeSalida;
    private $fexhaYHora;
    private $encabezadoModelo;
    private $encabezadoControlador;
    private $encabezadoVista;
    private $tablasAIgnorar;
    
    #Constantes
    const AUTOR = "lebauz";
    const NOMBRE_COL_LLAVE_PRIMARIA = "id";
    const NUEVA_LINEA = "\n";
    const SUBFIJO_MODELO = "Model";
    
    #Constructor
    public function __construct($host, $usuario, $pass, $nombreDeLaBaseDeDatos, $directorioDeSalida = "generado") {
        
        $this->fexhaYHora = date("d-m-Y H:i:s");
        $this->directorioDeSalida = __DIR__.DIRECTORY_SEPARATOR.$directorioDeSalida.DIRECTORY_SEPARATOR;
        $this->prepararDirectorioDeSalida();
        $this->nombreDeLaBaseDeDatos = $nombreDeLaBaseDeDatos;
        $this->bd = new PDO("mysql:host=$host;dbname=$nombreDeLaBaseDeDatos", $usuario, $pass);
        $this->tablasAIgnorar = [];
    }
    
    #Set de tablas a ignorar
    public function setTablasAIgnorar($tablas) {
        
        $this->tablasAIgnorar = $tablas;
    }
    
    /** Genera las clases
    * @param 
    * @return     
    */
    public function generar() {
        
        $tablas = $this->obtenerTablasDeLaBaseDeDatos();
        
        foreach ($tablas as $tabla) {
            if (!in_array(strtolower($tabla->nombre), $tabla->tablasAIgnorar)) {
                
                $nombreDelModelo = $this->crearModelo($tabla->nombre);
                $nombreDelControlador = $this->crearControlador($tabla->nombre, $nombreDelModelo);
                $this->crearVistaParaMostrarDatos($nombreDelControlador);
                $this->crearVistaDeFormularioParaInsertar($nombreDelControlador);
                $this->crearVistaDeFormularioParaEditar($nombreDelControlador);
                echo "OK";
            } else {
                echo "\nIgnorando tabla " . $tabla->nombre;
            }
        }
    }
    
    public function crearModelo($nombreDeLaTabla) {
        
        $nombreDeLaTabla = $nombreDeLaTabla.self::SUBFIJO_MODELO;
        
        #Propiedades 
        $argumentos = "";
        $argumentosUpdate = "";
        $arrayUpdate = "[";
        $arrayInsert = "[";
        
        $columnas = $this->obtenerColumnasDeTabla($nombreDeLaTabla);
        $numeroDeColumnas = count($columnas);
        $miembros = "";
        
        foreach ($columnas as $indice => $columna) {
            $miembros .= sprintf('private $%s;', $columna);
            if ($columna !== self::NOMBRE_COL_LLAVE_PRIMARIA) {
                $argumentos .= '$' . $columna;
                $arrayInsert .= sprintf('"%s" => $%s,', $columna, $columna);
                $arrayUpdate .= sprintf('"%s" => $%s,', $columna, $columna);
                if ($indice < $numeroDeColumnas - 1) {
                    $argumentos .= ", ";
                }
            }
            $argumentosUpdate .= '$' . $columna;
            if ($indice < $numeroDeColumnas - 1) {
                $argumentosUpdate .= ", ";
            }
        }
        $arrayInsert .= "]";
        $arrayUpdate .= "]";
        $miembros .= "";     
        
        #Constructor, cargar BD
        $codigo = sprintf('
            <?php
            %s
            class %s extends CI_Model{
                %s
                public function __construct(){
                    parent::__construct();
                    $this->load->database();
                }
            ', $this->encabezadoModelo, $nombreDelModelo, $miembros);
        
        
        #INSERT (crud)
        $codigo .= sprintf(' 
                    public funtion insertar(%s) {
                        return $this->db->insert("%s", %s);
                    }', $argumentos, $nombreDeLaTabla, $arrayInsert);
        
        $codigo .= sprintf('  
                        public function obtener($pagina = 1) {
                            if(intval($pagina) === 1) {
                                $pagina = 0;
                            } else {
                                $pagina--;
                            }
                            return $this->db->get("%s", DATOS_MOSTRAR_POR_PAGINA, $pagina * DATOS_MOSTRAR_POR_PAGINA)->result();
                        }', $nombreDeLaTabla);
        
        #TOTAL DE FILAS
        $codigo .= sprintf('
                    public function totalDeFilas() {
                        return $this->db->count_all("%s");
                    }', $nombreDeLaTabla);
        
        #OBTENER POR ID
        $codigo .= sprintf('
            public function porId($id){
                return $this->db->get_where("%s", ["id" => $id])->row();
            }', $nombreDeLaTabla);

        #UPDATE (crud)
        $codigo .= sprintf('
            public function guardarCambios(%s){
                $datos = %s;
                return $this->db->update("%s", $datos, ["%s" => $%s]);
            }', $argumentosUpdate, $arrayUpdate, $nombreDeLaTabla, self::NOMBRE_COL_LLAVE_PRIMARIA, self::NOMBRE_COL_LLAVE_PRIMARIA);
        
       #DELETE (crud)
        $codigo .= sprintf('
            public function eliminar($%s){
                return $this->db->delete("%s", ["%s" => $%s]);
            }', self::NOMBRE_COL_LLAVE_PRIMARIA, $nombreDeLaTabla, self::NOMBRE_COL_LLAVE_PRIMARIA, self::NOMBRE_COL_LLAVE_PRIMARIA);

        $codigo .= '
    }
    ?>';

        $nombreDeArchivo = $this->directorioDeSalida . "models/" . ucfirst($nombreDelModelo) . ".php";
        $bytesEscritos = file_put_contents($nombreDeArchivo, $codigo);
        if ($bytesEscritos !== false) {
            return $nombreDelModelo;
        } else {
            throw new Exception("No se pudo escribir el modelo $nombreDelModelo!");
        }   
    }
    
    
    private function crearControlador($nombreDeLaTabla, $nombreDelModelo) {
        
        $codigo = sprintf("<?php
            %s", $this->encabezadoControlador);
        
        $codigo .= "class $nombreDeLaTabla extends CI_Controller {";
        
        #CONTRUCTOR
        $codigo .= sprintf('
                        public function __construct(){
                        parent::__construct();
                        $this->load->model("%s");
                    }', $nombreDelModelo);
        
        #INDEX
        $codigo .= sprintf('
                        public function index(){
                            $this->listar(1);
                        }', $nombreDeLaTabla, $nombreDeLaTabla, $nombreDelModelo, $nombreDelModelo);
  
    }
    
    
}