<?php
include_once("model/producto.php");
include_once("Dao/ProductoDao.php");
$pro = new producto();
$pro->Nombre = (isset($_POST['Nombre']) ? $_POST['Nombre'] : '');
$pro->Codigo = (isset($_POST['Codigo']) ? $_POST['Codigo'] : '');
$pro->Precio = (isset($_POST['Precio']) ? $_POST['Precio'] : '');
$pro->Id = (isset($_POST['id']) ? $_POST['id'] : NULL);

$vector = array();
$vector["HayError"] = 0;

$vector = Validar($pro->Nombre,$pro->Codigo,$pro->Precio,$vector, $pro->Id);
if($vector["HayError"] == 0){
	if($pro->Id == ''){
		ProductoDao::Crear($pro);
	}else{
		ProductoDao::Editar($pro);
	}
}

echo json_encode($vector);

function Validar($Nombre, $Codigo, $Precio, $vector, $Id){
	if(trim($Nombre) == ''){
		$vector["errornombre"] = 'Debe completar el campo Nombre';
		$vector["HayError"] = 1;
	}
	$tof = ProductoDao::ValidarCodigo($Codigo, $Id);
	if(trim($Codigo) == ''){
		$vector["errorcodigo"] =  'Debe completar el campo Codigo ';
		$vector["HayError"] = 1;
	}elseif ($tof == 1) {
		$vector["errorcodigo"] =  'Este codigo ya existe';
		$vector["HayError"] = 1;
	}
	if(trim($Precio) < 1){
		$vector["errorprecio"] = 'El precio debe ser mayor a 0 php';
		$vector["HayError"] = 1;
	}


	return $vector;
}
?>
