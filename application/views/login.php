
<html>
    <head>
        <meta charset="utf-8">
	<title>- LOGIN -</title>
        <link rel="STYLESHEET" type="text/css" href="<?php base_url()?>/css/estilos.css"/> 
    </head>
    <body class="login">
        <div class="login">
            <section class='login_content'>
                    <?php echo validation_errors(); ?>
                    <?php echo form_open('login'); ?>
                    <h2 class="login_title">Login</h2>
                    <span>Usuario (e-mail):</span><br/>
                    <input type="email" name="email" /><br/>
                    <span>Contraseña:</span><br/>
                    <input type="password" name="password" /><br/>
                    <input type="submit" value="Entrar" name="submit" class="btn-login"/>
                    <?php echo form_close();?>
                    <?php session_destroy();?>
            </section>
        </div>
    </body>
</html>





    