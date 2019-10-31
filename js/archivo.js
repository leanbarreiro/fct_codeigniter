

$(document).ready(function() {
    
    //*********FICHA DE USUARIO**********//
    $("#list_fichausuario").jqGrid({

        url: 'ficha_usuario/cargarRepoUsuario',
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
//            {name:'documento',index:'documento', align:"center", width:200, editable:true, editoptions:{size:30}},
            {name: 'accion', index:'accion', width:70, align:"center", sortable:false }
        ],    
        gridComplete: function() {
//            var grid = jQuery("#list_fichausuario");
            var ids = jQuery("#list_fichausuario").jqGrid('getDataIDs');
            for (var i = 0; i < ids.length; i++) {
                
                var cl =  ids[i];
                btnfile = "<input class='btn-small' style='height:90%; width:90%;' id='' type='button' value='Ver' onclick=\"jQuery('#list_fichausuario');\"  />";
//                btnfile = "<input type='image' name='btnfile' src='img/pdf.png' onclick=\"jQuery('#list_fichausuario').editRow('"+cl+"');\"  />";
                jQuery("#list_fichausuario").jqGrid('setRowData',ids[i],{accion:btnfile});
            }
        },
        rowNum:10,
        pager: '#pager_fichausuario',
        sortname: 'id',
        autowidth: true,
        viewrecords: true,
        rownumbers: true,
        sortorder: "desc",
//        forceFit:true,
        caption: "Repositorio de Archivos",
        height: 500
    });
    
    jQuery("#list_fichausuario").jqGrid('navGrid',"#pager_fichausuario",{edit:false,add:false,del:false});

});