 
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

//function valadd() {
////    var t = document.getElementById("alerta").innerHTML = "¡SE HAN AÑADIDO LOD DATOS CORRECTAMENTE!";
//}