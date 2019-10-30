
$(document).ready(function() {
    
    //*********MENÚ**********//
    $("#list").jqGrid({

        url: 'adminjq/cargarDatosTabla',
        datatype: 'json',
        height: '100%',
        colNames:['Id','Nombre', 'Url', 'Descripción', 'Acceso',''],
        colModel:[
            {name:'id',index:'id',key:true, width:100, align:"right",sorttype:"text", editoptions:{readonly:true,size:30}},
            {name:'nombre',index:'nombre', align:"center", width:200, editable:true, editoptions:{size:30}},
            {name:'url',index:'url', align:"center", width:400, editable:true, editoptions:{size:30}},
            {name:'descripcion',index:'descripcion', align:"center", width:500, editable:true, editoptions:{size:30}},
            {name:'acceso',index:'acceso', align:"center", width:200, editable:true, editoptions:{size:30}},
            {name: 'myac', width:60, fixed:true, sortable:false, resize:false, formatter:'actions',formatoptions:{key:true}}
        ],
        rowNum: 10,
        rowList:[5,10,20,30],
        pager: '#pager',
        sortname: 'id',
        viewrecords: true,
        rownumbers: true,
        sortorder: "asc",
//        forceFit:true,
//        multiselect: true,
        caption: "Tabla de items del Menú",
        editurl:"adminjq/gestionTablaMenu"
    });
    
    //Llamamos al 'navigator' y le pasamos las opciones en cada caso especifico
    $("#list").jqGrid('navGrid','#pager',
        {edit:false,del:false},                                                                 //optiones generales
        {height:290,reloadAfterSubmit:true,closeAfterEdit:false},           //opc. de edición
        {height:290,reloadAfterSubmit:true,closeAfterAdd:true},             //opc. de añadido
        {width: 460,height:260,reloadAfterSubmit:true},                     //opc. de borrado
        {sopt:['eq','ne','lt','gt','bw','ew','cn'],closeAfterSearch:true}   //opc. de busqueda
    );
    
    //*******USUARIOS**********//
    $("#list_users").jqGrid({

        url: 'adminjq/cargarDatosUsu',
        datatype: 'json',
        height: '100%',
        colNames:['Id','Nombre', 'Apellidos', 'E-mail', 'Nivel', 'Ultimo archivo'],
        colModel:[
            {name:'user_id',index:'user_id',key:true, width:120, align:"right",sorttype:"text", editoptions:{readonly:true,size:30}},
            {name:'first_name',index:'first_name', align:"center", width:300, editable:true, editoptions:{size:30}},
            {name:'last_name',index:'last_name', align:"center", width:300, editable:true, editoptions:{size:30}},
            {name:'email',index:'email', align:"center", width:380, editable:true, editoptions:{size:30}},
            {name:'nivel',index:'nivel', align:"center", width:150, editable:true, editoptions:{size:30}},
            {name:'ultimo_archivo_subido',index:'ultimo_archivo_subido', align:"center", width:250, editable:false, editoptions:{size:30}},
        ],
        rowNum: 5,
        rowList:[5,10,15],
        pager: '#pager_users',
        sortname: 'user_id',
        viewrecords: true,
        sortorder: "asc",
        caption: "Tabla de Usuarios",
        editurl:"adminjq/gestionTablaUsers"
    });
    
    //Llamamos al 'navigator' y le pasamos las opciones en cada caso especifico
    $("#list_users").jqGrid('navGrid','#pager_users',
        {edit:true,del:true},                                                           //optiones generales
        {height:290,reloadAfterSubmit:true,closeAfterEdit:false},                       //opc. de edición
        {height:290,reloadAfterSubmit:true,closeAfterAdd:true},                         //opc. de añadido
        {width: 460,height:260,reloadAfterSubmit:true},                                 //opc. de borrado
        {sopt:['eq','ne','lt','gt','bw','ew','cn'],closeAfterSearch:true}               //opc. de busqueda
    )
    .navButtonAdd('#pager_users',{
        caption:"",
        id:"custom-edit", 
        buttonicon:"ui-icon-arrowthickstop-1-n", 
        onClickButton: function(){
            id = '';
            $('#list_users').find("tbody").find("tr[aria-selected=true]").find("td:first").each(function(){
                id+=$(this).html()+"\n";
            });
            $(location).attr('href','http://web/index.php/ficha_usuario?id='+id);           
        }, 
        position:"last"
     });
});
