<?php

function validarDatoObligatorio($dato, $nombreCampo) {
    $mensajeError = "";
    if ($dato == "") {
        $mensajeError = "El campo " . $nombreCampo . " es obligatorio";
    }
    return $mensajeError;
}

function validarEmail($mail) {
    $emailValido = true;

    $posarroba = strpos($mail, "@");
    $emailCortado = substr($mail, $posarroba + 1);
    if ($posarroba != false) {
        if (strlen($emailCortado) > 1) {
            $caracter = substr($emailCortado, 0, 1);
            if (is_numeric($caracter) == false && ctype_alpha($caracter) == false) {
                $emailValido = false;
            } else {
                if (strpos($emailCortado, ".") == false) {
                    $emailValido = false;
                }
            }
        } else {
            $emailValido = false;
        }
    } else {
        $emailValido = false;
    }
    return $emailValido;
}

function validarFecha($fecha) {
    $fechaValida = true;

    $fechaCortada = explode("/", $fecha);
    if (count($fechaCortada) !== 3) {
        $fechaValida = false;
    } else {
        $dia = $fechaCortada[0];
        $mes = $fechaCortada[1];
        $año = $fechaCortada[2];

        if (is_numeric($dia) && is_numeric($mes) && is_numeric($año)) {
            if (strlen($dia) == 2 && strlen($mes) == 2 && strlen($año) == 4) {
                $fechaValida = checkdate($mes, $dia, $año);
            } else {
                $fechaValida = false;
            }
        } else {
            $fechaValida = false;
        }
    }
    if ($fechaValida == false) {
        $errorFecha = "Fecha inválida. El formato debe ser el siguiente: dd/mm/yyyy";
    }
    return $fechaValida;
}

$nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
$apellido = (isset($_POST["apellido"]) ? $_POST["apellido"] : "");
$mail = (isset($_POST["email"]) ? $_POST["email"] : "");
$dni = (isset($_POST["documento"]) ? $_POST["documento"] : "");
$fechaNacimiento = (isset($_POST["fecha"]) ? $_POST["fecha"] : "");
$contraseña = (isset($_POST["contraseña"]) ? $_POST["contraseña"] : "");
$contraseña2 = (isset($_POST["contraseña2"]) ? $_POST["contraseña2"] : "");


if (isset($_POST['nombre']) || isset($_POST['apellido']) || isset($_POST['mail']) || isset($_POST['documento']) || isset($_POST['fecha']) || isset($_POST['contraseña']) || isset($_POST['contraseña2'])) {
    $errorNombre = validarDatoObligatorio(trim($nombre), "nombre");
    if ($errorNombre == "") {
        $error["errorNombre"] = $errorNombre;
    }
    $errorApellido = validarDatoObligatorio(trim($apellido), "apellido");
    if ($errorApellido == "") {
        $error["errorApellido"] = $errorApellido;
    }
    $errorMail = validarDatoObligatorio(trim($mail), "email");
    $errorContraseña = validarDatoObligatorio(trim($contraseña), "contraseña");
    $errorContraseña2 = validarDatoObligatorio(trim($contraseña2), "repetir contraseña");

    if ($errorMail == "") {
        $emailValido = validarEmail($mail);
        $error["errorMail"] = ($emailValido == false ? "E-mail inválido." : "");
    }
    $error["errorMail"] = $errorMail;

    $error["errorFecha"] = "";
    if ($fechaNacimiento != "") {
        $fechaValida = validarFecha($fechaNacimiento);
        $error["errorFecha"] = ($fechaValida == false ? "Fecha inválida." : "");
    }

    if ($errorContraseña == "") {
        if (strlen(trim($contraseña)) < 6 || strlen(trim($contraseña)) > 8) {
            $errorContraseña .= "La contraseña debe tener entre 6 y 8 caracteres.";
        }
        if (1 === preg_match('~[0-9]~', $contraseña)) {
            
        } else {
            $errorContraseña .= "La contraseña debe poseer 1 número mínimamente.";
        }
    }
    $error["errorContraseña"] = $errorContraseña;


    $error["errorContraseña2"] = ($contraseña2 != $contraseña ? "Las contraseñas no son iguales." : "");

    $errores = "";
    foreach ($error as $value) {
        $errores .= $value;
    }


    $error["TodoBien"] = ($errores == "" ? "Todo bien lince" : "");


    echo json_encode($error);
}

/*
  $contnum=0;
  for($i=0;$i<strlen(trim($nombre);$i++)
  {
  $letra=substr(trim($nombre),$i,1);
  if(is_numeric($letra))
  {
  $contnum++;
  }
  }
 */
?>