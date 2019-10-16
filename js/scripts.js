
$(document).ready(function() {

    $("#list").jqGrid({

        url: 'adminjq/cargarDatosTabla',
        datatype: 'json',
        height: 250,
        colNames:['Id','Nombre', 'Url'],
        colModel:[
            {name:'Id',index:'Id', width:100, align:"right", sorttype:"text", editable:true, editoptions:{readonly:true,size:30}},
            {name:'Nombre',index:'Nombre', align:"center", width:200, editable:true, editoptions:{size:30}},
            {name:'Url',index:'Url', align:"center", width:400, editable:true, editoptions:{size:30}}             		
        ],
        rowNum: 10,
        rowList:[5,10,20,30],
        pager: '#pager',
        sortname: 'id',
        viewrecords: true,
//        loadonce:true,
        sortorder: "asc",
        multiselect: true,
//        multikey: "ctrlKey",
        caption: "Tabla de Items del Menú",
        editurl:"adminjq/gestionTablaMenu"
    });

    $("#list").jqGrid('navGrid','#pager',
        {},                                                         //options
        {height:260,reloadAfterSubmit:true,closeAfterEdit:true},    // edit options
        {height:260,reloadAfterSubmit:true,closeAfterAdd:true},     // add options
        {height:260,reloadAfterSubmit:true},     // del options
        {sopt:['eq','ne','lt','gt','bw','ew','cn']}                 // search options
    );
    

});
