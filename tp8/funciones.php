<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . '/tp8/model/persona.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/tp8/dao/personaDao.php');

$personaDao = new personaDao(); //porque pusimos cosas importantes en el constructor

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

$persona = new persona();
$persona->id = (isset($_POST["id"]) ? $_POST["id"] : "");
$persona->nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
$persona->apellido = (isset($_POST["apellido"]) ? $_POST["apellido"] : "");
$persona->mail = (isset($_POST["email"]) ? $_POST["email"] : "");


if (isset($_POST['nombre']) || isset($_POST['apellido']) || isset($_POST['mail']) ) {
    $errorNombre = validarDatoObligatorio(trim($persona->nombre), "nombre");
    if ($errorNombre == "") {
        $error["errorNombre"] = $errorNombre;
    }
    $errorApellido = validarDatoObligatorio(trim($persona->apellido), "apellido");
    if ($errorApellido == "") {
        $error["errorApellido"] = $errorApellido;
    }
    $errorMail = validarDatoObligatorio(trim($persona->mail), "email");

    if ($errorMail == "") {
        $emailValido = validarEmail($persona->mail);
        $error["errorMail"] = ($emailValido == false ? "E-mail inválido." : "");
    }
    $error["errorMail"] = $errorMail;

    $errores = "";
    foreach ($error as $value) {
        $errores .= $value;
    }


    $error["TodoBien"] = ($errores == "" ? "Todo bien lince" : "");


    echo json_encode($error);

    if ($error["TodoBien"] == "Todo bien lince") {
        if($persona->id == ""){
            $persona->id = NULL;
        }
        personaDao::agregarModificarPersona($persona);
    }
}
?>