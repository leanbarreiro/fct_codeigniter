
<html>
    <head>
        <meta charset="utf-8">
	<title>- LOGIN -</title>
        <link rel="STYLESHEET" type="text/css" href="<?php base_url()?>/css/estilos.css"/> 
    </head>
    <body class="login">
        <section class='login_content'>
                <?php echo validation_errors(); ?>
                <?php echo form_open('login'); ?>
                <h2 class="login__title">Login</h2>
                <span>Usuario (e-mail):</span>
                <input type="email" name="email" /><br/>
                <span>Contraseña:</span>
                <input type="password" name="password" />
                <input type="submit" value="Entrar" name="submit" class="btn-login"/>
                <?php echo form_close();?>
                <?php session_destroy();?>
        </section>
    </body>
</html>





    