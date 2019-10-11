 
 window.onload = function () {
     
    document.formularioadd.addEventListener('submit', validarFormulario);
}


function validarInput() {

  var text1 = document.getElementById("nomf");
  var text2 = document.getElementById("urlf");
  if(text1.value != "" && text2.value != ""){
      document.getElementById("addid").disabled = "";  
  }else{
    document.getElementById("addid").disabled = "disabled"; 
  }
}
function validarInputLista() {

//  var text1 = document.getElementById("nomf");
//  var text2 = document.getElementById("urlf");
//  if(text1.value != "" && text2.value != ""){
//      document.getElementById("addid").disabled = "";  
//  }else{
//    document.getElementById("addid").disabled = "disabled"; 
//  }
}

//function comprobarClave(){
//    clave1 = document.repassword.clave1.value
//    clave2 = document.repassword.clave2.value
//
//    if (clave1 == clave2)
//       alert("Las dos claves son iguales...\nRealizaríamos las acciones del caso positivo")
//    else
//       alert("Las dos claves son distintas...\nRealizaríamos las acciones del caso negativo")
//}

//function enviar(){
//	var formulario = document.getElementById("myform");	
//	var dato = formulario[0];
//        var clave1 = document.repassword.clave1.value;
//        var clave2 = document.repassword.clave2.value;
// 
//	if (dato.value=="enviar" && clave1 == clave2){
//		alert("Enviando el formulario");
//		formulario.submit();
//		return true;
//	} else {
//		alert("No se envía el formulario");
//		return false;
//	}
//}