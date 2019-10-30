<?php
    
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo de tabla con jqgrid
 * @package CI_Model
 * @subpackage Modtablajq
 * @author Lebauz
 */
class Ficha_usuario_model extends CI_Model {
    
    protected $tabla = 'usuarios';
    protected $fields = ['user_id', 'first_name', 'last_name', 'email', 'nivel', 'habilitado', 'ultimo_archivo_subido'];
     
    public function __construct() {
        parent::__construct(); 
        //Cargamos el modelo del log de usuarios
        $this->load->model('Log_usuarios_model');
    }
    
     /** Consulta los datos del usuario
     * @param String $id
     * @param String $tabla
     * @return Array de Strings
     */
    public function getDatosUsuario($id) {
        
        $consulta = "SELECT ". join(",",$this->fields) ." FROM usuarios WHERE user_id =".$id;
        $sql = $this->db->query($consulta);
             
        return $sql->result_array();  
    }
    
    /** Añade un registro en la tabla archivo y modifica la tabla usuarios añadiendo el nombre del archivo.
    * @param Array $data
    * @param Array $post
    */
    public function AddArchivoUsuario($data, $post) {
       
        //Comprobamos si existe la key 'success', si es así realizamos el INSERT en la tabla archivo
        if (array_key_exists('success', $data)) {
            if (is_array($data['success'])) { 
                    
                    $sql_archivo = "INSERT INTO archivo (nombre, nombre_origen, tipo, ruta, size, id_usuario) "
                                        . "VALUES ('".$data["success"]['file_name']."','".$data["success"]['client_name']."','"
                                        .$data["success"]['file_type']."','".$data["success"]['full_path']."','".$data["success"]['file_size']."','"
                                        .$post["user_id"]."' )";
                    $this->db->query($sql_archivo);
            }
        

/** Update para modificar usuario desde la ficha       
        $sql_usuarios = "UPDATE ".$this->tabla." SET first_name = '" .$post["first_name"]. "', last_name ='" .$post["last_name"]. 
            "', email ='" .$post["email"]. "', nivel ='" .$post["nivel"]. "', habilitado ='" .$post["habilitado"]. 
            "', ultimo_archivo_subido ='" .$data["success"]['client_name']."' Where user_id = " .$post['user_id'];
**/
        
        //Realizamos el update en la tabla de usuarios para registrar el nombre del ultimo archivo subido.
        $sql_usuarios = "UPDATE ".$this->tabla." SET ultimo_archivo_subido ='" .$data["success"]['client_name']."' Where user_id = " .$post['user_id'];
        
        $this->db->query($sql_usuarios);
        
        
        //LOG - creamos una instancia del objeto 'datos_log' y enviamos los datos a la función de añadir en la tabla.
        $datlog = new datos_log($this->session->user_data['email'], 'Tabla: "usuarios/ficha_usuario"', 'UPDATE', $this->input->post());
        $this->Log_usuarios_model->addTablaLogUsuarioFicha($datlog, $data);
        } else {
            echo "Error: al intentar guardar en la base de datos";
        }
        
         redirect('adminjq');
    }
} 
