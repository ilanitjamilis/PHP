<?php

include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/model/usuario.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/usuarioDao.php');


function validarDatoObligatorio($dato, $nombreCampo) {
    $mensajeError = "";
    if ($dato == "") {
        $mensajeError = "El campo " . $nombreCampo . " es obligatorio";
    }
    return $mensajeError;
}


$usu = new usuario();
$usu->id = (isset($_POST["id"]) ? $_POST["id"] : "");
$usu->nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
$usu->usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
$usu->contrasena = (isset($_POST["contrasena"]) ? $_POST["contrasena"] : "");

$error = array();
$error["TodoBien"] = "";
$hayError = false;

if (isset($_POST['nombre'])) {
	$errorNombre = validarDatoObligatorio($usu->nombre, "nombre");
  $errorUsuario = validarDatoObligatorio($usu->usuario, "usuario");
  $errorContrasena = validarDatoObligatorio($usu->contrasena, "contraseña");

  if ($errorNombre != "") {
	$error["errorNombre"] = $errorNombre;
	$hayError = true;
  }
	else{
		$error["errorNombre"] = "";
	}

  if ($errorUsuario != "") {
  	$error["errorUsuario"] = $errorUsuario;
  	$hayError = true;
  }
	else{
		$error["errorUsuario"] = "";
	}

  if ($errorContrasena != "") {
  	$error["errorContrasena"] = $errorContrasena;
  	$hayError = true;
  }
	else{
		$error["errorContrasena"] = "";
	}

  $error["errorContrasena2"] = "";

  $existeUsuario = usuarioDao::verificarExistenciaUsuario($usu->usuario);
  if ($existeUsuario) {
  	$error["errorUsuario"] = "Usuario no disponible";
  	$hayError = true;
  }
	else{
		$error["errorUsuario"] = "";
	}


	if($hayError == false){
		$error["TodoBien"] = "NO HAY ERRORES";
		if($usu->id == ""){
      $usu->id = NULL;
    }
    usuarioDao::agregarModificarUsuario($usu);
  }
}

echo json_encode($error);

?>
