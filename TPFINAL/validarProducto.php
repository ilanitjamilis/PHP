<?php

include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/model/categoria.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/categoriaDao.php');

include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/model/producto.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/productoDao.php');


function validarDatoObligatorio($dato, $nombreCampo) {
    $mensajeError = "";
    if ($dato == "") {
        $mensajeError = "El campo " . $nombreCampo . " es obligatorio";
    }
    return $mensajeError;
}


$prod = new producto();
$prod->id = (isset($_POST["id"]) ? $_POST["id"] : "");
$prod->idCategoria = (isset($_POST["categoria"]) ? $_POST["categoria"] : "");
$prod->codigo = (isset($_POST["codigo"]) ? $_POST["codigo"] : "");
$prod->nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
$prod->precio = (isset($_POST["precio"]) ? $_POST["precio"] : "");
$prod->destacado = (isset($_POST["destacado"]) ? $_POST["destacado"] : "");
$prod->descripcion = (isset($_POST["descripcion"]) ? $_POST["descripcion"] : "");
$prod->imagen = (isset($_POST["imagen"]) ? $_POST["imagen"] : "");

$error = array();
$error["TodoBien"] = "";
$hayError = false;

if (isset($_POST['nombre'])) {
	$errorCategoria = validarDatoObligatorio($prod->idCategoria, "categoria");
	$errorCodigo = validarDatoObligatorio($prod->codigo, "código");
	$errorNombre = validarDatoObligatorio(trim($prod->nombre), "nombre");
	$errorPrecio = validarDatoObligatorio($prod->precio, "precio");
	$errorDestacado = validarDatoObligatorio($prod->destacado, "destacado");
	$errorDescripcion = validarDatoObligatorio($prod->descripcion, "descripcion");
	$errorImagen = validarDatoObligatorio($prod->imagen, "imagen");
	
	if($prod->idCategoria<1){
		$error["errorCategoria"] = "Seleccione categoría";
		$hayError = true;
	}
	else{
		$error["errorCategoria"] = "";
	}
	
	
	if ($errorCodigo != "") {
		$error["errorCodigo"] = $errorCodigo;
		$hayError = true;
    }
	else{
		$errorCodigo = productoDao::validarCodigo($prod->codigo, $prod->id);
		if($errorCodigo == 1){
			$error["errorCodigo"] = "El código ya existe";
			$hayError = true;
		}
		else{
			$error["errorCodigo"] = "";
		}
	}
	
    if ($errorNombre != "") {
		$error["errorNombre"] = $errorNombre;
		$hayError = true;
    }
	else{
		$error["errorNombre"] = "";
	}
	
	if ($errorPrecio != "") {
		$error["errorPrecio"] = $errorPrecio;
		$hayError = true;
    }
	else{
		$error["errorPrecio"] = "";
	}
	
	if($prod->destacado<1){
		$error["errorDestacado"] = "Seleccione destacado";
		$hayError = true;
	}
	else{
		$error["errorDestacado"] = "";
	}
	
	
	if ($errorDescripcion != "") {
		$error["errorDescripcion"] = $errorDescripcion;
		$hayError = true;
    }
	else{
		$error["errorDescripcion"] = "";
	}
	
	/*if ($errorImagen != "") {
		$error["errorImagen"] = $errorImagen;
		$hayError = true;
    }*/
	$error["errorImagen"] = "";
	
	if($hayError == false){
		$error["TodoBien"] = "NO HAY ERRORES";
		if($prod->id == ""){
            $prod->id = NULL;
        }
        productoDao::agregarModificarProducto($prod);
	}
}

echo json_encode($error);
?>