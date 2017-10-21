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

$usuario = array();
$usuario["nombre"] = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
$usuario["apellido"] = (isset($_POST["apellido"]) ? $_POST["apellido"] : "");
$usuario["email"] = (isset($_POST["email"]) ? $_POST["email"] : "");
$usuario["dni"] = (isset($_POST["documento"]) ? $_POST["documento"] : "");
$usuario["fechaNacimiento"] = (isset($_POST["fecha"]) ? $_POST["fecha"] : "");
$usuario["contraseña"] = (isset($_POST["contraseña"]) ? $_POST["contraseña"] : "");
$usuario["contraseña2"] = (isset($_POST["contraseña2"]) ? $_POST["contraseña2"] : "");


if (isset($_POST['nombre']) || isset($_POST['apellido']) || isset($_POST['mail']) || isset($_POST['documento']) || isset($_POST['fecha']) || isset($_POST['contraseña']) || isset($_POST['contraseña2'])) {
    $errorNombre = validarDatoObligatorio(trim($usuario["nombre"]), "nombre");
    if ($errorNombre == "") {
        $error["errorNombre"] = $errorNombre;
    }
    $errorApellido = validarDatoObligatorio(trim($usuario["apellido"]), "apellido");
    if ($errorApellido == "") {
        $error["errorApellido"] = $errorApellido;
    }
    $errorMail = validarDatoObligatorio(trim($usuario["email"]), "email");
    $errorContraseña = validarDatoObligatorio(trim($usuario["contraseña2"]), "contraseña");
    $errorContraseña2 = validarDatoObligatorio(trim($usuario["contraseña2"]), "repetir contraseña");

    if ($errorMail == "") {
        $emailValido = validarEmail($usuario["email"]);
        $error["errorMail"] = ($emailValido == false ? "E-mail inválido." : "");
    }
    $error["errorMail"] = $errorMail;

    $error["errorFecha"] = "";
    if ($usuario["fechaNacimiento"] != "") {
        $fechaValida = validarFecha($usuario["fechaNacimiento"]);
        $error["errorFecha"] = ($fechaValida == false ? "Fecha inválida." : "");
    }

    if ($errorContraseña == "") {
        if (strlen(trim($usuario["contraseña"])) < 6 || strlen(trim($usuario["contraseña"])) > 8) {
            $errorContraseña .= "La contraseña debe tener entre 6 y 8 caracteres.";
        }
        if (1 === preg_match('~[0-9]~', $usuario["contraseña"])) {
            
        } else {
            $errorContraseña .= "La contraseña debe poseer 1 número mínimamente.";
        }
    }
    $error["errorContraseña"] = $errorContraseña;


    $error["errorContraseña2"] = ($usuario["contraseña2"] != $usuario["contraseña"] ? "Las contraseñas no son iguales." : "");

    $errores = "";
    foreach ($error as $value) {
        $errores .= $value;
    }


    $error["TodoBien"] = ($errores == "" ? "Todo bien lince" : "");


    echo json_encode($error);

    if ($error["TodoBien"] == "Todo bien lince") {
        require 'conexion.php';
        insertarPersona($usuario);
    }
}

function insertarPersona($usuario) {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "prueba";

    try {
        $DBH = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "INSERT INTO persona (nombre, apellido, email, dni, fechaNacimiento, contrasena)
        VALUES (:nombre, :apellido, :email, :dni, :fechaNacimiento, :contrasena)";
        $STH = $DBH->prepare($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        $params = array(
        ":nombre" => $usuario["nombre"],
        ":apellido" => $usuario["apellido"],
        ":email" => $usuario["email"],
        ":dni" => $usuario["dni"],
        ":fechaNacimiento" => $usuario["fechaNacimiento"],
        ":contrasena" => $usuario["contraseña"],
        
        );
        $STH->execute($params);
    } catch (PDOException $e) {
        echo $query . "<br>" . $e->getMessage();
    }

    $conn = null;
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