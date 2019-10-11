
<div class="right center-h center-vusu">
    <div class="child">
        <h2>Datos de <?php echo $this->session->user_data['first_name'];?></h2>
        <table border="1" width="2">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $this->session->user_data['first_name'];?></td>
                    <td><?php echo $this->session->user_data['last_name'];?></td>
                    <td><?php echo $this->session->user_data['email'];?></td>
                </tr>
            </tbody>
        </table>
        <br><br><br><br>
        <form id="myform" action="http://web/index.php/micuenta/cambiarpass" name="repassword" method="POST">
            <h3>Cambiar contraseña</h3>
            <span>Contraseña actual:</span>
            <input type="password" name="pass"/>
            <br><br>
            <span>Repite contraseña:</span>
            <input type="password" name="repass"/>
            <br><br>
            <span>NUEVA contraseña:</span>
            <input type="password" name="newpass"/>
            <span> (De al menos 8 caracteres)</span>
            <br><br>
            <input id="btncam" type="submit" value="Cambiar" name="camsubmit" class="btn-small"/>
        </form>
    </div>
</div>