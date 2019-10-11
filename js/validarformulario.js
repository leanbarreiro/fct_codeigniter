 
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


function validar(){

        params = Validar.arguments;
        var f = params[0];
        
//        pass = document.getElementById(pass);        
//        repass = document.getElementById(repass);
//        newpass = document.getElementById(newpass);
//        
//	if (dato.value=="enviar" && clave1 == clave2){
//		alert("Enviando el formulario");
//		formulario.submit();
//		return true;
//	} else {
//		alert("No se envía el formulario");
//		return false;
//	}
}
