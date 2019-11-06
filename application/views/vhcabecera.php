<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>- APP -</title>             
        <link rel="stylesheet" type="text/css" media="screen" href="<?php base_url()?>/css/ui.jqgrid.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php base_url()?>/css/redmond/jquery-ui.css" />
        <!--<link rel="STYLESHEET" type="text/css" href="<?php base_url()?>/bootstrap-4.3.1/css/bootstrap.min.css"/>-->
        <!--<link rel="STYLESHEET" type="text/css" href="<?php base_url()?>/css/ui.jqgrid-bootstrap4.css"/>-->
        <link rel="icon" href="https://img.icons8.com/plasticine/100/000000/puzzle.png" type="image/png">
        <link rel="STYLESHEET" type="text/css" href="<?php base_url()?>/css/estilos.css"/>
        
</head>
<body>
    <header>
        <div class="header-padre">
            <div class="header-content">
                <a class="link-logo" href="http://web/index.php/home">
                    <span class="logo">FCT</span>
                    <span class="sublogo">daw</span>
                </a>
            </div>
            <div class="header-content">
                <p class="nivelusu">Rol: <span><?php echo $this->session->user_data['nivel'];?></span></p>
                <p class="nivelusu">Sesión: <span><?php echo $this->session->user_data['data_login'];?></span></p>
                <hr> 
                <span>Hola, </span>
                <p class="nomusu"><?php echo $this->session->user_data['first_name'];?></p>
                <p class="nomusu"><?php echo $this->session->user_data['last_name'];?></p>
                <a href="http://web/index.php/login/log_logout"><input type="button" value="Salir" name="Salir" class="btn-small"/></a>
            </div>
        </div>
    </header>
    <div id="main">
