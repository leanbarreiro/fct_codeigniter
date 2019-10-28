
<section>
   <div class="form-usu">
        <div class="centra-contenido">
            <?php echo validation_errors(); ?>
            <?php echo form_open('ficha_usuario'); ?>
            <h2 class="login_title">Ficha de Usuario</h2>
            <ul class="wrapper">
                <li class="form-row">
                  <label for="user_id">Id</label>
                  <input type="text" name="user_id" id="user_id" value="<?php echo $datos[0]['user_id'];?>" readonly="true"/>
                </li>
                <li class="form-row">
                  <label for="first_name">Primer nombre</label>
                  <input type="text" name="first_name" id="first_name" value="<?php echo $datos[0]['first_name'];?>"/><br/>
                </li>
                <li class="form-row">
                  <label for="last_name">Segundo nombre</label>
                  <input type="text" name="last_name" id="last_name" value="<?php echo $datos[0]['last_name'];?>"/><br/>
                </li>
                <li class="form-row">
                  <label for="email">E-mail</label>
                  <input type="text" name="email" id="email" value="<?php echo $datos[0]['email'];?>"/><br/>
                </li>
                <li class="form-row">
                  <label for="nivel">Nivel</label>
                  <input type="text" name="nivel" id="nivel" value="<?php echo $datos[0]['nivel'];?>"/><br/>
                </li>
                <li class="form-row">
                  <label for="habilitado">Habilitado</label>
                  <input type="text" name="habilitado" id="habilitado" value="<?php echo $datos[0]['habilitado'];?>"/><br/>
                </li>

                <li class="form-row">
                  <input type="submit" value="Enviar" name="submit" class="btn-ficha"/>
                </li>
              </ul>
            <?php echo form_close();?>
            <?php session_destroy();?>
        </div>
    </div>

</section>

