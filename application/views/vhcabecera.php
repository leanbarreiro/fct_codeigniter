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
               <span>Hola, </span>
                <p class="nomusu"><?php echo $this->session->user_data['first_name'];?></p>
                <p class="nomusu"><?php echo $this->session->user_data['last_name'];?></p>
                <hr>
                <p class="nivelusu">Rol: <span><?php echo $this->session->user_data['nivel'];?></span></p>
                <p class="nivelusu">Inicio de sesión: <span><?php if($this->session->user_data['data_login']['hours'] < 10){echo str_pad($this->session->user_data['data_login']['hours'], 2, "0", STR_PAD_LEFT) + 2;} else {echo $this->session->user_data['data_login']['hours']+2;};?>:
                                                             <?php if($this->session->user_data['data_login']['minutes'] < 10){echo str_pad($this->session->user_data['data_login']['minutes'], 2, "0", STR_PAD_LEFT);} else {echo $this->session->user_data['data_login']['minutes'];};?>:
                                                             <?php if($this->session->user_data['data_login']['seconds'] < 10){echo str_pad($this->session->user_data['data_login']['seconds'], 2, "0", STR_PAD_LEFT);} else {echo $this->session->user_data['data_login']['seconds'];};?></span></p>
                <a href="http://web/index.php/login"><input type="button" value="Salir" name="Salir" class="btn-small"/></a>
            </div>
        </div>
    </header>
    <div id="main">
