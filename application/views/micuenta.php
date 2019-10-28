
<section>

<div class="box">
    <h2 class="titulo">Datos de <?php echo $this->session->user_data['first_name'];?> <?php echo $this->session->user_data['last_name'];?></h2>

        <div class="contenido-box">
            <div class="box-item">
            <table border="1" width="2">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Nivel</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $this->session->user_data['first_name'];?></td>
                        <td><?php echo $this->session->user_data['last_name'];?></td>
                        <td><?php echo $this->session->user_data['email'];?></td>
                        <td><?php echo $this->session->user_data['nivel'];?></td>
                    </tr>
                </tbody>
            </table>
            </div>    
  

        <div class="box-item">
            <form id="myform" action="http://web/index.php/micuenta/cambiarpass" name="formupass" method="POST">
                <h3>Cambiar contraseña</h3>
                <span>Contraseña actual:</span>
                <input type="password" name="pass" id="pass"/>
                <br><br>
                <span>Repite contraseña:</span>
                <input type="password" name="repass" id="repass"/>
                <br><br>
                <span>Nueva contraseña:</span>
                <input type="password" name="newpass" id="newpass"/><br>
                <span> (De al menos 6 caracteres)</span>
                <br><br>
                <span id="error" style='color:red'></span>
                <br><br>
                <input id="btncam" type="submit" value="Cambiar" name="camsubmit" class="btn-small"/>
            </form>
        </div>
        </div>
</div>
</section>