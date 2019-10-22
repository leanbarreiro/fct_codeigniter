<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class datos_log {
    
    protected $usuario;
    protected $seccion;
    protected $accion;
    protected $respuestaget;
    protected $respuestapost;
    protected $fecha;

    public function __construct($usuario = NULL, $seccion = NULL, $accion = NULL,
                                $respuestaget = NULL, $respuestapost = NULL, $fecha = NULL) {
        
        $this->usuario = $usuario;
        $this->seccion = $seccion;
        $this->accion = $accion;
        $this->respuestaget = $respuestaget;
        $this->respuestapost = $respuestapost;
        $this->fecha = $fecha;     
    }
    
    public function __get($propiedad) {
        if(property_exists($this, $propiedad)) {
            return $this->$propiedad;
        }
    }
    
    public function __set($propiedad, $valor) {
        if(property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        }
    }
}

