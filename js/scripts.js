
$(document).ready(function() {
  

    $("#list").jqGrid({

        url: 'adminjq/cargarDatosTabla',
        datatype: 'json',
        height: 280,
        colNames:['Id','Nombre', 'Url'],
        colModel:[
            {name:'id',index:'id', width:100, align:"right", sorttype:"text", editoptions:{readonly:true,size:30}},
            {name:'nombre',index:'nombre', align:"center", width:200, editable:true, editoptions:{size:30}},
            {name:'url',index:'url', align:"center", width:400, editable:true, editoptions:{size:30}}             		
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
        {height:260,reloadAfterSubmit:true,closeAfterEdit:false},           //opc. de edición
        {height:260,reloadAfterSubmit:true,closeAfterAdd:true},             //opc. de añadido
        {width: 460,height:260,reloadAfterSubmit:true},                     //opc. de borrado
        {sopt:['eq','ne','lt','gt','bw','ew','cn'],closeAfterSearch:true}   //opc. de busqueda
    );
    
});
