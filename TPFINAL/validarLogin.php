<?php
session_start();
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
$usu->usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
$usu->contrasena = (isset($_POST["contrasena"]) ? $_POST["contrasena"] : "");
$usu->nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");

$error = array();
$error["TodoBien"] = "";
$hayError = false;

if (isset($_POST['usuario'])) {
	$errorUsuario = validarDatoObligatorio($usu->usuario, "usuario");
	$errorContrasena = validarDatoObligatorio($usu->contrasena, "contrasena");

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


	if($hayError == false){
    $miUsuario = usuarioDao::traerUsuario($usu->usuario);
    if($miUsuario->contrasena==$usu->contrasena){
        $error["TodoBien"] = "NO HAY ERRORES";
        $_SESSION['usuarioLogueado'] = 'OK';
        $_SESSION['nombreUsuario'] = $usu->usuario;
    }
    else{
      $_SESSION['usuarioLogueado'] = 'ERROR';
      $existeUsuario = usuarioDao::verificarExistenciaUsuario($usu->usuario);
      if($existeUsuario){
        $error["errorContrasena"] = "Contraseña incorrecta";
      }
      else{
        $error["errorUsuario"] = "Usuario incorrecto";
        $error["errorContrasena"] = "Contraseña incorrecta";
      }
    }
	}
}

echo json_encode($error);
?>
