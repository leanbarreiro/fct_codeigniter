
$(document).ready(function() {

    $("#list").jqGrid({

        url: 'adminjq/cargarDatosTabla',
        datatype: 'json',
        height: 250,
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
//        loadonce:true,
        sortorder: "asc",
        multiselect: true,
//        multikey: "ctrlKey",
        caption: "Tabla de Items del Menú",
        editurl:"adminjq/gestionTablaMenu"
    });

    $("#list").jqGrid('navGrid','#pager',
        {},                                                                 //options
        {height:260,reloadAfterSubmit:true,closeAfterEdit:false},           // edit options
        {height:260,reloadAfterSubmit:true,closeAfterAdd:true},             // add options
        {width: 460,height:260,reloadAfterSubmit:true},                                // del options
        {sopt:['eq','ne','lt','gt','bw','ew','cn'],closeAfterSearch:true}   // search options
    );
    

});
