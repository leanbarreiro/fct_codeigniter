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
                <span class="logo">FCT</span>
                <span class="sublogo">daw</span>
            </div>
            <div class="header-content">
               <label>Hola, </label>
                <p class="nomusu"><?php echo $this->session->user_data['first_name'];?></p>
                <p class="nomusu"><?php echo $this->session->user_data['last_name'];?></p>
                <p class="nivelusu">Nivel: <span><?php echo $this->session->user_data['nivel'];?></span></p>
                <a href="http://web/index.php/login"><input type="button" value="Salir" name="Salir" class="btn-small"/></a>
            </div>
        </div>
    </header>
    <div id="main">
