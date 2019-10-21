
$(document).ready(function() {
  
    //Menú
    $("#list").jqGrid({

        url: 'adminjq/cargarDatosTabla',
        datatype: 'json',
        height: 280,
        colNames:['Id','Nombre', 'Url', 'Descripción', 'Acceso'],
        colModel:[
            {name:'id',index:'id', width:100, align:"right",sorttype:"text", editoptions:{readonly:true,size:30}},
            {name:'nombre',index:'nombre', align:"center", width:200, editable:true, editoptions:{size:30}},
            {name:'url',index:'url', align:"center", width:400, editable:true, editoptions:{size:30}},
            {name:'descripcion',index:'descripcion', align:"center", width:400, editable:true, editoptions:{size:30}},
            {name:'acceso',index:'acceso', align:"center", width:200, editable:true, editoptions:{size:30}}
        ],
        rowNum: 10,
        rowList:[5,10,20,30],
        pager: '#pager',
        sortname: 'id',
        viewrecords: true,
        rownumbers: true,
        sortorder: "asc",
        multiselect: true,
        caption: "Tabla de items del Menú",
        editurl:"adminjq/gestionTablaMenu"
    });
    
    //Llamamos al 'navigator' y le pasamos las opciones en cada caso especifico
    $("#list").jqGrid('navGrid','#pager',
        {},                                                                 //optiones generales
        {height:290,reloadAfterSubmit:true,closeAfterEdit:false},           //opc. de edición
        {height:290,reloadAfterSubmit:true,closeAfterAdd:true},             //opc. de añadido
        {width: 460,height:260,reloadAfterSubmit:true},                     //opc. de borrado
        {sopt:['eq','ne','lt','gt','bw','ew','cn'],closeAfterSearch:true}   //opc. de busqueda
    );
    
    //Usuarios
    $("#list_users").jqGrid({

        url: 'adminjq/cargarDatosUsu',
        datatype: 'json',
        height: 150,
        colNames:['Id','Nombre', 'Apellidos', 'E-mail', 'Nivel'],
        colModel:[
            {name:'user_id',index:'user_id', width:100, align:"right",sorttype:"text", editoptions:{readonly:true,size:30}},
            {name:'first_name',index:'first_name', align:"center", width:300, editable:true, editoptions:{size:30}},
            {name:'last_name',index:'last_name', align:"center", width:400, editable:true, editoptions:{size:30}},
            {name:'email',index:'email', align:"center", width:400, editable:true, editoptions:{size:30}},
            {name:'nivel',index:'nivel', align:"center", width:140, editable:true, editoptions:{size:30}}
        ],
        rowNum: 5,
        rowList:[5,10,15],
        pager: '#pager_users',
        sortname: 'user_id',
        viewrecords: true,
        rownumbers: true,
        sortorder: "asc",
//        multiselect: true,
        caption: "Tabla de Usuarios",
        editurl:"adminjq/gestionTablaUsers"
    });
    
    //Llamamos al 'navigator' y le pasamos las opciones en cada caso especifico
    $("#list_users").jqGrid('navGrid','#pager_users',
        {},                                                                 //optiones generales
        {height:290,reloadAfterSubmit:true,closeAfterEdit:false},           //opc. de edición
        {height:290,reloadAfterSubmit:true,closeAfterAdd:true},             //opc. de añadido
        {width: 460,height:260,reloadAfterSubmit:true},                     //opc. de borrado
        {sopt:['eq','ne','lt','gt','bw','ew','cn'],closeAfterSearch:true}   //opc. de busqueda
    );
    
});
