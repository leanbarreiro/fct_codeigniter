<?php

defined('BASEPATH') OR exit('No se permite el acceso directo al script');

class usuario {
    
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $password;
    protected $nivel;
    protected $habilitado;
    
    public function __construct() {
        
        $this->first_name = $this->session->user_data['first_name'];
        $this->last_name = $this->session->user_data['last_name'];
        $this->email = $this->session->user_data['email'];
        $this->password = $this->session->user_data['password'];
        $this->nivel = $this->session->user_data['nivel'];
        $this->habilitado = $this->session->user_data['habilitado'];
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

