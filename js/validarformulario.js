 
 window.onload = function () {
     
    document.formupass.addEventListener('submit',validar);

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

function validar(evObject){

    evObject.preventDefault();
    var todobien = true;
    var formulario = document.formupass;
    for (var i=0; i<formulario.length; i++) {
        if(formulario[i].type =='password') {
            if (formulario[i].value == null || formulario[i].value.length == 0 || /^\s*$/.test(formulario[i].value)){
                document.getElementById("error").innerHTML = "¡Los campos NO pueden estar vacíos!";
                todobien=false;
            }
        }
    }
    
    if (document.getElementById('pass').value != document.getElementById('repass').value ) {
        document.getElementById("error").innerHTML = "¡Las contraseñas NO coinciden!";
        todobien=false;
    } else if (document.getElementById('newpass').value.length > 5 ) {
        document.getElementById("error").innerHTML = "¡Las contraseña debe tener al menos 6 caracteres!";
        todobien=false;
    }
   
    if (todobien === true) {formulario.submit()};
}

