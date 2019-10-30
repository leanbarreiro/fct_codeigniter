
<section>
   <div class="form-usu">
        <div class="centra-contenido">
            <?php echo $error = ''; ?>
            <?php //  echo form_open_multipart('Ficha_usuario/do_upload'); ?>
             <form action="ficha_usuario/cargar_archivo" method="post" enctype="multipart/form-data">
            <h2 class="ficha_title">Ficha de Usuario</h2>
            <ul class="wrapper">
                <li class="form-row">
                  <label for="user_id">Id</label>
                  <input type="text" name="user_id" id="user_id" value="<?php echo($user_id); ?>" readonly="true"/>
                </li>
                <li class="form-row">
                  <label for="first_name">Primer nombre</label>
                  <input type="text" name="first_name" id="first_name" value="<?php echo($first_name); ?>" readonly="true"/><br/>
                </li>
                <li class="form-row">
                  <label for="last_name">Segundo nombre</label>
                  <input type="text" name="last_name" id="last_name" value="<?php echo($last_name); ?>" readonly="true"/><br/>
                </li>
                <li class="form-row">
                  <label for="email">E-mail</label>
                  <input type="text" name="email" id="email" value="<?php echo($email); ?>" readonly="true"/><br/>
                </li>
                <li class="form-row">
                  <label for="nivel">Nivel</label>
                  <input type="text" name="nivel" id="nivel" value="<?php echo($nivel); ?>" readonly="true"/><br/>
                </li>
                <li class="form-row">
                  <label for="habilitado">Habilitado</label>
                  <input type="text" name="habilitado" id="habilitado" value="<?php echo($habilitado); ?>" readonly="true"/><br/>
                </li>
                <li class="form-row">
                  <label for="archivo">Subir archivo</label>
                  <input class="file" type="file" name="mi_archivo" id="upload" value=""/><br/>
                </li>

                <li class="form-row">
                  <input type="submit" value="subir" name="submit" class="btn-ficha"/>
                </li>
              </ul>
             </form>
            <?php // echo form_close();?>
        </div>
    </div>

</section>

