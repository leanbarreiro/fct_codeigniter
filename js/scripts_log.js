
//**********LOG************//

$("#listlog").jqGrid({

    url: 'log_usuarios/cargarDatosLog',
    datatype: 'json',
    height: '100%',
    colNames:['Id','Usuario', 'Seccion', 'Accion', 'RespuestaGet', 'RespuestaPost', 'Fecha'],
    colModel:[
        {name:'id',index:'id', width:100, align:"right",sorttype:"text", editoptions:{readonly:true,size:30}},
        {name:'usuario',index:'usuario', align:"center", width:200, editable:true, editoptions:{size:30}},
        {name:'seccion',index:'seccion', align:"center", width:200, editable:true, editoptions:{size:30}},
        {name:'accion',index:'accion', align:"center", width:200, editable:true, editoptions:{size:30}},
        {name:'respuestaget',index:'respuestaget', align:"left", width:280, editable:true, editoptions:{size:30}},
        {name:'respuestapost',index:'respuestapost', align:"left", width:280, editable:true, editoptions:{size:30}},
        {name:'fecha',index:'fecha', align:"center", width:200, editable:true, editoptions:{size:30}}
    ],
    rowNum: 20,
    rowList:[10,20,30,50],
    pager: '#pagerlog',
    sortname: 'id',
    viewrecords: true,
    rownumbers: true,
    sortorder: "desc",
    forceFit: true,
//    multiselect: true,
//   	grouping:true,
//   	groupingView : {
//   		groupField : ['usuario']
//   	},
    caption: "Tabla de Log - Acciones de los Usuarios",
    editurl:"log_usuarios/gestionTablaLog"
});

//    Llamamos al 'navigator' y le pasamos las opciones en cada caso especifico
$("#listlog").jqGrid('navGrid','#pagerlog',
    {add:false,edit:false,del:false},                                   //optiones generales
    {height:290,reloadAfterSubmit:true,closeAfterEdit:false},           //opc. de edición
    {height:290,reloadAfterSubmit:true,closeAfterAdd:true},             //opc. de añadido
    {width: 460,height:260,reloadAfterSubmit:true},                     //opc. de borrado
    {sopt:['eq','ne','lt','gt','bw','ew','cn'],closeAfterSearch:true}   //opc. de busqueda
);
