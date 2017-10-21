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

$usuario = array();
$usuario["id"] = (isset($_POST["id"]) ? $_POST["id"] : "");
$usuario["nombre"] = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
$usuario["apellido"] = (isset($_POST["apellido"]) ? $_POST["apellido"] : "");
$usuario["email"] = (isset($_POST["email"]) ? $_POST["email"] : "");


if (isset($_POST['nombre']) || isset($_POST['apellido']) || isset($_POST['mail']) ) {
    $errorNombre = validarDatoObligatorio(trim($usuario["nombre"]), "nombre");
    if ($errorNombre == "") {
        $error["errorNombre"] = $errorNombre;
    }
    $errorApellido = validarDatoObligatorio(trim($usuario["apellido"]), "apellido");
    if ($errorApellido == "") {
        $error["errorApellido"] = $errorApellido;
    }
    $errorMail = validarDatoObligatorio(trim($usuario["email"]), "email");

    if ($errorMail == "") {
        $emailValido = validarEmail($usuario["email"]);
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
        require 'conexion.php';
        insertarPersona($usuario);
    }
}

function insertarPersona($usuario) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db";
	if ($usuario["id"]==""){
		$usuario["id"]=NULL;
	}
    try {
        $DBH = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query="INSERT INTO Personas SET idPersonas = :idPersonas, Nombre=:nombre, Apellido=:apellido, Email=:email ON DUPLICATE KEY UPDATE idPersonas = :idPersonas, Nombre=:nombre, Apellido=:apellido, Email=:email";
        $STH = $DBH->prepare($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        $params = array(
        ":idPersonas" => $usuario["id"],
		":nombre" => $usuario["nombre"],
        ":apellido" => $usuario["apellido"],
        ":email" => $usuario["email"],
        
        );
        $STH->execute($params);
    } catch (PDOException $e) {
        echo $query . "<br>" . $e->getMessage();
    }

    $conn = null;
}
?>