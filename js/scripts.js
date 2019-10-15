
$("#list").jqGrid({
    
    url: 'adminjq/cargarDatosTabla?q=2',
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
    multiselect: true,
//    multikey: "ctrlKey",
    caption: "Tabla de Items del Menú",
    editurl:"someurl.php"
});

$("#cm1").click( function() {
	var s;
	s = jQuery("#list").jqGrid('getGridParam','selarrrow');
	alert(s);
});

$("#cm1s").click( function() {
	jQuery("#list").jqGrid('setSelection',"13");
});

$("#list").jqGrid('navGrid','#pager',
    {}, //options
    {height:280,reloadAfterSubmit:false}, // edit options
    {height:280,reloadAfterSubmit:false}, // add options
    {reloadAfterSubmit:false}, // del options
    {sopt:['cn','bw','eq','ne','lt','gt','ew']} // search options
);

//$("#list").jqGrid('navGrid','#pager',{add:false,edit:false,del:false},
//	{}, // edit parameters
//	{}, // add parameters
//	{reloadAfterSubmit:false} //delete parameters
//);
//$("#list").jqGrid('inlineNav',"#pager");



