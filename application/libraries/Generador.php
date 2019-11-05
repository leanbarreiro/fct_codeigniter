<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Generador de código de CodeIgniter 
 * @author Lebauz
 */
class Generador {
    
    //Variables
    private $bd;
    private $nombreDeLaBaseDeDatos;
    private $directorioDeSalida;
    private $fexhaYHora;
    private $encabezadoModelo;
    private $encabezadoControlador;
    private $encabezadoVista;
    private $tablasAIgnorar;
    
    //Constantes
    const AUTOR = "lebauz";
    const NOMBRE_COL_LLAVE_PRIMARIA = "id";
    const NUEVA_LINEA = "\n";
    const SUBFIJO_MODELO = "Model";
    
    //Constructor
    public function __construct($host, $usuario, $pass, $nombreDeLaBaseDeDatos, $directorioDeSalida = "generado") {
        
        $this->fexhaYHora = date("d-m-Y H:i:s");
        $this->directorioDeSalida = __DIR__.DIRECTORY_SEPARATOR.$directorioDeSalida.DIRECTORY_SEPARATOR;
        $this->prepararDirectorioDeSalida();
        $this->nombreDeLaBaseDeDatos = $nombreDeLaBaseDeDatos;
        $this->bd = new PDO("mysql:host=$host;dbname=$nombreDeLaBaseDeDatos", $usuario, $pass);
        $this->tablasAIgnorar = [];
    }
    
    //Set de tablas a ignorar
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
        
        //Propiedades 
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
        
        //Constructor, cargar BD
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
        
        
    }
    
    
}