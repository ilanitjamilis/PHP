<?php
include_once("model/producto.php");
class ProductoDao{
  public static function Crear($producto){
    $DBH = new PDO("mysql:host=localhost;dbname=db", "root", "root");
    $query = 'INSERT INTO productos (nombre,codigo,precio) values (:nombre,:codigo,:precio)';
  	$params = array(
  	  ":nombre" => $producto->Nombre,
  	  ":codigo" => $producto->Codigo,
  		":precio" => $producto->Precio,
  	);
    $STH = $DBH->prepare($query);
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    $STH->execute($params);
  }
  public static function ValidarCodigo($CodigoAValidar, $Id){
    // Create connection
    $DBH = new PDO("mysql:host=localhost;dbname=db", "root", "root");

    $sql = "SELECT id,codigo FROM productos";
    $STH = $DBH->prepare($sql);
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    $STH->execute();
    $result = $STH->fetchAll();

    $lista = array();
    $tof = 0;
    foreach ($result as &$valor){
		if($Id != $valor["id"]){
			if($CodigoAValidar == $valor["codigo"]){
				$tof = 1;
			}
		}
	}
	return $tof;
}
  public static function Editar($producto){
    $DBH = new PDO("mysql:host=localhost;dbname=db", "root", "root");
    $query = "UPDATE productos SET nombre=:nombre, codigo=:codigo, precio=:precio WHERE Id=:id";
    $params = array(
      ":id" =>  $producto->Id,
      ":nombre" => $producto->Nombre,
      ":codigo" => $producto->Codigo,
      ":precio" => $producto->Precio,
    );
    $STH = $DBH->prepare($query);
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    $STH->execute($params);
  }
  public static function Listar(){

    // Create connection
    $DBH = new PDO("mysql:host=localhost;dbname=db", "root", "root");

    $sql = "SELECT id,codigo, nombre FROM productos";
    $STH = $DBH->prepare($sql);
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    $STH->execute();
    $result = $STH->fetchAll();

    $lista = array();
    $i=0;
    foreach ($result as &$valor){
      $pro = new producto();

      $pro->Nombre = $valor["nombre"];
      $pro->Codigo = $valor["codigo"];
      $pro->Id = $valor["id"];

      $lista[$i]=$pro;
      $i++;
  }
  return $lista;
}
  public static function Eliminar($Id){

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "db";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM productos WHERE id=".$Id;
    $result = $conn->query($sql);
  }
}
?>
