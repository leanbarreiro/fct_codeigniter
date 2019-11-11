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
//    private $tablasAIgnorar;
    
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
//        $this->tablasAIgnorar = [];
    }
    
/*    #Set de tablas a ignorar
    public function setTablasAIgnorar($tablas) {
        
        $this->tablasAIgnorar = $tablas;
    }*/
    
    /** Genera las clases
    * @param 
    * @return  String   
    */
    public function generar() {
        
        $tablas = $this->obtenerTablasDeLaBaseDeDatos();
        
        foreach ($tablas as $tabla) {
            if (!in_array(strtolower($tabla->nombre))) { 
                
                $nombreDelModelo = $this->crearModelo($tabla->nombre);
                $nombreDelControlador = $this->crearControlador($tabla->nombre, $nombreDelModelo);
                $this->crearVista($nombreDelControlador);
                echo "OK";
            } else {
                echo "\nIgnorando tabla " . $tabla->nombre;
            }
        }
    } /*** FIN generar() ***/
   
    /** Crea el modelo
    * @param String $nombreDeLaTabla
    * @return  String $nombreDelModelo
    */
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
    } /*** FIN crearModelo() ***/
    
    
    /** Crea el controlador
    * @param String $nombreDeLaTabla
    * @param String $nombreDelModelo
    * @return  String $nombreDeLaTabla
    */
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
        
        # Obtener como tabla 
        $codigo .= sprintf('
                        public function listar($pagina = 1){
                            $totalDeFilas = $this->%s->totalDeFilas();
                            $paginas = ceil( $totalDeFilas / DATOS_MOSTRAR_POR_PAGINA);
                            $this->load->view("encabezado");
                            $this->load->view("%s",
                                [
                                    "titulo" => "%s",
                                    "datos" => $this->%s->obtener($pagina),
                                    "paginaActual" => $pagina,
                                    "paginas" => $paginas,
                                ]
                            );
                            $this->load->view("pie");
                        }', $nombreDelModelo, $nombreDeLaTabla, ucfirst($nombreDeLaTabla), $nombreDelModelo);

        # Obtener como JSON
        $codigo .= sprintf('
                        public function json($pagina = 1){
                            echo json_encode($this->%s->obtener($pagina), JSON_NUMERIC_CHECK);
                        }', $nombreDelModelo);

        $argumentos = "";
        $argumentosUpdate = "";
        $arrayUpdate = "";
        $arrayInsert = "";

        $columnas = $this->obtenerColumnasDeTabla($nombreDeLaTabla);
        $numeroDeColumnas = count($columnas);
        foreach ($columnas as $indice => $columna) {
            $arrayUpdate .= sprintf('$this->input->post("%s")', $columna);
            if ($columna !== self::NOMBRE_COL_LLAVE_PRIMARIA) {
                $argumentos .= '$' . $columna;
                $arrayInsert .= sprintf('$this->input->post("%s")', $columna);
                if ($indice < $numeroDeColumnas - 1) {
                    $arrayInsert .= ",
            ";
                    $argumentos .= ", ";
                }
            }
            $argumentosUpdate .= '$' . $columna;
            if ($indice < $numeroDeColumnas - 1) {
                $argumentosUpdate .= ", ";
                $arrayUpdate .= ",
            ";
            }    
        }
        
        $nombreDeArchivo = $this->directorioDeSalida . "/controllers/" . ucfirst($nombreDeLaTabla) . ".php";
        $bytesEscritos = file_put_contents($nombreDeArchivo, $codigo);
        if ($bytesEscritos !== false) {
            return $nombreDeLaTabla;
        } else {
            throw new Exception("¡No se pudo escribir el controlador $nombreDeLaTabla!");
        }  
        
    } /*** FIN crearControlador() ***/
    
    
    /** Crea la vista
    * @param String $nombreDeLaTabla
    * @return  String $nombreDeLaTabla
    */
    private function crearVista($nombreDeLaTabla) {

/* VISTA        
        $codigo = "";

        $codigo .= '
            <h1 class="is-size-1"><?php echo $titulo; ?></h1>';
        $codigo .= sprintf('
            <div class="columns">
                <div class="column">
                    <a href="<?php echo base_url() ?>index.php/%s/agregar" class="button is-warning">Agregar</a>
                </div>
            </div>',
            $nombreDeLaTabla);

        $columnas = $this->obtenerColumnasDeTabla($nombreDeLaTabla);
        $numeroDeColumnas = count($columnas);

        $codigo .= '

            <div class="columns">
                <div class="column">
                    <table class="table is-bordered is-hoverable">
                        <thead>
                            <tr>';

        $encabezado = "";

        foreach ($columnas as $indice => $columna) {
            $encabezado .= '
                                <th>' . $columna . '</th>';
        }
        // Agregar edit y delete
        $encabezado .= '
                                <th>Editar</th>
                                <th>Eliminar</th>';

        #Concatenar encabezado
        $codigo .= $encabezado;

        $codigo .= '        </tr>
                        <thead>
                        <tbody>
                        <?php foreach($datos as $dato){ ?>
                            <tr>';
        foreach ($columnas as $indice => $columna) {
            $codigo .= '
                                <td>';
            $codigo .= sprintf('
                                    <?php echo $dato->%s; ?>
                                </td>', $columna);
        }

        #Agregar botones
        $codigo .= sprintf('
                                <td>
                                    <a href="<?php echo base_url() . "index.php/%s/editar/" . $dato->id ?>" class="button">
                                        <span class="icon">
                                        <i class="fa fa-edit has-text-info"></i>
                                        </span>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url() . "index.php/%s/eliminar/" . $dato->id ?>" class="button">
                                        <span class="icon">
                                        <i class="fa fa-trash has-text-danger"></i>
                                        </span>
                                    </a>
                                </td>',
            $nombreDeLaTabla, $nombreDeLaTabla);

        $codigo .= sprintf('
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <nav class="pagination is-rounded" role="navigation" aria-label="pagination">
                        <?php if($paginaActual > 1){ ?>
                            <a href="<?php echo base_url() ?>index.php/%s/listar/<?php echo $paginaActual - 1 ?>" class="pagination-previous">Anterior</a>
                        <?php } ?>
                        <?php if($paginaActual < $paginas){ ?>
                            <a href="<?php echo base_url() ?>index.php/%s/listar/<?php echo $paginaActual + 1 ?>" class="pagination-next">Siguiente</a>
                        <?php } ?>
                        <ul class="pagination-list">
                            <?php for ($numeroDePagina = 1; $numeroDePagina <= $paginas; $numeroDePagina++) { ?>
                                <li>
                                    <a href="<?php echo base_url() ?>index.php/%s/listar/<?php echo $numeroDePagina ?>"
                                       class="pagination-link <?php echo intval($paginaActual) === intval($numeroDePagina) ? "is-current" : "" ?>"
                                       aria-label="Ir a la página <?php echo $numeroDePagina ?>">
                                        <?php echo $numeroDePagina ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>', $nombreDeLaTabla, $nombreDeLaTabla, $nombreDeLaTabla);
        $codigo = sprintf('
    %s
    <div class="columns">
        <div class="column">
            <?php if (!empty($this->session->flashdata())): ?>
                <div class="notification <?php echo $this->session->flashdata("clase") ?>">
                    <?php echo $this->session->flashdata("mensaje") ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="columns">
        <div class="column">
        %s
        </div>
    </div>
',
            sprintf('<?php
%s
?>', $this->encabezadoVista), $codigo); */
        
        $nombreDeArchivo = $this->directorioDeSalida . "/views/" . $nombreDeLaTabla . ".php";
        $bytesEscritos = file_put_contents($nombreDeArchivo, $codigo);
        if ($bytesEscritos !== false) {
            return $nombreDeLaTabla;
        } else {
            throw new Exception("¡No se pudo escribir la vista $nombreDeLaTabla!");
        }
    } /*** FIN crearVista() ***/
    
    
    /** Prepara los encabezados para el modelo, el controlador y la vista 
    * @param 
    * @return    
    */
    private function prepararEncabezados() {
        $this->encabezadoModelo = sprintf('
        /*
            Modelo de CodeIgniter generado por un script programado por %s
            Fecha y hora de generación: %s
        */

        ', self::AUTOR, $this->fechaYHora);

        $this->encabezadoControlador = sprintf('
        /*
            Controlador de CodeIgniter generado por un script programado por %s
            Fecha y hora de generación: %s
        */

        ', self::AUTOR, $this->fechaYHora);

        $this->encabezadoVista = sprintf('
        /*
            Vista de CodeIgniter generada por un script programado por %s
            Fecha y hora de generación: %s
        */

        ', self::AUTOR, $this->fechaYHora);
    } /*** FIN prepararEncabezados() ***/
    
    
    /** Prepara y crea el directorio de salida.
    * @param 
    * @return    
    */
    private function prepararDirectorioDeSalida() {
        
        if (is_dir($this->directorioDeSalida)) {
            $this->eliminarDirectorioYSuContenido($this->directorioDeSalida);
        }
        
        mkdir($this->directorioDeSalida);
        mkdir($this->directorioDeSalida . "models");
        mkdir($this->directorioDeSalida . "controllers");
        mkdir($this->directorioDeSalida . "views");
        
    } /*** FIN prepararDirectorioDeSalida() ***/
    
    
    /** Consulta las tablas de la base de datos.
    * @param 
    * @return  Object bd 
    */
    private function obtenerTablasDeLaBaseDeDatos() {
        
        return $this
            ->bd
            ->query("SELECT table_name AS nombre FROM information_schema.tables WHERE table_schema = '" . $this->nombreDeLaBaseDeDatos . "';")
            ->fetchAll(PDO::FETCH_OBJ);       
    } /*** FIN obtenerTablasDeLaBaseDeDatos() ***/

    
    /** Consulta las columnas de la tabla.
    * @param String $tabla
    * @return  Object bd   
    */
    private function obtenerColumnasDeTabla($tabla) {
        
        return $this
            ->bd
            ->query("SELECT COLUMN_NAME AS columna
                FROM information_schema.columns
                WHERE table_schema = '" . $this->nombreDeLaBaseDeDatos . "'
                AND TABLE_NAME = '" . $tabla . "'")
            ->fetchALL(PDO::FETCH_COLUMN);       
    } /*** FIN obtenerColumnasDeTabla() ***/

    
   /* public function obtenerColumnasDeTablaParaFormulario($tabla) {
        
        return $this
            ->bd
            ->query("SELECT COLUMN_NAME AS columna, DATA_TYPE AS tipoDeDato
                FROM information_schema.columns WHERE table_schema = '" . $this->nombreDeLaBaseDeDatos . "'
                AND TABLE_NAME = '$tabla'")
            ->fetchALL(PDO::FETCH_OBJ);    
    } /*** FIN obtenerColumnasDeTablaParaFormulario() ***/

    
    /** Elimina los directorios y su contenido.
    * @param String $directorio
    * @return  boolean   
    * @return  continue  
    * @return  instruccion rmdir($directorio)  
    */
    private function eliminarDirectorioYSuContenido($directorio) {
        
        if (!file_exists($directorio)) {
            return true;
        }

        if (!is_dir($directorio)) {
            return unlink($directorio);
        }

        foreach (scandir($directorio) as $elementoActual) {
            if ($elementoActual == '.' || $elementoActual == '..') {
                continue;
            }

            if (!$this->eliminarDirectorioYSuContenido($directorio . DIRECTORY_SEPARATOR . $elementoActual)) {
                return false;
            }

        }
        return rmdir($directorio);
    } /*** FIN eliminarDirectorioYSuContenido() ***/
    
}