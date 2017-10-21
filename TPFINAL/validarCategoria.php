<?php

include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/model/categoria.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/categoriaDao.php');


function validarDatoObligatorio($dato, $nombreCampo) {
    $mensajeError = "";
    if ($dato == "") {
        $mensajeError = "El campo " . $nombreCampo . " es obligatorio";
    }
    return $mensajeError;
}

$cat = new categoria();
$cat->id = (isset($_POST["id"]) ? $_POST["id"] : "");
$cat->nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");

$error = array();
$error["TodoBien"] = "";

if (isset($_POST['nombre'])) {
    $errorNombre = validarDatoObligatorio(trim($cat->nombre), "nombre");
    if ($errorNombre == "") {
		$error["TodoBien"] = "NO HAY ERRORES";
    }
	else{
		$error["errorNombre"] = $errorNombre;
	}
    
	if ($error["TodoBien"] == "NO HAY ERRORES") {
        if($cat->id == ""){
            $cat->id = NULL;
        }
        categoriaDao::agregarModificarCategoria($cat);
    }
}

echo json_encode($error);
?>