<?php

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

function formatear_respuesta($arrayrespuesta) {
    $strformateado = '';
        foreach ($arrayrespuesta as $key => $value) {
            $strformateado .= '<span class="item_array"><b>'.$key.':</b>'.$value.'</span></br>';
        }
        return $strformateado;
    }
   