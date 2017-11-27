<?php
  session_start();
  include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/usuarioDao.php');
  include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/model/usuario.php');
  include_once ('header.html');
?>

<script>

  var error;

  function validar(){
    var labelsError = $(".error");
    for (x in labelsError){
      labelsError[x].html = "";
    }

    error = false;

    var usuario = $("#usuario").val();
    var contrasena = $("#contrasena").val();

    if(usuario==""){
      $("#errorUsuario").text("El usuario es obligatorio");
      error = true;
    }
    else{
      $("#errorUsuario").text("");
    }

    if(contrasena==""){
      $("#errorContrasena").text("La contraseña es obligatoria");
      error = true;
    }
    else{
      $("#errorContrasena").text("");
    }

    if(error==false){
      $.ajax({
      async:true,
      type: "POST",
      url: "validarLogin.php",
      data:$("#formPrincipal").serialize(),
      success: function (input) {        
          //Cuando hay errores aca en AJAX comentar todo lo de abajo y hacer un alert del imput (es la respuesta)
          //alert(input);

          var errores = JSON.parse(input);

          if(errores["TodoBien"] == "NO HAY ERRORES"){
            window.location = "backend.php?usuarioUsuario="+usuario;
          }
          else{
            var i = -1;
            for (x in errores){
              if(i>=0){
                labelsError[i].innerHTML=(errores[x]);
              }
              i++;
            }
          }
        }
      });
    }
  }

</script>

<h2>Ingresa</h2><br/>

<form action="validarLogin.php" method="POST" id="formPrincipal" enctype="multipart/form-data">

  <label for="usuario">Usuario:</label>
  <input type="text" name="usuario" id="usuario" />
  <label class="error" id="errorUsuario"></label> </br></br>

  <label for="contrasena">Contraseña:</label>
  <input type="password" name="contrasena" id="contrasena" />
  <label class="error" id="errorContrasena"></label> </br></br>

  <input type="button" id="btnEnviar" name="btnEnviar" value="ENTRAR" onclick="validar();" />

</form><br/>

<a href="http://localhost/TPFINAL/Usuario-Form.php">Regístrate</a><br/>

<?php include ('footer.html'); ?>
