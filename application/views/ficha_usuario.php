<script src="<?php base_url()?>/js/jquery.jqGrid.min.js"></script>
<script>
//    $(document).ready(function() {    
document.addEventListener("DOMContentLoaded", function(event) { 
   $("#list_fichausuario").jqGrid({

             url: 'ficha_usuario/cargarRepoUsuario?id=<?php echo($user_id);?>',
             datatype: 'json',
             colNames:['Id','Nombre','Nombre Original', 'Tipo', 'Ruta', 'Tamaño','Fecha', 'Accion'],
             colModel:[
                 {name:'id_archivo',index:'id_archivo',key:true, width:80, align:"right",sorttype:"text", editoptions:{readonly:true,size:30}},
                 {name:'nombre',index:'nombre', align:"center", width:180, editable:true, editoptions:{size:30}},
                 {name:'nombre_origen',index:'nombre_origen', align:"center", width:180, editable:true, editoptions:{size:30}},
                 {name:'tipo',index:'tipo', align:"center", width:250, editable:true, editoptions:{size:30}},
                 {name:'ruta',index:'ruta', align:"center", width:600, editable:true, editoptions:{size:30}},
                 {name:'size',index:'size', align:"center", width:100, editable:true, editoptions:{size:30}},
                 {name:'fecha',index:'fecha', align:"center", width:180, editable:true, editoptions:{size:30}},
                 {name: 'accion', index:'accion', width:70, align:"center", sortable:false }
             ],    
             gridComplete: function() {
                 var ids = jQuery("#list_fichausuario").jqGrid('getDataIDs');
                 for (var i = 0; i < ids.length; i++) {
                     var cl =  ids[i]; 
                     btnfile = '<input class="btn-small" style="height:90%; width:90%;" name="btn'+cl+'" type="submit" value="Abrir" onclick=\"window.location=\'http://web/index.php/ficha_usuario/mostrarPdf?id='+cl+'&idusu=<?php echo($user_id);?>\'\"  />';                              
//                     btnfile = '<input class="btn-small" style="height:90%; width:90%;" id="" name="'+cl+'" type="button" value="Abrir" onclick=\"<?php //$this->mostrarPdf();?>\"  />';                              
                     jQuery("#list_fichausuario").jqGrid('setRowData',ids[i],{accion:btnfile});
                 }
             },
             rowNum:10,
             pager: '#pager_fichausuario',
             sortname: 'id_archivo',
             autowidth: true,
             viewrecords: true,
             rownumbers: true,
             sortorder: "desc",
             caption: "Repositorio de Archivos",
             height: 500
         });
         jQuery("#list_fichausuario").jqGrid('navGrid',"#pager_fichausuario",{edit:false,add:false,del:false});
});
</script>

<section>
   <div class="form-usu">
        <div class="fcontenido">
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
        </div>
        <div class="tabla_archivos">
            <div>
                <table id="list_fichausuario"></table>
                <div id="pager_fichausuario"></div>
            </div>
        </div>
   </div>
</section>

