<?php

/**
 * Formatea la hora 
 * @package 
 * @subpackage fecha_formateada
 * @author Lebauz
 */
function fecha_formateada() {
    
    $dactual = getdate();
    
    if ($dactual['hours'] < 10) {
        $hora = '0'.$dactual['hours'];
    } else {
        $hora = $dactual['hours'];
    }
  
    if ($dactual['minutes'] < 10) {
        $minutos = '0'.$dactual['minutes'];
    } else {
        $minutos = $dactual['minutes'];
    }
  
    if ($dactual['seconds'] < 10) {
        $segundos = '0'.$dactual['seconds'];
    } else {
        $segundos = $dactual['seconds'];
    }
  
    
    $respuesta = $dactual['mday']."/".$dactual['mon']."/".$dactual['year']." ".$hora.":".$minutos.":".$segundos;
    
    return $respuesta;
}

/**
 * Formatea la respuesta para la columna "cambios" de los logs
 * @param Array $arrayrespuesta, String $accion, Array $olddatos
 * @return String $str
 * @subpackage formatear_respuesta
 * @author Lebauz
 */
function formatear_respuesta($arrayrespuesta, $accion, $olddatos) {

    $str = '';
    switch ($accion) {
        case 'ADD':
            foreach ($arrayrespuesta as $key => $value) {
                if ($key != 'oper' && $key != 'id') { 
                    $str .= $key.':'.$value.';';
                }
            }
            $str .= 'id:'.$olddatos[0]['id'];
            return $str;
            break;
        case 'UPDATE':

                $resultado_comparacion = array_diff($arrayrespuesta, $olddatos[0]);

                foreach ($resultado_comparacion as $key => $value) {
                    if ($key != 'oper' && $key != 'id' && $key != 'submit' ) { 
                        $str .= $key.':'.$olddatos[0][$key].'->'.$value.';';
                    }
                }
                if (array_key_exists('id', $olddatos[0])) {
                    $str .= 'id:'.$olddatos[0]['id'];
                }
                if (array_key_exists('user_id', $olddatos[0])) {
                    $str .= 'id:'.$olddatos[0]['user_id'];
                }
//                if (array_key_exists('archivo', $file)) {
//                    $str .= 'archivo: '.$file['archivo']['name'];
//                }
                return $str;

            break;
        case 'DELETE':
            foreach ($olddatos[0] as $key => $value) {
                    $str .= $key.':'.$value.';';
            }
            return $str;
            break;
    }
}

/**
 * Genera un string random
 * @param int $length
 * @return String 
 * @subpackage RandomString
 * @author Lebauz
 */
function RandomString($length = 10) { 
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
} 
