
$(document).ready(function() {

    $("#list").jqGrid({

        url: 'adminjq/cargarDatosTabla',
        datatype: 'json',
        height: 250,
        colNames:['Id','Nombre', 'Url'],
        colModel:[
            {name:'id',index:'id', width:100, align:"right", sorttype:"text", editable:true},
            {name:'nombre',index:'nombre', align:"center", width:200, editable:true},
            {name:'url',index:'url', align:"center", width:400, editable:true}             		
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
        {},                                                                                     //options
        {height:260,readonly:true,size:30,reloadAfterSubmit:true,closeAfterEdit:false},         // edit options
        {height:260,size:30,reloadAfterSubmit:true,closeAfterAdd:true},                         // add options
        {height:260,size:30,reloadAfterSubmit:true},                                            // del options
        {sopt:['eq','ne','lt','gt','bw','ew','cn'],closeAfterSearch:true}                       // search options
    );
    

});
