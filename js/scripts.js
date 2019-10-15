
jQuery("#list").jqGrid({
    
    url: 'adminjq/cargarDatosTabla',
    datatype: 'json',
    height: 250,
    colNames:['Id','Nombre', 'Url'],
    colModel:[
        {name:'Id',index:'Id', width:100,align:"right", sorttype:"int"},
        {name:'Nombre',index:'Nombre asc',align:"center", width:200},
        {name:'Url',index:'Url',align:"center", width:400}             		
    ],
    rowNum: 10,
    rowList:[10,20,30],
    pager: '#pager',
    sortname: 'id',
    viewrecords: true,
    sortorder: "desc",
    caption: "Tabla de Items del Menú"
});


jQuery("#list").jqGrid('navGrid','#pager',{
    edit:false, add:false, del:false
});


  
