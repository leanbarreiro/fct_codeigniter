<?php

function formato_dates($date) {
    
    $CI = & get_instance();
    $date = new DateTime($date);
    
    return $date->format('d/m/y h:m');
}