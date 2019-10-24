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
   
function formatear_respuesta_menu($arrayrespuesta, $accion, $olddatos) {

    $strformateado = '';
    $accionformateada = substr("$accion", 3, -4);
    switch ($accionformateada) {
        case 'ADD':
            foreach ($arrayrespuesta as $key => $value) {
                        $strformateado .= '<span class="item_array"><b>'.$key.':</b>'.$value.'</span></br>';
                    }
            $strformateado .= '<span class="item_array"><b>new id:</b>'.$olddatos[0]['id'].'</span></br>';
            return $strformateado;
            break;
        case 'UPDATE':

                $resultado_comparacion = array_diff($arrayrespuesta, $olddatos[0]);

                 foreach ($resultado_comparacion as $key => $value) {
                        $strformateado .= '<span class="item_array"><b>campo:</b> '.$key.' <b>old:</b> '.$olddatos[0][$key].' <b>new:</b> '.$value.'</span></br>';
                    }
                 $strformateado .= '<span class="item_array"><b>id:</b>'.$olddatos[0]['id'].'</span></br>';
                 return $strformateado;

            break;
        case 'DELETE':
            foreach ($olddatos[0] as $key => $value) {
                        $strformateado .= '<span class="item_array"><b>'.$key.':</b>'.$value.'</span></br>';
                    }
            return $strformateado;
            break;
    }
}

function formatear_respuesta_usuarios($arrayrespuesta, $accion, $olddatos) {

    $strformateado = '';
    $accionformateada = substr("$accion", 3, -4);
    switch ($accionformateada) {
        case 'ADD':
            foreach ($arrayrespuesta as $key => $value) {
                        $strformateado .= '<span class="item_array"><b>'.$key.':</b>'.$value.'</span></br>';
                    }
            $strformateado .= '<span class="item_array"><b>new id:</b>'.$olddatos[0]['user_id'].'</span></br>';
            return $strformateado;
            break;
        case 'UPDATE':

                $resultado_comparacion = array_diff($arrayrespuesta, $olddatos[0]);

                 foreach ($resultado_comparacion as $key => $value) {
                        $strformateado .= '<span class="item_array"><b>campo:</b> '.$key.' <b>old:</b> '.$olddatos[0][$key].' <b>new:</b> '.$value.'</span></br>';
                    }
                 $strformateado .= '<span class="item_array"><b>id:</b>'.$olddatos[0]['user_id'].'</span></br>';
                 return $strformateado;

            break;
        case 'DELETE':
            foreach ($olddatos[0] as $key => $value) {
                        $strformateado .= '<span class="item_array"><b>'.$key.':</b>'.$value.'</span></br>';
                    }
            return $strformateado;
            break;
    }
}