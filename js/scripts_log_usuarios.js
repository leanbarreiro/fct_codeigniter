
//**********LOG************//

/***USUARIOS***/
$("#listlogusuarios").jqGrid({

    url: 'logusuarios/cargarDatosLogUsuarios',
    datatype: 'json',
    height: '100%',
    colNames:['Id','Usuario', 'Seccion', 'Accion', 'Cambios', 'Fecha'],
    colModel:[
        {name:'id',index:'id', width:80, align:"center",sorttype:"text", editoptions:{readonly:true,size:30}},
        {name:'usuario',index:'usuario', align:"center", width:220, editable:true, editoptions:{size:30}},
        {name:'seccion',index:'seccion', align:"center", width:220, editable:true, editoptions:{size:30}},
        {name:'accion',index:'accion', align:"center", width:100, editable:true, editoptions:{size:30}},
        {name:'cambios',index:'cambios', align:"left", width:700, editable:true, editoptions:{size:30}},
        {name:'fecha',index:'fecha', align:"center", width:180, editable:true, editoptions:{size:30}}
    ],
    rowNum: 20,
    rowList:[10,20,30,50],
    pager: '#pagerlogusuarios',
    sortname: 'id',
    viewrecords: true,
    rownumbers: true,
    sortorder: "desc",
    forceFit: true,
//    shrinkToFit: false,
//    multiselect: true,
//    grouping:true,
//    groupingView : {
//            groupField : ['usuario']
//    },
    caption: 'Tabla de Logs - Acciones de los usuarios sobre la tabla "usuarios"',
    editurl:"log_usuarios/gestionTablaLogUsuarios"
});

//    Llamamos al 'navigator' y le pasamos las opciones en cada caso especifico
$("#listlogusuarios").jqGrid('navGrid','#pagerlogusuarios',
    {add:false,edit:false,del:false},                                   //optiones generales
    {height:290,reloadAfterSubmit:true,closeAfterEdit:false},           //opc. de edición
    {height:290,reloadAfterSubmit:true,closeAfterAdd:true},             //opc. de añadido
    {width: 460,height:260,reloadAfterSubmit:true},                     //opc. de borrado
    {sopt:['eq','ne','lt','gt','bw','ew','cn'],closeAfterSearch:true}   //opc. de busqueda
);
