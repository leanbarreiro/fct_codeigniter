     
        <input class="btn-tabla" type="submit" name="actualizar" value="Actualizar">       
    </form>
    <br><hr><br>
    <form action='http://web/index.php/admin/addTable' method='post' style="overflow-x:auto;" class="simple-form" name="formularioaadd">
        <h2>Agregar datos</h2>
        <label class="cabtab">Nombre:</label>
        <input id="nomf" type="text" name="nomform" size="52" onkeyup="validarInput()" class="form-control"> 
        <span class="errorNombre" id="errorNombre"></span>
        <br><br>
        <label class="cabtab">URL:</label>
        <input id="urlf" type="text" name="urlform" size="56" onkeyup="validarInput()" class="form-control">
        <span class="errorUrl" id="errorUrl"></span>
        <br>
        <input class="btn-tabla" type="reset" name="borrar" value="Borrar">  
        <input id="addid" class="btn-tabla" type="submit" name="agregar" value="Agregar" disabled="disabled" onclick="valadd()"> 
    </form>
</div>
</div>